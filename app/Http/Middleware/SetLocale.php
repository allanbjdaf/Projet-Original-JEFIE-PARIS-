<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Si un paramètre "locale" est présent dans l'URL (ex: ?locale=en)
        if ($request->has('locale')) {
            $locale = $request->get('locale');
            // Vérifiez que la langue fait partie de vos choix autorisés
            $supportedLocales = ['fr', 'en', 'pt', 'it', 'de', 'zh'];

            if (in_array($locale, $supportedLocales)) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
        // Sinon, si une langue est déjà enregistrée en session
        elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
