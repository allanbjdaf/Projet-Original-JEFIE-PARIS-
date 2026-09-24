<?php
// app/Http/Controllers/FaqController.php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request): View
    {
        $categorieActive = $request->get('cat', 'tous');
        $recherche       = $request->get('q', '');

        $categories = $this->categories();
        $faqs       = $this->faqs();

        // Filtrer par catégorie
        if ($categorieActive !== 'tous') {
            $faqs = array_filter($faqs, fn($f) => $f['categorie'] === $categorieActive);
        }

        // Filtrer par recherche
        if ($recherche) {
            $faqs = array_filter($faqs, function ($f) use ($recherche) {
                return stripos($f['question'], $recherche) !== false
                    || stripos($f['reponse'], $recherche) !== false;
            });
        }

        return view('Faq', [
            'categories'      => $categories,
            'faqs'            => array_values($faqs),
            'categorieActive' => $categorieActive,
            'recherche'       => $recherche,
            'stats'           => $this->stats(),
            'contactCards'    => $this->contactCards(),
        ]);
    }

    // ── Données ────────────────────────────────────────────────────

    private function stats(): array
    {
        return [
            ['valeur' => '85+',  'label' => 'Questions répondues'],
            ['valeur' => '< 24h', 'label' => 'Délai de réponse'],
            ['valeur' => '98%',  'label' => 'Satisfaction'],
            ['valeur' => '7/7',  'label' => 'Support disponible'],
        ];
    }

    private function categories(): array
    {
        return [
            ['slug' => 'tous',           'label' => 'Toutes les questions', 'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',           'color' => '#0d1b3e'],
            ['slug' => 'inscription',    'label' => 'Inscription',          'icon' => '<path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>',                                        'color' => '#1565c0'],
            ['slug' => 'programme',      'label' => 'Programme',            'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',                                                                                                                       'color' => '#2e7d32'],
            ['slug' => 'partenariat',    'label' => 'Partenariats',         'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',                                                           'color' => '#f5a623'],
            ['slug' => 'diaspora',       'label' => 'Espace Diaspora',      'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>',                                                                                                    'color' => '#e65100'],
            ['slug' => 'logistique',     'label' => 'Logistique & Accès',   'icon' => '<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>',                                                                                                                 'color' => '#6a1b9a'],
            ['slug' => 'technique',      'label' => 'Technique & Accès',    'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33"/>', 'color' => '#c2185b'],
        ];
    }

    private function faqs(): array
    {
        return [
            // ── INSCRIPTION ─────────────────────────────────────────
            [
                'id' => 1,
                'categorie' => 'inscription',
                'populaire' => true,
                'question' => 'Comment s\'inscrire au JEFIE ?',
                'reponse'  => 'L’inscription se fait en ligne sur notre plateforme. Rendez-vous sur la page « s’inscrire », choisissez votre profil « participant ou acteur économique », choisissez votre package (si vous êtes acteur économique), remplissez le formulaire en suivant les étapes, puis procédez à la validation. Vous recevrez immédiatement un email de confirmation avec votre badge QR Code.'
            ],
            [
                'id' => 2,
                'categorie' => 'inscription',
                'populaire' => true,
                'question' => 'Quels sont les différents types de pass disponibles ?',
                'reponse'  => 'OFFICIEL — 50 000 € * Stand 36 m² * Naming officiel de l’événement (JEFIE Paris 2026 présenté par votre marque) * Stand 36 m² en emplacement premium * Keynote d’ouverture devant l’ensemble des participants * Visibilité maximale sur tous les supports (site, presse, réseaux sociaux, signalétique) * Accès prioritaire aux rencontres avec décideurs publics et investisseurs 
                * Session de recrutement dédiée et accès à la CVthèque complète * Valorisation de votre marque employeur auprès des meilleurs talents de la diaspora * Invitations VIP (dîner de gala, cocktail partenaires) 2 places disponibles ⸻ PLATINE — 40 000 € * Stand 24 m² * Stand 24 m² en emplacement privilégié * Visibilité premium sur l’ensemble des supports de communication * Intervention lors d’une table ronde ou d’un panel thématique * Rencontres d’affaires ciblées avec décideurs et investisseurs * Session de recrutement dédiée * Renforcement de votre marque employeur auprès de la diaspora * Invitations VIP à la soirée partenaires 5 places disponibles ⸻ OR — 30 000 € * Stand 18 m² * Intervention lors d’une conférence thématique * Logo sur les principaux supports de communication (site, programme, badges) * Accès à l’espace networking dédié entreprises-diaspora * Participation à des sessions de recrutement * Mise en lumière de vos métiers et opportunités de carrière 10 places disponibles ⸻ ARGENT — 20 000 € * Stand 12 m² * Logo sur le site web et le programme officiel * Accès à l’espace networking général * Participation aux sessions de recrutement collectives * Mention de votre entreprise sur les réseaux sociaux 20 places disponibles ⸻ BRONZE — 10 000 € * Stand 9 m² * Logo sur le programme et les supports d’accueil * Accès à l’espace networking général 
                * Visibilité sur le site web (page partenaires) 5 places disponibles.'
            ],

            // ── PROGRAMME ───────────────────────────────────────────
            [
                'id' => 6,
                'categorie' => 'programme',
                'populaire' => true,
                'question' => 'Quand et où se déroulent les JEFIE ?',
                'reponse'  => 'Le Forum se tiendra du 27 au 28 Novembre 2026 au CNIT FOREST LA DEFENSE, 2 Place de la défense, 92800 Puteaux, France.'
            ],
            [
                'id' => 7,
                'categorie' => 'programme',
                'populaire' => false,
                'question' => 'Quelles sont les thématiques abordées lors du Forum ?',
                'reponse'  => 'Le Forum 2026 s\'articule autour de 6 grandes thématiques : Innovation & Transformation digitale, Finance & Investissement en Afrique, Développement durable & Green Tech, Diaspora & Entrepreneuriat, Santé & Bien-être, et Éducation & Formation. Chaque thématique est déclinée en conférences plénières, panels et ateliers pratiques.'
            ],


            // ── PARTENARIAT ─────────────────────────────────────────
            [
                'id' => 10,
                'categorie' => 'partenariat',
                'populaire' => true,
                'question' => 'Comment devenir partenaire officiel des JEFIE ?',
                'reponse'  => 'Pour devenir partenaire officiel des JEFIE, il vous faudra choisir le Package  "Officiel" ou "Platine" et contacter nos équipes pourune rencontre de confirmation (Bronze, Argent, Or, Platine ) .'
            ],
            [
                'id' => 11,
                'categorie' => 'partenariat',
                'populaire' => false,
                'question' => 'Quels sont les avantages d\'un partenariat avec le Forum ?',
                'reponse'  => 'Les partenaires bénéficient d\'une visibilité internationale auprès de 5 000+ décideurs, d\'un espace d\'exposition dédié, de sessions de présentation, d\'accès à notre base de contacts qualifiés, d\'une présence sur tous nos supports de communication (site, newsletter, réseaux sociaux) et d\'un rapport d\'impact post-événement détaillé.'
            ],


            // ── DIASPORA ────────────────────────────────────────────
            [
                'id' => 13,
                'categorie' => 'diaspora',
                'populaire' => true,
                'question' => 'Comment créer et compléter mon profil entrepreneur diaspora ?',
                'reponse'  => 'Après votre inscription, accédez à votre espace personnel et cliquez sur "Mon profil entrepreneur". Renseignez vos informations professionnelles, votre secteur d\'activité, vos projets en cours et vos domaines d\'expertise. Un profil complété à 100% augmente votre visibilité de 5× dans l\'annuaire et vous permet d\'être mis en avant dans la section "Entrepreneurs à la une".'
            ],


            // ── LOGISTIQUE ──────────────────────────────────────────

            [
                'id' => 17,
                'categorie' => 'logistique',
                'populaire' => false,
                'question' => 'Y a-t-il une assistance pour l\'obtention de visas ?',
                'reponse'  => 'Nous fournissons aux participants qui en ont besoin une lettre d\'invitation officielle du Forum pour faciliter leurs démarches de visa auprès des consulats français. Cette lettre est disponible sur demande après confirmation de votre inscription. Contactez visas@forum-innovation.org en précisant votre nationalité et votre numéro d\'inscription.'
            ],
            [
                'id' => 18,
                'categorie' => 'logistique',
                'populaire' => false,
                'question' => 'Comment récupérer mon badge le jour de l\'événement ?',
                'reponse'  => 'Votre badge numérique QR Code vous sera envoyé par email après confirmation de votre paiement. Le jour J, présentez-le (sur téléphone ou imprimé) à l\'un de nos stands d\'accueil pour récupérer votre badge physique personnalisé. Un espace d\'accueil dédié "Inscription rapide" sera disponible pour les arrivées de dernière minute.'
            ],




            // ── TECHNIQUE ───────────────────────────────────────────
            [
                'id' => 22,
                'categorie' => 'technique',
                'populaire' => false,
                'question' => 'J\'ai oublié mon mot de passe, comment le réinitialiser ?',
                'reponse'  => 'Sur la page de connexion, cliquez sur "Mot de passe oublié ?". Entrez l\'adresse email utilisée lors de votre inscription. Vous recevrez un lien de réinitialisation valable 24h. Si vous ne recevez pas l\'email dans les 5 minutes, vérifiez vos spams ou contactez support@forum-innovation.org.'
            ],
            [
                'id' => 23,
                'categorie' => 'technique',
                'populaire' => false,
                'question' => 'Comment activer les alertes emploi et les notifications ?',
                'reponse'  => 'Dans votre tableau de bord, accédez à "Mes alertes" dans le menu latéral. Vous pouvez configurer des alertes par secteur d\'activité, type de contrat, lieu et niveau d\'expérience. Vous recevrez des notifications par email dès qu\'une nouvelle offre correspondant à vos critères est publiée sur la plateforme.'
            ],
            [
                'id' => 24,
                'categorie' => 'technique',
                'populaire' => false,
                'question' => 'La plateforme est-elle accessible sur mobile ?',
                'reponse'  => 'Oui, notre plateforme est entièrement responsive et optimisée pour les smartphones et tablettes (iOS et Android). Toutes les fonctionnalités sont disponibles sur mobile : inscription, tableau de bord entrepreneur, annuaire, rendez-vous B2B, programme et cartographie. Une application mobile dédiée est en cours de développement pour fin 2026.'
            ],
        ];
    }

    private function contactCards(): array
    {
        return [
            [
                'titre'   => 'Inscription & Billetterie',
                'desc'    => 'Questions sur votre inscription, vos passes et vos paiements.',
                'email'   => 'Contact@jefieparis.fr',
                'tel'     => '+241 62397223',
                'color'   => '#1565c0',
                'bg'      => '#e3f2fd',
                'icon'    => '<path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>',
            ],
            [
                'titre'   => 'Partenariats',
                'desc'    => 'Opportunités de partenariat, sponsoring et exposants.',
                'email'   => 'partenariat@jefieparis.fr',
                'tel'     => '+33 7 54 78 84',
                'color'   => '#f5a623',
                'bg'      => '#fff8e6',
                'icon'    => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
            ],
            [
                'titre'   => 'Support Technique',
                'desc'    => 'Problèmes de connexion, accès à la plateforme, bugs.',
                'email'   => 'Communication@jefieparis.fr',
                'tel'     => '+241 62397223',
                'color'   => '#2e7d32',
                'bg'      => '#e8f5e9',
                'icon'    => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4"/>',
            ],
        ];
    }
}
