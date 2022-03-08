<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class QuestionController extends Controller
{
    // todo: function to get all questions - getQuestions()
    // todo: function to create a question - createQuestion()

    /**
     * Returns specified question object
     *
     * @param Question $question specified question id
     */
    public function getQuestion(Question $question)
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

    /**
     * Update Question
     *
     * @param Request $request recipe parameters post
     * @param Integer $id question id
     */
    public function updateQuestion(Request $request, Question $question)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);

        $question->name = $validated['name'];
        $question->content = $validated['content'];
        
        if (isset($validated['active'])) {
            $question->active = $validated['active'];
        }

        $question->save();

        return $question;
    }

    /**
     * Delete question
     * 
     * @param Question $question question to be deleted
     * @return Response response JSON with status code
     */
    public function deleteQuestion(Question $question)
    {
        $question->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }
}
