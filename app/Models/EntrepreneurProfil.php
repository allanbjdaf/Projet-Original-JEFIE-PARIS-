<?php
// app/Models/EntrepreneurProfil.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntrepreneurProfil extends Model
{
    use HasFactory;

    protected $table = 'entrepreneur_profils';

    protected $fillable = [
        'user_id',
        'nom_complet',
        'slug',
        'photo',
        'poste',
        'entreprise',
        'ville',
        'pays_residence',
        'secteur_activite',
        'secteur_css',
        'taille_entreprise',
        'taille_employes',
        'chiffre_affaires',
        'capacite_investissement',
        'domaines_expertise',
        'projets_economiques',
        'a_la_une',
        'profil_verifie',
        'completion',
    ];

    protected $casts = [
        'a_la_une'       => 'boolean',
        'profil_verifie' => 'boolean',
        'completion'     => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
