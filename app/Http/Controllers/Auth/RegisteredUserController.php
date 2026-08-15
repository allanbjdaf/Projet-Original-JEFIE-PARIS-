<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation des données (on sécurise le champ role)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:candidat,recruteur,entrepreneur,partenaire,benevole'], // 👈 Sécurité ajoutée
        ]);

        // 2. Création de l'utilisateur avec son rôle
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // 👈 Enregistrement du rôle choisi
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 3. 🔀 AIGUILLAGE DYNAMIQUE (Correction de la dernière ligne)
        if ($user->role === 'recruteur') {
            return redirect()->route('recruteur.dashboard');
        } elseif ($user->role === 'admin' || $user->role === 'super_admin') {
            return redirect('/admin');
        } else {
            // Redirection pour tous les autres profils (candidats, bénévoles, etc.) vers leur profil
            return redirect()->route('profil');
        }
    }
}
