<?php
// app/Http/Controllers/ActualiteController.php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActualiteController extends Controller
{
    public function index(Request $request): View
    {
        $query = Actualite::where('publie', true)->orderByDesc('date_publication');

        if ($request->filled('categorie') && $request->categorie !== 'tous') {
            $query->where('categorie', $request->categorie);
        }
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->q . '%')
                    ->orWhere('resume', 'like', '%' . $request->q . '%');
            });
        }

        $actualites  = $query->paginate(9);
        $aLaUne      = Actualite::where('publie', true)->where('a_la_une', true)
            ->orderByDesc('date_publication')->first();
        $recentes    = Actualite::where('publie', true)->orderByDesc('date_publication')->take(4)->get();

        return view('actualites', [
            'actualites'   => $actualites,
            'aLaUne'       => $aLaUne,
            'recentes'     => $recentes,
            'categories'   => $this->categories(),
            'categorieActive' => $request->get('categorie', 'tous'),
            'stats'        => $this->stats(),
        ]);
    }

    public function show(string $slug): View
    {
        $actualite = Actualite::where('slug', $slug)->where('publie', true)->firstOrFail();
        $actualite->increment('vues');

        $similaires = Actualite::where('publie', true)
            ->where('categorie', $actualite->categorie)
            ->where('id', '!=', $actualite->id)
            ->orderByDesc('date_publication')
            ->take(3)->get();

        return view('actualites.show', compact('actualite', 'similaires'));
    }

    private function categories(): array
    {
        return [
            ['slug' => 'tous',          'label' => 'Toutes',          'color' => '#0d1b3e'],
            ['slug' => 'communique',    'label' => 'Communiqués',      'color' => '#1565c0'],
            ['slug' => 'interview',     'label' => 'Interviews',       'color' => '#6a1b9a'],
            ['slug' => 'annonce',       'label' => 'Annonces',         'color' => '#f5a623'],
            ['slug' => 'programme',     'label' => 'Programme',        'color' => '#2e7d32'],
            ['slug' => 'partenariat',   'label' => 'Partenariats',     'color' => '#e65100'],
            ['slug' => 'innovation',    'label' => 'Innovation',       'color' => '#00838f'],
            ['slug' => 'diaspora',      'label' => 'Diaspora',         'color' => '#c2185b'],
        ];
    }

    private function stats(): array
    {
        return [
            ['valeur' => Actualite::where('publie', true)->count() ?: '48',  'label' => 'Articles publiés'],
            ['valeur' => '12',  'label' => 'Communiqués officiels'],
            ['valeur' => '8',   'label' => 'Interviews exclusives'],
            ['valeur' => '25k', 'label' => 'Lecteurs mensuels'],
        ];
    }
}
