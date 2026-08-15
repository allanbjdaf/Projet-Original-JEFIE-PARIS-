<?php
// database/migrations/2026_01_01_000008_create_participation_forums_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participation_forums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            // statut : Participant | Exposant | Investisseur | Speaker
            $table->string('statut')->default('Participant');
            $table->string('stand')->nullable();       // ex: Hall B - Stand B24
            $table->string('docs_soumis')->nullable(); // ex: 3/3 complétés
            $table->unsignedInteger('nb_rdv')->default(0);
            $table->boolean('confirmee')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participation_forums');
    }
};
