<?php

namespace App\Http\Controllers;
 
use App\Models\Inscription;
use App\Models\CollaborateurForum;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
 
class InscriptionController extends Controller
{
    // ── Afficher le formulaire ────────────────────────────────
    public function index(): View
    {
        return view('inscription');
    }
 
    // ── Traiter et enregistrer l'inscription ──────────────────
    public function store(Request $request): RedirectResponse
    {
        $type = $request->input('type_inscription');
 
        if ($type === 'participant') {
            return $this->storeParticipant($request);
        }
 
        if ($type === 'entreprise') {
            return $this->storeEntreprise($request);
        }
 
        return back()->withErrors(['type' => 'Type d\'inscription invalide.']);
    }
 
    // ── PARTICIPANT ───────────────────────────────────────────
    private function storeParticipant(Request $request): RedirectResponse
    {
        $request->validate([
            'profil_visiteur'   => 'required|in:participant,ecoute,entrepreneur',
            'civilite'          => 'required|in:M,Mme',
            'nom'               => 'required|string|max:100',
            'prenom'            => 'required|string|max:100',
            'nationalite'       => 'required|string|max:100',
            'pays_residence'    => 'required|string|max:100',
            'whatsapp'          => 'required|string|max:30',
            'email'             => 'required|email|max:200',
            'certif_exactitude' => 'required|accepted',
            'accepte_donnees'   => 'required|accepted',
            // CV optionnel
            'cv'                => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'profil_visiteur.required'   => 'Veuillez sélectionner votre profil.',
            'civilite.required'          => 'La civilité est obligatoire.',
            'nom.required'               => 'Le nom est obligatoire.',
            'prenom.required'            => 'Le prénom est obligatoire.',
            'nationalite.required'       => 'La nationalité est obligatoire.',
            'pays_residence.required'    => 'Le pays de résidence est obligatoire.',
            'whatsapp.required'          => 'Le numéro WhatsApp est obligatoire.',
            'email.required'             => 'L\'adresse e-mail est obligatoire.',
            'email.email'                => 'L\'adresse e-mail n\'est pas valide.',
            'certif_exactitude.accepted' => 'Vous devez certifier l\'exactitude des informations.',
            'accepte_donnees.accepted'   => 'Vous devez accepter l\'utilisation de vos données.',
        ]);
 
        // Upload CV si présent
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }
 
        // Créer le numéro de badge unique
        $numeroBadge = 'JEFIE-2026-' . strtoupper(Str::random(8));
 
        // Enregistrement
        $inscription = Inscription::create([
            'type_inscription'  => 'participant',
            'profil'            => $request->profil_visiteur,
            'sous_profil'       => $request->sous_profil,
            'civilite'          => $request->civilite,
            'nom'               => strtoupper($request->nom),
            'prenom'            => ucfirst(strtolower($request->prenom)),
            'nationalite'       => $request->nationalite,
            'pays_residence'    => $request->pays_residence,
            'whatsapp'          => $request->whatsapp,
            'email'             => strtolower($request->email),
            'thematiques'       => $request->thematiques ?? [],
            'participe_b2b'     => $request->participe_b2b === 'oui',
            // Écoute d'opportunité
            'nationalite_type'  => $request->nationalite_type,
            'niveau_etudes'     => $request->niveau_etudes,
            'diplome'           => $request->diplome,
            'domaine_formation' => $request->domaine_formation,
            'situation_pro'     => $request->situation_pro,
            'experience'        => $request->experience,
            'postes_recherches' => $request->postes_recherches ?? [],
            'cv_path'           => $cvPath,
            // Entrepreneur
            'forme_juridique'   => $request->forme_juridique_part,
            'domaine_activite'  => $request->domaine_activite_part,
            'secteur_eco'       => $request->secteur_eco,
            'pays_siege'        => $request->pays_siege_part,
            // Meta
            'numero_badge'      => $numeroBadge,
            'statut'            => 'confirme',
            'qr_token'          => Str::random(40),
        ]);
 
        // Envoi email de confirmation avec badge (Job en queue)
        // dispatch(new \App\Jobs\EnvoyerBadgeInscription($inscription));
 
        return redirect()
            ->route('inscription')
            ->with('success', "Merci {$inscription->prenom} ! Votre inscription #{$numeroBadge} est confirmée. Votre badge avec QR Code vous a été envoyé par e-mail.");
    }
 
    // ── ENTREPRISE ────────────────────────────────────────────
    private function storeEntreprise(Request $request): RedirectResponse
    {
        $request->validate([
            'admin_civilite'     => 'required|in:M,Mme',
            'admin_nom'          => 'required|string|max:100',
            'admin_prenom'       => 'required|string|max:100',
            'admin_fonction'     => 'required|string|max:150',
            'admin_profil'       => 'required|string|max:150',
            'admin_email'        => 'required|email|max:200',
            'admin_telephone'    => 'required|string|max:30',
            'entreprise_nom'     => 'required|string|max:200',
            'forme_juridique'    => 'required|string|max:100',
            'pays_siege'         => 'required|string|max:100',
            'activite_principale'=> 'required|string|max:200',
            'taille_entreprise'  => 'required|string|max:50',
            'logo'               => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'cert_habilite'      => 'required|accepted',
            'cert_exactitude'    => 'required|accepted',
            'accepte_traitement' => 'required|accepted',
            'engage_usage'       => 'required|accepted',
            // Offres
            'offres.*.titre'       => 'nullable|required_with:offres.*.famille|string|max:200',
            'offres.*.famille'     => 'nullable|string|max:150',
            'offres.*.contrat'     => 'nullable|string|max:50',
            'offres.*.lieu'        => 'nullable|string|max:100',
            'offres.*.description' => 'nullable|string',
            'offres.*.competences' => 'nullable|string',
        ], [
            'admin_nom.required'          => 'Le nom de l\'administrateur est obligatoire.',
            'admin_prenom.required'       => 'Le prénom est obligatoire.',
            'admin_email.required'        => 'L\'e-mail professionnel est obligatoire.',
            'admin_telephone.required'    => 'Le téléphone est obligatoire.',
            'entreprise_nom.required'     => 'La raison sociale est obligatoire.',
            'forme_juridique.required'    => 'La forme juridique est obligatoire.',
            'activite_principale.required'=> 'L\'activité principale est obligatoire.',
            'taille_entreprise.required'  => 'La taille de l\'entreprise est obligatoire.',
            'cert_habilite.accepted'      => 'Vous devez certifier être habilité(e) à administrer ce compte.',
            'cert_exactitude.accepted'    => 'Vous devez certifier l\'exactitude des informations.',
            'accepte_traitement.accepted' => 'Vous devez accepter le traitement des données.',
            'engage_usage.accepted'       => 'Vous devez vous engager sur l\'usage des données.',
        ]);
 
        // Upload logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos-entreprises', 'public');
        }
 
        $numeroBadge = 'JEFIE-ENT-2026-' . strtoupper(Str::random(6));
 
        // Créer l'inscription entreprise
        $inscription = Inscription::create([
            'type_inscription'    => 'entreprise',
            'profil'              => 'acteur_economique',
            'civilite'            => $request->admin_civilite,
            'nom'                 => strtoupper($request->admin_nom),
            'prenom'              => ucfirst(strtolower($request->admin_prenom)),
            'email'               => strtolower($request->admin_email),
            'whatsapp'            => $request->admin_telephone,
            'fonction'            => $request->admin_fonction,
            'admin_profil'        => $request->admin_profil,
            // Entreprise
            'entreprise_nom'      => $request->entreprise_nom,
            'forme_juridique'     => $request->forme_juridique,
            'pays_siege'          => $request->pays_siege,
            'activite_principale' => $request->activite_principale,
            'taille_entreprise'   => $request->taille_entreprise,
            'site_internet'       => $request->site_internet,
            'logo_path'           => $logoPath,
            // Participation
            'objectifs'           => $request->objectifs ?? [],
            'profils_recherches'  => $request->profils_recherches ?? [],
            'participe_b2b'       => $request->entreprise_b2b === 'oui',
            'publie_offres'       => $request->publie_offres === 'oui',
            // Meta
            'numero_badge'        => $numeroBadge,
            'statut'              => 'confirme',
            'qr_token'            => Str::random(40),
        ]);
 
        // Enregistrer les collaborateurs
        if ($request->ajoute_collabs === 'oui' && $request->has('collabs')) {
            foreach ($request->collabs as $collab) {
                if (empty($collab['nom'])) continue;
                CollaborateurForum::create([
                    'inscription_id' => $inscription->id,
                    'nom'            => strtoupper($collab['nom']),
                    'prenom'         => ucfirst(strtolower($collab['prenom'] ?? '')),
                    'fonction'       => $collab['fonction'] ?? null,
                    'email'          => strtolower($collab['email'] ?? ''),
                    'telephone'      => $collab['telephone'] ?? null,
                    'numero_badge'   => 'JEFIE-2026-' . strtoupper(Str::random(8)),
                    'statut'         => 'confirme',
                ]);
            }
        }
 
        // Enregistrer les offres d'emploi
        if ($request->publie_offres === 'oui' && $request->has('offres')) {
            foreach ($request->offres as $i => $offre) {
                if (empty($offre['titre'])) continue;
 
                // Upload fiche de poste
                $fichePath = null;
                $ficheKey  = "offres.{$i}.fiche";
                if ($request->hasFile($ficheKey)) {
                    $fichePath = $request->file($ficheKey)->store('fiches-poste', 'public');
                }
 
                OffreEmploi::create([
                    'inscription_id'  => $inscription->id,
                    'partenaire_id'   => null,
                    'titre'           => $offre['titre'],
                    'famille_metier'  => $offre['famille'] ?? null,
                    'nb_postes'       => $offre['nb_postes'] ?? 1,
                    'type_contrat'    => $offre['contrat'] ?? null,
                    'localisation'    => $offre['lieu'] ?? null,
                    'niveau_etudes'   => $offre['niveau'] ?? null,
                    'experience'      => $offre['experience'] ?? null,
                    'description'     => $offre['description'] ?? null,
                    'competences'     => $offre['competences'] ?? null,
                    'date_limite'     => !empty($offre['date_limite']) ? $offre['date_limite'] : null,
                    'fiche_path'      => $fichePath,
                    'entreprise'      => $request->entreprise_nom,
                    'statut'          => 'active',
                    'slug'            => Str::slug($offre['titre']) . '-' . Str::random(5),
                ]);
            }
        }
 
        // dispatch(new \App\Jobs\EnvoyerConfirmationEntreprise($inscription));
 
        return redirect()
            ->route('inscription')
            ->with('success', "Compte entreprise créé ! Référence : #{$numeroBadge}. Les codes d'accès ont été envoyés à {$request->admin_email}.");
    }
}
 




































