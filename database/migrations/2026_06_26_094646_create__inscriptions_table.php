<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('organisation')->nullable();
            $table->string('fonction')->nullable();
            $table->string('pays');
            // type_participant : Participant | Exposant | Investisseur | Intervenant | ...
            $table->string('type_participant');
            // pass_choisi : gratuit | standard | premium
            $table->string('pass_choisi')->default('gratuit');
            // methode_paiement : mobile_money | carte_bancaire | virement | orange_money | mtn | wave | moov | paydunya
            $table->string('methode_paiement')->nullable();
            // statut : en_attente | confirme | annule | rembourse
            $table->string('statut')->default('en_attente');
            $table->string('numero_badge')->unique()->nullable();
            $table->unsignedInteger('montant_paye')->default(0);
            $table->timestamp('date_paiement')->nullable();
            $table->boolean('accepte_conditions')->default(true);
            $table->timestamps();

            $table->index(['statut', 'pass_choisi']);
            $table->index('email');
            $table->index('numero_badge');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
