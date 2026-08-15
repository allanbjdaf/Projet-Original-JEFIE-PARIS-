<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    // ── Liste mes candidatures ─────────────────────────────────
    public function index(): View
    {
        $candidatures = Candidature::where('user_id', Auth::id())
            ->with('offreEmploi')
            ->latest()
            ->paginate(10);

        $stats = [
            'total'        => Candidature::where('user_id', Auth::id())->count(),
            'en_attente'   => Candidature::where('user_id', Auth::id())->where('statut', 'en_attente')->count(),
            'en_cours'     => Candidature::where('user_id', Auth::id())->where('statut', 'en_cours')->count(),
            'acceptees'    => Candidature::where('user_id', Auth::id())->where('statut', 'accepte')->count(),
            'refusees'     => Candidature::where('user_id', Auth::id())->where('statut', 'refuse')->count(),
        ];

        return view('emploi_candidatures', compact('candidatures', 'stats'));
    }

    // ── Envoyer une candidature ────────────────────────────────
    public function storeCandidature(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'offre_id'     => ['nullable', 'exists:offres_emploi,id'],
            'nom_complet'  => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email'],
            'telephone'    => ['nullable', 'string', 'max:30'],
            'poste_cible'  => ['required', 'string', 'max:255'],
            'message'      => ['nullable', 'string', 'max:2000'],
            'cv'           => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        // Upload CV sécurisé
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store(
                'candidatures/' . Auth::id() . '/cv',
                'private'  // ✅ Stockage privé — non accessible publiquement
            );
        }

        Candidature::create([
            'user_id'     => Auth::id(),
            'offre_id'    => $validated['offre_id'] ?? null,
            'nom_complet' => $validated['nom_complet'],
            'email'       => $validated['email'],
            'telephone'   => $validated['telephone'] ?? null,
            'poste_cible' => $validated['poste_cible'],
            'message'     => $validated['message'] ?? null,
            'cv_path'     => $cvPath,
            'statut'      => 'en_attente',
        ]);

        return back()->with('success', '✅ Candidature envoyée avec succès ! Vous recevrez une réponse sous 48h.');
    }

    public function show(int $id): View
    {
        $candidature = Candidature::where('user_id', Auth::id())->findOrFail($id);
        return view('emploi.candidature-detail', compact('candidature'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $candidature = Candidature::where('user_id', Auth::id())->findOrFail($id);
        if ($candidature->cv_path) Storage::disk('private')->delete($candidature->cv_path);
        $candidature->delete();
        return back()->with('success', 'Candidature supprimée.');
    }
}
