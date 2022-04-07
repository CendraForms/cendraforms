<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Professor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!Auth::check()) {
        //     Auth::login(User::where('id', 2)->get()[0]);
        // }

        $roles = Auth::user()->roles;

        $comptador = 0;
        foreach ($roles as $role) {
            if ($role->name === 'direccio' || $role->name === 'professor') {
                $comptador++;
            }
        }

        if ($comptador > 0) {
            return $next($request);
        } else {
            return redirect()->route('auth')->with('error', 'No pots accedir.');
        }
    }
}
