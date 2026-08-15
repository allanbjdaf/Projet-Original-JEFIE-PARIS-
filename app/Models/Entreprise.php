<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'telephone'
    ];

    public function offres()
    {
        return $this->hasMany(OffreEmploi::class);
    }
}
