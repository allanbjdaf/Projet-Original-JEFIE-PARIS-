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
        Schema::create('profil_candidats', function (Blueprint $table) {
            $table->id();

            // Clé étrangère liée à la table des utilisateurs (supprime le profil si le compte est supprimé)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Champs de base requis créés automatiquement à l'indexation
            $table->string('nom_complet');
            $table->string('email');

            // Champs optionnels modifiables via votre formulaire (nullable)
            $table->string('telephone', 30)->nullable();
            $table->string('localisation')->nullable();
            $table->string('titre_pro')->nullable();
            $table->text('bio')->nullable(); // Utilisation de text pour accueillir jusqu'à 1000 caractères
            $table->string('secteur', 100)->nullable();
            $table->string('linkedin')->nullable();
            $table->string('disponibilite', 100)->nullable();
            $table->string('photo')->nullable(); // Stockera le chemin de l'image (ex: profils/abc.jpg)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_candidats');
    }
};
