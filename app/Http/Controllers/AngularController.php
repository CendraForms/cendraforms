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

    public function getRoles()
    {
        $roles=array();
        $totals = array();
        $contador =0;
        foreach(Role::get() as $role){
            $contador+=1;
            $roles[] = array($role->name);
            $totals[] = $role->users->count();
        }
        $resultat=array(array($roles),array($totals));
    
        return array(array($roles),array($totals));
    }

    public function GetLast10Days()
    {
        $avui=Carbon::parse(Carbon::now())->format('y-m-d');
        $start_date = Carbon::now()->format('Y-m-d');
        $end_date = Carbon::now();
   
        $last_1days = Form::whereDate('created_at', '=', Carbon::parse($avui))->count();
        $last_2days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(1))->count();
        $last_3days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(2))->count();
        $last_4days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(3))->count();
        $last_5days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(4))->count();
        $last_6days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(5))->count();
        $last_7days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(6))->count();
        $last_8days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(7))->count();
        $last_9days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(8))->count();
        $last_10days = Form::whereDate('created_at', '=', Carbon::parse($avui)->subDays(9))->count();

        $array = array(array( $last_10days, $last_9days, $last_8days, $last_7days, $last_6days, $last_5days, $last_4days, $last_3days, $last_2days, $last_1days));
        $final = array( array(Carbon::parse($avui)->subDays(9)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(8)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(7)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(6)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(5)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(4)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(3)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(2)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(1)->format('d/m/Y')),array(Carbon::parse($avui)->format('d/m/Y') ) );
        echo json_encode(array($final,$array));
    }

    public function AnswersLast10Days()
    {
        $avui=Carbon::parse(Carbon::now())->format('y-m-d');
        $start_date = Carbon::now()->format('Y-m-d');
        $end_date = Carbon::now();

        $last_1days = Answer::whereDate('created_at', '=', Carbon::parse($avui))->count();
        $last_2days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(1))->count();
        $last_3days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(2))->count();
        $last_4days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(3))->count();
        $last_5days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(4))->count();
        $last_6days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(5))->count();
        $last_7days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(6))->count();
        $last_8days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(7))->count();
        $last_9days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(8))->count();
        $last_10days = Answer::whereDate('created_at', '=', Carbon::parse($avui)->subDays(9))->count();

        $array = array(array( $last_10days, $last_9days, $last_8days, $last_7days, $last_6days, $last_5days, $last_4days, $last_3days, $last_2days, $last_1days));
        $final = array( array(Carbon::parse($avui)->subDays(9)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(8)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(7)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(6)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(5)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(4)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(3)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(2)->format('d/m/Y')),array(Carbon::parse($avui)->subDays(1)->format('d/m/Y')),array(Carbon::parse($avui)->format('d/m/Y') ) );
        echo json_encode(array($final,$array));
    }
}