<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleUser;

class RoleController extends Controller
{
    /**
     * Returns all roles
     *
     * @return JSON
     */
    public static function getRoles()
    {
        return Role::get();
    }

    /**
     * Returns specified role object
     *
     * @param Role $role specified role id
     */
    public function getRole(Role $role)
    {
        return $role;
    }

    /**
     * Create new Role
     *
     * @param Request $request recipe parameters post
     */
    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ]);

        $role = new Role();
        $role->name = $validated['name'];
        if (isset($validated['active'])) {
            $role->active = $validated['active'];
        }
        $role->save();

        return $role;
    }

    /**
     * Update Role
     *
     * @param Request $request recipe parameters post
     * @param Integer $id role id
     */
    public function updateRole(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ]);

        $role->name = $validated['name'];
        if (isset($validated['active'])) {
            $role->active = $validated['active'];
        }
        $role->save();

        return $role;
    }

    /**
     * Delete Role
     *
     * @param Integer $id role id
     */
    public function deleteRole(Role $role)
    {
        $deleted = $role->deleteOrFail();

        if ($deleted) {
            RoleUser::where('role_id', $role['id'])->delete();
        }

        return $deleted;
    }
}
