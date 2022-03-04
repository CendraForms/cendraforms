<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function Index()
    {
        //
    }
    public static function getSection()
    {
        return Section::get();
    }
    
}
