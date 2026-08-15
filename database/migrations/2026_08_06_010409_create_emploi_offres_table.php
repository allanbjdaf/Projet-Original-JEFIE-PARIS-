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
        Schema::create('emplois_offres', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la table des utilisateurs pour le recruteur
            $table->foreignId('recruteur_id')->constrained('users')->cascadeOnDelete();

            // Informations de l'offre basées sur votre modèle
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('entreprise');
            $table->string('logo_entreprise')->nullable();
            $table->string('lieu');
            $table->string('pays')->nullable(); // Optionnel ou obligatoire selon vos formulaires
            $table->string('secteur');
            $table->string('type_contrat'); // CDI, CDD, Stage...
            $table->text('description');
            $table->text('competences')->nullable();
            $table->string('salaire')->nullable();

            // Paramètres de l'offre
            $table->boolean('en_vedette')->default(false);
            $table->string('statut')->default('active'); // active, inactive, pourvue
            $table->date('date_expiration')->nullable();
            $table->integer('vues')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplois_offres');
    }
};
