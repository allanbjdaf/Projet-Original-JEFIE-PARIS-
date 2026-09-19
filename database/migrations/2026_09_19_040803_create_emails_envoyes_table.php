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
      Schema::create('emails_envoyes', function (Blueprint $table) {
    $table->id();
    $table->string('destinataire_email'); // L'adresse du participant
    $table->string('sujet');               // "Confirmation d'inscription"
    $table->text('contenu');               // Le texte envoyé ou le lien du badge
    $table->string('statut')->default('envoye');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails_envoyes');
    }
};
