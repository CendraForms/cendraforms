<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function Index()
    {
        //
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
    /**
     * Returns specified answer object
     *
     * @param Answer $answer specified answer id
     */
    public function getAnswer(Answer $answer)
    {
        return $answer;

        //In Future
        //return view('');
    }
}
