<?php
// database/migrations/2026_01_01_000004_create_page_contenus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contenus', function (Blueprint $table) {
            $table->id();
            $table->string('page');        // ex: home, apropos
            $table->string('cle');         // ex: vision, message_contenu
            $table->longText('valeur')->nullable();
            $table->timestamps();
            $table->unique(['page', 'cle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contenus');
    }
};
