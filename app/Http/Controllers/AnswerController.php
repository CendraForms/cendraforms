<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    // todo: function to get specific answer - get()
    // todo: function to create a answer - create()
    // todo: function to update a answer - update()

    /**
     * Gets all answers
     *
     * @return JSON All obtained answers
     */
    public static function getAll()
    {
        return Answer::get();
    }

    /**
     * Delete answer
     *
     * @param Answer $answer answer to be deleted
     * @return Response response JSON with status code
     */
    public function delete(Answer $answer)
    {
        $answer->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }

    /**
     * Returns all answers
     *
     * @return JSON
     */
    public static function getAnswers()
    {
        return Answer::get();
        //In Future
        //return view('');
    }

    public function getAnswerView(Answer $answer)
    {
        
        return view('Answer/answer', ['answer' => $answer]);
    }

    public function update(Request $request, Answer $answer)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ]);

        $answer->content = $validated['content'];

        if (isset($validated['active'])) {
            $answer->active = $validated['active'];
        }

        $answer->save();

        return $answer;
    }

    public function create(Request $request)
    {    
            
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'question_id' => ['required', 'integer', 'max:255'],
            'active' => ['required', 'boolean'],
        ]);

        $answer = new Answer();

        $answer->content = $validated['content'];
        $answer->question_id = $validated['question_id'];
        $answer->user_id = Auth::id();

        $answer->save();

        return redirect()->route('/answers')->with('success', 'answer creat.');
    }

   public function CreateAnswerView() {
    return view('Answer/Createanswer');
   }

    public function getAnswersView()
    {
        $answers = $this->getAnswers();

        return view('answers.answers', ['answers' => $answers]);
    }
    
    /**
     * Returns specified answer object
     *
     * @param Answer $answer specified answer id
     */
    public function get(Answer $answer)
    {
        return $answer;

        //In Future
        //return view('');
    }

}
