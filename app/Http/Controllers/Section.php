<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Section extends Controller
{
    public function deleteSection(Section $section)
    {
        $section->delete();
       
        return response()->json([
            'state' => 'ok',
        ]);
    }
}
