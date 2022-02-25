<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    public static function getSection()
    {
        return Section::get();
    }
}
