<?php
// app/Http/Controllers/InstitutionnelController.php

namespace App\Http\Controllers;

use Illuminate\View\View;

class InstitutionnelController extends Controller
{
    public function index(): View
    {
        return view('institutionnel', [
            'stats'                  => $this->stats(),
            'objectifs'              => $this->objectifs(),
            'organisateurs'          => $this->organisateurs(),
            'partenairesInstitution' => $this->partenairesInstitution(),
            'messagesOfficiels'      => $this->messagesOfficiels(),
            'documents'              => $this->documents(),
        ]);
    }

    private function stats(): array
    {
        return [
            [
                'valeur' => '2s000+',
                'label' => "Participants\nattendu",
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'valeur' => '200+',
                'label' => "Entreprises",
                'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'
            ],
            [
                'valeur' => '50+',
                'label' => "Pays\nreprésentés",
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
            [
                'valeur' => '2',
                'label' => "Jours\nd'échanges",
                'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'
            ],
        ];
    }

    private function objectifs(): array
    {
        return [
            [
                'texte' => "Plateforme de mise en relation : Mettre en place un cadre institutionnel et opérationnel reliant les compétences et investisseurs
                 de la diaspora aux opportunités de développement du Gabon.",
                'icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'
            ],
            [
                'texte' => "Emploi et compétences : Connecter directement les talents de l'étranger aux entreprises locales pour répondre à leurs besoins en recrutement 
                tout en constituant un répertoire qualifié des compétences.",
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'texte' => "Investissement et entrepreneuriat : Présenter des opportunités d'affaires concrètes et accompagner les entrepreneurs de la diaspora 
                souhaitant investir ou créer une activité au Gabon.",
                'icon' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>'
            ],
            [
                'texte' => "Partenariats et réseaux : Faciliter les synergies économiques et instaurer un réseau durable de coopération entre l'État, 
                les entreprises nationales et les Gabonais de l'étranger.",
                'icon' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'
            ],
        ];
    }

    private function organisateurs(): array
    {
        return [
            ['nom' => "Ministère de l'Économie et de la Planification", 'logo' => 'mec.png', 'initiale' => 'ME'],
            ['nom' => "Agence Nationale de l'Innovation",               'logo' => 'ctr.jpg', 'initiale' => 'ANI'],
            ['nom' => "Comité des Gabonais de France",             'logo' => 'cgforga.png', 'initiale' => 'CGF'],
        ];
    }

    private function partenairesInstitution(): array
    {
        return [
            ['nom' => 'Pôle National de Promotion Emploi',   'logo' => 'Pnp.jpg', 'initiale' => 'PNPE'],
            ['nom' => 'Fédèration des Entreprises Gabonaises (FEG)', 'logo' => 'Feg.jpg', 'initiale' => 'FEG'],
            ['nom' => 'Union Européenne',  'logo' => 'ue.png', 'initiale' => 'UE'],
            ['nom' => 'Banque Mondiale',   'logo' => 'ba.jpg', 'initiale' => 'BM'],
        ];
    }



    private function messagesOfficiels(): array
    {
        return [
            [
                'nom'     => 'S.E.M. Brice Clotaire Oligui Nguema',
                'poste'   => "Président de la République chef de l'Etat, Chef du Gouvernement",
                'message' => "Nous devons créer des passerelles concrètes, des points d'information, des dispositifs d'orientation, [...] qui permettent à un Gabonais vivant à l'étranger de connaître les opportunités qui existent au Gabon. C'est dans cet esprit que j'ai décidé de l'organisation des Journées Économiques et d'un Forum international de l'emploi de la diaspora gabonaise qui auront 
                lieu du 28 au 29 Novembre 2026 avec l'appui du PNPE [...].",
                'photo'   => 'Pr .jpg',
            ],

        ];
    }

    private function documents(): array
    {
        return [
            ['nom' => 'Note conceptuelle du Forum', 'type' => 'PDF', 'taille' => '1.2 Mo', 'url' => '#'],
            ['nom' => 'Programme prévisionnel',      'type' => 'PDF', 'taille' => '2.4 Mo', 'url' => '#'],
            ['nom' => 'Dossier de partenariat',      'type' => 'PDF', 'taille' => '3.1 Mo', 'url' => '#'],
            ['nom' => 'Charte du Forum',             'type' => 'PDF', 'taille' => '1.1 Mo', 'url' => '#'],
            ['nom' => "Rapport édition précédente",  'type' => 'PDF', 'taille' => '4.5 Mo', 'url' => '#'],
        ];
    }
}
