<?php
// app/Http/Controllers/CartographieController.php

namespace App\Http\Controllers;

use App\Models\EntrepreneurProfil;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class CartographieController extends Controller
{
    public function index(Request $request): View
    {
        // Stats globales du tableau de bord
        $stats = $this->statsGlobales();

        // Données carte (points géolocalisés groupés par pays)
        $pointsCarte = $this->pointsCarte($request);

        // Entrepreneurs à la une (5)
        $entrepreneursUne = EntrepreneurProfil::where('a_la_une', true)
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();

        // Répartition par continent
        $repartitionContinent = $this->repartitionContinent();

        // Top 5 secteurs
        $topSecteurs = $this->topSecteurs();

        // Répartition par capacité économique
        $repartitionCapacite = $this->repartitionCapacite();

        // Évolution des indicateurs
        $evolutionIndicateurs = $this->evolutionIndicateurs();

        return view('cartographie', [
            'stats'                  => $stats,
            'pointsCarte'            => $pointsCarte,
            'entrepreneursUne'       => $entrepreneursUne,
            'repartitionContinent'   => $repartitionContinent,
            'topSecteurs'            => $topSecteurs,
            'repartitionCapacite'    => $repartitionCapacite,
            'evolutionIndicateurs'   => $evolutionIndicateurs,
            'pays'                   => $this->listePays(),
            'villes'                 => $this->listeVilles(),
            'secteurs'               => $this->listeSecteurs(),
            'annees'                 => range(1990, 2024),
        ]);
    }

    // Filtre AJAX pour la carte
    public function filter(Request $request): JsonResponse
    {
        $points = $this->pointsCarte($request);
        return response()->json(['points' => $points]);
    }

    // ── Données de référence ─────────────────────────────────────

    private function statsGlobales(): array
    {
        return [
            [
                'label' => 'Entrepreneurs référencés',
                'valeur' => '3 811',
                'evolution' => '+12,5%',
                'sous' => 'vs année précédente',
                'color' => '#f5a623',
                'bg' => '#f5a62322', // <-- Clé bg ajoutée
                'dark' => true,
                'icon'  => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'label' => 'Pays représentés',
                'valeur' => '78',
                'evolution' => '+8',
                'sous' => 'vs année précédente',
                'color' => '#1565c0',
                'bg' => '#f5a62322', // <-- Clé bg ajoutée
                'dark' => false,
                'icon'  => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
            [
                'label' => 'Entreprises',
                'valeur' => '2 945',
                'evolution' => '+10,2%',
                'sous' => 'vs année précédente',
                'color' => '#2e7d32',
                'bg' => '#f5a62322', // <-- Clé bg ajoutée
                'dark' => false,
                'icon'  => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'
            ],
            [
                'label' => 'Emplois créés',
                'valeur' => '14 732',
                'evolution' => '+15,7%',
                'sous' => 'vs année précédente',
                'color' => '#6a1b9a',
                'bg' => '#f5a62322', // <-- Clé bg ajoutée
                'dark' => false,
                'icon'  => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>'
            ],
            [
                'label' => "Chiffre d'affaires cumulé",
                'valeur' => '850 Mds FCFA',
                'evolution' => '+48,1%',
                'sous' => 'vs année précédente',
                'color' => '#e65100',
                'bg' => '#f5a62322', // <-- Clé bg ajoutée
                'dark' => false,
                'icon'  => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>'
            ],
        ];
    }

    private function pointsCarte(Request $request): array
    {
        // Données statiques représentant les clusters par pays/région
        return [
            ['lat' => 48.8,  'lng' => 2.3,   'count' => 1256, 'label' => 'France',       'color' => '#e53935'],
            ['lat' => 51.5,  'lng' => -0.1,  'count' => 312,  'label' => 'Royaume-Uni',  'color' => '#1e88e5'],
            ['lat' => 52.5,  'lng' => 13.4,  'count' => 178,  'label' => 'Allemagne',    'color' => '#43a047'],
            ['lat' => 40.4,  'lng' => -3.7,  'count' => 96,   'label' => 'Espagne',      'color' => '#fb8c00'],
            ['lat' => 50.8,  'lng' => 4.3,   'count' => 224,  'label' => 'Belgique',     'color' => '#8e24aa'],
            ['lat' => 40.7,  'lng' => -74.0, 'count' => 532,  'label' => 'USA',          'color' => '#00897b'],
            ['lat' => 45.5,  'lng' => -73.5, 'count' => 124,  'label' => 'Canada',       'color' => '#f4511e'],
            ['lat' => -23.5, 'lng' => -46.6, 'count' => 74,   'label' => 'Brésil',       'color' => '#43a047'],
            ['lat' => -33.9, 'lng' => 18.4,  'count' => 58,   'label' => 'Afrique du Sud', 'color' => '#1e88e5'],
            ['lat' => -4.3,  'lng' => 15.3,  'count' => 96,   'label' => 'Congo',        'color' => '#e53935'],
            ['lat' => 35.7,  'lng' => 139.7, 'count' => 38,   'label' => 'Japon',        'color' => '#fb8c00'],
        ];
    }

    private function repartitionContinent(): array
    {
        return [
            ['label' => 'Europe',    'valeur' => 1674, 'pct' => 43.9, 'color' => '#1565c0'],
            ['label' => 'Afrique',   'valeur' => 786,  'pct' => 20.6, 'color' => '#2e7d32'],
            ['label' => 'Amériques', 'valeur' => 687,  'pct' => 18.0, 'color' => '#f5a623'],
            ['label' => 'Asie',      'valeur' => 425,  'pct' => 11.1, 'color' => '#8e24aa'],
            ['label' => 'Océanie',   'valeur' => 239,  'pct' => 6.3,  'color' => '#00897b'],
        ];
    }

    private function topSecteurs(): array
    {
        return [
            ['label' => 'Services',      'valeur' => 1156, 'pct' => 30.3, 'color' => '#1565c0'],
            ['label' => 'Technologies',  'valeur' => 964,  'pct' => 25.3, 'color' => '#2e7d32'],
            ['label' => 'Commerce',      'valeur' => 645,  'pct' => 16.9, 'color' => '#f5a623'],
            ['label' => 'Industrie',     'valeur' => 412,  'pct' => 10.8, 'color' => '#8e24aa'],
            ['label' => 'Agriculture',   'valeur' => 258,  'pct' => 6.7,  'color' => '#00897b'],
        ];
    }

    private function repartitionCapacite(): array
    {
        return [
            ['label' => 'Émergente',    'valeur' => 1089, 'pct' => 28.6, 'color' => '#1565c0'],
            ['label' => 'En croissance', 'valeur' => 1256, 'pct' => 33.0, 'color' => '#2e7d32'],
            ['label' => 'Établie',      'valeur' => 1034, 'pct' => 27.1, 'color' => '#f5a623'],
            ['label' => 'Leader',       'valeur' => 432,  'pct' => 11.3, 'color' => '#8e24aa'],
        ];
    }

    private function evolutionIndicateurs(): array
    {
        return [
            ['label' => 'Entrepreneurs', 'valeur' => '3 811',        'evolution' => '+12,5%', 'color' => '#1565c0'],
            ['label' => 'Entreprises',   'valeur' => '2 945',        'evolution' => '+10,2%', 'color' => '#2e7d32'],
            ['label' => 'Emplois créés', 'valeur' => '14 732',       'evolution' => '+15,7%', 'color' => '#f5a623'],
            ['label' => "Chiffre d'aff.", 'valeur' => '850 Mds FCFA', 'evolution' => '+18,3%', 'color' => '#8e24aa'],
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
            'USA',
            'Canada',
            'Brésil',
            'Afrique du Sud',
            'Congo',
            'Gabon'
        ];
    }

    private function listeVilles(): array
    {
        return [
            'Paris',
            'Lyon',
            'Marseille',
            'Bruxelles',
            'Berlin',
            'Madrid',
            'New York',
            'Montréal',
            'Libreville'
        ];
    }

    private function listeSecteurs(): array
    {
        return [
            'Technologies',
            'Services',
            'Commerce',
            'Industrie',
            'Agriculture',
            'Santé',
            'Éducation',
            'Autres'
        ];
    }
}
