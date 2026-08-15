<?php


// app/Http/Controllers/ProfilCandidatController.php

namespace App\Http\Controllers;

use App\Models\ProfilCandidat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilCandidatController extends Controller
{
    public function index(): View
    {
        $profil = ProfilCandidat::firstOrCreate(
            ['user_id' => Auth::id()],
            ['nom_complet' => Auth::user()->name, 'email' => Auth::user()->email]
        );
        return view('emploi_profil', compact('profil'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_complet' => ['required', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:30'],
            'localisation' => ['nullable', 'string', 'max:255'],
            'titre_pro' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'secteur' => ['nullable', 'string', 'max:100'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'disponibilite' => ['nullable', 'string', 'max:100'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $profil = ProfilCandidat::firstOrCreate(['user_id' => Auth::id()]);

        if ($request->hasFile('photo')) {
            if ($profil->photo) Storage::disk('public')->delete($profil->photo);
            $validated['photo'] = $request->file('photo')->store('profils', 'public');
        }

        $profil->update($validated);

        return back()->with('success', '✅ Profil mis à jour avec succès !');
    }
}
