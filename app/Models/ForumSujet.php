<?php
// app/Models/ForumSujet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumSujet extends Model
{
    use HasFactory;

    protected $table = 'forum_sujets';

    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'forum_categorie_id',
        'user_id',
        'tags',
        'vues',
        'nb_reponses',
        'epingle',
        'verrouille',
        'resolu',
    ];

    protected $casts = [
        'epingle'     => 'boolean',
        'verrouille'  => 'boolean',
        'resolu'      => 'boolean',
        'vues'        => 'integer',
        'nb_reponses' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(ForumCategorie::class, 'forum_categorie_id');
    }

    public function reponses()
    {
        return $this->hasMany(ForumReponse::class, 'forum_sujet_id');
    }

    public function derniereReponse()
    {
        return $this->hasOne(ForumReponse::class, 'forum_sujet_id')->latestOfMany();
    }

    public function getTagsArrayAttribute(): array
    {
        return $this->tags ? array_map('trim', explode(',', $this->tags)) : [];
    }

    public function getTempsAttribute(): string
    {
        return $this->created_at?->diffForHumans() ?? '';
    }
}
