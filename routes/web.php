<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\CartographieController;
use App\Http\Controllers\AProposController;
use App\Http\Controllers\InstitutionnelController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\PartenairesController;
use App\Http\Controllers\DevenirPartenaireController;
use App\Http\Controllers\RecruteurController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AlerteEmploiController;
use App\Http\Controllers\DocumentCandidatController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\RendezVousB2BController;
use App\Http\Controllers\ProfilCandidatController;
use App\Http\Controllers\EntrepreneurDashboardController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfilEntrepreneurController;


// ✅ OBLIGATOIRE — Routes Breeze auth (login, register, logout, etc.)
require __DIR__ . '/auth.php';


Route::get('/lang/{locale}', function ($locale) {

    $locales = ['fr', 'en', 'pt', 'it', 'de', 'zh'];

    if (!in_array($locale, $locales)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('lang.switch');

// --- 1. INSCRIPTION CLASSIQUE ---
Route::get('/inscription', [InscriptionController::class, 'index'])->name('inscription');
// Cette route utilise 'inscription.store'
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');

// --- 2. CANDIDATURE / PARTICIPATION ---
Route::get('/inscription-participation', [InscriptionController::class, 'showFormulaire'])->name('inscription.formulaire');
// Changez ici pour 'inscription.store_candidature' pour éviter le doublon !
Route::post('/inscription-participation', [InscriptionController::class, 'storeCandidature'])->name('inscription.store_candidature');

// ══════════════════════════════════════════════════════════════
// ✅ REMPLACER la route /dashboard de Breeze par votre accueil
// ══════════════════════════════════════════════════════════════
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── Pages publiques ───────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [AProposController::class, 'index'])->name('Apropos');
Route::get('/programme', [ProgrammeController::class, 'index'])->name('programme');
Route::get('/institutionnel', [InstitutionnelController::class, 'index'])->name('institutionnel');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/faq', [FaqController::class, 'index'])->name('Faq');
Route::get('/cartographie', [CartographieController::class, 'index'])->name('cartographie');

// Programme
Route::get('/programme', [ProgrammeController::class, 'index'])->name('programme');
Route::get('/programme/activite/{type}', [ProgrammeController::class, 'activite'])
    ->name('programme.activite')
    ->where('type', 'conference|panel|atelier|networking|b2b|pitch');

// ── Galerie ───────────────────────────────────────────────────
Route::get('/galerie', [GalerieController::class, 'index'])->name('galerie');
Route::get('/galerie/{slug}', [GalerieController::class, 'show'])->name('galerie.show');

// ── Actualités ────────────────────────────────────────────────
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites');
Route::get('/actualites/{slug}', [ActualiteController::class, 'show'])->name('actualites.show');

// ── Notifications ─────────────────────────────────────────
Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications');

// ── Partenaires ───────────────────────────────────────────────
Route::get('/partenaires', [PartenairesController::class, 'index'])->name('partenaires.index');
Route::get('/partenaires', [PartenairesController::class, 'index'])->name('partenaires');
Route::get('/partenaires/devenir', [DevenirPartenaireController::class, 'index'])->name('partenaires.devenir');
Route::post('/partenaires/devenir', [DevenirPartenaireController::class, 'store'])->name('partenaires.devenir.store');
// Routes pour l'espace ou la présentation des partenaires
Route::get('/partenaires/profil', [PartenairesController::class, 'profil'])->name('partenaires.profil');
Route::get('/partenaires/activites', [PartenairesController::class, 'activites'])->name('partenaires.activites');
Route::get('/partenaires/media', [PartenairesController::class, 'media'])->name('partenaires.media');
Route::get('/partenaires/opportunites/creer', [PartenairesController::class, 'createOpportunite'])->name('partenaires.opportunites.create');
Route::get('/partenaires/opportunites', [PartenairesController::class, 'indexOpportunites'])->name('partenaires.opportunites.index');
Route::get('/partenaires/stands/reserver', [PartenairesController::class, 'reserverStand'])->name('partenaires.stands.reserver');
Route::get('/partenaires/reservations', [PartenairesController::class, 'reservations'])->name('partenaires.reservations');
Route::get('/partenaires/badges', [PartenairesController::class, 'badges'])->name('partenaires.badges');
Route::get('/partenaires/actualites', [PartenairesController::class, 'actualites'])->name('partenaires.actualites');
Route::get('/partenaires/offres', [PartenairesController::class, 'offres'])->name('partenaires.offres');
Route::get('/partenaires/documents', [PartenairesController::class, 'documents'])->name('partenaires.docs');
Route::get('/partenaires/statistiques', [PartenairesController::class, 'statistiques'])->name('partenaires.stats');
Route::get('/partenaires/visibilite', [PartenairesController::class, 'visibilite'])->name('partenaires.visibilite');
Route::get('/partenaires/plan-salon', [PartenairesController::class, 'planSalon'])->name('partenaires.plan');
Route::get('/partenaires/liste', [PartenairesController::class, 'liste'])->name('partenaires.liste');
Route::get('/partenaires/packs/{slug}', [PartenairesController::class, 'showPack'])->name('partenaires.pack');
Route::get('/partenaires/mes-avantages', [PartenairesController::class, 'avantages'])->name('partenaires.avantages');

// =========================================================================
// 💼 1. ESPACE EMPLOI (Accès libre temporaire pour développement)
// =========================================================================

// Page d'index publique : accessible à tout le monde
Route::get('/emploi', [EmploiController::class, 'index'])->name('emploi');

// 🚀 NETTOYAGE : Les middlewares 'auth' et 'role' ont été retirés pour ouvrir l'accès direct aux pages
Route::group([], function () {
    Route::get('/emploi/mes-rendez-vous', [EmploiController::class, 'mesRendezVous'])->name('emploi.rendezvous');
    Route::get('/emploi/mes-candidatures', [EmploiController::class, 'mesCandidatures'])->name('emploi.candidatures');
    Route::get('/emploi/mes-documents', [EmploiController::class, 'mesDocuments'])->name('emploi.documents');
    Route::get('/emploi/mes-alertes', [EmploiController::class, 'mesAlertes'])->name('emploi.alertes');
    Route::get('/emploi/mon-profil', [EmploiController::class, 'monProfil'])->name('emploi.profil');
});

// ⚠️ La route dynamique reste TOUJOURS en dernier, complètement en dehors du groupe
Route::get('/emploi/{slug}', [EmploiController::class, 'show'])->name('emploi.show');

// ── Inscription billetterie ───────────────────────────────────
Route::get('/inscription', [InscriptionController::class, 'index'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');
Route::get('/inscription/paiement', [InscriptionController::class, 'paiement'])->name('inscription.paiement');
Route::get('/inscription/confirmation', [InscriptionController::class, 'confirmation'])->name('inscription.confirmation');

// ── Newsletter ────────────────────────────────────────────────
Route::post('/newsletter/subscribe', function (Request $r) {
    $r->validate(['email_newsletter' => ['required', 'email']]);
    return back()->with('success', '✅ Vous êtes abonné à notre newsletter !');
})->name('newsletter.subscribe');


use App\Http\Controllers\RapportController;

// ── Pages légales & Espace Téléchargements ────────────────────
Route::get('/mentions-legales', fn() => view('mentions-legales'))->name('mentions-legales');
Route::get('/confidentialite', fn() => view('confidentialite'))->name('confidentialite');
Route::get('/conditions', fn() => view('conditions'))->name('conditions');
Route::get('/dossiers', fn() => view('dossiers.index'))->name('dossiers');
Route::get('/branding', fn() => view('branding.index'))->name('branding');

// Groupe dédié aux rapports (Remplace l'ancienne route /rapports)
Route::controller(RapportController::class)->group(function () {
    Route::get('/rapports', 'index')->name('rapports'); // Garde exactement le même nom de route
    Route::get('/telecharger/rapport/{id}', 'downloadSingle')->name('rapports.download.single');
    Route::get('/telecharger/rapports-groupes', 'downloadZip')->name('rapports.download.zip');
    Route::get('/telecharger/programme', 'downloadProgram')->name('rapports.download.program');
});


// ── Forum ─────────────────────────────────────────────────────
Route::prefix('forum')->name('forum.')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/{categorieSlug}', [ForumController::class, 'categorie'])->name('categorie');
    Route::get('/{categorieSlug}/{sujetSlug}', [ForumController::class, 'sujet'])->name('sujet');
    Route::middleware('auth')->group(function () {
        Route::get('/nouveau-sujet', [ForumController::class, 'creerSujet'])->name('creer');
        Route::post('/nouveau-sujet', [ForumController::class, 'storeSujet'])->name('store');
        Route::post('/sujets/{sujet}/repondre', [ForumController::class, 'storeReponse'])->name('repondre');
        Route::post('/sujets/{sujet}/resolu', [ForumController::class, 'marquerResolu'])->name('resolu');
    });
});

// ── Stripe webhook (sans CSRF) ────────────────────────────────
Route::post('/stripe/webhook', [PaiementController::class, 'webhook'])
    ->name('stripe.webhook')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// ══════════════════════════════════════════════════════════════
// ROUTES AUTHENTIFIÉES
// ══════════════════════════════════════════════════════════════
Route::middleware('auth')->group(function () {

    // ── Profil Breeze (GARDER ces routes Breeze) ──────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Paiement Stripe ───────────────────────────────────────
    Route::post('/paiement/intent', [PaiementController::class, 'creerIntent'])->name('paiement.intent');
    Route::get('/inscription/confirmation', [PaiementController::class, 'confirmation'])->name('inscription.confirmation');

    // ── Espace Emploi Candidat ────────────────────────────────
    // =========================================================================
    Route::middleware(['auth', 'role:candidat,benevole'])->group(function () {
        Route::prefix('emploi')->name('emploi.')->group(function () {
            // Liste des pages fixes du menu (Noms harmonisés avec vos fichiers Blade)
            Route::get('/mes-candidatures', [CandidatureController::class, 'index'])->name('candidatures');
            Route::get('/mes-alertes', [AlerteEmploiController::class, 'index'])->name('alertes');
            Route::get('/mes-documents', [DocumentCandidatController::class, 'index'])->name('documents');
            Route::get('/mes-rendez-vous', [RendezVousB2BController::class, 'index'])->name('rendezvous'); // 🚀 Harmonisé 'rendezvous'
            Route::get('/mon-profil', [ProfilCandidatController::class, 'index'])->name('profil');

            // Formulaires et traitements de données Actions
            Route::post('/candidature', [CandidatureController::class, 'storeCandidature'])->name('candidature.store');
            Route::get('/candidature/{id}', [CandidatureController::class, 'show'])->name('candidature.show');
            Route::delete('/candidature/{id}', [CandidatureController::class, 'destroy'])->name('candidature.destroy');

            Route::post('/alerte', [AlerteEmploiController::class, 'store'])->name('alerte.store');
            Route::post('/alerte-store', [AlerteEmploiController::class, 'store'])->name('alerte');
            Route::delete('/alerte/{id}', [AlerteEmploiController::class, 'destroy'])->name('alerte.destroy');
            Route::patch('/alerte/{id}/toggle', [AlerteEmploiController::class, 'toggle'])->name('alerte.toggle');

            Route::post('/document', [DocumentCandidatController::class, 'store'])->name('document.store');
            Route::delete('/document/{id}', [DocumentCandidatController::class, 'destroy'])->name('document.destroy');

            // 1. AJOUTER CETTE ROUTE (Affichage de la page des rendez-vous)
            Route::get('/rendez-vous-b2b', [RendezVousB2BController::class, 'index'])->name('rdvb2b');
            Route::post('/rendez-vous-b2b', [RendezVousB2BController::class, 'store'])->name('rdvb2b.store');
            Route::delete('/rendez-vous-b2b/{id}', [RendezVousB2BController::class, 'destroy'])->name('rdvb2b.destroy');
            Route::put('/mon-profil', [ProfilCandidatController::class, 'update'])->name('profil.update');
        });
    });


    // ── Espace Recruteur ──────────────────────────────────────
    Route::middleware(['auth', 'role:recruteur,partenaire,entrepreneur,institution'])->group(function () {
        Route::prefix('recruteur')->name('recruteur.')->group(function () {
            Route::get('/', [RecruteurController::class, 'dashboard'])->name('dashboard');
            Route::get('/mes-offres', [RecruteurController::class, 'mesOffres'])->name('offres');
            Route::get('/offres/nouvelle', [RecruteurController::class, 'creerOffre'])->name('offre.creer');
            Route::post('/offres', [RecruteurController::class, 'storeOffre'])->name('offre.store');
            Route::get('/offres/{id}/modifier', [RecruteurController::class, 'editOffre'])->name('offre.edit');
            Route::put('/offres/{id}', [RecruteurController::class, 'updateOffre'])->name('offre.update');
            Route::delete('/offres/{id}', [RecruteurController::class, 'destroyOffre'])->name('offre.destroy');
            Route::get('/candidatures', [RecruteurController::class, 'candidatures'])->name('candidatures');
            Route::get('/candidatures/{id}', [RecruteurController::class, 'voirCandidature'])->name('candidature.voir');
            Route::post('/candidatures/{id}/statut', [RecruteurController::class, 'changerStatut'])->name('candidature.statut');
            Route::get('/newsletter', [RecruteurController::class, 'newsletter'])->name('newsletter');
        });
    });

    // =========================================================================
    // 🚀 2. ESPACE ENTREPRENEURS (Accès libre temporaire pour développement)
    // =========================================================================

    // 1. PAGE PUBLIQUE
    Route::get('/entrepreneurs/liste-publique', [EntrepreneurController::class, 'entrepreneurs'])->name('entrepreneurs.index');

    // 2. ESPACE PRIVÉ OUVERT : Les filtres 'auth' et 'role' ont été retirés pour stopper la boucle
    Route::group([], function () {
        Route::prefix('entrepreneurs')->name('entrepreneurs.')->group(function () {

            Route::get('/dashboard', [ProfilEntrepreneurController::class, 'dashboard'])->name('dashboard');
            Route::get('/opportunites', [ProfilEntrepreneurController::class, 'opportunites'])->name('opportunites');
            Route::get('/profil', [ProfilEntrepreneurController::class, 'index'])->name('profil');
            Route::get('/annuaire', [ProfilEntrepreneurController::class, 'annuaire'])->name('annuaire');
            Route::get('/profil/edit', [ProfilEntrepreneurController::class, 'editProfil'])->name('profil.edit');
            Route::put('/profil', [ProfilEntrepreneurController::class, 'updateProfil'])->name('profil.update');
            Route::get('/favoris', [ProfilEntrepreneurController::class, 'favoris'])->name('favoris');
            Route::get('/messages', [ProfilEntrepreneurController::class, 'messages'])->name('messages');
            Route::get('/rendez-vous', [ProfilEntrepreneurController::class, 'rendezVous'])->name('rendez-vous');
            Route::get('/participation', [ProfilEntrepreneurController::class, 'participation'])->name('participation');
            Route::get('/guides', [ProfilEntrepreneurController::class, 'guides'])->name('guides');
            Route::get('/financements', [ProfilEntrepreneurController::class, 'financements'])->name('financements');
            Route::get('/actualites-diaspora', [ProfilEntrepreneurController::class, 'actualitesDiaspora'])->name('actualites-diaspora');
            Route::get('/evenements', [ProfilEntrepreneurController::class, 'evenements'])->name('evenements');
            Route::get('/inviter', [ProfilEntrepreneurController::class, 'inviter'])->name('inviter');

            // Route dynamique maintenue à sa place en bas
            Route::get('/{slug}', [ProfilEntrepreneurController::class, 'show'])->name('show')->where('slug', '[A-Za-z0-9\-]+');
        });
    });




    // 💬 4. ESPACE FORUM DE DISCUSSION (Accessible à tous les membres connectés)
    // =========================================================================
    Route::group([], function () {
        Route::prefix('forum')->name('forum.')->group(function () {
            // Accueil du forum (Liste des catégories et sujets)
            Route::get('/', [ForumController::class, 'index'])->name('index');

            // Afficher un sujet spécifique
            Route::get('/sujet/{id}-{slug}', [ForumController::class, 'showSujet'])->name('sujet.show');

            // Créer un nouveau sujet
            Route::get('/sujet/nouveau', [ForumController::class, 'createSujet'])->name('sujet.create');
            Route::post('/sujet', [ForumController::class, 'storeSujet'])->name('sujet.store');

            // Répondre à un sujet
            Route::post('/sujet/{id}/reponse', [ForumController::class, 'storeReponse'])->name('reponse.store');

            // Zone de Modération (Ouverte temporairement pour éviter les conflits d'accolades)
            Route::group([], function () {
                Route::delete('/sujet/{id}', [ForumController::class, 'destroySujet'])->name('sujet.destroy');
                Route::post('/sujet/{id}/epingler', [ForumController::class, 'epingleSujet'])->name('sujet.epingler');
            });
        });
    });
});
// ══════════════════════════════════════════════════════════════
// À AJOUTER dans routes/web.php
// Routes Admin — après require __DIR__.'/auth.php'
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\AdminController;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                          [AdminController::class, 'dashboard'])->name('dashboard');
    // Inscriptions
    Route::get('/inscriptions',              [AdminController::class, 'inscriptions'])->name('inscriptions');
    Route::get('/inscriptions/{id}',         [AdminController::class, 'voirInscription'])->name('inscription.voir');
    Route::post('/inscriptions/{id}/statut', [AdminController::class, 'changerStatutInscription'])->name('inscription.statut');
    // Candidatures
    Route::get('/candidatures',              [AdminController::class, 'candidatures'])->name('candidatures');
    Route::get('/candidatures/{id}',         [AdminController::class, 'voirCandidature'])->name('candidature.voir');
    Route::post('/candidatures/{id}/statut', [AdminController::class, 'changerStatutCandidature'])->name('candidature.statut');
    // Contacts
    Route::get('/contacts',                  [AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contacts/{id}',             [AdminController::class, 'voirContact'])->name('contact.voir');
    // Partenariats
    Route::get('/partenariats',              [AdminController::class, 'partenariats'])->name('partenariats');
    // Newsletter
    Route::get('/newsletter',                [AdminController::class, 'newsletter'])->name('newsletter');
    // RDV B2B
    Route::get('/rdvb2b',                    [AdminController::class, 'rdvb2b'])->name('rdvb2b');
    // Offres
    Route::get('/offres',                    [AdminController::class, 'offres'])->name('offres');
    Route::post('/offres/{id}/toggle',       [AdminController::class, 'toggleOffre'])->name('offre.toggle');
    // Utilisateurs
    Route::get('/utilisateurs',              [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::post('/utilisateurs/{id}/role',   [AdminController::class, 'changerRoleUser'])->name('user.role');
    // Export CSV
    Route::get('/export',                    [AdminController::class, 'exportPage'])->name('export');
    Route::get('/export/download',           [AdminController::class, 'export'])->name('export.download');
});

use App\Http\Controllers\Admin\NewsletterController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/newsletter', [NewsletterController::class, 'newsletter'])->name('admin.newsletter');
});


use App\Http\Controllers\GouvernanceController;
// Route publique pour afficher la page de gouvernance
Route::get('/gouvernance', [GouvernanceController::class, 'index'])->name('gouvernance');

/// Page Mon Agenda (accessible à tous — visiteurs et connectés)
Route::get('/programme/mon-agenda', function () {
    return view('programme.mon-agenda');
})->name('programme.mon-agenda');


// ══════════════════════════════════════════════════════════════
// FICHIER 1 — Route à ajouter dans routes/web.php
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\PourquoiController;

// Configuré avec un tiret pour correspondre exactement à votre navbar
Route::get('/pourquoi-participer', [PourquoiController::class, 'index'])
    ->name('pourquoi-participer');

// Alias de sécurité
Route::get('/participer', fn() => redirect()->route('pourquoi-participer'));


// FICHIER choix auth login/web.php
// ═══════════════════════════════════════════════════════════
// ══════════════════════════════════════════════════════════════
// ROUTES PUBLIQUES (Accessibles à tous)
// ══════════════════════════════════════════════════════════════
Route::get('/espace-client', function () {
    return view('auth.choice');
})->name('auth.choice');


// ══════════════════════════════════════════════════════════════
// ROUTES PRIVÉES (Nécessitent une connexion)
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\MonEspaceController;


Route::middleware('auth')->prefix('mon-espace')->name('mon-espace.')->group(function () {
    Route::get('/',              [MonEspaceController::class, 'dashboard'])->name('dashboard');
    Route::get('/profil',        [MonEspaceController::class, 'profil'])->name('profil');
    Route::put('/profil',        [MonEspaceController::class, 'updateProfil'])->name('profil.update');
    Route::get('/billet',        [MonEspaceController::class, 'billet'])->name('billet');
    Route::get('/candidatures',  [MonEspaceController::class, 'candidatures'])->name('candidatures');
    Route::get('/preferences',   [MonEspaceController::class, 'preferences'])->name('preferences');
    Route::put('/preferences',   [MonEspaceController::class, 'updatePreferences'])->name('preferences.update');
    Route::put('/password',      [MonEspaceController::class, 'updatePassword'])->name('password.update');
});
