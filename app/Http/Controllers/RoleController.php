<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Returns the view to list the roles.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('Role/index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Returns the view to create a role.
     *
     * @return Response|ResponseFactory
     */
    public function create()
    {
      return inertia('Role/create');
    }

    /**
     * Returns the view to edit a role.
     *
     * @param Role $role role to edit
     * @return Response|ResponseFactory
     */
    public function edit(Role $role)
    {
        if ($role['active'] == 1) {
            $role['active'] = true;
        } else {
            $role['active'] = false;
        }

        return inertia('Role/edit', [
            'role' => $role
        ]);
    }

    /**
     * Create a new Role.
     *
     * @param Request $request Http Request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:30', 'unique:roles'],
            'active' => ['required', 'boolean'],
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'Rol creat.');
    }

    /**
     * Update a Role.
     *
     * @param Request $request Http Request
     * @param Role $role role to update
     * @return Response|ResponseFactory
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ]);

        $role->update($validated);

        return redirect()->route('roles.index')->with('success', 'Rol actualitzat.');
    }

    /**
     * Destroy a Role.
     *
     * @param Role $role role to destroy
     * @return Response|ResponseFactory
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminat.');
    }
}
