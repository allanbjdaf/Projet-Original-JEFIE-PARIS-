<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'user_id',
        'offre_id',
        'nom_complet',
        'email',
        'telephone',
        'poste_cible',
        'message',
        'cv_path',
        'statut',
    ];


    public function offreEmploi()
    {
        return $this->belongsTo(OffreEmploi::class, 'offre_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
