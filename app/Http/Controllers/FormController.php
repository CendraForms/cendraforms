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

    public function index()
    {
        return view('forms.index', [
            'forms' => Form::get()
        ]);
    }

    public function create()
    {
        return view('forms.create');
    }

    public function edit(Form $form)
    {
        return view('forms.edit', [
            'form' => $form
        ]);
    }

    /**
     * Creates a new Form
     *
     * @param Request $request recipe parameters post
     * @return JSON created form
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:255', 'unique:forms'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['required', 'boolean'],
        ]);

        $validated['user_id'] = Auth::id();

        Form::create($validated);

        return redirect()->back()->with('success', 'Formulari Creat.');
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
            'active' => ['sometimes', 'boolean'],
        ]);

        $form->update($validated);

        return redirect()->back()->with('success', 'Formulari Actualitzat.');
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

    public function updateFormView(Form $form)
    {
        return view('forms.formsupdate', ['forms' => $form]);
    }
  
    public function getFormView(Form $form)
    {

        return view('Form/form', ['form' => $form]);
    }

    public function getFormsView()
    {
        $forms = $this->getForms();

        return view('forms.forms', ['forms' => $forms]);
    }
}
