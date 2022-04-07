<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleUserController extends Controller
{
    /**
     * Returns the view to list the roles of user.
     *
     * @param User $user user to search roles
     * @return Response|ResponseFactory
     */
    public function index(User $user)
    {
        return inertia('RoleUser/index', [
            'user' => $user,
            'roles' => $user->roles,
            'rolesLogin' => Auth::user()->roles,
        ]);
    }

    /**
     * Returns the view to add role to user.
     *
     * @param User $user user to search and add roles
     * @return Response|ResponseFactory
     */
    public function create(User $user)
    {
        return inertia('RoleUser/create', [
            'user' => $user,
            'activeRoles' => Role::where('active', true)->get(),
            'maxRole' => Role::where('active', true)->min('id'),
        ]);
    }

    /**
     * Create a new Role User.
     *
     * @param User $user user to add roles
     * @param Request $request Http Request
     * @return Response|ResponseFactory
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => ['required'],
        ]);

        $user->roles()->detach($validated['role_id']);
        $user->roles()->attach($validated['role_id']);

        return redirect('/users/' . $user->id . '/roles')->with('success', 'Rol afegit.');
    }

    /**
     * Destroy a Role User.
     *
     * @param User $user user to role destroy
     * @param Role $role role destroy
     * @return Response|ResponseFactory
     */
    public function destroy(User $user, Role $role)
    {
        $user->roles()->detach($role->id);

        return redirect('/users/' . $user->id . '/roles')->with('success', 'Rol eliminat.');
    }
}
