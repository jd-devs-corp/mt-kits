<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupération de l'utilisateur connecté
        $user = Auth::user();

        // Si l'utilisateur n'est pas authentifié, on le redirige vers la page de connexion
       /* if (!$user) {
            return back()->with('error', 'Compte inactif.');
        }*/

        // Vérification du statut de l'utilisateur
        /*if (!$user->is_active) {
            // Redirection vers la page de connexion avec un message d'erreur
            return redirect()->route('login')->with('error', 'Compte inactif.');
        }*/

        // Si le statut est actif, on continue l'authentification
        return $next($request);
    }
}
