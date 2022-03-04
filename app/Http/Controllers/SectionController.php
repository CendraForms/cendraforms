<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    // todo: function to get a specific section - getSection(Section $section)
    // todo: function to create a sections - createSection()

    /**
     * Returns all sections
     *
     * @return JSON
     */
    public static function getSections()
    {
        return Section::get();
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

    /**
     * Delete Section
     *
     * @param Integer $id section id
     */
    public function deleteSection(Section $section)
    {
        $section->delete();
       
        return response()->json([
            'state' => 'ok',
        ]);
    }
}
