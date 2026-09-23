<?php
// app/Http/Controllers/AProposController.php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class AProposController extends Controller
{
    public function index(): View
    {
        return view('Apropos', [
            'stats'      => $this->stats(),
            'valeurs'    => $this->valeurs(),
            'timeline'   => $this->timeline(),
            'equipe'     => $this->equipe(),
            'partenaires' => $this->partenaires(),
            'faq'        => $this->faqItems(),
        ]);
    }

    private function stats(): array
    {
        return [
            ['valeur' => '5 000+',  'label' => 'Participants attendus',    'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['valeur' => '50+',     'label' => 'Pays représentés',         'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'],
            ['valeur' => '200+',    'label' => 'Intervenants & experts',   'icon' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>'],
            ['valeur' => '3',       'label' => "Jours d'innovation",       'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
            ['valeur' => '120+',    'label' => 'Partenaires officiels',    'icon' => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>'],
            ['valeur' => '2ème',    'label' => 'Édition du Forum',         'icon' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>'],
        ];
    }

    private function valeurs(): array
    {
        return [
            [
                'titre'  => 'Innovation',
                'desc'   => "Créer une plateforme moderne reliant la diaspora aux opportunités économiques du Gabon. Mettre en place de nouvelles passerelles entre talents, entreprises, investisseurs et institutions. Développer des mécanismes de suivi pour mesurer les résultats après l’événement.",
                'couleur' => '#1565c0',
                'bg'     => '#e3f2fd',
                'icon'   => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',
            ],
            [
                'titre'  => 'Inclusivité',
                'desc'   => "Rassembler demandeurs d’emploi, entrepreneurs, investisseurs, entreprises et institutions autour d’un même espace. Donner à chaque compétence gabonaise, quel que soit son parcours ou son lieu de résidence, la possibilité de contribuer. Favoriser un accès élargi aux opportunités professionnelles et économiques.",
                'couleur' => '#2e7d32',
                'bg'     => '#e8f5e9',
                'icon'   => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
            ],
            [
                'titre'  => 'Impact',
                'desc'   => "Créer des opportunités concrètes d’emploi, d’entrepreneuriat et d’investissement au Gabon. Faciliter les recrutements et les mises en relation entre compétences et entreprises. Transformer les rencontres en projets, partenariats et investissements durables.",
                'couleur' => '#f5a623',
                'bg'     => '#fff8e6',
                'icon'   => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>',
            ],
            [
                'titre'  => 'Excellence',
                'desc'   => " Valoriser les compétences, l’expertise et les expériences professionnelles acquises au Gabon comme à l’international. Mettre en relation les meilleurs talents avec les besoins réels des entreprises. Promouvoir des échanges professionnels fondés sur la qualité, la compétence et la création de valeur.",
                'couleur' => '#6a1b9a',
                'bg'     => '#ede7f6',
                'icon'   => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
            ],
            [
                'titre'  => 'Diaspora',
                'desc'   => "Faire de la diaspora gabonaise un acteur pleinement engagé dans le développement économique du pays. Mobiliser ses compétences, ses réseaux, son expérience et sa capacité d’investissement. Créer des passerelles durables entre les Gabonais de l’étranger et les acteurs économiques nationaux.",
                'couleur' => '#e65100',
                'bg'     => '#fff3e0',
                'icon'   => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>',
            ],
            [
                'titre'  => 'Durabilité',
                'desc'   => "Inscrire les JEFIE au-delà d’un événement ponctuel, dans une dynamique permanente de mobilisation. Assurer le suivi des recrutements, projets, partenariats et investissements initiés. Construire un réseau durable de compétences et d’acteurs économiques au service du développement du Gabon.",
                'couleur' => '#00838f',
                'bg'     => '#e0f7fa',
                'icon'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            ],
        ];
    }

    private function timeline(): array
    {
        return [
            [
                'annee'  => '2023',
                'titre'  => 'Naissance du projet',
                'desc'   => "Un groupe d'entrepreneurs de la diaspora gabonaise réuni à Paris initie l'idée d'un forum international dédié à l'innovation africaine.",
                'couleur' => '#f5a623',
            ],
            [
                'annee'  => '2024',
                'titre'  => '1ère édition — Succès historique',
                'desc'   => "La première édition réunit 2 800 participants de 38 pays. 45 partenariats stratégiques signés, 12 M€ de projets lancés.",
                'couleur' => '#1565c0',
            ],
            [
                'annee'  => '2025',
                'titre'  => 'Expansion internationale',
                'desc'   => "Ouverture de représentations dans 8 pays. Création de l'annuaire numérique des entrepreneurs de la diaspora (3 800+ profils).",
                'couleur' => '#2e7d32',
            ],
            [
                'annee'  => '2026',
                'titre'  => '2ème édition — Paris',
                'desc'   => "La 2ème édition vise 5 000+ participants de 50+ pays. Thème : \"Innover, Collaborer, Transformer l'Avenir\".",
                'couleur' => '#0d1b3e',
            ],
        ];
    }

    private function equipe(): array
    {
        return [
            ['nom' => 'Jean-Baptiste Moussavou', 'poste' => 'Président du Comité d\'organisation', 'photo' => 'boaa.jpg', 'linkedin' => '#'],
            ['nom' => 'Aïcha Nzamba',            'poste' => 'Directrice générale',                  'photo' => 'baoo.jpeg', 'linkedin' => '#'],
            ['nom' => 'Pierre Obiang',            'poste' => 'Directeur des partenariats',           'photo' => 'bao.jpg', 'linkedin' => '#'],
            ['nom' => 'Fatima Mba',               'poste' => 'Responsable programme',                'photo' => 'bo.jpg', 'linkedin' => '#'],
            ['nom' => 'David Nguema',             'poste' => 'Directeur technique & digital',        'photo' => 'dio.jpg', 'linkedin' => '#'],
            ['nom' => 'Sandrine Ella',            'poste' => 'Coordinatrice diaspora',               'photo' => 'bao.jpg', 'linkedin' => '#'],
        ];
    }

    private function partenaires(): array
    {
        return [
            ['nom' => 'Union Africaine',    'logo' => 'mec.png', 'initiale' => 'UA'],
            ['nom' => 'BAD',                'logo' => 'ba.jpg', 'initiale' => 'BAD'],
            ['nom' => 'ONU',                'logo' => 'Pnp.jpg', 'initiale' => 'ONU'],
            ['nom' => 'Union Européenne',   'logo' => 'ue.png', 'initiale' => 'UE'],
            ['nom' => 'Orange',             'logo' => 'ora.png', 'initiale' => 'O'],
            ['nom' => 'Ecobank',            'logo' => 'eco.jpg', 'initiale' => 'E'],
            ['nom' => 'Sonatel',            'logo' => 'son.jpg', 'initiale' => 'S'],
            ['nom' => 'Société Générale',   'logo' => 'socie.png', 'initiale' => 'SG'],
        ];
    }

    private function faqItems(): array
    {
        return [
            [
                'q' => 'Qui peut participer au Forum ?',
                'r' => 'Le Forum est ouvert à tous : entrepreneurs, investisseurs, décideurs, chercheurs, représentants institutionnels et membres de la diaspora africaine. Toute personne intéressée par l\'innovation et le développement de l\'Afrique est la bienvenue.'
            ],
            [
                'q' => 'Où et quand aura lieu le Forum 2026 ?',
                'r' => 'La 2ème édition du Forum International de l\'Innovation se tiendra du 15 au 18 juin 2026 à Paris, France. Le lieu exact sera communiqué prochainement.'
            ],
            [
                'q' => 'Comment s\'inscrire ?',
                'r' => 'L\'inscription se fait en ligne sur notre plateforme. Plusieurs passes sont disponibles : Gratuit, Standard et Premium. Rendez-vous sur la page Inscriptions & Billetterie pour réserver votre place.'
            ],
            [
                'q' => 'Comment devenir partenaire du Forum ?',
                'r' => 'Remplissez le formulaire de demande de partenariat en ligne. Notre équipe vous contactera sous 48h pour discuter des modalités et trouver le niveau de partenariat adapté à vos objectifs.'
            ],
            [
                'q' => 'Y a-t-il des opportunités pour les entrepreneurs de la diaspora ?',
                'r' => 'Absolument ! La diaspora africaine est au cœur du Forum. Un espace dédié "Entrepreneurs Diaspora" est disponible avec un annuaire, des rendez-vous B2B et des sessions de pitchs spécifiques.'
            ],
        ];
    }
}
