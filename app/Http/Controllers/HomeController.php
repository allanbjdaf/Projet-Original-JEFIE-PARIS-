<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('index', [
            'chiffres'       => $this->chiffres(),
            'partenaires'    => $this->partenaires(),
            'actualites'     => $this->actualites(),
            'videos'         => $this->videos(),
            'appels'         => $this->appels(),
            // Vision & Message
            'vision'         => "Être le catalyseur de l'innovation en Afrique en créant un espace de rencontres, d'échanges et de synergies pour un avenir prospère et durable.",
            'visionImage'    => '263.png',           // ⚠️ public/images/vis.jpg
            'messageContenu' => "Ce Forum est une opportunité unique de bâtir ensemble des solutions innovantes, inclusives et durables pour répondre aux défis de notre époque et préparer les générations futures.",
            'messageNom'     => 'Le Comité d\'Organisation',
            'messageRole'    => 'Direction Générale',
            'messageAvatar'  => 'dio.jpg',           // ⚠️ public/images/dio.jpg
            'heroVideoThumb' => null,                // pas de thumbnail, on utilise la vidéo mp4
        ]);
    }

    public function storeInscription(Request $request)
    {
        $validated = $request->validate([
            'nom_complet'  => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
        ]);

        return redirect()->route('home')
            ->with('success', 'Votre inscription a bien été enregistrée !');
    }

    // ── Données ───────────────────────────────────────────────────

    private function chiffres(): array
    {
        return [
            [
                'valeur' => '5 000+',
                'label' => 'Participants attendus',
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'valeur' => '50+',
                'label' => 'Partenaires',
                'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>'
            ],
            [
                'valeur' => '20+',
                'label' => 'Pays représentés',
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
            [
                'valeur' => '15',
                'label' => 'Conférences',
                'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8"/>'
            ],
            [
                'valeur' => '3',
                'label' => "Jours d'échanges",
                'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'
            ],
        ];
    }

    private function partenaires(): array
    {
        // ✅ Vos vrais fichiers dans public/images/
        return [
            ['nom' => 'PNUD',           'logo' => 'Pnp.jpg'],
            ['nom' => 'Banque Mondiale', 'logo' => 'ba.jpg'],
            ['nom' => 'UNESCO',          'logo' => 'ue.png'],
            ['nom' => 'AFD',             'logo' => 'cgforga.png'],
            ['nom' => 'BAD',             'logo' => 'bao.jpg'],
            ['nom' => 'Orange',          'logo' => 'ora.png'],
            ['nom' => 'Société Générale', 'logo' => 'socie.png'],
            ['nom' => 'Ecobank',         'logo' => 'eco.jpg'],
        ];
    }

    private function actualites(): array
    {
        // ✅ Vos vrais fichiers dans public/images/
        return [
            [
                'date'   => '10 Mai',
                'titre'  => 'Ouverture des inscriptions officielles du Forum 2026',
                'resume' => 'Les inscriptions pour le Forum International de l\'Innovation 2026 sont désormais ouvertes. Réservez votre place dès maintenant.',
                'image'  => 'Cooo.jpg',       // ✅ public/images/Cooo.jpg
                'slug'   => 'ouverture-inscriptions',
            ],
            [
                'date'   => '05 Mai',
                'titre'  => 'Découvrez le programme complet du Forum',
                'resume' => 'Consultez le programme des conférences, ateliers et tables rondes prévus lors des 3 jours de l\'événement.',
                'image'  => 'Ctr.jpg',        // ✅ public/images/Ctr.jpg
                'slug'   => 'programme-complet',
            ],
            [
                'date'   => '28 Avr',
                'titre'  => 'Appel à communication ouvert aux chercheurs',
                'resume' => 'Soumettez vos propositions d\'interventions et de communications scientifiques avant le 30 mai 2026.',
                'image'  => 'CGFjpg.jpg',     // ✅ public/images/CGFjpg.jpg
                'slug'   => 'appel-communication',
            ],
        ];
    }

    private function videos(): array
    {
        // ✅ Votre vraie vidéo mp4 + images thumbnail disponibles
        return [
            [
                'titre'     => 'Teaser officiel Forum 2026',
                'thumbnail' => 'bo.jpg',          // ✅ public/images/bo.jpg
                'src_mp4'   => 'vd.mp4',          // ✅ public/images/vd.mp4
                'youtube_id' => '',
            ],
            [
                'titre'     => 'Retour en images — Édition 2024',
                'thumbnail' => 'boaa.jpg',         // ✅ public/images/boaa.jpg
                'src_mp4'   => '',
                'youtube_id' => '',
            ],
            [
                'titre'     => 'Témoignages des participants',
                'thumbnail' => 'son.jpg',          // ✅ public/images/son.jpg
                'src_mp4'   => '',
                'youtube_id' => '',
            ],
        ];
    }

    private function appels(): array
    {
        return [
            ['label' => 'Exposants',    'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
            ['label' => 'Partenaires',  'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['label' => 'Intervenants', 'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/>'],
            ['label' => 'Bénévoles',    'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23"/>'],
        ];
    }
}
