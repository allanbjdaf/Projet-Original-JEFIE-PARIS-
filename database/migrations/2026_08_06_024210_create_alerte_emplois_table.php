<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alerte_emplois', function (Blueprint $blueprint) {
            $blueprint->id();

            // Liaison avec la table des utilisateurs (supprime les alertes si l'utilisateur supprime son compte)
            $blueprint->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Champs obligatoires basés sur votre validation
            $blueprint->string('email');
            $blueprint->string('mots_cles');
            $blueprint->string('frequence'); // Ex: instantanee, quotidienne, hebdomadaire

            // Champs facultatifs (nullable)
            $blueprint->string('secteur', 100)->nullable();
            $blueprint->string('lieu', 100)->nullable();
            $blueprint->string('type_contrat', 50)->nullable();

            // Statut de l'alerte (active par défaut)
            $blueprint->boolean('active')->default(true);

            $blueprint->timestamps(); // Crée 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerte_emplois');
    }
};
