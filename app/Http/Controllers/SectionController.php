<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    // todo: function to get a specific section - get(Section $section)
    // todo: function to create a sections - create()

    /**
     * Gets all sections
     *
     * @return JSON All obtained sections
     */
    public static function getAll()
    {
        return Section::get();
    }

    /**
     * Updates parsed Section
     *
     * @param Request $request recipe parameters post
     * @param Section $section Section id
     * @return JSON updated section
     */
    public function update(Request $request, Section $section)
    {
        $validate = $request->validate([
            'active' => ['nullable', 'boolean']
        ]);

        $section->active = $validate['active'];
        $section->save();

        return $section;
    }

    /**
     * Deletes parsed Section
     * 
     * @param Section $section Section to be deleted
     * @return Response JSON response with status code
     */
    public function delete(Section $section)
    {
        $section->delete();
       
        return response()->json([
            'state' => 'ok',
        ]);
    }
}
