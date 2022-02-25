<?php

namespace App\Http\Controllers;
use App\Models\Question;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function Index()
    {
        //
    }
    public function getQuestion(Question $question)
    {
        
        return $question;
    }
}
