<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 🌐 Configuration globale du groupe 'web'
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \App\Http\Middleware\SetLocale::class,
        ]);

        // 🛡️ ENREGISTREMENT DE L'ALIAS POUR LA VÉRIFICATION DES RÔLES
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // 🚀 NETTOYAGE : Le bloc "redirectTo" a été supprimé pour casser définitivement la boucle infinie.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*')
        );
    })
    ->create();
