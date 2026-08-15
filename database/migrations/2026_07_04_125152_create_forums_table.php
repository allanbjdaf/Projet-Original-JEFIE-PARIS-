<?php
// database/migrations/2026_01_01_000013_create_forum_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Catégories ─────────────────────────────────────────────
        Schema::create('forum_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icone')->nullable();          // chemin SVG ou nom icône
            $table->string('couleur')->default('#0d1b3e'); // hex couleur
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->unsignedInteger('sujets_count')->default(0);
            $table->unsignedInteger('reponses_count')->default(0);
            $table->timestamps();
        });

        // ── Sujets ─────────────────────────────────────────────────
        Schema::create('forum_sujets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->longText('contenu');
            $table->foreignId('forum_categorie_id')->constrained('forum_categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tags')->nullable();            // CSV : "innovation,gabon"
            $table->unsignedInteger('vues')->default(0);
            $table->unsignedInteger('nb_reponses')->default(0);
            $table->boolean('epingle')->default(false);
            $table->boolean('verrouille')->default(false);
            $table->boolean('resolu')->default(false);
            $table->timestamps();

            $table->index(['forum_categorie_id', 'epingle', 'updated_at']);
            $table->index('user_id');
            $table->index('slug');
        });

        // ── Réponses ───────────────────────────────────────────────
        Schema::create('forum_reponses', function (Blueprint $table) {
            $table->id();
            $table->longText('contenu');
            $table->foreignId('forum_sujet_id')->constrained('forum_sujets')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('est_solution')->default(false);
            $table->unsignedInteger('likes')->default(0);
            $table->timestamps();

            $table->index(['forum_sujet_id', 'created_at']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_reponses');
        Schema::dropIfExists('forum_sujets');
        Schema::dropIfExists('forum_categories');
    }
};
