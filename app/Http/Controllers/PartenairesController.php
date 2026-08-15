<?php
// app/Http/Controllers/PartenairesController.php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\Opportunite;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartenairesController extends Controller
{
    public function index(): View
    {
        // ✅ CORRECTION : Remplacement de FIELD() par un tri CASE WHEN compatible SQLite et MySQL
        $partenairesUne = Partenaire::orderByRaw("
            CASE niveau
                WHEN 'platinum' THEN 1
                WHEN 'gold' THEN 2
                WHEN 'silver' THEN 3
                WHEN 'bronze' THEN 4
                ELSE 5
            END
        ")->take(4)->get();

        return view('partenaires', [
            'partenairesUne'    => $partenairesUne, // Attention à la minuscule sur la clé 'partenairesUne'
            'opportunites'      => Opportunite::latest('date')->take(3)->get(),
            'packs'             => $this->listePacks(),
            'visibilite'        => $this->statsVisibilite(),
            'niveauPartenariat' => ['niveau' => 'Gold', 'expiration' => '31 Décembre 2026'],
            'standImage'        => null,
            'conseillerPhoto'   => null,
        ]);
    }


    public function devenir(): View
    {
        return view('partenaires.devenir');
    }
    public function liste(): View
    {
        return view('partenaires.liste', ['partenaires' => Partenaire::paginate(12)]);
    }
    public function profil(): View
    {
        return view('partenaires.profil');
    }
    public function activites(): View
    {
        return view('partenaires.activites');
    }
    public function media(): View
    {
        return view('partenaires.media');
    }
    public function reservations(): View
    {
        return view('partenaires.reservations');
    }
    public function badges(): View
    {
        return view('partenaires.badges');
    }
    public function offres(): View
    {
        return view('partenaires.offres');
    }
    public function docs(): View
    {
        return view('partenaires.docs');
    }
    public function stats(): View
    {
        return view('partenaires.stats');
    }
    public function visibilite(): View
    {
        return view('partenaires.visibilite');
    }
    public function plan(): View
    {
        return view('partenaires.plan');
    }
    public function avantages(): View
    {
        return view('partenaires.avantages');
    }

    public function show(string $slug): View
    {
        $partenaire = Partenaire::where('slug', $slug)->firstOrFail();
        return view('partenaires.show', compact('partenaire'));
    }

    public function pack(string $slug): View
    {
        $pack = collect($this->listePacks())->firstWhere('slug', $slug);
        abort_if(!$pack, 404);
        return view('partenaires.pack', compact('pack'));
    }

    // ── Données ───────────────────────────────────────────────────

    private function listePacks(): array
    {
        return [
            [
                'slug'        => 'bronze',
                'niveau'      => 'Bronze',
                'color_class' => 'bronze-c',
                'prix'        => '1 500 €',
                'featured'    => false,
                'features'    => ['Visibilité sur le site', 'Logo sur supports', '2 badges inclus'],
            ],
            [
                'slug'        => 'silver',
                'niveau'      => 'Silver',
                'color_class' => 'silver-c',
                'prix'        => '3 000 €',
                'featured'    => false,
                'features'    => ['Visibilité avancée', 'Stand standard', '5 badges inclus'],
            ],
            [
                'slug'        => 'gold',
                'niveau'      => 'Gold',
                'color_class' => 'gold-c',
                'prix'        => '6 000 €',
                'featured'    => true,
                'features'    => ['Visibilité premium', 'Stand premium', '10 badges inclus'],
            ],
            [
                'slug'        => 'platinum',
                'niveau'      => 'Platinum',
                'color_class' => 'plat-c',
                'prix'        => '10 000 €',
                'featured'    => false,
                'features'    => ['Visibilité exclusive', 'Emplacement premium', '20 badges inclus'],
            ],
        ];
    }

    private function statsVisibilite(): array
    {
        return [
            ['valeur' => '1 245', 'label' => 'Vues de votre profil',  'color' => '#1565c0', 'icon_path' => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'],
            ['valeur' => '318',   'label' => 'Visites sur votre stand', 'color' => '#f5a623', 'icon_path' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>'],
            ['valeur' => '86',    'label' => 'Téléchargements',        'color' => '#2e7d32', 'icon_path' => '<path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>'],
            ['valeur' => '24',    'label' => 'Demandes de contact',    'color' => '#c2185b', 'icon_path' => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/>'],
        ];
    }
}
