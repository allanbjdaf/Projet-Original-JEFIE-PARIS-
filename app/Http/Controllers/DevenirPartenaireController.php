<?php
// app/Http/Controllers/DevenirPartenaireController.php

namespace App\Http\Controllers;

use App\Models\DemandePartenariat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DevenirPartenaireController extends Controller
{
    public function index(): View
    {
        return view('DevenirPartenaire', [
            'niveaux'     => $this->niveaux(),
            'avantages'   => $this->avantages(),
            'temoignages' => $this->temoignages(),
            'stats'       => $this->stats(),
            'secteurs'    => $this->secteurs(),
            'budgets'     => $this->budgets(),
            'typesOrga'   => $this->typesOrga(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_contact'      => ['required', 'string', 'max:255'],
            'poste'            => ['nullable', 'string', 'max:255'],
            'organisation'     => ['required', 'string', 'max:255'],
            'type_organisation' => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255'],
            'telephone'        => ['nullable', 'string', 'max:30'],
            'pays'             => ['required', 'string', 'max:100'],
            'secteur'          => ['required', 'string', 'max:100'],
            'niveau_partenariat' => ['required', 'string', 'in:bronze,argent,or,platine,sur_mesure'],
            'budget_prevu'     => ['required', 'string', 'max:100'],
            'objectifs'        => ['required', 'string', 'max:2000'],
            'accepte_conditions' => ['required', 'accepted'],
        ], [
            'nom_contact.required'       => 'Le nom du contact est obligatoire.',
            'organisation.required'      => "Le nom de l'organisation est obligatoire.",
            'type_organisation.required' => "Le type d'organisation est obligatoire.",
            'email.required'             => "L'email est obligatoire.",
            'email.email'                => "L'email n'est pas valide.",
            'pays.required'              => 'Le pays est obligatoire.',
            'secteur.required'           => "Le secteur d'activité est obligatoire.",
            'niveau_partenariat.required' => 'Choisissez un niveau de partenariat.',
            'budget_prevu.required'      => 'Indiquez votre budget prévisionnel.',
            'objectifs.required'         => 'Décrivez vos objectifs de partenariat.',
            'accepte_conditions.accepted' => 'Vous devez accepter les conditions.',
        ]);

        DemandePartenariat::create([
            'nom_contact'       => $validated['nom_contact'],
            'poste'             => $validated['poste'] ?? null,
            'organisation'      => $validated['organisation'],
            'type_organisation' => $validated['type_organisation'],
            'email'             => $validated['email'],
            'telephone'         => $validated['telephone'] ?? null,
            'pays'              => $validated['pays'],
            'secteur'           => $validated['secteur'],
            'niveau_partenariat' => $validated['niveau_partenariat'],
            'budget_prevu'      => $validated['budget_prevu'],
            'objectifs'         => $validated['objectifs'],
            'statut'            => 'en_attente',
        ]);

        return redirect()
            ->route('partenaires.devenir')
            ->with('success', 'Votre demande de partenariat a bien été reçue ! Notre équipe vous contactera sous 48h.');
    }

    // ── Données ────────────────────────────────────────────────────

    private function stats(): array
    {
        return [
            ['valeur' => '120+',  'label' => "Partenaires\nconfirmés",    'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['valeur' => '50+',   'label' => "Pays\nreprésentés",         'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'],
            ['valeur' => '5 000+', 'label' => "Décideurs\nattendus",       'icon' => '<path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
            ['valeur' => '3 jours', 'label' => "Jours\nd'exposition",      'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
        ];
    }

    private function niveaux(): array
    {
        return [
            [
                'slug'      => 'bronze',
                'nom'       => 'Bronze',
                'prix'      => 'dès 500 000 FCFA',
                'couleur'   => '#8b5e3c',
                'bg'        => '#fdf6f0',
                'populaire' => false,
                'avantages' => [
                    'Logo sur le site officiel',
                    '2 badges d\'accès inclus',
                    'Mention dans les supports',
                    'Stand exposition 4m²',
                ],
            ],
            [
                'slug'      => 'argent',
                'nom'       => 'Argent',
                'prix'      => 'dès 1 500 000 FCFA',
                'couleur'   => '#607d8b',
                'bg'        => '#f0f4f8',
                'populaire' => false,
                'avantages' => [
                    'Tout ce qui est inclus Bronze',
                    '5 badges d\'accès inclus',
                    'Espace lounge dédié',
                    'Présentation de 15 minutes',
                    'Accès annuaire VIP',
                ],
            ],
            [
                'slug'      => 'or',
                'nom'       => 'Or',
                'prix'      => 'dès 3 000 000 FCFA',
                'couleur'   => '#f5a623',
                'bg'        => '#fff8e6',
                'populaire' => true,
                'avantages' => [
                    'Tout ce qui est inclus Argent',
                    '10 badges VIP inclus',
                    'Stand premium 12m²',
                    'Session plénière 30 min',
                    'Logo sur la scène principale',
                    'Accès base de données contacts',
                ],
            ],
            [
                'slug'      => 'platine',
                'nom'       => 'Platine',
                'prix'      => 'dès 7 000 000 FCFA',
                'couleur'   => '#0d1b3e',
                'bg'        => '#eef2ff',
                'populaire' => false,
                'avantages' => [
                    'Tout ce qui est inclus Or',
                    '20 badges Executive inclus',
                    'Naming rights d\'une salle',
                    'Keynote d\'ouverture',
                    'Publi-reportage presse inclus',
                    'Dîner VIP avec officiels',
                    'Rapport d\'impact dédié',
                ],
            ],
            [
                'slug'      => 'sur_mesure',
                'nom'       => 'Sur Mesure',
                'prix'      => 'Devis personnalisé',
                'couleur'   => '#162552',
                'bg'        => '#f4f6fa',
                'populaire' => false,
                'avantages' => [
                    'Offre 100% personnalisée',
                    'Visibilité digitale avancée',
                    'Activation de marque créative',
                    'Partenariat multi-éditions',
                    'Accompagnement dédié',
                ],
            ],
        ];
    }

    private function avantages(): array
    {
        return [
            ['titre' => 'Visibilité internationale',  'desc' => 'Votre marque exposée à 5 000+ décideurs, entrepreneurs et investisseurs de 50+ pays.',                   'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'],
            ['titre' => 'Networking qualifié',         'desc' => 'Accédez à une communauté de leaders, innovateurs et entrepreneurs de la diaspora africaine.',            'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['titre' => 'Opportunités B2B',            'desc' => 'Rencontrez des partenaires qualifiés lors de sessions de rendez-vous B2B structurées.',                  'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
            ['titre' => 'Présence digitale',           'desc' => 'Logo sur le site, newsletter, réseaux sociaux et tous les supports de communication du Forum.',          'icon' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>'],
            ['titre' => 'Rapport d\'impact',           'desc' => 'Recevez un rapport détaillé de votre visibilité, retombées presse et résultats de votre participation.',  'icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'],
            ['titre' => 'Accompagnement dédié',        'desc' => 'Un chef de projet attitré vous accompagne de la signature du contrat jusqu\'à l\'après-Forum.',          'icon' => '<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z"/>'],
        ];
    }

    private function temoignages(): array
    {
        return [
            ['nom' => 'Ibrahim Coulibaly', 'poste' => 'DG Orange Sénégal',    'photo' => 'baoo.jpeg', 'texte' => 'Ce partenariat nous a permis de connecter notre marque avec l\'écosystème entrepreneurial africain. Un retour sur investissement exceptionnel.'],
            ['nom' => 'Fatou Diallo',      'poste' => 'Directrice Ecobank CI', 'photo' => 'bao.jpg', 'texte' => 'L\'organisation était irréprochable et la qualité des participants remarquable. Nous renouvelons notre partenariat pour la 3ème année consécutive.'],
        ];
    }

    private function secteurs(): array
    {
        return [
            'Technologies',
            'Finance & Banque',
            'Énergie',
            'Télécommunications',
            'Agriculture',
            'Santé',
            'Commerce',
            'Industrie',
            'Conseil',
            'Immobilier',
            'Autre'
        ];
    }

    private function budgets(): array
    {
        return [
            'Moins de 500 000 FCFA',
            '500 000 – 1 500 000 FCFA',
            '1 500 000 – 3 000 000 FCFA',
            '3 000 000 – 7 000 000 FCFA',
            'Plus de 7 000 000 FCFA',
            'À définir ensemble',
        ];
    }

    private function typesOrga(): array
    {
        return [
            'Entreprise privée',
            'Institution publique',
            'ONG / Association',
            'Start-up',
            'Fondation',
            'Organisation internationale',
            'Autre'
        ];
    }
}
