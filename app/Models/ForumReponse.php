<?php
// app/Models/ForumReponse.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumReponse extends Model
{
    use HasFactory;

    protected $table = 'forum_reponses';

    protected $fillable = [
        'contenu',
        'forum_sujet_id',
        'user_id',
        'est_solution',
        'likes',
    ];

    protected $casts = [
        'est_solution' => 'boolean',
        'likes'        => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sujet()
    {
        return $this->belongsTo(ForumSujet::class, 'forum_sujet_id');
    }

    public function getTempsAttribute(): string
    {
        return $this->created_at?->diffForHumans() ?? '';
    }
}
