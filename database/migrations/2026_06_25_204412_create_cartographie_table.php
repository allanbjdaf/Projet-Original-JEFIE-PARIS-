<?php
// database/migrations/2026_01_01_000009_add_geo_fields_to_entrepreneur_profils_table.php
// Ce fichier ajoute les champs de géolocalisation à la table existante
// entrepreneur_profils (créée dans la migration précédente)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entrepreneur_profils', function (Blueprint $table) {
            // Géolocalisation
            $table->decimal('latitude',  10, 7)->nullable()->after('pays_residence');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

            // Continent : europe | afrique | ameriques | asie | oceanie
            $table->string('continent')->nullable()->after('longitude');

            // Capacité économique : emergente | en_croissance | etablie | leader
            $table->string('capacite_eco')->nullable()->after('capacite_investissement');

            // Chiffre d'affaires numérique (pour les filtres de plage)
            $table->unsignedBigInteger('ca_numerique')->nullable()->after('chiffre_affaires');

            // Année de création de l'entreprise
            $table->year('annee_creation')->nullable()->after('ca_numerique');
        });
    }

    public function down(): void
    {
        Schema::table('entrepreneur_profils', function (Blueprint $table) {
            $table->dropColumn([
                'latitude',
                'longitude',
                'continent',
                'capacite_eco',
                'ca_numerique',
                'annee_creation',
            ]);
        });
    }
};
