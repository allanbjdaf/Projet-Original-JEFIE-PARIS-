<?php
// database/migrations/2026_01_01_000006_create_opportunites_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            // type : partenariat | investissement | cooperation | collaboration
            $table->string('type');
            $table->string('type_label')->nullable();
            $table->string('type_css')->nullable();
            $table->string('icon_path')->nullable();
            $table->string('entreprise');
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->index(['type', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunites');
    }
};
