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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('secteur')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->text('description')->nullable();
            $table->string('site_web')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('stand')->nullable(); // <-- AJOUT DE LA COLONNE STAND
            $table->string('type')->default('partenaire'); // <-- Pour différencier (organisateur, sponsor, etc.)
            $table->string('niveau_sponsor')->nullable(); // <-- Pour stocker "Partenaire Or", "Argent", etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
