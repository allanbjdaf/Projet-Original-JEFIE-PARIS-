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

        return view('faq', [
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
            ['slug' => 'paiement',       'label' => 'Paiement & Tarifs',    'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>',                                                                                                        'color' => '#00838f'],
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
                'question' => 'Comment s\'inscrire au Forum International de l\'Innovation 2026 ?',
                'reponse'  => 'L\'inscription se fait entièrement en ligne sur notre plateforme. Rendez-vous sur la page "Inscriptions & Billetterie", choisissez votre type de pass (Gratuit, Standard ou Premium), remplissez le formulaire avec vos informations personnelles et professionnelles, puis procédez au paiement si nécessaire. Vous recevrez immédiatement un email de confirmation avec votre badge QR Code.'
            ],
            [
                'id' => 2,
                'categorie' => 'inscription',
                'populaire' => true,
                'question' => 'Quels sont les différents types de pass disponibles ?',
                'reponse'  => 'Trois niveaux de pass sont disponibles : le Pass Gratuit (accès aux conférences principales, espaces d\'exposition, supports numériques), le Pass Standard à 15 000 FCFA (accès à toutes les conférences, kit participant, attestation de participation) et le Pass Premium à 50 000 FCFA (accès VIP à toutes les activités, déjeuner networking, kit premium, certificat officiel et accès aux replays vidéo).'
            ],
            [
                'id' => 3,
                'categorie' => 'inscription',
                'populaire' => false,
                'question' => 'Puis-je modifier mon inscription après l\'avoir soumise ?',
                'reponse'  => 'Oui, vous pouvez modifier certaines informations de votre inscription (coordonnées, type de participation) en vous connectant à votre espace personnel. Pour un changement de pass ou un remboursement, contactez notre équipe à inscription@forum-innovation.org au minimum 15 jours avant l\'événement.'
            ],
            [
                'id' => 4,
                'categorie' => 'inscription',
                'populaire' => false,
                'question' => 'Une inscription groupée est-elle possible pour une organisation ?',
                'reponse'  => 'Oui, nous proposons des tarifs préférentiels pour les groupes de 5 personnes ou plus. Contactez notre équipe partenariats à groupes@forum-innovation.org pour obtenir un devis personnalisé et faciliter la gestion de vos inscriptions collectives.'
            ],
            [
                'id' => 5,
                'categorie' => 'inscription',
                'populaire' => false,
                'question' => 'Y a-t-il des tarifs réduits pour les étudiants ou jeunes entrepreneurs ?',
                'reponse'  => 'Oui ! Nous proposons un tarif étudiant avec 50% de réduction sur le Pass Standard sur présentation d\'une carte étudiante valide. Les jeunes entrepreneurs de moins de 30 ans bénéficient également d\'un tarif préférentiel. Contactez-nous à jeunes@forum-innovation.org pour en bénéficier.'
            ],

            // ── PROGRAMME ───────────────────────────────────────────
            [
                'id' => 6,
                'categorie' => 'programme',
                'populaire' => true,
                'question' => 'Quand et où se déroule le Forum International de l\'Innovation 2026 ?',
                'reponse'  => 'Le Forum se tiendra du 15 au 18 juin 2026 à Paris, France. La localisation précise du lieu sera communiquée courant mars 2026 via notre newsletter et sur le site officiel. Le Forum accueillera 5 000+ participants de 50+ pays sur 4 jours d\'échanges intensifs.'
            ],
            [
                'id' => 7,
                'categorie' => 'programme',
                'populaire' => false,
                'question' => 'Quelles sont les thématiques abordées lors du Forum ?',
                'reponse'  => 'Le Forum 2026 s\'articule autour de 6 grandes thématiques : Innovation & Transformation digitale, Finance & Investissement en Afrique, Développement durable & Green Tech, Diaspora & Entrepreneuriat, Santé & Bien-être, et Éducation & Formation. Chaque thématique est déclinée en conférences plénières, panels et ateliers pratiques.'
            ],
            [
                'id' => 8,
                'categorie' => 'programme',
                'populaire' => false,
                'question' => 'Comment soumettre un pitch entrepreneurial ?',
                'reponse'  => 'Les pitchs sont ouverts aux entrepreneurs diaspora disposant d\'un projet innovant. Pour soumettre votre candidature, rendez-vous dans la section Programme, choisissez "Pitchs entrepreneuriaux" et remplissez le formulaire de soumission avant le 1er mai 2026. Les projets sélectionnés seront présentés devant un jury d\'investisseurs lors de la soirée dédiée.'
            ],
            [
                'id' => 9,
                'categorie' => 'programme',
                'populaire' => false,
                'question' => 'Les sessions seront-elles disponibles en replay ?',
                'reponse'  => 'Oui, l\'ensemble des conférences plénières et panels seront enregistrés et disponibles en replay pour les détenteurs de Pass Premium dans les 7 jours suivant l\'événement. Les Pass Standard auront accès aux replays 30 jours après l\'événement. Le Pass Gratuit ne donne pas accès aux replays.'
            ],

            // ── PARTENARIAT ─────────────────────────────────────────
            [
                'id' => 10,
                'categorie' => 'partenariat',
                'populaire' => true,
                'question' => 'Comment devenir partenaire officiel du Forum ?',
                'reponse'  => 'Pour devenir partenaire, rendez-vous sur la page "Devenir Partenaire" et soumettez votre demande via le formulaire en ligne. Notre équipe commerciale vous contactera sous 48h pour discuter du niveau de partenariat adapté à vos objectifs (Bronze, Argent, Or, Platine ou Sur Mesure) et finaliser les modalités de collaboration.'
            ],
            [
                'id' => 11,
                'categorie' => 'partenariat',
                'populaire' => false,
                'question' => 'Quels sont les avantages d\'un partenariat avec le Forum ?',
                'reponse'  => 'Les partenaires bénéficient d\'une visibilité internationale auprès de 5 000+ décideurs, d\'un espace d\'exposition dédié, de sessions de présentation, d\'accès à notre base de contacts qualifiés, d\'une présence sur tous nos supports de communication (site, newsletter, réseaux sociaux) et d\'un rapport d\'impact post-événement détaillé.'
            ],
            [
                'id' => 12,
                'categorie' => 'partenariat',
                'populaire' => false,
                'question' => 'Puis-je sponsoriser un événement ou une session spécifique ?',
                'reponse'  => 'Absolument ! Nous proposons des offres de "naming" sur des sessions spécifiques (conférence d\'ouverture, dîner de gala, sessions B2B, espace startup) qui permettent une visibilité ciblée et un association forte de votre marque à un moment clé du Forum. Contactez partenariats@forum-innovation.org pour les détails.'
            ],

            // ── DIASPORA ────────────────────────────────────────────
            [
                'id' => 13,
                'categorie' => 'diaspora',
                'populaire' => true,
                'question' => 'Comment créer et compléter mon profil entrepreneur diaspora ?',
                'reponse'  => 'Après votre inscription, accédez à votre espace personnel et cliquez sur "Mon profil entrepreneur". Renseignez vos informations professionnelles, votre secteur d\'activité, vos projets en cours et vos domaines d\'expertise. Un profil complété à 100% augmente votre visibilité de 5× dans l\'annuaire et vous permet d\'être mis en avant dans la section "Entrepreneurs à la une".'
            ],
            [
                'id' => 14,
                'categorie' => 'diaspora',
                'populaire' => false,
                'question' => 'Comment planifier des rendez-vous B2B avec d\'autres entrepreneurs ?',
                'reponse'  => 'Via votre tableau de bord entrepreneur, accédez à la section "Annuaire" pour rechercher des profils par secteur, pays ou expertise. Cliquez sur un profil et sélectionnez "Planifier un RDV". Vous pouvez proposer des créneaux disponibles pendant les 4 jours du Forum. Les deux parties reçoivent une confirmation par email.'
            ],
            [
                'id' => 15,
                'categorie' => 'diaspora',
                'populaire' => false,
                'question' => 'La cartographie des entrepreneurs est-elle accessible à tous ?',
                'reponse'  => 'La carte mondiale des entrepreneurs de la diaspora gabonaise est accessible à tous les visiteurs du site. Les fonctionnalités avancées (filtres détaillés, informations de contact, prise de rendez-vous) sont réservées aux membres inscrits. Pour apparaître sur la cartographie, créez votre profil entrepreneur et renseignez votre localisation.'
            ],

            // ── LOGISTIQUE ──────────────────────────────────────────
            [
                'id' => 16,
                'categorie' => 'logistique',
                'populaire' => false,
                'question' => 'Des hébergements partenaires sont-ils disponibles pour les participants ?',
                'reponse'  => 'Oui, nous avons négocié des tarifs préférentiels avec une sélection d\'hôtels partenaires situés à proximité du lieu de l\'événement à Paris. La liste des hébergements partenaires et les codes de réservation seront communiqués aux inscrits confirmés par email dès mars 2026.'
            ],
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

            // ── PAIEMENT ────────────────────────────────────────────
            [
                'id' => 19,
                'categorie' => 'paiement',
                'populaire' => true,
                'question' => 'Quels moyens de paiement sont acceptés ?',
                'reponse'  => 'Nous acceptons les paiements par Mobile Money (Orange Money, MTN Mobile Money, Wave, Moov Money, PayDunya), carte bancaire (Visa, Mastercard) et virement bancaire pour les montants supérieurs à 100 000 FCFA. Tous les paiements sont sécurisés. Pour les partenariats, des facilités de paiement en 2 ou 3 fois sont disponibles.'
            ],
            [
                'id' => 20,
                'categorie' => 'paiement',
                'populaire' => false,
                'question' => 'Quelle est la politique de remboursement en cas d\'annulation ?',
                'reponse'  => 'Remboursement intégral jusqu\'à 30 jours avant l\'événement. Entre 15 et 30 jours avant : remboursement de 50%. Moins de 15 jours avant l\'événement : aucun remboursement, mais vous pouvez transférer votre inscription à une autre personne. En cas d\'annulation du Forum de notre fait, tous les participants seront intégralement remboursés.'
            ],
            [
                'id' => 21,
                'categorie' => 'paiement',
                'populaire' => false,
                'question' => 'Puis-je obtenir une facture pour mon inscription ?',
                'reponse'  => 'Oui, une facture officielle au format PDF vous sera envoyée automatiquement par email après confirmation de votre paiement. Vous pouvez également la télécharger depuis votre espace personnel dans la section "Mes documents". Pour les entreprises nécessitant une facture avec TVA intracommunautaire, contactez facturation@forum-innovation.org.'
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
                'email'   => 'inscription@forum-innovation.org',
                'tel'     => '+221 33 123 45 67',
                'color'   => '#1565c0',
                'bg'      => '#e3f2fd',
                'icon'    => '<path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>',
            ],
            [
                'titre'   => 'Partenariats',
                'desc'    => 'Opportunités de partenariat, sponsoring et exposants.',
                'email'   => 'partenariats@forum-innovation.org',
                'tel'     => '+221 33 123 45 68',
                'color'   => '#f5a623',
                'bg'      => '#fff8e6',
                'icon'    => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
            ],
            [
                'titre'   => 'Support Technique',
                'desc'    => 'Problèmes de connexion, accès à la plateforme, bugs.',
                'email'   => 'support@forum-innovation.org',
                'tel'     => '+221 33 123 45 69',
                'color'   => '#2e7d32',
                'bg'      => '#e8f5e9',
                'icon'    => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4"/>',
            ],
        ];
    }
}
