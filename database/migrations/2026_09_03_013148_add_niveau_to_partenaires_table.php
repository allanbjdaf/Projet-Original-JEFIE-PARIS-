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
        Schema::table('partenaires', function (Blueprint $table) {
            $table->string('niveau')->default('bronze'); // Adaptez la valeur par défaut si besoin
        });
    }

    public function down(): void
    {
        Schema::table('partenaires', function (Blueprint $table) {
            $table->dropColumn('niveau');
        });
    }
};
