<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class QuestionController extends Controller
{
    // todo: function to get all questions - getAll()
    // todo: function to create a question - create()

    public function getQuestions()
    {
         return Question::get();
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
    public function get(Question $question)
    {

        $question=Question::get();

        return $question;
    }

    public function createQuestion (Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);
        $question = new Question();
        $question->name = $validated['name'];
        if (isset($validated['active'])) {
            $question->active = $validated['active'];
        }
        $question->save();

        return $question;
    }



    public function getQuestionView(Question $question)
    {
        return view('Questions/question', ['question' => $question]);
    }


    /**
     * Updates parsed Question
     *
     * @param Request $request recipe parameters post
     * @param Question $question Question id
     * @return JSON updated question
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);
      
        $question->update($validated);

        return $question;
    }

    /**
     * Deletes parsed Question
     * 
     * @param Question $question Question to be deleted
     * @return Response JSON response with status code
     */
    public function delete(Question $question)
    {
        $question->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }

    public function getQuestionsView()
    {
        $question = $this->getQuestions();

        return view('questions.questions', ['question' => $question]);
    }
}
