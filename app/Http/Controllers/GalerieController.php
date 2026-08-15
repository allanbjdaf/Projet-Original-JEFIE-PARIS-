<?php
// app/Http/Controllers/GalerieController.php

namespace App\Http\Controllers;

use App\Models\MediaContenu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalerieController extends Controller
{
    public function index(Request $request): View
    {
        $types      = ['communique', 'interview', 'video', 'podcast', 'photo', 'livestream', 'presse'];
        $typeActif  = $request->get('type', 'tous');
        $thematique = $request->get('thematique', '');
        $annee      = $request->get('annee', '');
        $q          = $request->get('q', '');
        $tri        = $request->get('tri', 'recent');

        // Contenus à la une (4 premiers)
        try {
            $aLaUne = MediaContenu::where('publie', true)
                ->where('a_la_une', true)
                ->orderByDesc('date')
                ->take(4)->get();

            $query = MediaContenu::where('publie', true);
            if ($typeActif !== 'tous') $query->where('type', $typeActif);
            if ($thematique)           $query->where('thematique', $thematique);
            if ($annee)                $query->whereYear('date', $annee);
            if ($q)                    $query->where('titre', 'like', "%$q%");
            match ($tri) {
                'populaire' => $query->orderByDesc('vues'),
                'ancien'    => $query->orderBy('date'),
                default     => $query->orderByDesc('date'),
            };
            $derniers   = $query->paginate(8);
            $populaires = MediaContenu::where('publie', true)->orderByDesc('vues')->take(4)->get();
            $stats      = [
                'contenus'  => MediaContenu::where('publie', true)->count(),
                'vues'      => MediaContenu::where('publie', true)->sum('vues'),
                'interviews' => MediaContenu::where('type', 'interview')->count(),
                'pays'      => 47,
            ];
        } catch (\Exception $e) {
            $aLaUne = collect($this->staticALaUne());
            $derniers = collect($this->staticDerniers());
            $populaires = collect($this->staticPopulaires());
            $stats = ['contenus' => 163, 'vues' => 256000, 'interviews' => 78, 'pays' => 47];
        }

        return view('Galeries', [
            'aLaUne'     => $aLaUne,
            'derniers'   => $derniers,
            'populaires' => $populaires,
            'stats'      => $stats,
            'typeActif'  => $typeActif,
            'types'      => $this->types(),
            'thematiques' => $this->thematiques(),
            'annees'     => ['2026', '2025', '2024', '2023'],
            'tri'        => $tri,
        ]);
    }

    private function types(): array
    {
        return [
            ['slug' => 'tous',        'label' => 'Tous les contenus', 'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>'],
            ['slug' => 'communique',  'label' => 'Communiqués',       'icon' => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
            ['slug' => 'interview',   'label' => 'Interviews',        'icon' => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/>'],
            ['slug' => 'video',       'label' => 'Vidéos',            'icon' => '<polygon points="5 3 19 12 5 21 5 3"/>'],
            ['slug' => 'podcast',     'label' => 'Podcasts',          'icon' => '<circle cx="12" cy="12" r="2"/><path d="M16.24 7.76a6 6 0 010 8.49m-8.48-.01a6 6 0 010-8.49m11.31-2.82a10 10 0 010 14.14m-14.14 0a10 10 0 010-14.14"/>'],
            ['slug' => 'photo',       'label' => 'Photos',            'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>'],
            ['slug' => 'livestream',  'label' => 'Livestreams',       'icon' => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>'],
            ['slug' => 'presse',      'label' => 'Presse',            'icon' => '<path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a4 4 0 01-4-4V6a2 2 0 012-2"/>'],
        ];
    }

    private function thematiques(): array
    {
        return ['Innovation', 'Entrepreneuriat', 'Diaspora', 'Finance', 'Emploi', 'Agriculture', 'Santé', 'Éducation'];
    }

    // ── Données statiques (si pas de BDD) ─────────────────────────
    private function staticALaUne(): array
    {
        return [
            (object)['id' => 1, 'type' => 'communique', 'badge_couleur' => ['bg' => '#1565c0', 'label' => 'COMMUNIQUÉ'], 'image' => 'Cooo.jpg', 'duree' => null, 'date_publication' => now()->subDays(5), 'titre' => 'Lancement officiel du Forum International de l\'Innovation 2026', 'resume' => 'Le Forum International annonce officiellement l\'ouverture de son édition 2026.', 'vues' => 12500, 'cta_label' => 'Lire le communiqué', 'slug' => 'lancement-forum-2026'],
            (object)['id' => 2, 'type' => 'interview', 'badge_couleur' => ['bg' => '#2e7d32', 'label' => 'INTERVIEW'], 'image' => 'dio.jpg', 'duree' => '12:45', 'date_publication' => now()->subDays(10), 'titre' => 'Interview exclusive avec le Ministre de l\'Économie et de l\'Innovation', 'resume' => null, 'vues' => 8200, 'cta_label' => 'Voir l\'interview', 'slug' => 'interview-ministre'],
            (object)['id' => 3, 'type' => 'video',     'badge_couleur' => ['bg' => '#162552', 'label' => 'VIDÉO'],    'image' => 'Ctr.jpg', 'duree' => '03:21', 'date_publication' => now()->subDays(12), 'titre' => 'Retour en vidéo sur l\'édition 2025', 'resume' => null, 'vues' => 6700, 'cta_label' => 'Regarder la vidéo', 'slug' => 'retour-2025'],
            (object)['id' => 4, 'type' => 'podcast',   'badge_couleur' => ['bg' => '#f5a623', 'label' => 'PODCAST'],  'image' => 'bo.jpg',  'duree' => '22:18', 'date_publication' => now()->subDays(15), 'titre' => 'Podcast : Innover pour l\'Afrique de demain', 'resume' => null, 'vues' => 5300, 'cta_label' => 'Écouter le podcast', 'slug' => 'podcast-innover-afrique'],
        ];
    }

    private function staticDerniers(): array
    {
        return [
            (object)['id' => 5, 'type' => 'photo',    'badge_couleur' => ['bg' => '#43a047', 'label' => 'PHOTOS'],    'image' => 'CGFjpg.jpg', 'badge_extra' => '+24', 'duree' => null, 'date_publication' => now()->subDays(6), 'titre' => 'Galerie photos - Soirée de lancement du Forum 2026', 'vues' => 3200, 'cta_label' => 'Voir la galerie', 'slug' => 'galerie-soiree-lancement'],
            (object)['id' => 6, 'type' => 'livestream', 'badge_couleur' => ['bg' => '#e53935', 'label' => 'LIVESTREAM'], 'image' => 'boaa.jpg', 'badge_live' => true, 'duree' => null, 'date_publication' => now()->subDays(8), 'titre' => 'Live : Conférence inaugurale du Forum 2026', 'vues' => 4100, 'cta_label' => 'Voir le livestream', 'slug' => 'live-conference-inaugurale'],
            (object)['id' => 7, 'type' => 'presse',   'badge_couleur' => ['bg' => '#fb8c00', 'label' => 'PRESSE'],    'image' => 'bao.jpg', 'badge_extra' => null, 'duree' => null, 'date_publication' => now()->subDays(11), 'titre' => 'Revue de presse - Forum 2026 : ce qu\'en dit la presse internationale', 'vues' => 2800, 'cta_label' => 'Lire l\'article', 'slug' => 'revue-presse-internationale'],
            (object)['id' => 8, 'type' => 'interview', 'badge_couleur' => ['bg' => '#2e7d32', 'label' => 'INTERVIEW'], 'image' => 'baoo.jpg', 'badge_extra' => null, 'duree' => '08:32', 'date_publication' => now()->subDays(13), 'titre' => 'Interview : Les femmes au cœur de l\'innovation', 'vues' => 3900, 'cta_label' => 'Voir l\'interview', 'slug' => 'interview-femmes-innovation'],
        ];
    }

    private function staticPopulaires(): array
    {
        return [
            (object)['id' => 1, 'image' => 'Cooo.jpg', 'titre' => 'Lancement officiel du Forum 2026', 'vues' => 12500, 'slug' => 'lancement-forum-2026'],
            (object)['id' => 3, 'image' => 'Ctr.jpg', 'titre' => 'Retour en vidéo sur l\'édition 2025', 'vues' => 8200, 'slug' => 'retour-2025'],
            (object)['id' => 2, 'image' => 'dio.jpg', 'titre' => 'Interview avec le Ministre', 'vues' => 6700, 'slug' => 'interview-ministre'],
            (object)['id' => 9, 'image' => 'CGFjpg.jpg', 'titre' => 'Conférence : L\'Innovation durable', 'vues' => 5300, 'slug' => 'conference-innovation-durable'],
        ];
    }
}
