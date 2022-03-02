<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

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

    public function updateForm(Request $request, Form $form)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'string'],
        ]);

        $form->name = $validated['name'];
        if (isset($validated['active'])) {
            $form->active = $validated['active'];
        }
        $form->save();

        return $form;
    }
}
