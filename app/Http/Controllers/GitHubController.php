<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class GitHubController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
    }
}
