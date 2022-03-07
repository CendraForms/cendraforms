<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function createSection(Request $request)
    {
        $validate = $request->validate([
            'form_id' => ['nullable', 'integer'],
            'active' => ['required', 'boolean']
        ]);

        $section = new Section();

        if (isset($validate['form_id'])) {
            $section->form_id = $validate['form_id'];
        }

        $section->active = $validate['active'];
        // $section->user_id = Auth::user()->id;
        $section->user_id = 1;
        $section->save();

        return redirect('/sections');
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

    public function getSectionsView()
    {
        $sections = $this->getSections();

        return view('sections', ['sections' => $sections]);
    }

    public function getSectionsCreateView()
    {
        return view('sectioncreate');
    }
}
