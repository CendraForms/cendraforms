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
}
