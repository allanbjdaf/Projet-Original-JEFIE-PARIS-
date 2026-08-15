<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        // Statistiques clés du Forum / Diaspora
        $stats = [
            ['number' => '5 000+', 'label' => 'Membres de la Diaspora'],
            ['number' => '150+', 'label' => 'Entreprises Partenaires'],
            ['number' => '450+', 'label' => 'Opportunités d\'Emploi'],
            ['number' => '20+', 'label' => 'Projets Innovants Soutenus'],
        ];

        // Piliers stratégiques
        $piliers = [
            [
                'title' => 'Cartographie des Talents',
                'desc' => 'Identifier et répertorier les compétences des Gabonais de l\'étranger pour mieux les connecter aux opportunités locales.'
            ],
            [
                'title' => 'Recrutement & Insertion',
                'desc' => 'Faciliter le retour des cadres et jeunes diplômés via des offres d\'emploi ciblées et adaptées au marché gabonais.'
            ],
            [
                'title' => 'Innovation & Entrepreneuriat',
                'desc' => 'Soutenir l\'investissement productif de la diaspora dans les secteurs technologiques et innovants au Gabon.'
            ],
        ];

        return view('about', compact('stats', 'piliers'));
    }
}
