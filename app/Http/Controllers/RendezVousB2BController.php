<?php
// app/Http/Controllers/RendezVousB2BController.php

namespace App\Http\Controllers;

use App\Models\RendezVousB2B;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class RendezVousB2BController extends Controller
{
    public function index(): View
    {
        $rdvs = RendezVousB2B::where('user_id', Auth::id())
            ->orderBy('date_heure')
            ->paginate(10);
        $prochains = RendezVousB2B::where('user_id', Auth::id())
            ->where('date_heure', '>', now())
            ->where('statut', 'confirme')
            ->orderBy('date_heure')
            ->take(3)->get();
        return view('emploi_rdvb2b', compact('rdvs', 'prochains'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_complet'  => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email'],
            'recruteur_id' => ['required', 'string', 'max:255'],
            'objet'        => ['required', 'string', 'max:255'],
            'date_heure'   => ['required', 'date', 'after:now'],
            'message'      => ['nullable', 'string', 'max:1000'],
        ]);

        RendezVousB2B::create([
            ...$validated,
            'user_id' => Auth::id(),
            'statut'  => 'en_attente',
        ]);

        return back()->with('success', '📅 Rendez-vous B2B demandé ! Vous recevrez une confirmation sous 24h.');
    }

    public function destroy(int $id): RedirectResponse
    {
        RendezVousB2B::where('user_id', Auth::id())->findOrFail($id)->delete();
        return back()->with('success', 'Rendez-vous annulé.');
    }
}
