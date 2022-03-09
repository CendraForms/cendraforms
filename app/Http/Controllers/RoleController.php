<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Gets all roles
     *
     * @return JSON All obtained roles
     */
    public static function getAll()
    {
        return Role::get();
    }

    /**
     * Gets specified Role object
     *
     * @param Role $role Role id
     * @return JSON obtained role
     */
    public function get(Role $role)
    {
        return $role;
    }

    /**
     * Creates a new Role
     *
     * @param Request $request recipe parameters post
     * @return JSON created role
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ]);

        return Role::create($validated);
    }

    /**
     * Updates parsed Role
     *
     * @param Request $request recipe parameters post
     * @param Role $role Role id
     * @return JSON updated role
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ]);
        
        $role->update($validated);

        return $role;
    }

    /**
     * Deletes parsed Role
     * 
     * @param Role $role Role to be deleted
     * @return Response JSON response with status code
     */
    public function delete(Role $role)
    {
        $role->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }
}
