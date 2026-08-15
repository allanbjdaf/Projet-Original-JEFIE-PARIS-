<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            // type: communique | interview | video | podcast | photos | livestream | presse
            $table->string('type');
            $table->text('extrait')->nullable();
            $table->longText('contenu')->nullable();
            $table->string('thumbnail')->nullable();   // chemin images
            $table->string('duree')->nullable();       // ex: "12:45"
            $table->unsignedBigInteger('vues')->default(0);
            $table->string('thematique')->nullable();
            $table->boolean('a_la_une')->default(false);
            $table->boolean('is_live')->default(false);
            $table->unsignedInteger('photos_count')->default(1);
            $table->string('cta_label')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->index(['type', 'date']);
            $table->index('a_la_une');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_contenus');
    }
};
