<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use Inertia\Inertia;

class FormController extends Controller
{
    public function create()
    {
        return inertia('Form/Create');
    }

    public function answer(Form $form)
    {
        return inertia('Form/Answer');
    }


    /**
     * Gets all forms
     *
     * @return JSON All obtained forms
     */
    public static function getAll()
    {
        return Form::get();
    }

    /**
     * Gets specified Form object
     *
     * @param Form $form Form id
     * @return JSON obtained form
     */
    public function get(Form $form)
    {
        return $form;
    }

    public function index()
    {
        return view('forms.index', [
            'forms' => Form::get()
        ]);
    }

    // public function create()
    // {
    //     return view('forms.create');
    // }

    /**
     * Generate the form object and send it to the vue component that lets the user edit the form.
     *
     * @param Form $form Form model
     * @return Inertia view inertia
     */
    public function edit(Form $form)
    {
        $formulari = $this->getFormEdit($form);

        // return view inertia
        return Inertia::render('Form/Edit', [
            'form' => $formulari,
        ]);

        // return view('forms.edit', [
        //     'form' => $form
        // ]);
    }

    /**
     * Get Form object
     *
     * @param Form $form Form model
     * @return Object object form
     */
    private function getFormEdit(Form $form)
    {
        // create object form
        $formulari = [];

        // assign form id, name and description
        $formulari['id'] = $form->id;
        $formulari['name'] = $form->name;
        $formulari['description'] = $form->description;
        $formulari['published'] = false;

        // get a sections to the form
        $sections = $form->sections()->get();

        // create object sections
        $sections2 = [];
        $comptador = 1;
        foreach ($sections as $section) {
            // create object section
            $section2 = [];
            // assign section id, name, visible, collapsed, locked and deleted
            $section2['id'] = $section->id;
            $section2['name'] = $section->name;
            $section2['visible'] = true;
            $section2['collapsed'] = false;
            $section2['locked'] = false;
            $section2['deleted'] = false;

            // get a questions to the section
            $questions = $section->questions;

            // create object questions
            $questions2 = [];
            $comptador2 = 1;
            foreach ($questions as $question) {
                // create object question
                $question2 = [];
                // assign question id, name, type, visible, deleted and content
                $question2['id'] = $question->id;
                $question2['name'] = $question->name;
                $question2['type'] = $question->type;
                $question2['visible'] = true;
                $question2['deleted'] = false;
                $question2['content'] = $question->content;

                // assign question to questions
                $questions2[$comptador2] = $question2;
                $comptador2++;
            }

            // assign section questions
            $section2['questions'] = $questions2;

            // assign section to sections
            $sections2[$comptador] = $section2;
            $comptador++;
        }
        // assign sections form
        $formulari['sections'] = $sections2;



        $roles2 = [];
        $edit2 = [];
        $edit2[0] = 'Direcció';
        $edit2[1] = 'Professor';
        $answer2 = [];
        $answer2[0] = 'Alumne';

        $roles2['edit'] = $edit2;
        $roles2['answer'] = $answer2;
        $formulari['roles'] = $roles2;

        // return object form
        return $formulari;
    }

    /**
     * Creates a new Form
     *
     * @param Request $request recipe parameters post
     * @return JSON created form
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:255', 'unique:forms'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['required', 'boolean'],
        ]);

        $validated['user_id'] = Auth::id();

        Form::create($validated);

        return redirect()->back()->with('success', 'Formulari Creat.');
    }

    /**
     * Updates parsed Form
     *
     * @param Request $request recipe parameters post
     * @param Form $form Form id
     * @return JSON updated form
     */
    public function update(Request $request, Form $form)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['sometimes', 'boolean'],
        ]);

        $form->update($validated);

        return redirect()->back()->with('success', 'Formulari Actualitzat.');
    }

    /**
     * Deletes parsed Form
     *
     * @param Form $form Form to be deleted
     * @return Response JSON response with status code
     */
    public function delete(Form $form)
    {
        $form->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }

    public function updateFormView(Form $form)
    {
        return view('forms.formsupdate', ['forms' => $form]);
    }

    public function getFormView(Form $form)
    {

        return view('Form/form', ['form' => $form]);
    }

    public function getFormsView()
    {
        $forms = $this->getForms();

        return view('forms.forms', ['forms' => $forms]);
    }
}
