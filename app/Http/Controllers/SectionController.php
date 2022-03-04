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

    public function updateSection(Request $request, Section $section){
        $validated = $request->validate([
           
            'active' => ['nullable', 'string']
        ]);
        if (isset($validated['active'])) {
            $section->active = $validated['active'];
        }
        $section->save();

        return $section;

    }

    public function deleteSection(Section $section)
    {
        $section->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }    
}
