<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    protected $fillable = [
        'nom',
        'slug',
        'logo',
        'secteur',
        'ville',
        'pays',
        'description',
        'site_web',
        'email',
        'telephone',
        'stand',          // <-- AJOUT : Numéro ou nom du stand
        'type',           // <-- AJOUT : 'organisateur', 'partenaire' ou 'sponsor'
        'niveau_sponsor', // <-- AJOUT : 'Partenaire Or', 'Argent', 'Bronze', etc.
        'color_sponsor'   // <-- AJOUT : Code couleur hexadécimal (ex: '#ff6600')
    ];

    /**
     * Obtenir les offres d'emploi associées à l'entreprise.
     */
    public function offres(): HasMany
    {
        return $this->hasMany(OffreEmploi::class);
    }
}
