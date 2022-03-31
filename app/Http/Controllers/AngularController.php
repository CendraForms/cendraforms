<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Role;
use Carbon\Carbon;

class AngularController extends Controller
{
     /**
     * Et diu el nombre de forms.
     */
    public static function countForms()
    {
        return Form::get();
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

    public function getRoles()
    {
        $roles = array();
        $totals = array();
        foreach(Role::get() as $role){
            $roles[] = $role->name;
            $totals[] = $role->users->count();
        }

        return array(array($roles),array($totals));
    }

    public function GetLast10Days()
    {
        $start_date = Carbon::now();
        $end_date = Carbon::now();
       


        $last_1days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date])->count();
        $last_2days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_3days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_4days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_5days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_6days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_7days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_8days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_9days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();
        $last_10days = Form::whereBetween('created_at', [$start_date->subDays(1), $end_date->subDays(1)])->count();

        $array = array(array( $last_10days, $last_9days, $last_8days, $last_7days, $last_6days, $last_5days, $last_4days, $last_3days, $last_2days, $last_1days));
        $final = array(array("test","test","test","test","test","test","test","test","test"));
        echo json_encode(array($final,$array));
        die();
    }
}