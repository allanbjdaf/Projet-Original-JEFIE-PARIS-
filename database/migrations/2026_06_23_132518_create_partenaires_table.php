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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();

            // OPTIMISATION : Utilisation d'un type ENUM pour restreindre et sécuriser les niveaux valides
            $table->enum('niveau', ['platinum', 'gold', 'silver', 'bronze'])->default('bronze');

            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('site_web')->nullable();
            $table->string('secteur')->nullable();
            $table->boolean('a_la_une')->default(false);
            $table->timestamps();

            // Index préservé pour accélérer les tris et filtrages par niveau de partenariat
            $table->index('niveau');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
