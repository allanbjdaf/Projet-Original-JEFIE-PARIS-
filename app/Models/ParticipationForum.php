<?php
// app/Models/ParticipationForum.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipationForum extends Model
{
    use HasFactory;

    protected $table = 'participation_forums';

    protected $fillable = [
        'user_id',
        'statut',
        'stand',
        'docs_soumis',
        'nb_rdv',
        'confirmee',
    ];

    protected $casts = [
        'confirmee' => 'boolean',
        'nb_rdv'    => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
