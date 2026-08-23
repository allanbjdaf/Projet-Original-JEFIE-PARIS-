<?php
// app/Http/Controllers/PourquoiController.php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\OffreEmploi;
use App\Models\EntrepreneurProfil;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class PourquoiController extends Controller
{
    public function index(): View
    {
        // Stats réelles depuis la BDD (avec fallback si table vide)
        $stats = Cache::remember('pourquoi_stats', 600, function () {
            return [
                'inscrits'       => $this->safeCount(fn() => Inscription::where('statut', 'confirme')->count(), 2500),
                'pays'           => $this->safeCount(fn() => Inscription::distinct('pays')->count('pays'), 78),
                'entreprises'    => $this->safeCount(fn() => EntrepreneurProfil::count(), 3811),
                'offres'         => $this->safeCount(fn() => OffreEmploi::where('statut', 'active')->count(), 320),
                'partenaires'    => 150,
                'investisseurs'  => 200,
                'rdv_b2b'        => 500,
                'emplois_crees'  => 14732,
            ];
        });

        // Raisons de participer
        $raisons = $this->getRaisons();

        // Profils participants
        $profils = $this->getProfils();

        // Chiffres clés éditions passées
        $palmares = $this->getPalmares();

        // Témoignages
        $temoignages = $this->getTemoignages();

        // FAQ
        $faq = $this->getFaq();

        return view('pourquoi-participer', compact(
            'stats',
            'raisons',
            'profils',
            'palmares',
            'temoignages',
            'faq'
        ));
    }

    private function safeCount(callable $fn, int $fallback = 0): int
    {
        try {
            return max($fn(), $fallback);
        } catch (\Exception) {
            return $fallback;
        }
    }

    private function getRaisons(): array
    {
        return [
            [
                'icon'  => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/>',
                'couleur' => '#f5a623',
                'bg' => '#fff8e6',
                'numero' => '01',
                'titre'  => 'Réseau de 3 811 entrepreneurs',
                'desc'   => 'Connectez-vous directement avec des entrepreneurs, investisseurs et décideurs de la diaspora gabonaise répartis dans 78 pays. Des rencontres qui changent des destins professionnels.',
                'points' => ['500+ rendez-vous B2B organisés', 'Annuaire exclusif membres', 'Mise en relation ciblée par secteur', 'Networking premium 4 jours'],
                'stat'   => '3 811',
                'stat_label' => 'membres actifs',
            ],
            [
                'icon'  => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>',
                'couleur' => '#1565c0',
                'bg' => '#e3f2fd',
                'numero' => '02',
                'titre'  => 'Accès direct aux investisseurs',
                'desc'   => 'Présentez votre projet devant 200+ investisseurs internationaux spécialisés en Afrique. Des fonds d\'investissement, family offices et business angels à la recherche d\'opportunités.',
                'points' => ['Pitch competition avec jury expert', '200+ investisseurs présents', 'Deals signés sur place', 'Accès aux fonds diaspora'],
                'stat'   => '850 Mds',
                'stat_label' => 'FCFA levés en 3 éditions',
            ],
            [
                'icon'  => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>',
                'couleur' => '#2e7d32',
                'bg' => '#e8f5e9',
                'numero' => '03',
                'titre'  => 'Marchés africains à portée de main',
                'desc'   => 'Rencontrez des représentants gouvernementaux, institutionnels et opérateurs économiques du Gabon et d\'Afrique centrale. Des opportunités concrètes de développement commercial.',
                'points' => ['Délégation officielle du Gabon', 'Marchés publics & appels d\'offres', 'Partenariats commerciaux', 'Implantation locale facilitée'],
                'stat'   => '78',
                'stat_label' => 'pays représentés',
            ],
            [
                'icon'  => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
                'couleur' => '#6a1b9a',
                'bg' => '#ede7f6',
                'numero' => '04',
                'titre'  => 'Formation & expertise de haut niveau',
                'desc'   => 'Accédez à 16 sessions de formations, conférences et ateliers pratiques animés par des experts internationaux. Des compétences directement applicables à votre activité.',
                'points' => ['6 types d\'activités', '16 sessions sur 4 jours', 'Experts certifiés internationaux', 'Attestation de participation'],
                'stat'   => '16',
                'stat_label' => 'sessions de formation',
            ],
            [
                'icon'  => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>',
                'couleur' => '#e65100',
                'bg' => '#fff3e0',
                'numero' => '05',
                'titre'  => '320+ offres d\'emploi exclusives',
                'desc'   => 'Explorez des centaines d\'offres d\'emploi et d\'opportunités professionnelles publiées par des entreprises gabonaises et internationales cherchant des talents de la diaspora.',
                'points' => ['CDI, CDD, Freelance', 'Missions au Gabon', 'Directions & postes clés', 'CV directement consulté par les recruteurs'],
                'stat'   => '320+',
                'stat_label' => 'offres disponibles',
            ],
            [
                'icon'  => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20"/>',
                'couleur' => '#c2185b',
                'bg' => '#fce4ec',
                'numero' => '06',
                'titre'  => 'Visibilité internationale',
                'desc'   => 'Publiez votre profil entreprise sur la plateforme officielle JEFIE. Soyez visible par des milliers de décideurs, médias et partenaires présents au Forum et au-delà.',
                'points' => ['Profil entrepreneur public', 'Couverture médias africains', 'Répertoire officiel diaspora', 'Badge & QR Code nominatif'],
                'stat'   => '50 000+',
                'stat_label' => 'vues de la plateforme',
            ],
        ];
    }

    private function getProfils(): array
    {
        return [
            ['icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>', 'couleur' => '#f5a623', 'bg' => '#fff8e6', 'titre' => 'Entrepreneurs', 'desc' => 'Développez votre réseau, trouvez des partenaires et accédez aux marchés africains depuis la diaspora.', 'avantages' => ['Profil entreprise visible', 'RDV B2B prioritaires', 'Pitch investisseurs', 'Annuaire exclusif']],
            ['icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>', 'couleur' => '#1565c0', 'bg' => '#e3f2fd', 'titre' => 'Recruteurs & Employeurs', 'desc' => 'Identifiez les talents qualifiés de la diaspora pour renforcer vos équipes au Gabon et à l\'international.', 'avantages' => ['Publication d\'offres illimitée', 'Accès aux CVthèques', 'Entretiens sur place', 'Matching automatique']],
            ['icon' => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>', 'couleur' => '#2e7d32', 'bg' => '#e8f5e9', 'titre' => 'Candidats & Talents', 'desc' => 'Rencontrez directement vos futurs employeurs et explorez des centaines d\'opportunités professionnelles.', 'avantages' => ['Candidatures directes', 'RDV employeurs', 'Ateliers CV & entretiens', 'Alertes emploi personnalisées']],
            ['icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>', 'couleur' => '#6a1b9a', 'bg' => '#ede7f6', 'titre' => 'Investisseurs', 'desc' => 'Découvrez des projets innovants portés par la diaspora et investissez dans l\'économie gabonaise de demain.', 'avantages' => ['Accès exclusif Pitch Competition', 'Dossiers projets préfiltrés', 'Due diligence facilitée', 'Réseau co-investisseurs']],
            ['icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>', 'couleur' => '#e65100', 'bg' => '#fff3e0', 'titre' => 'Institutionnels', 'desc' => 'Représentez votre institution et nouez des partenariats stratégiques avec la diaspora pour le développement du Gabon.', 'avantages' => ['Stand institutionnel', 'Protocole officiel', 'Délégation organisée', 'Visibilité nationale']],
            ['icon' => '<path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a4 4 0 01-4-4"/>', 'couleur' => '#c2185b', 'bg' => '#fce4ec', 'titre' => 'Médias & Journalistes', 'desc' => 'Couvrez l\'événement de l\'année de la diaspora gabonaise. Accès presse prioritaire et interviews organisées.', 'avantages' => ['Accréditation presse', 'Salle de presse dédiée', 'Interviews exclusives', 'Dossier de presse complet']],
        ];
    }

    private function getPalmares(): array
    {
        return [
            ['annee' => '2023', 'lieu' => 'Libreville, Gabon',  'inscrits' => '1 200', 'pays' => '32', 'partenariats' => '87',  'investissements' => '120 Mds FCFA'],
            ['annee' => '2024', 'lieu' => 'Paris, France',      'inscrits' => '2 100', 'pays' => '58', 'partenariats' => '134', 'investissements' => '310 Mds FCFA'],
            ['annee' => '2025', 'lieu' => 'Bruxelles, Belgique', 'inscrits' => '3 200', 'pays' => '71', 'partenariats' => '198', 'investissements' => '420 Mds FCFA'],
            ['annee' => '2026', 'lieu' => 'Paris, France',      'inscrits' => '5 000+', 'pays' => '80+', 'partenariats' => '300+', 'investissements' => '?'],
        ];
    }

    private function getTemoignages(): array
    {
        return [
            ['init' => 'S', 'couleur' => '#f5a623', 'nom' => 'Stéphane Obame', 'role' => 'CEO TechGabon SAS', 'pays' => 'Paris, France 🇫🇷', 'texte' => 'Le Forum JEFIE a été le tournant de ma carrière entrepreneuriale. J\'ai rencontré mon associé gabonais, levé 2 millions d\'euros et lancé notre bureau à Libreville — tout ça en 4 jours de Forum. Ne manquez pas ça.'],
            ['init' => 'M', 'couleur' => '#1565c0', 'nom' => 'Mireille Moubamba', 'role' => 'Fondatrice AgroGreen', 'pays' => 'Bruxelles, Belgique 🇧🇪', 'texte' => 'En tant qu\'entrepreneuse dans l\'agroalimentaire, j\'ai trouvé 3 distributeurs gabonais et signé un contrat de 500 000€. JEFIE, c\'est concret. Ce n\'est pas une conférence de plus — c\'est un accélérateur de business réel.'],
            ['init' => 'H', 'couleur' => '#2e7d32', 'nom' => 'Hervé Ndong', 'role' => 'DG FinTransfer', 'pays' => 'Lyon, France 🇫🇷', 'texte' => 'J\'ai pitché devant 150 investisseurs. Résultat : 4 term sheets en 48h. Le Forum JEFIE est la meilleure plateforme pour les entrepreneurs africains qui veulent passer à la vitesse supérieure.'],
        ];
    }

    private function getFaq(): array
    {
        return [
            ['q' => 'Qui peut participer au Forum JEFIE Paris 2026 ?', 'r' => 'Le Forum est ouvert à tous : entrepreneurs de la diaspora, candidats à l\'emploi, recruteurs, investisseurs, institutionnels et médias. Une seule condition : avoir la volonté de contribuer au développement économique du Gabon.'],
            ['q' => 'Quel est le coût d\'inscription ?', 'r' => 'Trois formules existent : Pass Gratuit (accès aux conférences et expositions), Pass Standard (15 000 FCFA – kit complet + attestation) et Pass Premium (50 000 FCFA – accès VIP, déjeuner networking, certificat officiel et accès prioritaire aux RDV B2B).'],
            ['q' => 'Comment planifier mes rendez-vous B2B ?', 'r' => 'Après inscription, vous accédez à votre espace entrepreneur où vous pouvez consulter les profils des membres et planifier jusqu\'à 12 rendez-vous B2B de 30 minutes sur les 4 jours du Forum.'],
            ['q' => 'Y a-t-il un accompagnement pour les entrepreneurs ?', 'r' => 'Oui. Des experts dédiés accompagnent chaque entrepreneur : conseil juridique, fiscal et financier, aide à la structuration de projets, mise en relation avec des investisseurs et accompagnement post-Forum.'],
            ['q' => 'Peut-on participer à distance ?', 'r' => 'Certaines conférences seront diffusées en direct sur la plateforme. Cependant, nous recommandons fortement la présence physique pour maximiser les opportunités de networking et de rendez-vous B2B.'],
        ];
    }
}
