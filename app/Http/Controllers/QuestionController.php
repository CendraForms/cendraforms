<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class QuestionController extends Controller
{
    // todo: function to get all questions - getAll()
    // todo: function to create a question - create()

    public function index()
    {
        return view('questions.index', [
            'questions' => Question::get()
        ]);
    }

    public function create()
    {
        return view('questions.create');

    }

    public function edit(Question $questions)
    {
        return view('questions.edit', [
            'questions' => $questions
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:30'],
        'content' => ['required','string','max:1000'],
        'active' => ['required', 'boolean'],
    ]);

        Question::create($validated);

        return redirect()->route('questions.index')->with('success', 'Pregunta creada.');
    }

    

    public function getQuestions()
    {
        return Question::get();
    }

    /**
     * Gets specified Question object
     *
     * @param Question $question Question id
     * @return JSON obtained question
     */
    public function get(Question $questions)
    {

        $questions=Question::get();

        return $questions;
    }

    public function createQuestions (Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);
        $questions = new Question();
        $questions->name = $validated['name'];
        if (isset($validated['active'])) {
            $questions->active = $validated['active'];
        }
        $questions->save();

        return $questions;
    }

    public function getQuestionsView(Question $questions)
    {
        return view('Questions/questions', ['questions' => $questions]);
    }


    /**
     * Updates parsed Question
     *
     * @param Request $request recipe parameters post
     * @param Question $question Question id
     * @return JSON updated question
     */
    public function update(Request $request, Question $questions)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);
      
        $questions->update($validated);

        return $questions;
    }

    /**
     * Deletes parsed Question
     *
     * @param Question $question Question to be deleted
     * @return Response JSON response with status code
     */
    public function destroy(Question $questions)
    {
        $questions->delete();

        return redirect()->route('questions.index')->with('success', 'Pregunta eliminada.');

    }

    
}
