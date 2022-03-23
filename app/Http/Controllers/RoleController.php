<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::get()
        ]);
    }

    public function create()
    {
      return view('roles.create');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:30', 'unique:roles'],
            'active' => ['required', 'boolean'],
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'Rol creat.');
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ]);

        $role->update($validated);

        return redirect()->back()->with('success', 'Rol actualitzat.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminat.');
    }
}