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

    public function index()
    {
        return view('users.index', [
            'users' => User::get()
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function getUserView(User $user)
    {
        return view('Users/user', ['user' => $user]);
    }

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
}
