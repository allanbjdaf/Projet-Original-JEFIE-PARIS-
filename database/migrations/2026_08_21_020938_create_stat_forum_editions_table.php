<?php


// ══════════════════════════════════════════════════════════════
// FICHIER 3 — Migration stat_forum_editions
// database/migrations/xxxx_create_stat_forum_editions_table.php
// ══════════════════════════════════════════════════════════════
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stat_forum_editions', function (Blueprint $table) {
            $table->id();
            $table->string('annee', 4);
            $table->string('lieu');
            $table->string('pays', 100)->nullable();
            $table->unsignedInteger('inscrits')->default(0);
            $table->unsignedInteger('entreprises')->default(0);
            $table->unsignedInteger('pays_representes')->default(0);
            $table->unsignedInteger('partenariats')->default(0);
            $table->decimal('investissements_fcfa', 20, 2)->default(0);
            $table->unsignedInteger('emplois_crees')->default(0);
            $table->unsignedInteger('offres_publiees')->default(0);
            $table->unsignedInteger('rdv_b2b')->default(0);
            $table->boolean('edition_active')->default(false);
            $table->timestamps();

            $table->index('annee');
            $table->index('edition_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stat_forum_editions');
    }
};
