<?php
// ══════════════════════════════════════════════════════════════
// database/migrations/2026_01_01_000001_create_inscriptions_table.php
// ══════════════════════════════════════════════════════════════

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── TABLE INSCRIPTIONS ────────────────────────────────
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();

            // Type
            $table->string('type_inscription', 30)->default('participant');
            $table->string('profil', 50)->nullable();
            $table->string('sous_profil', 50)->nullable();

            // Identité commune
            $table->string('civilite', 10)->nullable();
            $table->string('nom', 100);
            $table->string('prenom', 100)->nullable();
            $table->string('email', 200);
            $table->string('whatsapp', 30)->nullable();
            $table->string('nationalite', 100)->nullable();
            $table->string('pays_residence', 100)->nullable();
            $table->string('fonction', 150)->nullable();
            $table->string('admin_profil', 150)->nullable();

            // Thématiques & préférences participant
            $table->json('thematiques')->nullable();
            $table->boolean('participe_b2b')->default(false);

            // Écoute d'opportunité
            $table->string('nationalite_type', 50)->nullable();
            $table->string('niveau_etudes', 50)->nullable();
            $table->string('diplome', 80)->nullable();
            $table->string('domaine_formation', 200)->nullable();
            $table->string('situation_pro', 100)->nullable();
            $table->string('experience', 50)->nullable();
            $table->json('postes_recherches')->nullable();
            $table->string('cv_path', 500)->nullable();

            // Entrepreneur individuel
            $table->string('forme_juridique', 100)->nullable();
            $table->string('domaine_activite', 200)->nullable();
            $table->string('secteur_eco', 50)->nullable();
            $table->string('pays_siege', 100)->nullable();

            // Informations entreprise
            $table->string('entreprise_nom', 200)->nullable();
            $table->string('activite_principale', 200)->nullable();
            $table->string('taille_entreprise', 50)->nullable();
            $table->string('site_internet', 300)->nullable();
            $table->string('logo_path', 500)->nullable();
            $table->json('objectifs')->nullable();
            $table->json('profils_recherches')->nullable();
            $table->boolean('publie_offres')->default(false);

            // Badge & sécurité
            $table->string('numero_badge', 30)->unique();
            $table->string('qr_token', 60)->unique()->nullable();
            $table->string('statut', 20)->default('confirme');
            $table->timestamp('badge_envoye_le')->nullable();

            $table->timestamps();

            // Index
            $table->index('email');
            $table->index('type_inscription');
            $table->index('profil');
            $table->index('statut');
            $table->index('numero_badge');
        });

        // ── TABLE COLLABORATEURS FORUM ────────────────────────
        Schema::create('collaborateurs_forum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')
                ->constrained('inscriptions')
                ->onDelete('cascade');
            $table->string('nom', 100);
            $table->string('prenom', 100)->nullable();
            $table->string('fonction', 150)->nullable();
            $table->string('email', 200);
            $table->string('telephone', 30)->nullable();
            $table->string('numero_badge', 30)->unique();
            $table->string('statut', 20)->default('confirme');
            $table->timestamp('badge_envoye_le')->nullable();
            $table->timestamps();

            $table->index('inscription_id');
            $table->index('email');
        });

        // ── COLONNES offres_emploi (si table existe déjà) ─────
        if (Schema::hasTable('offres_emploi')) {
            Schema::table('offres_emploi', function (Blueprint $table) {
                if (!Schema::hasColumn('offres_emploi', 'inscription_id')) {
                    $table->foreignId('inscription_id')
                        ->nullable()->after('id')
                        ->constrained('inscriptions')
                        ->onDelete('set null');
                }
                if (!Schema::hasColumn('offres_emploi', 'famille_metier')) {
                    $table->string('famille_metier', 150)->nullable();
                }
                if (!Schema::hasColumn('offres_emploi', 'nb_postes')) {
                    $table->integer('nb_postes')->default(1);
                }
                if (!Schema::hasColumn('offres_emploi', 'competences')) {
                    $table->text('competences')->nullable();
                }
                if (!Schema::hasColumn('offres_emploi', 'fiche_path')) {
                    $table->string('fiche_path', 500)->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborateurs_forum');
        Schema::dropIfExists('inscriptions');
    }
};
