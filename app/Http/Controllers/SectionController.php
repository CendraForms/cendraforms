<?php

namespace App\Http\Controllers;
use App\Models\Section;
use App\Models\User;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Symfony\Contracts\Service\Attribute\Required;
use function PHPUnit\Framework\isNull;

  
class SectionController extends Controller
{
  
    /**
     * Returns all sections
     * 
     *
     * @return JSON
     */
    public static function getSections()

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



    public function getSection($id){
        $section = Section::findOrFail($id);
        return $section;
    }

    public function getSectionid(Section $section){
        return $section;
    }

    public function createSection(Request $request){
        $validated = $request->validate([
           
            'active' => ['nullable', 'string']
        ]);
        $section = new Section();
        $section->user_id = Auth::id();
        

        if (isset($validated['active'])) {
            $form->active = $validated['active'];
        }

        $section->save();

        return $section;


    }

 



    public function deleteSection(Section $section)

    public static function getSectionView(Section $section)

    {
        return view('Sections/section', ['section' => $section]);
    }
  
    /**
     * Updates parsed Section
     *
     * @param Request $request recipe parameters post
     * @param Section $section Section id
     * @return JSON updated section
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

        return view('sections.sections', ['sections' => $sections]);
    }

    public function getSectionsCreateView()
    {
        return view('sections.sectioncreate');
    }

    public function updateSectionView(Section $section)
    {
        return view('sections.sectionupdate', ['section' => $section]);
    }

}
