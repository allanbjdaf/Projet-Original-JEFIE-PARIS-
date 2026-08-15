<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilCandidat extends Model
{
    use HasFactory;

    /**
     * La table associée au modèle.
     */
    protected $table = 'profil_candidats';

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Indispensable pour injecter les données utilisateur sans blocage.
     */
    protected $fillable = [
        'user_id',
        'nom_complet',
        'email',
        'telephone',
        'localisation',
        'titre_pro',
        'bio',
        'secteur',
        'linkedin',
        'disponibilite',
        'photo',
    ];
}
