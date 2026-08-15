<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Si l'utilisateur n'est pas connecté, on le renvoie vers la page de connexion
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Si l'utilisateur est un Admin ou Super Admin, on lui donne tous les accès automatiquement
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return $next($request);
        }

        // 3. On vérifie si le rôle de l'utilisateur est présent dans la liste des rôles autorisés
        if (!in_array($user->role, $roles)) {
            abort(403, "Accès interdit : Votre rôle [{$user->role}] n'a pas l'autorisation d'accéder à cet espace.");
        }

        return $next($request);
    }
}
