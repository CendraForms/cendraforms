<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public static function getUsers()
    {
        return User::get();
    }

    public static function getUser(User $user)
    {
        return $user;
    }

     /**
     * Returns the view to list the users.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('User/index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Returns the view to create a user.
     *
     * @return Response|ResponseFactory
     */
    public function create()
    {
        return inertia('User/create');
    }

    /**
     * Returns the view to edit a user.
     *
     * @param User $user user to edit
     * @return Response|ResponseFactory
     */
    public function edit(User $user)
    {
        if ($user['active'] == 1) {
            $user['active'] = true;
        } else {
            $user['active'] = false;
        }

        return inertia('User/edit', [
            'user' => $user,
        ]);
    }

    /**
     * Create a new User.
     *
     * @param Request $request Http Request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'max:255'],
            'active' => ['required', 'boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Usuari creat.');
    }

    /**
     * Update a User.
     *
     * @param Request $request Http Request
     * @param User $user user to update
     * @return Response|ResponseFactory
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuari Actualitzat.');
    }

    /**
     * Destroy a User.
     *
     * @param User $user user to destroy
     * @return Response|ResponseFactory
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuari Eliminat.');
    }
}
