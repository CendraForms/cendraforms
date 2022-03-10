<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;

class FormController extends Controller
{
    /**
     * Gets all forms
     *
     * @return JSON All obtained forms
     */
    public static function getAll()
    {
        return Form::get();
    }

    /**
     * Gets specified Form object
     *
     * @param Form $form Form id
     * @return JSON obtained form
     */
    public function get(Form $form)
    {
        return $form;
    }

    /**
     * Creates a new Form
     *
     * @param Request $request recipe parameters post
     * @return JSON created form
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);

        $validated['user_id'] = Auth::id();

        return Form::create($validated);
    }

    /**
     * Updates parsed Form
     *
     * @param Request $request recipe parameters post
     * @param Form $form Form id
     * @return JSON updated form
     */
    public function update(Request $request, Form $form)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
        ]);

        $validated['user_id'] = Auth::id();

        $form->update($validated);

        return $form;
    }

    /**
     * Deletes parsed Form
     * 
     * @param Form $form Form to be deleted
     * @return Response JSON response with status code
     */
    public function delete(Form $form)
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
