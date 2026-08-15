<?php
// app/Http/Controllers/ProgrammeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(Request $request): View
    {
        $jourActif = $request->get('jour', 1);

        return view('programme', [
            'jours'           => $this->jours(),
            'activites'       => $this->activitesParJour($jourActif),
            'jourActif'       => (int) $jourActif,
            'aNesPasManquer'  => $this->aNesPasManquer(),
            'accesRapides'    => $this->accesRapides(), // <-- CORRIGÉ : Un seul "e" pour correspondre à Blade
            'thematiques'     => $this->thematiques(),
            'intervenants'    => $this->intervenants(),
            'formats'         => $this->formats(),
        ]);
    }


    // ── Données ────────────────────────────────────────────────────

    private function jours(): array
    {
        return [
            ['num' => 1, 'label' => 'Jour 1', 'date' => '15 septembre 2026'],
            ['num' => 2, 'label' => 'Jour 2', 'date' => '16 septembre 2026'],
            ['num' => 3, 'label' => 'Jour 3', 'date' => '17 septembre 2026'],
            ['num' => 4, 'label' => 'Jour 4', 'date' => '18 septembre 2026'],
        ];
    }

    private function activitesParJour(int $jour): array
    {
        $data = [
            1 => [
                [
                    'heure_debut' => '09:00',
                    'heure_fin' => '10:00',
                    'type' => 'conference',
                    'type_label' => 'Conférence d\'ouverture',
                    'titre' => 'L\'innovation au service du développement durable',
                    'salle' => 'Salle plénière',
                    'places_total' => null,
                    'places_restantes' => null,
                    'photo' => 'bao.jpg',
                    'couleur' => '#1565c0',
                    'bg' => '#e3f2fd',
                    'intervenant_nom' => 'Pr. Amadou KONÉ',
                    'intervenant_role' => 'Président du Comité',
                    'nb_intervenants' => 5,
                    'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8"/>',
                ],
                [
                    'heure_debut' => '10:30',
                    'heure_fin' => '12:00',
                    'type' => 'panel',
                    'type_label' => 'Panel',
                    'titre' => 'Innovation Africa : défis et opportunités',
                    'salle' => 'Salle A',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#6a1b9a',
                    'bg' => '#ede7f6',
                    'intervenants' => [
                        [
                            'nom' => 'Jean Dupont',
                            'role' => 'Expert IA',
                            'photo' => 'bo.jpg',
                        ],
                        [
                            'nom' => 'Marie Ngoma',
                            'role' => 'CEO Tech',
                            'photo' => 'boaa.jpg',
                        ],
                        [
                            'nom' => 'Paul Smith',
                            'role' => 'Investisseur',
                            'photo' => 'baoo.jpeg',
                        ],
                        [
                            'nom' => 'Amina Diallo',
                            'role' => 'Entrepreneure',
                            'photo' => 'bao.jpg',
                        ],
                    ],
                    'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
                ],
                [
                    'heure_debut' => '14:00',
                    'heure_fin' => '16:00',
                    'type' => 'atelier',
                    'type_label' => 'Atelier',
                    'titre' => 'Intelligence Artificielle & Business',
                    'salle' => 'Salle B',
                    'places_total' => 30,
                    'places_restantes' => 20,
                    'couleur' => '#2e7d32',
                    'bg' => '#e8f5e9',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 2,
                    'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>',
                ],
                [
                    'heure_debut' => '16:30',
                    'heure_fin' => '18:00',
                    'type' => 'networking',
                    'type_label' => 'Session Networking',
                    'titre' => 'Cocktail & échanges professionnels',
                    'salle' => 'Espace Networking',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#e65100',
                    'bg' => '#fff3e0',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 0,
                    'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>',
                ],
                [
                    'heure_debut' => '18:30',
                    'heure_fin' => '20:00',
                    'type' => 'b2b',
                    'type_label' => 'Rendez-vous B2B',
                    'titre' => 'Rencontrez des partenaires qualifiés',
                    'salle' => 'Espace B2B',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#1565c0',
                    'bg' => '#e3f2fd',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 0,
                    'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>',
                ],
                [
                    'heure_debut' => '20:30',
                    'heure_fin' => '22:00',
                    'type' => 'pitch',
                    'type_label' => 'Pitchs entrepreneuriaux',
                    'titre' => 'Session investisseurs',
                    'salle' => 'Salle Pitch',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#c62828',
                    'bg' => '#ffebee',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 8,
                    'icon' => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>',
                ],
            ],
            2 => [
                [
                    'heure_debut' => '09:00',
                    'heure_fin' => '10:30',
                    'type' => 'conference',
                    'type_label' => 'Conférence',
                    'titre' => 'Financement de l\'innovation en Afrique',
                    'salle' => 'Salle plénière',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#1565c0',
                    'bg' => '#e3f2fd',
                    'intervenant_nom' => 'Dr. Marie Kouassi',
                    'intervenant_role' => 'DG BAD',
                    'nb_intervenants' => 3,
                    'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8"/>',
                ],
                [
                    'heure_debut' => '10:00',
                    'heure_fin' => '12:00',
                    'type' => 'atelier',
                    'type_label' => 'Atelier Design Thinking',
                    'titre' => 'Méthodes agiles pour l\'innovation',
                    'salle' => 'Salle B',
                    'places_total' => 25,
                    'places_restantes' => 10,
                    'couleur' => '#2e7d32',
                    'bg' => '#e8f5e9',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 2,
                    'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83"/>',
                ],
            ],

            [
                'heure_debut' => '10:30',
                'heure_fin' => '12:00',
                'type' => 'panel',
                'type_label' => 'Panel',
                'titre' => 'Innovation Africa : défis et opportunités',
                'salle' => 'Salle A',
                'places_total' => null,
                'places_restantes' => null,
                'couleur' => '#6a1b9a',
                'bg' => '#ede7f6',
                'intervenants' => [
                    [
                        'nom' => 'Jean Dupont',
                        'role' => 'Expert IA',
                        'photo' => 'bo.jpg',
                    ],
                    [
                        'nom' => 'Marie Ngoma',
                        'role' => 'CEO Tech',
                        'photo' => 'boaa.jpg',
                    ],
                    [
                        'nom' => 'Paul Smith',
                        'role' => 'Investisseur',
                        'photo' => 'baoo.jpeg',
                    ],
                    [
                        'nom' => 'Amina Diallo',
                        'role' => 'Entrepreneure',
                        'photo' => 'bao.jpg',
                    ],
                ],
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
            ],
            [
                'heure_debut' => '14:00',
                'heure_fin' => '16:00',
                'type' => 'atelier',
                'type_label' => 'Atelier',
                'titre' => 'Intelligence Artificielle & Business',
                'salle' => 'Salle B',
                'places_total' => 30,
                'places_restantes' => 20,
                'couleur' => '#2e7d32',
                'bg' => '#e8f5e9',
                'intervenant_nom' => null,
                'intervenant_role' => null,
                'nb_intervenants' => 2,
                'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>',
            ],
            [
                'heure_debut' => '16:30',
                'heure_fin' => '18:00',
                'type' => 'networking',
                'type_label' => 'Session Networking',
                'titre' => 'Cocktail & échanges professionnels',
                'salle' => 'Espace Networking',
                'places_total' => null,
                'places_restantes' => null,
                'couleur' => '#e65100',
                'bg' => '#fff3e0',
                'intervenant_nom' => null,
                'intervenant_role' => null,
                'nb_intervenants' => 0,
                'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>',
            ],

            3 => [
                [
                    'heure_debut' => '09:30',
                    'heure_fin' => '11:00',
                    'type' => 'panel',
                    'type_label' => 'Panel',
                    'titre' => 'Diaspora & Développement : ponts économiques',
                    'salle' => 'Salle A',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#6a1b9a',
                    'bg' => '#ede7f6',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 5,
                    'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>',
                ],
                [
                    'heure_debut' => '16:30',
                    'heure_fin' => '18:30',
                    'type' => 'networking',
                    'type_label' => 'Networking Cocktail',
                    'titre' => 'Soirée de gala et networking',
                    'salle' => 'Espace Networking',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#e65100',
                    'bg' => '#fff3e0',
                    'intervenant_nom' => null,
                    'intervenant_role' => null,
                    'nb_intervenants' => 0,
                    'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78"/>',
                ],
            ],
            4 => [
                [
                    'heure_debut' => '09:00',
                    'heure_fin' => '10:00',
                    'type' => 'conference',
                    'type_label' => 'Conférence de clôture',
                    'titre' => 'Bilan et perspectives pour l\'avenir',
                    'salle' => 'Salle plénière',
                    'places_total' => null,
                    'places_restantes' => null,
                    'couleur' => '#1565c0',
                    'bg' => '#e3f2fd',
                    'intervenant_nom' => 'SEM. Président du Comité',
                    'intervenant_role' => 'Président',
                    'nb_intervenants' => 6,
                    'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/>',
                ],
            ],
        ];
        return $data[$jour] ?? $data[1];
    }

    private function aNesPasManquer(): array
    {
        return [
            ['date' => '15 JUIN · 09:00', 'titre' => 'Conférence d\'ouverture',       'salle' => 'Salle plénière',    'color' => '#1565c0', 'photo' => 'bao.jpg'],
            ['date' => '15 JUIN · 14:00', 'titre' => 'Panel Innovation Africa',        'salle' => 'Salle A',           'color' => '#6a1b9a', 'photo' => 'Cooo.jpg'],
            ['date' => '16 JUIN · 10:00', 'titre' => 'Atelier Design Thinking',        'salle' => 'Salle B',           'color' => '#2e7d32', 'photo' => 'coo.jpg'],
            ['date' => '17 JUIN · 16:30', 'titre' => 'Networking Cocktail',            'salle' => 'Espace Networking', 'color' => '#e65100', 'photo' => 'co.jpg'],
        ];
    }

    private function accesRapides(): array
    {
        return [
            ['label' => 'Conférences', 'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8"/>',    'color' => '#1565c0'],
            ['label' => 'Panels',      'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/>', 'color' => '#6a1b9a'],
            ['label' => 'Ateliers',    'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',                                                                 'color' => '#2e7d32'],
            ['label' => 'Networking',  'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23"/>',             'color' => '#e65100'],
            ['label' => 'B2B',         'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>',                 'color' => '#00838f'],
            ['label' => 'Pitchs',      'icon' => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>',                             'color' => '#c62828'],
        ];
    }

    private function thematiques(): array
    {
        return [
            'Innovation & Tech',
            'Finance & Investissement',
            'Développement durable',
            'Diaspora & Entrepreneuriat',
            'Éducation & Formation',
            'Santé & Bien-être'
        ];
    }

    private function intervenants(): array
    {
        return [
            'Pr. Amadou KONÉ',
            'Dr. Marie Kouassi',
            'SEM. Jean Diallo',
            'Dr. Amina Maiga',
            'Prof. Ibrahim Traoré'
        ];
    }

    private function formats(): array
    {
        return ['Conférence', 'Panel', 'Atelier', 'Networking', 'B2B', 'Pitch'];
    }
}
