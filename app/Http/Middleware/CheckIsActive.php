<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();

            // Redirigez l'utilisateur vers la page de connexion avec un message d'erreur
            return redirect()->route('filament.fournisseur.auth.login')->with('error', 'Votre compte est inactif.');
        }

        return $next($request);
    }
}
