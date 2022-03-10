<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
