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
            ['valeur' => '35000+',  'label' => "Gabonais\nen France",    'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['valeur' => '2000+',   'label' => "Gabonais\ndel'Europe",         'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'],
            ['valeur' => '2000+', 'label' => "Participants\nattendus",       'icon' => '<path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
            ['valeur' => '2000 ', 'label' => "Entretiens\nde recrutement",      'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
        ];
    }

    private function niveaux(): array
    {
        return [
            [
                'slug'      => 'bronze',
                'nom'       => 'Bronze',
                'prix'      => 'dès 10 000 €',
                'couleur'   => '#8b5e3c',
                'bg'        => '#fdf6f0',
                'populaire' => false,
                'avantages' => [
                    "Logo sur le programme et les supports d'accueil",
                    'Vidibilité sur le site web (page partenaires)',
                    "Accès à l'espace networking général",
                    'Stand exposition 9m²',
                ],
            ],
            [
                'slug'      => 'argent',
                'nom'       => 'Argent',
                'prix'      => 'dès 20 000 €',
                'couleur'   => '#607d8b',
                'bg'        => '#f0f4f8',
                'populaire' => false,
                'avantages' => [
                    'Stand 12m²',
                    'Logo sur le site et programme officiel',
                    "Accés à l'espace networking général",
                    'Participation aux sessions de recrutement collectives',
                    'Mentions de votre entreprise sur les réseax sociaux',
                ],
            ],
            [
                'slug'      => 'or',
                'nom'       => 'Or',
                'prix'      => 'dès 30 000 €',
                'couleur'   => '#f5a623',
                'bg'        => '#fff8e6',
                'populaire' => true,
                'avantages' => [
                    'Stand 18m²',
                    "Intervention lors d'une conférence thématique",
                    'Logo sur les principaux supports de communication(site, progrmae, badges)',
                    "Accès à l'espace networking dédié entreprises-diaspora",
                    'Participation à des sessions de recrutement',
                    'Mise en lumière de vos metiers et opportunités de carrière',
                ],
            ],
            [
                'slug'      => 'platine',
                'nom'       => 'Platine',
                'prix'      => 'dès 40 000 €',
                'couleur'   => '#0d1b3e',
                'bg'        => '#eef2ff',
                'populaire' => false,
                'avantages' => [
                    'Stand 24m²',
                    "Visibilité premium sur l'ensemble des supports de communications",
                    'Intervention lors d\'une table ronde ou d\'un panel thématique',
                    'Rencontres d\'affaires ciblées avec décideurs et investisseurs',
                    'Session de recrutement dédiée',
                    'Renforcement de votre marque employeur auprès de la diaspora',
                    'Invitations VIP à la soirée partenaires',
                ],
            ],
            [
                'slug'      => 'Officiel',
                'nom'       => 'Officiel',
                'prix'      => '50 000 €',
                'couleur'   => '#162552',
                'bg'        => '#f4f6fa',
                'populaire' => false,
                'avantages' => [
                    'Stand 36m²',
                    'Naming officiel de lévénement (JEFIE PARIS 2026 présenté par votre marque)',
                    'Stand 36m² emplacement premium',
                    'Keynote d\'ouverture devant l\'ensemble des participants',
                    'Visibilité max sur tous les supports de communication',
                    'Accès prioritaire aux rencontres avec des décideurs public et investisseurs',
                    'Session de recrutment dédiée et accès à la CVthèque complète ',
                    'Valorisation de votre marque employeur auprès des meilleurs talents de la diaspora',
                    'Invitations VIP (dîner de gala; cocktail partenaires',
                ],
            ],
        ];
    }

    private function avantages(): array
    {
        return [
            ['titre' => 'Visibilité internationale',  'desc' => 'Associer votre marque à un événement institutionnel de référence.',                   'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'],
            ['titre' => 'Networking qualifié',         'desc' => 'Accédez à des profils qualifiés.',            'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['titre' => 'Opportunités B2B',            'desc' => 'Rencontrez des décideurs public et privée.',                  'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
            ['titre' => 'Présence digitale',           'desc' => 'Valoriser votre engagements RSE.',          'icon' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>'],
            ['titre' => 'Rapport d\'impact',           'desc' => 'Recevez un rapport détaillé de votre visibilité, retombées presse et résultats de votre participation.',  'icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'],
            ['titre' => 'Accompagnement dédié',        'desc' => 'Renforcer votre marque employeur',          'icon' => '<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z"/>'],
        ];
    }

    private function temoignages(): array
    {
        return [
            ['nom' => 'Astima Ognia Daffney', 'poste' => 'DG BJ TECh',    'photo' => 'ALLAN.jpg', 'texte' => 'Ce partenariat nous a permis de connecter notre marque avec l\'écosystème entrepreneurial africain. Un retour sur investissement exceptionnel.'],
            ['nom' => 'Pascal Franck Nze Ndong Nze',      'poste' => 'DG PNPE', 'photo' => 'Pascal Franck Nze Ndong Nze.jpg', 'texte' => 'L\'organisation était irréprochable et la qualité des participants remarquable.'],
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
