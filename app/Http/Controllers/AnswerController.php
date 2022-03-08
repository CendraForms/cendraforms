<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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


    public function getAnswerView(Answer $answer)
    {
        
        return view('Answer/answer', ['answer' => $answer]);
    }
    
}
