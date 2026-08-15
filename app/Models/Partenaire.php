<?php
// app/Models/Partenaire.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partenaire extends Model
{
    use HasFactory;

    protected $table = 'partenaires';

    protected $fillable = [
        'nom',
        'slug',
        'niveau',
        'logo',
        'description',
        'site_web',
        'ordre',
        'secteur',
        'a_la_une',
    ];

    protected $casts = [
        'a_la_une' => 'boolean',
        'ordre'    => 'integer',
    ];
}
