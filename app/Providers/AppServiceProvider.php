<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 🚀 PROTECTION ANTI-BOUCLE POUR LARAVEL RÉCENT
        // On indique aux composants d'authentification de réorienter vers l'accueil public par défaut
        if (class_exists(\Illuminate\Auth\Middleware\RedirectIfAuthenticated::class)) {
            \Illuminate\Auth\Middleware\RedirectIfAuthenticated::redirectUsing(function () {
                return route('index'); // Redirige vers la racine publique '/'
            });
        }
    }
}
