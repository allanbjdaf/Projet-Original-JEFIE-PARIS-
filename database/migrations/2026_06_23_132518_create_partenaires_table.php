<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('partenaires')) {
            Schema::create('partenaires', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('slug')->unique();
                $table->string('qr_token', 60)->unique()->nullable();
                $table->string('logo')->nullable();
                $table->text('description')->nullable();
                $table->string('description_courte', 200)->nullable();
                $table->string('secteur')->nullable();
                $table->string('site_web')->nullable();
                $table->string('email_contact')->nullable();
                $table->string('telephone')->nullable();
                $table->string('ville')->nullable();
                $table->string('pays')->nullable();
                $table->string('adresse')->nullable();
                $table->string('type')->default('partenaire');
                $table->string('statut')->default('en_attente');
                $table->boolean('visible_offres_public')->default(false);
                $table->string('stand')->nullable();
                $table->string('nombre_employes')->nullable();
                $table->string('chiffre_affaires')->nullable();
                $table->json('reseaux_sociaux')->nullable();
                $table->timestamps();

                $table->index('slug');
                $table->index('statut');
                $table->index('type');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
