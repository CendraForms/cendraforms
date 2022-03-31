<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormRoleAnswerer;
use App\Models\FormRoleEditor;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Inertia\ResponseFactory;

class FormController extends Controller
{
    /**
     * Returns the view to create a form.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Form/Create');
    }

    /**
     * Returns the view to edit parsed form.
     *
     * @param Form $form Form to be edited in the view.
     * @return Response|ResponseFactory
     */
    public function edit(Form $form): Response|ResponseFactory
    {
        return inertia('Form/Edit', [
            'form' => $this->generateForm($form)
        ]);
    }

    /**
     * From source form, it generates needed form object, and it sends it to the view.
     * It adds required variables for Vue.
     *
     * @param Form $srcForm source Form from where to generate the new Form.
     * @return array
     */
    private function generateForm(Form $srcForm): array
    {
        // start building new form container
        $form = [
            'id' => $srcForm->id,
            'name' => $srcForm->name,
            'description' => $srcForm->description,
            'published' => false,
        ];

        // get source form's sections
        $srcSections = $srcForm->sections()->get();

        // create new sections container
        $sections = [];

        foreach ($srcSections as $srcSection) {
            // build new section
            $section = [
                'id' => $srcSection->id,
                'name' => $srcSection->name,
                'visible' => true,
                'collapsed' => true,
                'locked' => true,
                'deleted' => false,
            ];

            // get source section's questions
            $srcQuestions = $srcSection->questions;

            // create new questions container
            $questions = [];

            foreach ($srcQuestions as $srcQuestion) {
                // build new question
                $question = [
                    'id' => $srcQuestion->id,
                    'name' => $srcQuestion->name,
                    'type' => $srcQuestion->type,
                    'visible' => true,
                    'deleted' => false,
                    'content' => $srcQuestion->content,
                ];

                // save new question to new questions container
                $questions[] = $question;
            }

            // save new questions to new section container
            $section['questions'] = $questions;

            // save new section to new sections container
            $sections[] = $section;
        }

        // save new sections to new form container
        $form['sections'] = $sections;

        // get the roles that can edit the form
        $srcFormEditors = $srcForm->canBeEditedBy()->get();

        $formEditors = [];

        // save them in the new form container
        foreach ($srcFormEditors as $srcEditor) {
            $formEditors[] = $srcEditor->name;
            // $formEditors[] = $srcEditor->id; fer-ho per nom o id?
        }

        $form['editors'] = $formEditors;

        // todo: fer el mateix amb els form answerers

        dd($form);
        return $form;
    }

    /**
     * Returns the view to answer parsed form.
     *
     * @param Form $form Form to be answered in the view.
     * @return Response|ResponseFactory
     */
    public function answer(Form $form): Response|ResponseFactory
    {
        // todo -> send $form to view!
        return inertia('Form/Answer');
    }

    /**
     * Manages the request and calls required methods to validate
     * and store the objects into the database.
     *
     * Collects the request (Form object).
     * Validates the request (Form / FormRoles / Sections / Questions).
     * Stores (creates, updates or deletes) Form object, its sections, its questions and its roles.
     *
     * Note that IDs can be null or integer.
     * If IDs are null, means that they are new objects (create),
     * otherwise it understands that they are existent objects (update).
     *
     * Some objects can also be deleted.
     * An object will be deleted if it has deleted field set to true.
     *
     * @param Request $request Request to be validated and stored
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::id()) {
            return redirect()
                ->back()
                ->with('validationErrors', 'user must be authenticated');
        }

        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('validationErrors', $validator->errors());
        }

        $this->storeValidatedForm($validator->validated()['form']);

        $mode = $validator->validated()['form']['id'] == null ? "created" : "updated";

        return redirect()
            ->route('home')
            ->with('message', 'form ' . $mode . ' successfully');
    }

    /**
     * Validates parsed request.
     * It checks all nested objects and fields.
     *
     * @param Request $request Validated request.
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateRequest(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), [
            'form.id' => ['present', 'nullable', 'integer'],
            'form.name' => ['required', 'string', 'min:3', 'max:255'],
            'form.description' => ['required', 'string', 'max:1000'],
            'form.published' => ['required', 'boolean'],

            'form.roles' => ['required', 'array', 'min:1'],
            'form.sections' => ['required', 'array', 'min:1'],

            'form.roles.edit' => ['required', 'array', 'min:1'],
            'form.roles.edit.*.id' => ['required', 'integer'],
            'form.roles.edit.*.name' => ['required', 'string'],
            'form.roles.edit.*.deleted' => ['required', 'boolean'],

            'form.roles.answer' => ['required', 'array', 'min:1'],
            'form.roles.answer.*.id' => ['required', 'integer'],
            'form.roles.answer.*.name' => ['required', 'string'],
            'form.roles.answer.*.deleted' => ['required', 'boolean'],

            'form.sections.*.id' => ['present', 'nullable', 'integer'],
            'form.sections.*.name' => ['required', 'string'],
            'form.sections.*.deleted' => ['required', 'boolean'],

            'form.sections.*.questions.*.id' => ['present', 'nullable', 'integer'],
            'form.sections.*.questions.*.name' => ['required', 'string'],
            'form.sections.*.questions.*.type' => ['required', 'string'],
            'form.sections.*.questions.*.content' => ['present', 'array'],
            'form.sections.*.questions.*.deleted' => ['required', 'boolean'],
        ]);
    }

    /**
     * Stores validated form and nested objects (create, update or delete).
     * It understands that parsed form is already validated.
     * This method must be called after retrieving the validated form, otherwise will fail.
     *
     * @param array $validatedForm Validated form to be stored.
     * @return void
     */
    private function storeValidatedForm(array $validatedForm)
    {
        // store form
        $formToBeStored = [
            'name' => $validatedForm['name'],
            'description' => $validatedForm['description'],
            'user_id' => Auth::id(),
            'published' => $validatedForm['published'],
        ];

        $formId = $validatedForm['id'];

        // if the form id is null
        if (blank($formId)) {
            $formObj = Form::create($formToBeStored);

            $formId = $formObj->id;
        } else {
            Form::where('id', '=', $formId)
                ->update($formToBeStored);
        }

        // store form editors
        $formEditors = $validatedForm['roles']['edit'];

        foreach ($formEditors as $formEditor) {
            if ($formEditor['deleted']) {
                FormRoleEditor::where('form_id', '=', $formId)
                    ->where('role_id', '=', $formEditor['id'])
                    ->delete();
            } else {
                FormRoleEditor::create([
                    'form_id' => $formId,
                    'role_id' => $formEditor['id'],
                ]);
            }
        }

        // store form answerers
        $formAnswerers = $validatedForm['roles']['answer'];

        foreach ($formAnswerers as $formAnswerer) {
            if ($formAnswerer['deleted']) {
                FormRoleAnswerer::where('form_id', '=', $formId)
                    ->where('role_id', '=', $formAnswerer['id'])
                    ->delete();
            } else {
                FormRoleAnswerer::create([
                    'form_id' => $formId,
                    'role_id' => $formAnswerer['id'],
                ]);
            }
        }

        // store sections
        $sections = $validatedForm['sections'];

        foreach ($sections as $section) {
            $sectionId = $section['id'];

            if ($section['deleted']) {
                Section::where('id', '=', $sectionId)->delete();
            } else {
                $sectionToBeStored = [
                    'name' => $section['name'],
                    'form_id' => $formId,
                    'user_id' => Auth::id(),
                ];

                // if the section id is null
                if (blank($sectionId)) {
                    $sectionObj = Section::create($sectionToBeStored);

                    $sectionId = $sectionObj->id;
                } else {
                    Section::where('id', '=', $sectionId)
                        ->update($sectionToBeStored);
                }
            }

            $questions = $section['questions'];

            // store questions
            foreach ($questions as $question) {
                if ($question['deleted']) {
                    Question::where('deleted', '=', $question['id'])->delete();
                } else {
                    $questionToBeStored = [
                        'name' => $question['name'],
                        'type' => $question['type'],
                        'content' => json_encode($question['content']),
                        'section_id' => $sectionId,
                    ];

                    $questionId = $question['id'];

                    // if the question id is null
                    if (blank($questionId)) {
                        Question::create($questionToBeStored);
                    } else {
                        Question::where('id', '=', $questionId)
                            ->update($questionToBeStored);
                    }
                }
            }
        }
    }
}
