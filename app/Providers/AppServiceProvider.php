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
        // 🚀 PROTECTION ANTI-BOUCLE — REDIRECTION VERS MON ESPACE
        // Indique à Laravel de réorienter les utilisateurs connectés vers leur espace unifié
        if (class_exists(\Illuminate\Auth\Middleware\RedirectIfAuthenticated::class)) {
            \Illuminate\Auth\Middleware\RedirectIfAuthenticated::redirectUsing(function () {
                // Modification ici : on utilise le nom de votre route d'espace unifié
                return route('mon-espace.dashboard');
            });
        }
    }
}
