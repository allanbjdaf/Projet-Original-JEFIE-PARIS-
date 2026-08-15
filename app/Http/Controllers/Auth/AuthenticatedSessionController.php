<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // 🚀 SÉCURITÉ ANTI-BOUCLE : Utilisation de redirections directes fixes
        // On n'utilise PLUS redirect()->intended() pour forcer le navigateur à aller au bon endroit.
        if ($user->role === 'recruteur' || $user->role === 'partenaire') {
            return redirect('/recruteur');
        }

        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return redirect('/admin');
        }

        if ($user->role === 'entrepreneur' || $user->role === 'institution' || $user->role === 'participant_forum') {
            return redirect('/entrepreneurs/dashboard');
        }

        if ($user->role === 'candidat' || $user->role === 'benevole') {
            return redirect('/emploi');
        }

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
