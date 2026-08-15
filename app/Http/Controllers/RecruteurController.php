<?php

namespace App\Http\Controllers;

use App\Models\OffreEmploi;
use App\Models\Candidature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecruteurController extends Controller
{
    // ── Dashboard recruteur ────────────────────────────────────
    public function dashboard(): View
    {
        $stats = [
            'offres_actives'     => OffreEmploi::where('recruteur_id', Auth::id())->where('statut', 'active')->count(),
            'candidatures_total' => Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', Auth::id()))->count(),
            'candidatures_new'   => Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', Auth::id()))->where('statut', 'en_attente')->count(),
            'vues_total'         => OffreEmploi::where('recruteur_id', Auth::id())->sum('vues'),
        ];

        $offres_recentes = OffreEmploi::where('recruteur_id', Auth::id())
            ->withCount('candidatures')
            ->latest()->take(5)->get();

        $candidatures_recentes = Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', Auth::id()))
            ->with('offreEmploi')
            ->where('statut', 'en_attente')
            ->latest()->take(5)->get();

        return view('recruteur.dashboard', compact('stats', 'offres_recentes', 'candidatures_recentes'));
    }

    // ── Mes offres ─────────────────────────────────────────────
    public function mesOffres(Request $request): View
    {
        $query = OffreEmploi::where('recruteur_id', Auth::id())->withCount('candidatures');
        if ($request->statut) $query->where('statut', $request->statut);
        $offres = $query->latest()->paginate(10);
        return view('recruteur.offres', compact('offres'));
    }

    // ── Créer offre ────────────────────────────────────────────
    public function creerOffre(): View
    {
        return view('recruteur.offre-form', ['offre' => null]);
    }

    public function storeOffre(Request $request): RedirectResponse
    {
        $v = $request->validate([
            'titre'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'entreprise'      => ['required', 'string', 'max:255'],
            'lieu'            => ['required', 'string', 'max:255'],
            'pays'            => ['nullable', 'string', 'max:100'], // 👈 Ajouté pour correspondre au modèle
            'type_contrat'    => ['required', 'in:CDI,CDD,Stage,Freelance,Alternance'],
            'secteur'         => ['required', 'string', 'max:100'],
            'salaire'         => ['nullable', 'string', 'max:100'],
            'competences'     => ['nullable', 'string'], // 👈 Ajouté pour correspondre au modèle
            'date_expiration' => ['nullable', 'date', 'after:today'], // 👈 Corrigé (date_limite -> date_expiration)
            'logo_entreprise' => ['nullable', 'image', 'max:2048'],
            'en_vedette'      => ['boolean'],
        ]);

        $logo = null;
        if ($request->hasFile('logo_entreprise')) {
            $logo = $request->file('logo_entreprise')->store('recruteurs/logos', 'public');
        }

        OffreEmploi::create([
            ...$v,
            'recruteur_id'    => Auth::id(),
            'slug'            => Str::slug($v['titre'] . '-' . Str::random(6)),
            'logo_entreprise' => $logo,
            'statut'          => 'active',
            'vues'            => 0,
        ]);

        return redirect()->route('recruteur.offres')->with('success', '✅ Offre publiée avec succès !');
    }

    // ── Modifier offre ─────────────────────────────────────────
    public function editOffre(int $id): View
    {
        $offre = OffreEmploi::where('recruteur_id', Auth::id())->findOrFail($id);
        return view('recruteur.offre-form', compact('offre'));
    }

    public function updateOffre(Request $request, int $id): RedirectResponse
    {
        $offre = OffreEmploi::where('recruteur_id', Auth::id())->findOrFail($id);
        $v = $request->validate([
            'titre'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'lieu'            => ['required', 'string', 'max:255'],
            'pays'            => ['nullable', 'string', 'max:100'], // 👈 Ajouté
            'type_contrat'    => ['required', 'in:CDI,CDD,Stage,Freelance,Alternance'],
            'secteur'         => ['required', 'string', 'max:100'],
            'salaire'         => ['nullable', 'string', 'max:100'],
            'competences'     => ['nullable', 'string'], // 👈 Ajouté
            'date_expiration' => ['nullable', 'date'], // 👈 Corrigé
            'statut'          => ['required', 'in:active,inactive,pourvue'],
        ]);

        $offre->update($v);
        return redirect()->route('recruteur.offres')->with('success', '✅ Offre mise à jour.');
    }

    public function destroyOffre(int $id): RedirectResponse
    {
        OffreEmploi::where('recruteur_id', Auth::id())->findOrFail($id)->delete();
        return back()->with('success', 'Offre supprimée.');
    }

    // ── Candidatures reçues ────────────────────────────────────
    public function candidatures(Request $request): View
    {
        $query = Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', Auth::id()))
            ->with('offreEmploi');
        if ($request->statut) $query->where('statut', $request->statut);
        if ($request->offre_id) $query->where('offre_id', $request->offre_id);
        $candidatures = $query->latest()->paginate(15);
        $offres = OffreEmploi::where('recruteur_id', Auth::id())->select('id', 'titre')->get();
        return view('recruteur.candidatures', compact('candidatures', 'offres'));
    }

    public function voirCandidature(int $id): View
    {
        $candidature = Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', Auth::id()))
            ->with('offreEmploi')->findOrFail($id);
        return view('recruteur.candidature-detail', compact('candidature'));
    }

    public function changerStatut(Request $request, int $id): RedirectResponse
    {
        $request->validate(['statut' => ['required', 'in:en_attente,en_cours,accepte,refuse']]);
        Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', Auth::id()))
            ->findOrFail($id)->update(['statut' => $request->statut]);
        return back()->with('success', 'Statut mis à jour.');
    }

    // ── Newsletter recruteur ───────────────────────────────────
    public function newsletter(): View
    {
        return view('recruteur.newsletter');
    }
}
