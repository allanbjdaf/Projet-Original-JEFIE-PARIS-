<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterAbonne extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     * En français, Laravel ne devine pas le pluriel correctement (il chercherait "newsletter_abonnes").
     *
     * @var string
     */
    protected $table = 'newsletter_abonnes';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'actif',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'actif' => 'boolean', // Force la conversion en vrai/faux PHP lors de la lecture
    ];
}
