<?php
// app/Http/Controllers/MonEspaceController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inscription;
use App\Models\Candidature;
use App\Models\AlerteEmploi;
use App\Models\RendezVousB2B;
use App\Models\DocumentCandidat;
use App\Models\OffreEmploi;
use App\Models\ProfilEntrepreneur;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MonEspaceController extends Controller
{
    // 🔥 CORRECTION : Le constructeur $this->middleware('auth') a été supprimé ici
    // pour éviter l'erreur "Appel à la méthode non définie" sur Laravel 13.


    // ══════════════════════════════════════════════════════════
    // DASHBOARD UNIFIÉ — détecte le rôle et affiche les données
    // ══════════════════════════════════════════════════════════
    public function dashboard(): View
    {
        $user = Auth::user();
        $role = $user->role ?? 'participant';

        // Données communes à tous
        $inscription = $this->getInscription($user->id);
        $notifications = $this->getNotifications($user->id, $role);

        // Données selon le rôle
        $data = match (true) {
            in_array($role, ['recruteur', 'partenaire'])
            => $this->dataRecruteur($user->id),
            in_array($role, ['entrepreneur', 'institution'])
            => $this->dataEntrepreneur($user->id),
            in_array($role, ['admin', 'super_admin'])
            => $this->dataAdmin(),
            default // candidat, benevole, participant_forum, visiteur, moderateur
            => $this->dataCandidat($user->id),
        };

        return view('mon_espace_dashboard', array_merge([
            'user'          => $user,
            'role'          => $role,
            'inscription'   => $inscription,
            'notifications' => $notifications,
        ], $data));
    }

    // ── Profil unifié ──────────────────────────────────────────
    public function profil(): View
    {
        $user = Auth::user();
        return view('mon-espace.profil', [
            'user'        => $user,
            'role'        => $user->role ?? 'participant',
            'inscription' => $this->getInscription($user->id),
        ]);
    }

    public function updateProfil(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'telephone'     => ['nullable', 'string', 'max:30'],
            'organisation'  => ['nullable', 'string', 'max:255'],
            'fonction'      => ['nullable', 'string', 'max:255'],
            'pays'          => ['nullable', 'string', 'max:100'],
            'ville'         => ['nullable', 'string', 'max:100'],
            'bio'           => ['nullable', 'string', 'max:1000'],
            'photo'         => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) Storage::disk('public')->delete($user->photo);
            $validated['photo'] = $request->file('photo')->store('avatars', 'public');
        }

        $user->update($validated);
        return back()->with('success', '✅ Profil mis à jour avec succès !');
    }

    // ── Mon billet ─────────────────────────────────────────────
    public function billet(): View
    {
        $inscription = $this->getInscription(Auth::id());
        return view('mon-espace.billet', [
            'user'        => Auth::user(),
            'inscription' => $inscription,
        ]);
    }

    // ── Mes candidatures ───────────────────────────────────────
    public function candidatures(): View
    {
        $candidatures = Candidature::where('user_id', Auth::id())
            ->with('offreEmploi')
            ->latest()
            ->paginate(10);

        return view('mon-espace.candidatures', [
            'user'         => Auth::user(),
            'candidatures' => $candidatures,
            'stats' => [
                'total'      => Candidature::where('user_id', Auth::id())->count(),
                'en_attente' => Candidature::where('user_id', Auth::id())->where('statut', 'en_attente')->count(),
                'acceptees'  => Candidature::where('user_id', Auth::id())->where('statut', 'accepte')->count(),
                'refusees'   => Candidature::where('user_id', Auth::id())->where('statut', 'refuse')->count(),
            ],
        ]);
    }

    // ── Mes préférences ────────────────────────────────────────
    public function preferences(): View
    {
        return view('mon-espace.preferences', [
            'user' => Auth::user(),
            'role' => Auth::user()->role ?? 'participant',
        ]);
    }

    public function updatePreferences(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'langue'            => ['nullable', 'in:fr,en,pt'],
            'notif_email'       => ['boolean'],
            'notif_candidature' => ['boolean'],
            'notif_alerte'      => ['boolean'],
            'notif_rdv'         => ['boolean'],
            'notif_newsletter'  => ['boolean'],
            'profil_public'     => ['boolean'],
        ]);

        $user->update(['preferences' => json_encode($validated)]);
        return back()->with('success', '✅ Préférences enregistrées !');
    }

    // ── Changer mot de passe ───────────────────────────────────
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password'  => ['required'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', '✅ Mot de passe modifié avec succès !');
    }

    // ═══════════════════════════════════════════════════════════
    // HELPERS — Données par rôle
    // ═══════════════════════════════════════════════════════════
    private function getInscription(int $userId): ?object
    {
        try {
            return Inscription::where('user_id', $userId)->latest()->first();
        } catch (\Exception) {
            return null;
        }
    }

    private function getNotifications(int $userId, string $role): array
    {
        $notifs = [];
        try {
            // Candidatures en attente de réponse
            $nb = Candidature::where('user_id', $userId)->where('statut', 'en_cours')->count();
            if ($nb > 0) $notifs[] = ['type' => 'info', 'msg' => "{$nb} candidature(s) en cours d'examen", 'icon' => 'candidature'];

            // Inscription non confirmée
            $ins = Inscription::where('user_id', $userId)->where('statut', 'en_attente_paiement')->first();
            if ($ins) $notifs[] = ['type' => 'warning', 'msg' => 'Votre inscription est en attente de paiement', 'icon' => 'paiement', 'url' => route('inscription.paiement')];

            // RDV B2B à venir
            $rdv = RendezVousB2B::where('user_id', $userId)->where('date_heure', '>=', now())->where('statut', 'confirme')->count();
            if ($rdv > 0) $notifs[] = ['type' => 'success', 'msg' => "{$rdv} rendez-vous B2B confirmé(s) à venir", 'icon' => 'rdv'];
        } catch (\Exception) {
        }
        return $notifs;
    }

    private function dataCandidat(int $userId): array
    {
        try {
            return [
                'stats' => [
                    ['valeur' => Candidature::where('user_id', $userId)->count(),         'label' => 'Candidatures', 'couleur' => '#1565c0', 'icon' => 'candidature'],
                    ['valeur' => Candidature::where('user_id', $userId)->where('statut', 'accepte')->count(), 'label' => 'Acceptées', 'couleur' => '#2e7d32', 'icon' => 'check'],
                    ['valeur' => AlerteEmploi::where('user_id', $userId)->where('active', true)->count(),    'label' => 'Alertes actives', 'couleur' => '#f5a623', 'icon' => 'alerte'],
                    ['valeur' => RendezVousB2B::where('user_id', $userId)->where('date_heure', '>=', now())->count(), 'label' => 'RDV à venir', 'couleur' => '#6a1b9a', 'icon' => 'rdv'],
                ],
                'candidatures_recentes' => Candidature::where('user_id', $userId)->with('offreEmploi')->latest()->take(5)->get(),
                'alertes'               => AlerteEmploi::where('user_id', $userId)->take(3)->get(),
                'rdvs_prochains'        => RendezVousB2B::where('user_id', $userId)->where('date_heure', '>=', now())->orderBy('date_heure')->take(3)->get(),
                'offres_suggeres'       => OffreEmploi::where('statut', 'active')->inRandomOrder()->take(4)->get(),
            ];
        } catch (\Exception) {
            return ['stats' => [], 'candidatures_recentes' => collect(), 'alertes' => collect(), 'rdvs_prochains' => collect(), 'offres_suggeres' => collect()];
        }
    }

    private function dataRecruteur(int $userId): array
    {
        try {
            $offres = OffreEmploi::where('recruteur_id', $userId);
            return [
                'stats' => [
                    ['valeur' => (clone $offres)->where('statut', 'active')->count(), 'label' => 'Offres actives', 'couleur' => '#2e7d32', 'icon' => 'offre'],
                    ['valeur' => Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', $userId))->count(), 'label' => 'Candidatures reçues', 'couleur' => '#1565c0', 'icon' => 'candidature'],
                    ['valeur' => Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', $userId))->where('statut', 'en_attente')->count(), 'label' => 'Nouvelles', 'couleur' => '#f5a623', 'icon' => 'nouveau'],
                    ['valeur' => (clone $offres)->sum('vues'), 'label' => 'Vues des offres', 'couleur' => '#6a1b9a', 'icon' => 'vue'],
                ],
                'offres_recentes'       => (clone $offres)->withCount('candidatures')->latest()->take(5)->get(),
                'candidatures_recentes' => Candidature::whereHas('offreEmploi', fn($q) => $q->where('recruteur_id', $userId))->with('offreEmploi')->latest()->take(5)->get(),
                'rdvs_prochains'        => collect(),
                'alertes'               => collect(),
                'offres_suggeres'       => collect(),
            ];
        } catch (\Exception) {
            return ['stats' => [], 'offres_recentes' => collect(), 'candidatures_recentes' => collect(), 'rdvs_prochains' => collect(), 'alertes' => collect(), 'offres_suggeres' => collect()];
        }
    }

    private function dataEntrepreneur(int $userId): array
    {
        try {
            $profil = ProfilEntrepreneur::where('user_id', $userId)->first();
            return [
                'stats' => [
                    ['valeur' => $profil?->nombre_employes ?? 0, 'label' => 'Employés', 'couleur' => '#2e7d32', 'icon' => 'employe'],
                    ['valeur' => 0, 'label' => 'Opportunités', 'couleur' => '#1565c0', 'icon' => 'opportunite'],
                    ['valeur' => RendezVousB2B::where('user_id', $userId)->count(), 'label' => 'RDV B2B', 'couleur' => '#f5a623', 'icon' => 'rdv'],
                    ['valeur' => $profil?->completion ?? 0, 'label' => '% Profil complété', 'couleur' => '#6a1b9a', 'icon' => 'profil'],
                ],
                'profil_entrepreneur'   => $profil,
                'rdvs_prochains'        => RendezVousB2B::where('user_id', $userId)->where('date_heure', '>=', now())->orderBy('date_heure')->take(3)->get(),
                'candidatures_recentes' => collect(),
                'alertes'               => collect(),
                'offres_suggeres'       => collect(),
                'offres_recentes'       => collect(),
            ];
        } catch (\Exception) {
            return ['stats' => [], 'profil_entrepreneur' => null, 'rdvs_prochains' => collect(), 'candidatures_recentes' => collect(), 'alertes' => collect(), 'offres_suggeres' => collect(), 'offres_recentes' => collect()];
        }
    }

    private function dataAdmin(): array
    {
        return [
            'stats' => [
                ['valeur' => User::count(),        'label' => 'Utilisateurs', 'couleur' => '#1565c0', 'icon' => 'user'],
                ['valeur' => Inscription::count(), 'label' => 'Inscriptions', 'couleur' => '#2e7d32', 'icon' => 'billet'],
                ['valeur' => Candidature::count(), 'label' => 'Candidatures', 'couleur' => '#f5a623', 'icon' => 'candidature'],
                ['valeur' => OffreEmploi::count(), 'label' => 'Offres emploi', 'couleur' => '#6a1b9a', 'icon' => 'offre'],
            ],
            'candidatures_recentes' => collect(),
            'rdvs_prochains'        => collect(),
            'alertes'               => collect(),
            'offres_suggeres'       => collect(),
        ];
    }
}
