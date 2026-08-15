<?php
// app/Http/Controllers/AlerteEmploiController.php

namespace App\Http\Controllers;

use App\Models\AlerteEmploi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AlerteEmploiController extends Controller
{
    public function index(): View
    {
        $alertes = AlerteEmploi::where('user_id', Auth::id())->latest()->get();
        return view('emploi_alertes', compact('alertes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'         => ['required', 'email'],
            'mots_cles'     => ['required', 'string', 'max:255'],
            'secteur'       => ['nullable', 'string', 'max:100'],
            'lieu'          => ['nullable', 'string', 'max:100'],
            'type_contrat'  => ['nullable', 'string', 'max:50'],
            'frequence'     => ['required', 'in:instantanee,quotidienne,hebdomadaire'],
        ]);

        AlerteEmploi::create([...$validated, 'user_id' => Auth::id(), 'active' => true]);

        return back()->with('success', '🔔 Alerte créée ! Vous serez notifié dès qu\'une offre correspond.');
    }

    public function destroy(int $id): RedirectResponse
    {
        AlerteEmploi::where('user_id', Auth::id())->findOrFail($id)->delete();
        return back()->with('success', 'Alerte supprimée.');
    }

    public function toggle(int $id): RedirectResponse
    {
        $alerte = AlerteEmploi::where('user_id', Auth::id())->findOrFail($id);
        $alerte->update(['active' => !$alerte->active]);
        return back()->with('success', $alerte->active ? 'Alerte activée.' : 'Alerte suspendue.');
    }
}
