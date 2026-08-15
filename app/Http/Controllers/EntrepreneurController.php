<?php
// app/Http/Controllers/EntrepreneurDashboardController.php

namespace App\Http\Controllers;

use App\Models\EntrepreneurProfil;
use App\Models\Opportunite;
use App\Models\RendezVous;
use App\Models\ParticipationForum;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; // ✅ AJOUTÉ : Permet d'utiliser Auth::user() sans erreur


use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware; // 1. On importe l'interface


class EntrepreneurController extends Controller
{

    // 3. On remplace le constructeur par cette méthode statique obligatoire
    public static function middleware(): array
    {
        return [
            'auth', // Applique le middleware à toutes les fonctions du contrôleur
        ];
    }

    public function index(): View
    {
        // ✅ CORRIGÉ : Utilisation sécurisée de la façade Auth
        $user = Auth::user();


        // Profil de l'entrepreneur connecté
        $monProfil = EntrepreneurProfil::where('user_id', $user->id)->first();

        // Entrepreneurs à la une (4)
        $entrepreneursUne = EntrepreneurProfil::where('a_la_une', true)
            ->orderByDesc('updated_at')
            ->take(4)
            ->get();

        // Opportunités récentes (3)
        $opportunites = Opportunite::latest('date')->take(3)->get();

        // Prochains rendez-vous (3)
        $rendezvous = RendezVous::where('user_id', $user->id)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->take(3)
            ->get();

        // Participation au forum
        $participation    = ParticipationForum::where('user_id', $user->id)->first();
        $detailsParticipation = $this->buildDetailsParticipation($participation);

        // Infos clés du profil pour sidebar
        $infosClés = $this->buildInfosCles($monProfil);

        // Listes de filtres pour la recherche
        return view('entrepreneurs', [
            'monProfil'            => $monProfil,
            'entrepreneursUne'     => $entrepreneursUne,
            'opportunites'         => $opportunites,
            'rendezvous'           => $rendezvous,
            'participation'        => $participation,
            'detailsParticipation' => $detailsParticipation,
            'infosClés'            => $infosClés,
            'nbMessages'           => 0, // ✅ Fixé temporairement à 0 pour bloquer l'erreur $user->messages()->unread()->count(),
            'heroStats'            => $this->heroStats(),
            'secteurs'             => $this->listeSecteurs(),
            'pays'                 => $this->listePays(),
            'villes'               => $this->listeVilles(),
            'tailles'              => $this->listeTailles(),
        ]);
    }

    // ── Helpers privés ─────────────────────────────────────────────

    private function buildInfosCles(?EntrepreneurProfil $p): array
    {
        if (!$p) return [];
        return [
            [
                'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
                'label' => "Secteur d'activité",
                'valeur' => $p->secteur_activite  ?? '—'
            ],
            [
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>',
                'label' => "Taille de l'entreprise",
                'valeur' => $p->taille_entreprise ?? '—'
            ],
            [
                'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>',
                'label' => "Chiffre d'affaires",
                'valeur' => $p->chiffre_affaires  ?? '—'
            ],
            [
                'icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>',
                'label' => "Capacités d'invest.",
                'valeur' => $p->capacite_investissement ?? '—'
            ],
            [
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',
                'label' => "Domaines d'expertise",
                'valeur' => $p->domaines_expertise ?? '—'
            ],
            [
                'icon' => '<path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>',
                'label' => "Projets économiques",
                'valeur' => $p->projets_economiques ?? '—'
            ],
        ];
    }

    private function buildDetailsParticipation(?ParticipationForum $p): array
    {
        if (!$p) return [];
        return [
            ['label' => 'Stand réservé',      'valeur' => $p->stand        ?? '—',    'style' => ''],
            ['label' => 'Documents soumis',   'valeur' => $p->docs_soumis  ?? '—',    'style' => 'ok'],
            ['label' => 'Rendez-vous programmés', 'valeur' => $p->nb_rdv   ?? '0',    'style' => ''],
        ];
    }

    private function heroStats(): array
    {
        return [
            [
                'valeur' => '1 250',
                'label' => "Entrepreneurs\ninscrits",
                'color' => '#1565c0',
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'valeur' => '820',
                'label' => "Entreprises\nréférencées",
                'color' => '#2e7d32',
                'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>'
            ],
            [
                'valeur' => '430',
                'label' => "Projets\néconomiques",
                'color' => '#6a1b9a',
                'icon' => '<path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>'
            ],
            [
                'valeur' => '150',
                'label' => "Investisseurs\nmembres",
                'color' => '#e65100',
                'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>'
            ],
            [
                'valeur' => '12',
                'label' => "Pays\nreprésentés",
                'color' => '#00838f',
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
        ];
    }

    private function listeSecteurs(): array
    {
        return [
            'Technologies de l\'information',
            'Agriculture & Agroalimentaire',
            'Finance & Assurance',
            'BTP & Immobilier',
            'Commerce & Distribution',
            'Énergie & Mines',
            'Santé & Pharmacie',
            'Transport & Logistique',
            'Autre'
        ];
    }

    private function listePays(): array
    {
        return [
            'France',
            'Belgique',
            'Allemagne',
            'Espagne',
            'Portugal',
            'Italie',
            'Pays-Bas',
            'Suisse',
            'Royaume-Uni',
            'Luxembourg'
        ];
    }

    private function listeVilles(): array
    {
        return [
            'Paris',
            'Lyon',
            'Marseille',
            'Bordeaux',
            'Bruxelles',
            'Berlin',
            'Madrid',
            'Amsterdam',
            'Genève',
            'Londres'
        ];
    }

    private function listeTailles(): array
    {
        return [
            'Auto-entrepreneur',
            '1 – 9 salariés',
            'PME (11 – 50 employés)',
            '50 – 249 salariés',
            '250 salariés et plus'
        ];
    }
}
