<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Returns all forms
     *
     * @return JSON
     */
    public static function getForms()
    {
        return Form::get();
    }

    public function getForm(Form $form)
    {
        return $form;
        //In Future
        //return view('');
    }
    
}
