<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class AngularController extends Controller
{
     /**
     * Et diu el nombre de forms.
     */
    public static function countForms()
    {
        return Form::get()->count();
    }
     /**
     * Et diu el nombre de usuaris.
     */
    public static function countUsers()
    {
        return User::get()->count();
    }
    /**
     * Et diu el nombre de preguntes.
     */

    public function countQuestions()
    {
        return Question::get()->count();
    }

    public function countAnswers()
    {
        return Answer::get()->count();
    }
}
