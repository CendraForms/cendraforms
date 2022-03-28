<?php

namespace App\Http\Controllers;

use App\Models\Form;
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
    public function create()
    {
        return inertia('Form/Create');
    }

    /**
     * Returns the view to edit parsed form.
     *
     * @param Form $form Form to be edited in the view
     * @return Response|ResponseFactory
     */
    public function edit(Form $form)
    {
        return inertia('Form/Edit', [
            'form' => $this->generateFormObject($form)
        ]);
    }

    /**
     * From source form, it generates needed form object, and it sends it to the view.
     * It adds required variables for Vue.
     *
     * @param Form $srcForm source Form from where to generate the new Form
     * @return array
     */
    private function generateFormObject(Form $srcForm)
    {
        // start building new form container
        $form = [];
        $form['id'] = $srcForm->id;
        $form['name'] = $srcForm->name;
        $form['description'] = $srcForm->description;
        $form['published'] = false;

        // get source form's sections
        $srcSections = $srcForm->sections()->get();

        // create new sections container
        $sections = [];

        foreach ($srcSections as $srcSection) {
            // build new section
            $section = [];
            $section['id'] = $srcSection->id;
            $section['name'] = $srcSection->name;
            $section['visible'] = true;
            $section['collapsed'] = true;
            $section['locked'] = true;
            $section['deleted'] = false;

            // get source section's questions
            $srcQuestions = $srcSection->questions;

            // create new questions container
            $questions = [];

            foreach ($srcQuestions as $srcQuestion) {
                // build new question
                $question = [];
                $question['id'] = $srcQuestion->id;
                $question['name'] = $srcQuestion->name;
                $question['type'] = $srcQuestion->type;
                $question['visible'] = true;
                $question['deleted'] = false;
                $question['content'] = $srcQuestion->content;

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

        // todo -> això dels roles està ben fet? no s'hauria d'iterar en comptes de fer-ho així?
        $roles = [];

        $edit = [];
        $edit[] = 'Direcció';
        $edit[] = 'Professor';

        $answer = [];
        $answer[] = 'Alumne';

        $roles['edit'] = $edit;
        $roles['answer'] = $answer;

        $form['roles'] = $roles;

        dd($form);
        return $form;
    }

    /**
     * Returns the view to answer parsed form.
     *
     * @param Form $form Form to be answered in the view
     * @return Response|ResponseFactory
     */
    public function answer(Form $form)
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
    public static function store(Request $request): RedirectResponse
    {
        // get the form from the request
        $form = $request->get('form');

        self::validateAndStoreForm($form);

        return redirect()
            ->route('home')
            ->with('message', 'validation succeed');
    }

    /**
     * Validates parsed form and stores it in the database.
     * It also calls the method that validates and stores the form sections.
     *
     * @param $form array form to be validated and stored
     * @return RedirectResponse|void
     * @throws ValidationException
     */
    private static function validateAndStoreForm(array $form)
    {
        // validate the form
        $validator = Validator::make($form, [
            'id' => ['present', 'nullable', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'published' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('message', 'validation failed - form');
        } else {
            // retrieve the validated input
            $validated = $validator->validated();

            $validated['user_id'] = Auth::id();

            $formId = $form['id'];

            // if the form id is null
            if (blank($formId)) {
                $formObj = Form::create($validated);

                $formId = $formObj->id;
            } else {
                Form::where('id', '=', $formId)
                    ->update($validated);
            }

            // get the form sections
            $sections = $form['sections'];

            // validate the sections and their questions
            self::validateAndStoreSections($sections, $formId);
        }
    }

    /**
     * Validates parsed sections and stores them in the database.
     * It also calls the method that validates and stores the sections questions.
     *
     * @param $sections array sections to be validated and stored
     * @param $formId integer form id where the sections belong to
     * @return RedirectResponse|void
     * @throws ValidationException
     */
    private static function validateAndStoreSections(array $sections, int $formId)
    {
        foreach ($sections as $section) {
            // validate the section
            $validator = Validator::make($section, [
                'id' => ['present', 'nullable', 'integer'],
                'name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->with('message', 'validation failed - section');
            } else {
                // retrieve the validated input
                $validated = $validator->validated();

                $validated['form_id'] = $formId;
                $validated['user_id'] = Auth::id();

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
                self::validateAndStoreQuestions($questions, $sectionId);
            }
        }
    }

    /**
     * Validates parsed questions and stores them in the database
     *
     * @param $questions array questions to be validated and stored
     * @param $sectionId integer section id where the questions belong to
     * @return RedirectResponse|void
     * @throws ValidationException
     */
    private static function validateAndStoreQuestions(array $questions, int $sectionId)
    {
        foreach ($questions as $question) {
            // convert array to JSON
            $question['content'] = json_encode($question['content']);

            // validate the question
            $validator = Validator::make($question, [
                'id' => ['present', 'nullable', 'integer'],
                'name' => ['required', 'string'],
                'type' => ['required', 'string'],
                'content' => ['required', 'json']
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->with('message', 'validation failed - question');
            } else {
                // retrieve the validated input
                $validated = $validator->validated();

                $validated['section_id'] = $sectionId;

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
