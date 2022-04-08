<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Render View Auth
     *
     * @return Inertia Render View Auth
     */
    public function render()
    {
        return Inertia::render('Auth');
    }

    /**
     * Redirect to Socialite provider
     *
     * @param String $provider socialite provider
     * @return Socialite redirect to socialite driver
     */
    public function socialRedirect($provider)
    {
        $providers = ["google", "discord", "github", "gitlab"];

        if (!in_array($provider, $providers)) {
            return redirect()->route('auth');
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback to Socialite
     *
     * @param String $provider socialite provider
     * @return Socialite login in to socialite provider
     */
    public function socialCallback($provider)
    {
        try {
            $providers = ["google", "discord", "github", "gitlab"];

            if (!in_array($provider, $providers)) {
                return redirect()->route('auth');
            }

            $user = Socialite::driver($provider)->user();

            if (!Str::endsWith($user->getEmail(), '@cendrassos.net')) {
                return redirect()
                    ->route('auth')
                    ->with('error', 'Usuari no autoritzat. Recorda utilitzar el correu del centre.');
            }

            // First or Create User
            $user = User::firstOrCreate([
                "name" => str_replace('@cendrassos.net', '', $user->getEmail()),
                "email" => $user->getEmail(),
            ]);

            $role = Role::where('name', 'alumne')->get()[0]; // Search student role

            $user->roles()->detach($role->id); // detach register in pivot table between user and role
            $user->roles()->attach($role->id); // attach register in pivot table between user and role

            Auth::login($user); // Login user

            return redirect()->route('form.create');
        } catch (Exception) {
            return redirect('/accedir')->with('error', 'Error. Has d\'acceptar per poder accedir.');
        }
    }
}
