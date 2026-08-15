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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Clé étrangère pour lier le document à l'utilisateur connecté
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Champs requis par votre DocumentCandidatController
            $table->string('type');         // Enregistre 'cv', 'lettre_motivation' ou 'diplome'
            $table->string('nom_fichier');  // Nom d'origine (ex: mon_cv.pdf)
            $table->string('chemin');       // Emplacement de stockage (ex: documents/1/abc.pdf)
            $table->unsignedBigInteger('taille'); // Taille en octets

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
