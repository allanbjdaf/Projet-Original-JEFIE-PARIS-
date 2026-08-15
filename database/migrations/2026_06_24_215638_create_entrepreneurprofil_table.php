<?php
// database/migrations/2026_01_01_000005_create_entrepreneur_profils_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrepreneur_profils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom_complet');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->string('poste')->nullable();
            $table->string('entreprise')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays_residence')->nullable();
            $table->string('secteur_activite')->nullable();
            $table->string('secteur_css')->nullable();       // tech | agri | conseil | commerce
            $table->string('taille_entreprise')->nullable();
            $table->string('taille_employes')->nullable();
            $table->string('chiffre_affaires')->nullable();
            $table->string('capacite_investissement')->nullable();
            $table->text('domaines_expertise')->nullable();
            $table->text('projets_economiques')->nullable();
            $table->boolean('a_la_une')->default(false);
            $table->boolean('profil_verifie')->default(false);
            $table->unsignedTinyInteger('completion')->default(0); // 0-100
            $table->timestamps();

            $table->index('user_id');
            $table->index('a_la_une');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrepreneur_profils');
    }
};
