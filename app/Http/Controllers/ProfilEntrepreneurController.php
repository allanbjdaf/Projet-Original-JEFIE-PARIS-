<?php

namespace App\Http\Controllers;

use App\Models\EntrepreneurProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class ProfilEntrepreneurController extends Controller
{
    /**
     * Afficher le tableau de bord (Dashboard).
     */
    public function dashboard(): View
    {
        $profil = EntrepreneurProfil::where('user_id', Auth::id())->first();
        $monProfil = $profil;

        $heroStats = [
            [
                'valeur' => '12',
                'label'  => 'Opportunités ciblées',
                'color'  => '#2563eb',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'
            ],
            [
                'valeur' => '8',
                'label'  => 'Rendez-vous B2B',
                'color'  => '#10b981',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'
            ],
            [
                'valeur' => '94%',
                'label'  => 'Profil complété',
                'color'  => '#f5a623',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            ]
        ];

        $secteurs = ['Technologie & Digital', 'Agriculture & Agrobusiness', 'Énergie & Environnement', 'Santé & Biotech', 'Éducation & EdTech', 'Fintech & Assurances', 'Artisanat & Mode'];
        $pays = ["Côte d'Ivoire", 'Sénégal', 'Gabon', 'Cameroun', 'Mali', 'Burkina Faso', 'France'];
        $villes = ['Abidjan', 'Dakar', 'Libreville', 'Douala', 'Bamako', 'Ouagadougou', 'Paris'];
        $tailles = ['Start-up (1-10 pers.)', 'TPE (11-50 pers.)', 'PME (51-250 pers.)', 'Grande Entreprise (250+ pers.)'];

        $entrepreneursUne = EntrepreneurProfil::limit(3)->get();

        if ($entrepreneursUne->isEmpty()) {
            $entrepreneursUne = collect([
                (object)[
                    'id' => 1,
                    'nom_complet' => 'Mariam DIALLO',
                    'slug' => 'mariam-diallo',
                    'photo' => null,
                    'entreprise' => 'Innova Tech',
                    'secteur_activite' => 'Technologie & Digital',
                    'secteur_css' => 'tech',
                    'ville' => 'Dakar',
                    'pays_residence' => 'Sénégal',
                    'chiffre_affaires' => '45M FCFA',
                    'taille_employes' => '5'
                ],
                (object)[
                    'id' => 2,
                    'nom_complet' => 'Amadou BAMBA',
                    'slug' => 'amadou-bamba',
                    'photo' => null,
                    'entreprise' => 'Agro Faso',
                    'secteur_activite' => 'Agriculture & Agrobusiness',
                    'secteur_css' => 'agro',
                    'ville' => 'Ouagadougou',
                    'pays_residence' => 'Burkina Faso',
                    'chiffre_affaires' => '12M FCFA',
                    'taille_employes' => '24'
                ]
            ]);
        }

        $opportunites = collect([
            (object)[
                'type_css' => 'finance',
                'icon_path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                'type_label' => 'Levée de fonds',
                'titre' => 'Recherche investisseurs série A',
                'entreprise' => 'Innova Tech',
                'date' => Carbon::now()->subDays(2)
            ],
            (object)[
                'type_css' => 'partner',
                'icon_path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                'type_label' => 'Partenariat commercial',
                'titre' => 'Distribution de produits agricoles',
                'entreprise' => 'Agro Faso',
                'date' => Carbon::now()->subDays(5)
            ]
        ]);

        $rendezvous = collect([
            (object)[
                'titre' => 'Rencontre B2B avec VC Africa',
                'lieu'  => 'Zone Box B1, Hall Central',
                'date'  => Carbon::now()->addDays(1)
            ],
            (object)[
                'titre' => 'Discussion partenariat distribution',
                'lieu'  => 'Espace Cafétéria VIP',
                'date'  => Carbon::now()->addDays(3)
            ]
        ]);

        $infosClés = [
            [
                'label' => 'Entreprise',
                'valeur' => $profil?->entreprise ?? 'Non renseignée',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'
            ],
            [
                'label' => 'Secteur',
                'valeur' => $profil?->secteur_activite ?? 'Non renseigné',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'
            ],
            [
                'label' => 'Localisation',
                'valeur' => $profil ? "{$profil->ville}, {$profil->pays_residence}" : 'Non renseignée',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>'
            ]
        ];

        $participation = (object)[
            'confirmee' => true,
            'statut'    => 'Validé (Pass Premium)'
        ];

        // CORRIGÉ : Ajout de la variable $detailsParticipation requise à la ligne 2002
        $detailsParticipation = [
            ['label' => 'Type de Pass', 'valeur' => 'Premium Pass', 'style' => 'pass-vip'],
            ['label' => 'Numéro Badge', 'valeur' => 'FII26-08942', 'style' => 'code-badge'],
            ['label' => 'Accès Salons B2B', 'valeur' => 'Illimité', 'style' => 'text-success'],
        ];

        return view('entrepreneurs', compact('profil', 'monProfil', 'heroStats', 'secteurs', 'pays', 'villes', 'tailles', 'entrepreneursUne', 'opportunites', 'rendezvous', 'infosClés', 'participation', 'detailsParticipation'));
    }

    /**
     * Afficher le profil.
     */
    public function index(): View
    {
        $profil = EntrepreneurProfil::where('user_id', Auth::id())->first();
        $monProfil = $profil;

        $heroStats = [];
        $secteurs = ['Technologie & Digital', 'Agriculture & Agrobusiness', 'Énergie & Environnement', 'Santé & Biotech', 'Éducation & EdTech', 'Fintech & Assurances', 'Artisanat & Mode'];
        $pays = ["Côte d'Ivoire", 'Sénégal', 'Gabon', 'Cameroun', 'Mali', 'Burkina Faso', 'France'];
        $villes = ['Abidjan', 'Dakar', 'Libreville', 'Douala', 'Bamako', 'Ouagadougou', 'Paris'];
        $tailles = ['Start-up (1-10 pers.)', 'TPE (11-50 pers.)', 'PME (51-250 pers.)', 'Grande Entreprise (250+ pers.)'];

        $entrepreneursUne = EntrepreneurProfil::limit(3)->get();

        if ($entrepreneursUne->isEmpty()) {
            $entrepreneursUne = collect([
                (object)[
                    'id' => 1,
                    'nom_complet' => 'Mariam DIALLO',
                    'slug' => 'mariam-diallo',
                    'photo' => null,
                    'entreprise' => 'Innova Tech',
                    'secteur_activite' => 'Technologie & Digital',
                    'secteur_css' => 'tech',
                    'ville' => 'Dakar',
                    'pays_residence' => 'Sénégal',
                    'chiffre_affaires' => '45M FCFA',
                    'taille_employes' => '5'
                ]
            ]);
        }

        $opportunites = collect([]);
        $rendezvous = collect([]);
        $infosClés = [];
        $participation = (object)['confirmee' => false, 'statut' => 'Aucun'];

        // Sécurité pour la méthode index
        $detailsParticipation = [];

        return view('entrepreneurs', compact('profil', 'monProfil', 'heroStats', 'secteurs', 'pays', 'villes', 'tailles', 'entrepreneursUne', 'opportunites', 'rendezvous', 'infosClés', 'participation', 'detailsParticipation'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit()
    {
        $user = Auth::user();
        $profil = EntrepreneurProfil::where('user_id', $user->id)->first();
        return view('profile.profil-edit', compact('user', 'profil'));
    }

    /**
     * Enregistrer les modifications.
     */
    public function update(Request $request)
    {
        $profil = EntrepreneurProfil::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $profil->update([
            'nom_complet' => $request->name,
        ]);

        return redirect()
            ->route('entrepreneurs.profil')

            ->with('success', 'Profil mis à jour avec succès.');
    }
}
