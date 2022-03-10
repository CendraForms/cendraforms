<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    public function getUsersView()
    {
        $users = self::getUsers(); 
        return view('Users/users', ['user' => $users]);
    }

    public function getUserView(User $user)
    {
        return view('Users/user', ['user' => $user]);
    }




}
