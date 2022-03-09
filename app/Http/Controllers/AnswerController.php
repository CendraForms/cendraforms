<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

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
}
