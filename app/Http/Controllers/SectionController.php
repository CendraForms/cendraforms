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
    public function deleteSection(Section $section)
    {
        $section->delete();
       
        return response()->json([
            'state' => 'ok',
        ]);
    }

    /**
     * Update Section
     *
     * @param Request $request recipe parameters put
     * @param Integer $section section id (Section Model)
     */
    public function updateSection(Request $request, Section $section)
    {
        $validate = $request->validate([
            'active' => ['nullable', 'boolean']
        ]);

        $section->active = $validate['active'];
        $section->save();

        return $section;
    }
}
