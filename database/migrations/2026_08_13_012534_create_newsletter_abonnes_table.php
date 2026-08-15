<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletter_abonnes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // L'email doit être unique pour éviter les doublons
            $table->boolean('actif')->default(true); // Gère l'état de l'abonnement (utilisé par votre filtre $request->actif)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_abonnes');
    }
};
