<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormRoleAnswerer;
use App\Models\FormRoleEditor;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Inertia\ResponseFactory;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\NoReturn;

class FormController extends Controller
{
    private bool $validationFailed = false;

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
     * @param Form $form Form to be edited in the view
     * @return Response|ResponseFactory
     */
    #[NoReturn] public function edit(Form $form): Response|ResponseFactory
    {
        return inertia('Form/Edit', [
            'form' => $this->generateForm($form)
        ]);
    }

    /**
     * From source form, it generates needed form object, and it sends it to the view.
     * It adds required variables for Vue.
     *
     * @param Form $srcForm source Form from where to generate the new Form
     * @return array
     */
    #[NoReturn] #[ArrayShape([
        'id' => "mixed",
        'name' => "mixed",
        'description' => "mixed",
        'published' => "false",
        'editors' => "array",
        'sections' => "array"
    ])]
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

        // get the rols that can edit the form
        $srcFormEditors = $srcForm->canBeEditedBy()->get();

        $formEditors = [];

        // save them in the new form container
        foreach ($srcFormEditors as $srcEditor) {
            $formEditors[] = $srcEditor->name;
            // $formEditors[] = $srcEditor->id; fer-ho per nom o id?
        }

        $form['editors'] = $formEditors;

        // fer el mateix amb els form answerers

        dd($form);
        return $form;
    }

    /**
     * Returns the view to answer parsed form.
     *
     * @param Form $form Form to be answered in the view
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
     * Recursively validates the request (Form -> Sections -> Questions).
     * Stores (creates or updates) Form object, its sections and its questions.
     *
     * Note that IDs can be null or integer.
     * If IDs are null, means that they are new objects (create),
     * otherwise it understands that they are existent objects (update)
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // get the form from the request
        $form = $request->get('form');

        $this->validateStoreForm($form);

        if ($this->validationFailed) {
            dd($this->validationFailed);

            return redirect()
                ->back()
                ->with('message', $this->validationFailed);
        } else {
            dd("validation succeed");

            return redirect()
                ->route('home')
                ->with('message', 'validation succeed');
        }
    }

    /**
     * Validates parsed form and stores it in the database.
     * It also calls the method that validates and stores the form sections.
     *
     * @param array $form form to be validated and stored
     * @return void
     * @throws ValidationException
     */
    private function validateStoreForm(array $form)
    {
        // validate the form
        $validator = Validator::make($form, [
            'id' => ['present', 'nullable', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'published' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            $this->validationFailed = 'validation failed - form';
        } else {
            // retrieve the validated input
            $validated = $validator->validated();

            $validated['user_id'] = Auth::id() || 0; // todo -> remove " || 0" when end developing

            $formId = $form['id'];

            // if the form id is null
            if (blank($formId)) {
                $formObj = Form::create($validated);

                $formId = $formObj->id;
            } else {
                Form::where('id', '=', $formId)
                    ->update($validated);
            }

            // get and validate form editors and answerers
            $this->validateStoreFormRoles($form['roles']['edit'], 'editors', $formId);
            $this->validateStoreFormRoles($form['roles']['answer'], 'answerers', $formId);

            // get and validate sections and their questions
            $this->validateStoreSections($form['sections'], $formId);
        }
    }

    /**
     * Validates parsed form roles and stores them in the database.
     * Depending on type, updates role editors or answerers.
     * If type is editors, uses FormRoleEditor model.
     * If type is answerers, uses FormRoleAnswerer model.
     *
     * @param array $formRoles roles of the form to be validated and stored
     * @param string $type type of form role to be updated (editors or answerers)
     * @param int $formId form id where the roles belong to
     * @return void
     * @throws ValidationException
     */
    private function validateStoreFormRoles(array $formRoles, string $type, int $formId)
    {
        foreach ($formRoles as $formRole) {
            // validate the roles
            $validator = Validator::make($formRole, [
                'id' => ['required', 'integer'],
                'name' => ['required', 'string'],
                'deleted' => ['required', 'boolean'],
            ]);

            if ($validator->fails()) {
                $this->validationFailed = 'validation failed - role ' . $type;
            } else {
                // retrieve the validated input
                $validated = $validator->validated();

                // check type of roles (editors or answerers)
                if ($type == 'editors') {
                    if ($validated['deleted']) {
                        FormRoleEditor::where('form_id', '=', $formId)
                            ->where('role_id', '=', $validated['id'])
                            ->delete();
                    } else {
                        FormRoleEditor::create([
                            'form_id' => $formId,
                            'role_id' => $validated['id'],
                        ]);
                    }
                } else if ($type == 'answerers') {
                    if ($validated['deleted']) {
                        FormRoleAnswerer::where('form_id', '=', $formId)
                            ->where('role_id', '=', $validated['id'])
                            ->delete();
                    } else {
                        FormRoleAnswerer::create([
                            'form_id' => $formId,
                            'role_id' => $validated['id'],
                        ]);
                    }
                } else {
                    $this->validationFailed = 'validation failed - role ' . $type;
                    return;
                }
            }
        }
    }

    /**
     * Validates parsed sections and stores them in the database.
     * It also calls the method that validates and stores the sections questions.
     *
     * @param $sections array sections to be validated and stored
     * @param int $formId form id where the sections belong to
     * @return void
     * @throws ValidationException
     */
    private function validateStoreSections(array $sections, int $formId)
    {
        foreach ($sections as $section) {
            // validate the section
            $validator = Validator::make($section, [
                'id' => ['present', 'nullable', 'integer'],
                'name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                $this->validationFailed = 'validation failed - section';
                return;
            } else {
                // retrieve the validated input
                $validated = $validator->validated();

                $validated['form_id'] = $formId;
                $validated['user_id'] = Auth::id() || 0; // todo -> remove " || 0" when end developing

                $sectionId = $section['id'];

                // if the section id is null
                if (blank($sectionId)) {
                    $sectionObj = Section::create($validated);

                    $sectionId = $sectionObj->id;
                } else {
                    Section::where('id', '=', $sectionId)
                        ->update($validated);
                }

                // get the section questions
                $questions = $section['questions'];

                // validate the questions
                $this->validateStoreQuestions($questions, $sectionId);
            }
        }
    }

    /**
     * Validates parsed questions and stores them in the database
     *
     * @param $questions array questions to be validated and stored
     * @param int $sectionId section id where the questions belong to
     * @return void
     * @throws ValidationException
     */
    private function validateStoreQuestions(array $questions, int $sectionId)
    {
        foreach ($questions as $question) {
            // convert array to JSON
            if (Arr::exists($question, 'content')) {
                $question['content'] = json_encode($question['content']);
            }

            // validate the question
            $validator = Validator::make($question, [
                'id' => ['present', 'nullable', 'integer'],
                'name' => ['required', 'string'],
                'type' => ['required', 'string'],
                'content' => ['required', 'json']
            ]);

            if ($validator->fails()) {
                $this->validationFailed = 'validation failed - question';
                return;
            } else {
                // retrieve the validated input
                $validated = $validator->validated();

                $validated['section_id'] = $sectionId;

                if ($validated['content'] == '[]') {
                    $validated['content'] = '{}';
                }

                $questionId = $question['id'];

                // if the question id is null
                if (blank($questionId)) {
                    Question::create($validated);
                } else {
                    Question::where('id', '=', $questionId)
                        ->update($validated);
                }
            }
        }
    }
}
