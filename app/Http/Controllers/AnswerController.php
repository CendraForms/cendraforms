<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Delete answer
     *
     * @param Answer $answer answer to be deleted
     * @return Response response JSON with status code
     */
    public function deleteAnswer(Answer $answer)
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

    public function updateAnswer(Request $request, Answer $answer)
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
