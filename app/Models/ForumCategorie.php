<?php
// app/Models/ForumCategorie.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumCategorie extends Model
{
    use HasFactory;

    // ⚠️ NOM DE TABLE EXPLICITE — sans ça Laravel cherche "forums"
    protected $table = 'forum_categories';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'icone',
        'couleur',
        'ordre',
        'sujets_count',
        'reponses_count',
    ];

    protected $casts = ['ordre' => 'integer'];

    public function sujets()
    {
        return $this->hasMany(ForumSujet::class, 'forum_categorie_id');
    }

    public function reponses()
    {
        return $this->hasManyThrough(
            ForumReponse::class,
            ForumSujet::class,
            'forum_categorie_id', // FK sur forum_sujets
            'forum_sujet_id',     // FK sur forum_reponses
            'id',
            'id'
        );
    }
}
