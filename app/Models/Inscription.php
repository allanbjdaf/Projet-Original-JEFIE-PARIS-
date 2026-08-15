<?php
// app/Models/Inscription.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscription extends Model
{
    use HasFactory;

    protected $table = 'inscriptions';

    protected $fillable = [
        'nom_complet',
        'prenom',
        'email',
        'telephone',
        'organisation',
        'fonction',
        'pays',
        'type_participant',
        // pass : gratuit | standard | premium
        'pass_choisi',
        // methode : mobile_money | carte_bancaire | virement | orange_money | mtn | wave | moov | paydunya
        'methode_paiement',
        // statut : en_attente | confirme | annule | rembourse
        'statut',
        'numero_badge',
        'montant_paye',
        'date_paiement',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
        'montant_paye'  => 'integer',
    ];

    // Badge complet pour affichage
    public function getNomCompletAttribute(): string
    {
        return trim(($this->attributes['nom_complet'] ?? '') . ' ' . ($this->prenom ?? ''));
    }

    public function estPaye(): bool
    {
        return $this->statut === 'confirme';
    }
}
