<?php
// app/Http/Controllers/EmploiController.php

namespace App\Http\Controllers;

use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\EntrepreneursProfil;

class EmploiController extends Controller
{
    public function index(Request $request): View
    {
        $query = OffreEmploi::query()->orderByDesc('created_at');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->q . '%')
                    ->orWhere('entreprise', 'like', '%' . $request->q . '%')
                    ->orWhere('competences', 'like', '%' . $request->q . '%');
            });
        }
        if ($request->filled('secteur'))  $query->where('secteur', $request->secteur);
        if ($request->filled('lieu'))     $query->where('lieu', 'like', '%' . $request->lieu . '%');
        if ($request->filled('contrat'))  $query->where('type_contrat', $request->contrat);

        $onglet = $request->get('onglet', 'recentes');
        if ($onglet === 'vedette') $query->where('en_vedette', true);

        $offres = $query->paginate(10);

        return view('emploi', [
            'offres'           => $offres,
            'ongletActif'      => $onglet,
            'stats'            => $this->stats(),
            'recherchesPop'    => $this->recherchesPop(),
            'secteurs'         => $this->secteurs(),
            'typesContrat'     => $this->typesContrat(),
            'fonctionnalites'  => $this->fonctionnalites(),
            'candidaturesStats' => $this->candidaturesStats(),
        ]);
    }

    /**
     * Traiter le formulaire de la modale "Déposer candidature"
     */
    public function storeCandidature(Request $request)
    {
        $request->validate([
            'nom'   => 'required|string|max:255',
            'poste' => 'required|string|max:255',
        ]);

        // Insérez ici la logique d'enregistrement en base (ex: Candidature::create(...))

        return redirect()->back()->with('success', 'Votre candidature a bien été envoyée !');
    }

    /**
     * Traiter le formulaire de la modale "CV et documents"
     */
    public function storeDocuments(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
            'lettre' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $cv = $request->file('cv')->store('cvs', 'public');

        $lettre = null;

        if ($request->hasFile('lettre')) {
            $lettre = $request->file('lettre')->store('lettres', 'public');
        }


        return redirect()
            ->back()
            ->with('success', 'Vos documents ont été enregistrés avec succès !');
    }

    /**
        /**
     * Traiter le formulaire de la modale "Rendez-vous B2B"
     */
    public function storeRdv(Request $request)
    {
        // 1. Validation : Les règles (1er tableau) et les messages (2e tableau) sont bien séparés !
        $request->validate([
            'recruteur' => 'required|string|max:255',
            'date_rdv'  => 'required|date|after:now',
        ], [
            'recruteur.required' => 'Veuillez sélectionner ou renseigner un recruteur.',
            'date_rdv.required'  => 'La date et l\'heure du rendez-vous sont obligatoires.',
            'date_rdv.after'     => 'La date du rendez-vous doit être dans le futur.',
        ]);

        // Extraction de la date (AAAA-MM-JJ) et de l'heure (HH:MM) depuis le champ "date_rdv"
        $dateTime = new \DateTime($request->input('date_rdv'));
        $date = $dateTime->format('Y-m-d');
        $heure = $dateTime->format('H:i');

        // 2. Enregistrement en base de données avec vos colonnes réelles
        \App\Models\RendezVousB2B::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'titre'   => 'Rencontre B2B avec ' . $request->input('recruteur'), // Crée un titre propre
            'lieu'    => 'Espace B2B - Hall Principal', // Lieu par défaut du Forum
            'date'    => $date,
            'heure'   => $heure,
            'statut'  => 'en_attente',
        ]);

        // 3. Redirection avec un message de succès flash pour la modale
        return redirect()
            ->back()
            ->with('success', 'Votre demande de rendez-vous B2B a été transmise avec succès !');
    }

    /**
     * Traiter le formulaire de la modale "Alertes emploi" (Ajouté)
     */
    public function storeAlerte(Request $request)
    {
        $request->validate([
            'keyword'   => 'required|string|max:255',
            'frequence' => 'required|string|in:quotidienne,hebdomadaire',
        ]);

        // Insérez ici la logique d'enregistrement de l'alerte en base de données

        return redirect()->back()->with('success', 'Votre alerte emploi a été créée avec succès !');
    }

    private function stats(): array
    {
        return [
            ['valeur' => '128',   'label' => "Entreprises\nrecruteuses",    'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
            ['valeur' => '320',   'label' => "Offres d'emploi\npubliées",   'icon' => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
            ['valeur' => '2 450', 'label' => "Candidats\ninscrits",          'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
            ['valeur' => '560',   'label' => "Rendez-vous\nB2B programmés", 'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
        ];
    }

    private function recherchesPop(): array
    {
        return ['Développeur', 'Ingénieur', 'Data Analyst', 'Chef de projet', 'Marketing', 'Finance'];
    }

    private function secteurs(): array
    {
        return [
            'Technologies',
            'Finance & Banque',
            'Commerce',
            'Industrie',
            'Santé',
            'Agriculture',
            'Énergie',
            'Conseil',
            'RH',
            'Marketing'
        ];
    }

    private function typesContrat(): array
    {
        return ['CDI', 'CDD', 'Stage', 'Freelance', 'Alternance'];
    }

    private function fonctionnalites(): array
    {
        return [
            ['titre' => 'Déposez votre candidature',   'desc' => 'Postulez en quelques clics et suivez l\'évolution de vos candidatures.',     'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
            ['titre' => 'CV et documents',             'desc' => 'Téléchargez votre CV et vos lettres de motivation en toute sécurité.',        'icon' => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
            ['titre' => 'Alertes emploi',              'desc' => 'Recevez des notifications pour les nouvelles offres correspondant à votre profil.', 'icon' => '<path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>'],
            ['titre' => 'Rendez-vous B2B',             'desc' => 'Échangez directement avec les recruteurs lors de rendez-vous qualifiés.',      'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'],
        ];
    }

    private function candidaturesStats(): array
    {
        return [
            ['label' => 'Candidatures envoyées', 'count' => 8,  'color' => '#2e7d32'],
            ['label' => 'En cours d\'examen',     'count' => 3,  'color' => '#f5a623'],
            ['label' => 'Présélectionnées',       'count' => 2,  'color' => '#1565c0'],
            ['label' => 'Entretiens programmés',  'count' => 1,  'color' => '#6a1b9a'],
            ['label' => 'Refusées',               'count' => 2,  'color' => '#c62828'],
        ];
    }
}
