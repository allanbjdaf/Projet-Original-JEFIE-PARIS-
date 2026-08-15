<?php
// app/Http/Controllers/AProposController.php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AproposController extends Controller
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
                'desc'   => "Nous croyons en la capacité de l'Afrique à être à la pointe de l'innovation mondiale. Chaque édition du Forum est un laboratoire d'idées, de solutions et de technologies pour l'avenir.",
                'couleur' => '#1565c0',
                'bg'     => '#e3f2fd',
                'icon'   => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',
            ],
            [
                'titre'  => 'Inclusivité',
                'desc'   => "Le Forum valorise la diversité des parcours, des origines et des expertises. Diaspora, acteurs locaux, institutions internationales : tous ont leur place dans ce dialogue.",
                'couleur' => '#2e7d32',
                'bg'     => '#e8f5e9',
                'icon'   => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
            ],
            [
                'titre'  => 'Impact',
                'desc'   => "Au-delà des discours, le Forum génère des résultats concrets : partenariats signés, projets financés, entreprises créées. Chaque rencontre peut changer le destin d'un entrepreneur.",
                'couleur' => '#f5a623',
                'bg'     => '#fff8e6',
                'icon'   => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>',
            ],
            [
                'titre'  => 'Excellence',
                'desc'   => "Nous nous engageons à offrir une expérience de haute qualité : organisation rigoureuse, intervenants de premier plan et contenus d'une valeur exceptionnelle pour chaque participant.",
                'couleur' => '#6a1b9a',
                'bg'     => '#ede7f6',
                'icon'   => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
            ],
            [
                'titre'  => 'Diaspora',
                'desc'   => "La diaspora africaine est un moteur de développement. Le Forum crée des ponts durables entre les talents établis à l'étranger et les opportunités sur le continent africain.",
                'couleur' => '#e65100',
                'bg'     => '#fff3e0',
                'icon'   => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>',
            ],
            [
                'titre'  => 'Durabilité',
                'desc'   => "L'innovation que nous promouvons est au service du développement durable. Nos thématiques intègrent systématiquement les enjeux environnementaux, sociaux et de gouvernance.",
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
