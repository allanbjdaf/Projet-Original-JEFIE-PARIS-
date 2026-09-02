<?php
// ══════════════════════════════════════════════════════════════
// FICHIER 1 — app/Http/Controllers/PartenairesController.php
// ══════════════════════════════════════════════════════════════

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class PartenairesController extends Controller
{
    // Page liste partenaires — offres masquées
    public function liste()
    {
        $partenaires = Partenaire::where('statut', 'actif')
            ->withCount('offres')
            ->orderBy('nom')
            ->paginate(12);

        return view('partenaires_show', compact('partenaires'));
    }

    // Page entreprise individuelle avec ses offres — URL propre
    // URL : /partenaires/{slug}  ex: /partenaires/orange-gabon
    public function show(string $slug)
    {
        $partenaire = Partenaire::where('slug', $slug)
            ->where('statut', 'actif')
            ->firstOrFail();

        // Vérifier si l'accès QR est déjà validé en session
        $qrValide = session("qr_acces_{$partenaire->id}", false);

        // Offres : chargées uniquement si QR validé
        $offres = $qrValide
            ? OffreEmploi::where('partenaire_id', $partenaire->id)
            ->where('statut', 'active')
            ->latest()
            ->get()
            : collect();

        return view('partenaires.show', compact('partenaire', 'offres', 'qrValide'));
    }

    // Valider le scan QR → déverrouille les offres pour cette session
    // URL : /partenaires/{slug}/qr-acces/{token}
    public function qrAcces(string $slug, string $token)
    {
        $partenaire = Partenaire::where('slug', $slug)
            ->where('statut', 'actif')
            ->firstOrFail();

        // Vérifier que le token correspond au partenaire
        if ($token !== $partenaire->qr_token) {
            abort(403, 'QR Code invalide ou expiré.');
        }

        // Valider l'accès en session (durée 4h)
        session(["qr_acces_{$partenaire->id}" => true]);
        session()->put("qr_acces_expiry_{$partenaire->id}", now()->addHours(4)->timestamp);

        return redirect()
            ->route('partenaires.show', $slug)
            ->with('qr_success', 'Accès déverrouillé ! Toutes les offres de ' . $partenaire->nom . ' sont maintenant visibles.');
    }

    // Générer / Régénérer le QR token d'un partenaire (admin)
    public function regenererQr(int $id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $partenaire->update(['qr_token' => Str::random(40)]);
        return back()->with('success', 'QR Code régénéré avec succès.');
    }
}
