<?php
// app/Models/InscriptionRapide.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InscriptionRapide extends Model
{
    use HasFactory;

    protected $table = 'inscriptions_rapides';

    protected $fillable = [
        'nom_complet',
        'email',
        'organisation',
    ];
}
