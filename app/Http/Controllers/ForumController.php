<?php
// app/Http/Controllers/ForumController.php

namespace App\Http\Controllers;

use App\Models\ForumCategorie;
use App\Models\ForumSujet;
use App\Models\ForumReponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    // ── Index ───────────────────────────────────────────────────────
    public function index(): View
    {
        // Sécurisé : si la migration n'a pas encore été faite
        try {
            $categories = ForumCategorie::withCount(['sujets', 'reponses'])
                ->orderBy('ordre')->get();

            $sujetsRecents = ForumSujet::with(['user', 'categorie', 'derniereReponse.user'])
                ->orderByDesc('updated_at')
                ->take(5)->get();

            $stats = [
                'sujets'   => ForumSujet::count(),
                'reponses' => ForumReponse::count(),
                'membres'  => \App\Models\User::count(),
                'en_ligne' => 12,
            ];
        } catch (\Exception $e) {
            // Tables pas encore créées → données vides
            $categories    = collect();
            $sujetsRecents = collect();
            $stats = ['sujets' => 0, 'reponses' => 0, 'membres' => 0, 'en_ligne' => 0];
        }

        return view('forum', compact('categories', 'sujetsRecents', 'stats'));
    }

    // ── Catégorie ───────────────────────────────────────────────────
    public function categorie(string $slug, Request $request): View
    {
        $categorie = ForumCategorie::where('slug', $slug)->firstOrFail();

        $query = ForumSujet::with(['user', 'derniereReponse.user'])
            ->where('forum_categorie_id', $categorie->id);

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->q . '%')
                    ->orWhere('contenu', 'like', '%' . $request->q . '%');
            });
        }

        $tri = $request->get('tri', 'recent');
        match ($tri) {
            'populaire' => $query->orderByDesc('vues'),
            'reponses'  => $query->orderByDesc('nb_reponses'),
            default     => $query->orderByDesc('updated_at'),
        };

        $sujets     = $query->paginate(15);
        $categories = ForumCategorie::orderBy('ordre')->get();

        return view('forum.categorie', compact('categorie', 'sujets', 'categories', 'tri'));
    }

    // ── Sujet ───────────────────────────────────────────────────────
    public function sujet(string $categorieSlug, string $sujetSlug): View
    {
        $categorie = ForumCategorie::where('slug', $categorieSlug)->firstOrFail();
        $sujet     = ForumSujet::with(['user', 'categorie'])
            ->where('slug', $sujetSlug)
            ->where('forum_categorie_id', $categorie->id)
            ->firstOrFail();

        $sujet->increment('vues');

        $reponses = ForumReponse::with('user')
            ->where('forum_sujet_id', $sujet->id)
            ->orderBy('created_at')
            ->paginate(20);

        $sujetsLies = ForumSujet::where('forum_categorie_id', $categorie->id)
            ->where('id', '!=', $sujet->id)
            ->orderByDesc('updated_at')
            ->take(5)->get();

        return view('forum.sujet', compact('sujet', 'categorie', 'reponses', 'sujetsLies'));
    }

    // ── Créer sujet ─────────────────────────────────────────────────
    public function creerSujet(Request $request): View
    {
        $categories  = ForumCategorie::orderBy('ordre')->get();
        $categorieId = $request->get('categorie');
        return view('forum.creer', compact('categories', 'categorieId'));
    }

    public function storeSujet(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titre'              => ['required', 'string', 'min:10', 'max:255'],
            'contenu'            => ['required', 'string', 'min:20'],
            'forum_categorie_id' => ['required', 'exists:forum_categories,id'],
            'tags'               => ['nullable', 'string', 'max:255'],
        ], [
            'titre.required'              => 'Le titre est obligatoire.',
            'titre.min'                   => 'Le titre doit contenir au moins 10 caractères.',
            'contenu.required'            => 'Le contenu est obligatoire.',
            'contenu.min'                 => 'Le contenu doit contenir au moins 20 caractères.',
            'forum_categorie_id.required' => 'Choisissez une catégorie.',
        ]);

        $sujet = ForumSujet::create([
            'titre'              => $validated['titre'],
            'slug'               => Str::slug($validated['titre']) . '-' . time(),
            'contenu'            => $validated['contenu'],
            'forum_categorie_id' => $validated['forum_categorie_id'],
            'user_id'            => auth()->id(),
            'tags'               => $validated['tags'] ?? null,
            'vues'               => 0,
            'nb_reponses'        => 0,
            'epingle'            => false,
            'verrouille'         => false,
            'resolu'             => false,
        ]);

        $categorie = ForumCategorie::find($validated['forum_categorie_id']);

        return redirect()
            ->route('forum.sujet', [$categorie->slug, $sujet->slug])
            ->with('success', 'Votre sujet a été créé avec succès !');
    }

    // ── Répondre ────────────────────────────────────────────────────
    public function storeReponse(Request $request, int $sujetId): RedirectResponse
    {
        $validated = $request->validate([
            'contenu' => ['required', 'string', 'min:5'],
        ], [
            'contenu.required' => 'La réponse ne peut pas être vide.',
            'contenu.min'      => 'La réponse doit contenir au moins 5 caractères.',
        ]);

        $sujet = ForumSujet::findOrFail($sujetId);

        ForumReponse::create([
            'contenu'        => $validated['contenu'],
            'forum_sujet_id' => $sujet->id,
            'user_id'        => auth()->id(),
        ]);

        $sujet->increment('nb_reponses');
        $sujet->touch();

        $categorie = ForumCategorie::find($sujet->forum_categorie_id);

        return redirect()
            ->route('forum.sujet', [$categorie->slug, $sujet->slug])
            ->with('success', 'Votre réponse a été publiée !')
            ->fragment('reponses');
    }

    // ── Résolu ──────────────────────────────────────────────────────
    public function marquerResolu(int $sujetId): RedirectResponse
    {
        $sujet = ForumSujet::findOrFail($sujetId);

        if (auth()->id() !== $sujet->user_id) {
            abort(403, 'Action non autorisée.');
        }

        $sujet->update(['resolu' => !$sujet->resolu]);
        $categorie = ForumCategorie::find($sujet->forum_categorie_id);

        return redirect()
            ->route('forum.sujet', [$categorie->slug, $sujet->slug])
            ->with('success', $sujet->resolu ? 'Sujet marqué comme résolu !' : 'Marqué comme non résolu.');
    }
}
