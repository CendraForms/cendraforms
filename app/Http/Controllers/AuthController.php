<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function render()
    {
        return Inertia::render('Auth');
    }

    public function socialRedirect($provider)
    {
        $providers = ["google", "discord", "github"];

        if (!in_array($provider, $providers))
        {
            return redirect()->route('auth');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function socialCallback($provider)
    {
        try
        {
            $providers = ["google", "discord", "github"];

            if (!in_array($provider, $providers))
            {
                return redirect()->route('auth');
            }

            $user = Socialite::driver($provider)->user();

            if (!Str::endsWith($user->getEmail(), '@cendrassos.net'))
            {
                return redirect()->route('auth')->with('error', 'Usuari no autoritzat. Recorda utilitzar el correu del centre.');
            }

            $user = User::firstOrCreate([
                "name" => str_replace('@cendrassos.net', '', $user->getEmail()),
                "email" => $user->getEmail(),
            ]);

            Auth::login($user);

            return redirect()->route('form.create');
        }
        catch (Exception $exception)
        {
            return redirect('/accedir')->with('error', 'Error. Has d\'acceptar per poder accedir.');
        }
    }
}
