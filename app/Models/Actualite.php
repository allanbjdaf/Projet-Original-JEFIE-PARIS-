<?php
// app/Models/Actualite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actualite extends Model
{
    use HasFactory;

    protected $table = 'actualites';

    protected $fillable = [
        'titre',
        'slug',
        'resume',
        'contenu',
        'image',
        'categorie',
        'auteur',
        'auteur_photo',
        'auteur_poste',
        'date_publication',
        'publie',
        'a_la_une',
        'vues',
        'tags',
        'temps_lecture',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
        'publie'           => 'boolean',
        'a_la_une'         => 'boolean',
        'vues'             => 'integer',
        'temps_lecture'    => 'integer',
    ];

    // Badge couleur selon catégorie
    public function getBadgeCouleurAttribute(): array
    {
        return match ($this->categorie) {
            'communique'  => ['bg' => '#e3f2fd', 'color' => '#1565c0'],
            'interview'   => ['bg' => '#ede7f6', 'color' => '#6a1b9a'],
            'annonce'     => ['bg' => '#fff8e6', 'color' => '#b07d10'],
            'programme'   => ['bg' => '#e8f5e9', 'color' => '#2e7d32'],
            'partenariat' => ['bg' => '#fff3e0', 'color' => '#e65100'],
            'innovation'  => ['bg' => '#e0f7fa', 'color' => '#00838f'],
            'diaspora'    => ['bg' => '#fce4ec', 'color' => '#c2185b'],
            default       => ['bg' => '#f4f6fa', 'color' => '#718096'],
        };
    }

    // Label lisible
    public function getCategorieLabel(): string
    {
        return match ($this->categorie) {
            'communique'  => 'Communiqué',
            'interview'   => 'Interview',
            'annonce'     => 'Annonce',
            'programme'   => 'Programme',
            'partenariat' => 'Partenariat',
            'innovation'  => 'Innovation',
            'diaspora'    => 'Diaspora',
            default       => ucfirst($this->categorie),
        };
    }

    // Tags en tableau
    public function getTagsArrayAttribute(): array
    {
        return $this->tags ? array_map('trim', explode(',', $this->tags)) : [];
    }
}
