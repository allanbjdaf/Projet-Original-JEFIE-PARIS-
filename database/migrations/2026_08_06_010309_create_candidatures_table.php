<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {

            $table->id();

            // Utilisateur connecté
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Offre concernée
            $table->foreignId('offre_id')
                ->nullable()
                ->constrained('offres_emploi')
                ->nullOnDelete();

            $table->string('nom_complet');
            $table->string('email');
            $table->string('telephone')->nullable();

            $table->string('poste_cible');

            $table->text('message')
                ->nullable();

            $table->string('cv_path')
                ->nullable();

            $table->enum('statut', [
                'en_attente',
                'en_cours',
                'accepte',
                'refuse'
            ])->default('en_attente');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
