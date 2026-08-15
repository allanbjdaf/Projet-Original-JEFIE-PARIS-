<?php
// database/migrations/2026_01_01_000012_create_demandes_partenariat_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes_partenariat', function (Blueprint $table) {
            $table->id();
            $table->string('nom_contact');
            $table->string('poste')->nullable();
            $table->string('organisation');
            // type_organisation : Entreprise privée | Institution publique | ONG | Start-up | ...
            $table->string('type_organisation');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('pays');
            $table->string('secteur');
            // niveau_partenariat : bronze | argent | or | platine | sur_mesure
            $table->string('niveau_partenariat')->default('bronze');
            $table->string('budget_prevu')->nullable();
            $table->text('objectifs');
            // statut : en_attente | en_cours | accepte | refuse
            $table->string('statut')->default('en_attente');
            $table->text('notes_internes')->nullable();
            $table->timestamp('date_reponse')->nullable();
            $table->timestamps();

            $table->index(['statut', 'niveau_partenariat']);
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_partenariat');
    }
};
