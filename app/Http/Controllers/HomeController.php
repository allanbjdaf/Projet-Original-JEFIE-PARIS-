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
            'messageContenu' => "Ce Forum est l'occasion unique de bâtir un système durable et de creer des passerelles concrètes avec la disapora gabonaise,pour que ses talents et son expertise profitent pleinement au gabon.",
            'messageNom'     => 'Le Comité d\'Organisation',
            'messageRole'    => 'Direction Générale',
            'messageAvatar'  => 'dg.jpg',           // ⚠️ public/images/dio.jpg
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
                'valeur' => '2 000+',
                'label' => 'Participants attendus',
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'valeur' => '35000+',
                'label' => 'Gabonais en France',
                'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>'
            ],
            [
                'valeur' => '2000+',
                'label' => 'GABONAIS DE L"EUROPE',
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
            [
                'valeur' => '15',
                'label' => 'Conférences',
                'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v4M8 23h8"/>'
            ],
            [
                'valeur' => '2000',
                'label' => "Entretiens de recrutement",
                'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'
            ],
            [
                'valeur' => '1000+',
                'label' => 'Offres d emplois',
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
            [
                'valeur' => '300+',
                'label' => 'Investisseurs',
                'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>'
            ],
        ];
    }

    private function partenaires(): array
    {
        // ✅ Vos vrais fichiers dans public/images/
        return [
            ['nom' => 'PNUD',           'logo' => 'Pnp.jpg'],
            ['nom' => 'Ministère du Travail, du Plein Emploi du Dialogue Social et la Formation Professionnelle', 'logo' => '16.png'],
            ['nom' => "Ministère des Affaires étrangères et de la Coopération, Chargé de l'Integration",          'logo' => '17.png'],
            ['nom' => "Ministère de l'Economie, des Finances, de la Dette et des Participations, Chargé de la Lutte contre la vie chère",             'logo' => '18.png'],
            ['nom' => 'Société Générale', 'logo' => 'socie.png'],
            ['nom' => 'Ecobank',         'logo' => 'eco.jpg'],
        ];
    }

    private function actualites(): array
    {
        // ✅ Vos vrais fichiers dans public/images/
        return [
            [
                'date'   => '27 novembre',
                'titre'  => 'ZLECAF',
                'resume' => "Le numérique au coeur de la construction d'un marché africain integré.",
                'image'  => 'Cooo.jpg',       // ✅ public/images/Cooo.jpg
                'slug'   => 'ouverture-inscriptions',
                'url_externe' => 'https://gabon24.tv/economie/zlecaf-le-numerique-au-c-ur-de-la-construction-d-un-marche-africain-integre', // Mettre un autre lien ou '#' si interne

            ],
            [
                'date'   => '05 Mai',
                'titre'  => 'Découvrez le programme ',
                'resume' => "51 milliards de FCFA pour reduire la dette de l'Etat envers les entreprises privées.",
                'image'  => 'ina.jpg',        // ✅ public/images/Ctr.jpg
                'slug'   => 'programme-complet',
                'url_externe' => 'https://gabon24.tv/economie/gabon-51-milliards-de-fcfa-pour-reduire-la-dette-de-l-etat-envers-les-entreprises-privees', // <-- Lien ajouté ici

            ],
            [
                'date'   => '28 Avr',
                'titre'  => 'Appel à communication ouvert aux chercheurs',
                'resume' => 'Relance de la filière Forêt-Bois:Oligui Nguema débloque 20 milliards de FCFA pour les entreprises.',
                'image'  => 'CGFjpg.jpg',     // ✅ public/images/CGFjpg.jpg
                'slug'   => 'appel-communication',
                'url_externe' => 'https://gabon24.tv/economie/relance-de-la-filiere-foret-bois-oligui-nguema-debloque-20-milliards-de-fcfa-pour-les-operateurs', // Mettre un autre lien ou '#' si interne

            ],
        ];
    }

    private function videos(): array
    {
        // ✅ Votre vraie vidéo mp4 + images thumbnail disponibles
        return [
            [
                'titre'     => 'Gabon : un partenariat relancé avec la BAD pour accélérer la diversification économique',
                'thumbnail' => 'bo.jpg',          // ✅ public/images/bo.jpg
                'src_mp4'   => 'vd.mp4',          // ✅ public/images/vd.mp4
                'youtube_id' => '',
                'url_externe' => 'https://gabon24.tv/economie/gabon-un-partenariat-relance-avec-la-bad-pour-accelerer-la-diversification-economique', // <-- Lien Gabon24

            ],
            [
                'titre'     => 'Makokou : 50 nouvelles villas pour renforcer l’offre de logements',
                'thumbnail' => 'boaa.jpg',         // ✅ public/images/boaa.jpg
                'src_mp4'   => '',
                'youtube_id' => '',
                'url_externe' => 'https://gabon24.tv/societe/makokou-50-nouvelles-villas-pour-renforcer-l-offre-de-logements', // <-- Lien Gabon24

            ],
            [
                'titre'     => 'Gabon : Oligui Nguema accélère la modernisation des services publics et dynamise l’économie locale',
                'thumbnail' => 'son.jpg',          // ✅ public/images/son.jpg
                'src_mp4'   => '',
                'youtube_id' => '',
                'url_externe' => 'https://gabon24.tv/economie/gabon-oligui-nguema-accelere-la-okmodernisation-des-services-publics-et-dynamise-leconomie-locale', // <-- Lien Gabon24

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
