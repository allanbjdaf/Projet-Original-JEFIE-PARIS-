<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Optionnel : utile si vous utilisez des Factories

class AlerteEmploi extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Indispensable pour que votre méthode AlerteEmploi::create() fonctionne.
     */
    protected $fillable = [
        'user_id',
        'email',
        'mots_cles',
        'secteur',
        'lieu',
        'type_contrat',
        'frequence',
        'active',
    ];

    /**
     * Le cast des attributs.
     * Force Laravel à traiter la colonne 'active' comme un vrai booléen (true/false).
     */
    protected $casts = [
        'active' => 'boolean',
    ];
}
