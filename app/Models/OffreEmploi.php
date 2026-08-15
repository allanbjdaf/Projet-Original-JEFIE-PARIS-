<?php
// app/Models/OffreEmploi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OffreEmploi extends Model
{
    use HasFactory;

    protected $table = 'offres_emplois';

    protected $fillable = [
        'recruteur_id', // 👈 AJOUTÉ pour lier l'offre au recruteur connecté
        'titre',
        'slug',
        'entreprise',
        'logo_entreprise',
        'lieu',
        'pays',
        'secteur',
        'type_contrat',
        'description',
        'competences',
        'salaire',
        'en_vedette',
        'statut',
        'date_expiration',
        'vues', // 👈 AJOUTÉ pour l'incrémentation des vues
    ];

    protected $casts = [
        'en_vedette'      => 'boolean',
        'date_expiration' => 'date',
        'vues'            => 'integer',
    ];

    /**
     * Relation indispensable pour ->withCount('candidatures')
     */
    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class, 'offre_id');
    }

    public function getTempsPublicationAttribute(): string
    {
        $diff = now()->diffInMinutes($this->created_at);
        if ($diff < 60)  return "Il y a {$diff}min";
        $diff = now()->diffInHours($this->created_at);
        if ($diff < 24)  return "Il y a {$diff}h";
        $diff = now()->diffInDays($this->created_at);
        return "Il y a {$diff}j";
    }
}
