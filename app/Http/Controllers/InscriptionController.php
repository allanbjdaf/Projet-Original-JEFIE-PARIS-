<?php
// app/Http/Controllers/InscriptionController.php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\ParticipationForum; // À ajouter tout en haut du fichier


class InscriptionController extends Controller
{
    public function index(): View
    {
        return view('inscription', [
            'stats'   => $this->stats(),
            'passes'  => $this->passes(),
            'raisons' => $this->raisons(),
            'pays'    => $this->listePays(),
            'types'   => $this->typesParticipant(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_complet'          => ['required', 'string', 'max:255'],
            'prenom'               => ['required', 'string', 'max:255'],
            'email'                => ['required', 'email', 'max:255', 'unique:inscriptions,email'],
            'telephone'            => ['required', 'string', 'max:30'],
            'organisation'         => ['nullable', 'string', 'max:255'],
            'fonction'             => ['nullable', 'string', 'max:255'],
            'pays'                 => ['required', 'string', 'max:100'],
            'type_participant'     => ['required', 'string', 'max:100'],
            'pass_choisi'          => ['nullable', 'string', 'in:gratuit,standard,premium'],
            'methode_paiement'     => ['nullable', 'string', 'max:50'],
            'accepte_conditions'   => ['required', 'accepted'],
        ], [
            'nom_complet.required'       => 'Le nom complet est obligatoire.',
            'prenom.required'            => 'Le prénom est obligatoire.',
            'email.required'             => "L'adresse email est obligatoire.",
            'email.email'                => "L'adresse email n'est pas valide.",
            'email.unique'               => 'Cette adresse email est déjà inscrite.',
            'telephone.required'         => 'Le numéro de téléphone est obligatoire.',
            'pays.required'              => 'Veuillez sélectionner votre pays.',
            'type_participant.required'  => 'Veuillez sélectionner votre type de participation.',
            'accepte_conditions.required' => 'Vous devez accepter les conditions générales.',
            'accepte_conditions.accepted' => 'Vous devez accepter les conditions générales.',
        ]);

        $inscription = Inscription::create([
            'nom_complet'      => $validated['nom_complet'],
            'prenom'           => $validated['prenom'],
            'email'            => $validated['email'],
            'telephone'        => $validated['telephone'],
            'organisation'     => $validated['organisation'] ?? null,
            'fonction'         => $validated['fonction'] ?? null,
            'pays'             => $validated['pays'],
            'type_participant' => $validated['type_participant'],
            'pass_choisi'      => $validated['pass_choisi'] ?? 'gratuit',
            'methode_paiement' => $validated['methode_paiement'] ?? null,
            'statut'           => 'en_attente',
            'numero_badge'     => strtoupper('FII26-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT)),
        ]);

        return redirect()
            ->route('inscription')
            ->with('success', "Votre inscription a bien été enregistrée ! Numéro de badge : {$inscription->numero_badge}");
    }

    // ── Données de référence ────────────────────────────────────────

    private function stats(): array
    {
        return [
            [
                'valeur' => '5 000+',
                'label' => 'Places disponibles',
                'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'
            ],
            [
                'valeur' => '2 500+',
                'label' => 'Inscrits',
                'icon' => '<path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>'
            ],
            [
                'valeur' => '150+',
                'label' => 'Entreprises',
                'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'
            ],
            [
                'valeur' => '30+',
                'label' => 'Pays représentés',
                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>'
            ],
        ];
    }

    private function passes(): array
    {
        return [
            [
                'slug'       => 'gratuit',
                'nom'        => 'Pass Gratuit',
                'prix'       => '0 FCFA',
                'prix_num'   => 0,
                'populaire'  => false,
                'couleur'    => '#2e7d32',
                'avantages'  => [
                    'Accès aux conférences',
                    'Espaces d\'exposition',
                    'Supports numériques',
                ],
                'icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
            ],
            [
                'slug'       => 'standard',
                'nom'        => 'Pass Standard',
                'prix'       => '15 000 FCFA',
                'prix_num'   => 15000,
                'populaire'  => true,
                'couleur'    => '#1565c0',
                'avantages'  => [
                    'Accès à toutes les conférences',
                    'Espaces d\'exposition',
                    'Kit participant',
                    'Attestation de participation',
                ],
                'icon' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
            ],
            [
                'slug'       => 'premium',
                'nom'        => 'Pass Premium',
                'prix'       => '50 000 FCFA',
                'prix_num'   => 50000,
                'populaire'  => false,
                'couleur'    => '#f5a623',
                'avantages'  => [
                    'Accès VIP à toutes les activités',
                    'Déjeuner & networking',
                    'Kit premium',
                    'Certificat officiel',
                    'Accès aux replays',
                ],
                'icon' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>',
            ],
        ];
    }

    private function raisons(): array
    {
        return [
            ['titre' => 'Rencontrez les leaders',    'desc' => 'Échangez avec des experts et décideurs internationaux',   'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['titre' => 'Découvrez & innovez',       'desc' => 'Accédez aux dernières tendances et innovations',           'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>'],
            ['titre' => 'Développez votre réseau',   'desc' => 'Créez des opportunités et partenariats',                   'icon' => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>'],
            ['titre' => 'Valorisez votre profil',    'desc' => 'Recevez un badge et un certificat officiel',               'icon' => '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>'],
        ];
    }

    private function listePays(): array
    {
        return [
            "Côte d'Ivoire",
            'Sénégal',
            'Gabon',
            'Cameroun',
            'Mali',
            'Burkina Faso',
            'Niger',
            'Guinée',
            'Togo',
            'Bénin',
            'Congo',
            'RDC',
            'France',
            'Belgique',
            'Allemagne',
            'États-Unis',
            'Canada',
            'Maroc',
            'Tunisie',
            'Algérie',
            'Égypte',
            'Afrique du Sud',
            'Ghana',
            'Nigéria',
            'Kenya',
            'Éthiopie',
            'Autre',
        ];
    }
    /**
     * Gère la soumission des candidatures distinctes.
     */
    public function storeCandidature(Request $request): RedirectResponse
    {
        // 1. Validation des données du formulaire de participation
        $validated = $request->validate([
            'stand'       => ['required', 'string', 'in:oui,non'],
            'docs_soumis' => ['nullable', 'string', 'max:255'],
        ], [
            'stand.required' => 'Veuillez indiquer si vous souhaitez un stand ou non.',
        ]);

        // 2. Sécurité : Vérifier que l'utilisateur est connecté pour l'associer à sa participation
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour postuler.');
        }

        // 3. Enregistrement dans la table "participation_forums"
        ParticipationForum::create([
            'user_id'     => auth()->id(), // Récupère l'ID de l'utilisateur connecté
            'statut'      => 'en_attente',
            'stand'       => $validated['stand'],
            'docs_soumis' => $validated['docs_soumis'] ?? null,
            'nb_rdv'      => 0,
            'confirmee'   => false,
        ]);

        // 4. Redirection avec un message de succès
        return redirect()
            ->route('candidature.show')
            ->with('success', 'Votre demande de participation au forum a été enregistrée avec succès !');
    }
    // <--- Dernière accolade du fichier

    private function typesParticipant(): array
    {
        return [
            'Participant',
            'Exposant',
            'Investisseur',
            'Intervenant',
            'Journaliste / Presse',
            'Sponsor',
            'Partenaire institutionnel',
            'Bénévole',
        ];
    }
}
