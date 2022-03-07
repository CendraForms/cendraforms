<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    /**
     * Returns all forms
     *
     * @return JSON
     */
    public static function getForms()
    {
        return Form::get();
    }

    /**
     * Returns specified form object
     *
     * @param Form $form specified form id
     */
    public function getForm(Form $form)
    {
        return $form;

        //In Future
        //return view('');
    }

    /**
     * Create new Form
     *
     * @param Request $request recipe parameters post
     */
    public function createForm(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);

        $form = new Form();

        $form->name = $validated['name'];
        $form->description = $validated['description'];
        $form->user_id = Auth::id();

        if (isset($validated['active'])) {
            $form->active = $validated['active'];
        }

        $form->save();

        return $form;
    }

    /**
     * Update Form
     *
     * @param Request $request recipe parameters post
     * @param Integer $id form id
     */
    public function updateForm(Request $request, Form $form)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ]);

        $form->name = $validated['name'];
        if (isset($validated['active'])) {
            $form->active = $validated['active'];
        }

        $form->save();

        return $form;
    }

    /**
     * Delete form
     *
     * @param Form $form form to be deleted
     * @return Response response JSON with status code
     */
    public function deleteForm(Form $form)
    {
        $form->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }

    public function getFormsView()
    {
        $forms = $this->getForms();

        return view('forms.forms', ['forms' => $forms]);
    }
}
