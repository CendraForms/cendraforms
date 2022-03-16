<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function socialCallbackGitlab()
    {
        $user = Socialite::driver('gitlab')->user();

        /*if (!Str::endsWith($user->getEmail(), '@cendrassos.net'))
        {
            return redirect()->route('auth')->with('error', 'Usuari no autoritzat. Recorda utilitzar el correu del centre.');
        }

        $user = User::firstOrCreate([
            "name" => str_replace('@cendrassos.net', '', $user->getEmail()),
            "email" => $user->getEmail(),
        ]);*/

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
