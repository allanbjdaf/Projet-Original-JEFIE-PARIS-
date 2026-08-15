<?php
// app/Models/DemandePartenariat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandePartenariat extends Model
{
    use HasFactory;

    protected $table = 'demandes_partenariat';

    protected $fillable = [
        'nom_contact',
        'poste',
        'organisation',
        'type_organisation',
        'email',
        'telephone',
        'pays',
        'secteur',
        'niveau_partenariat',
        'budget_prevu',
        'objectifs',
        'statut',
        'notes_internes',
        'date_reponse',
    ];

    protected $casts = [
        'date_reponse' => 'datetime',
    ];

    // Labels lisibles pour les niveaux
    public function getNiveauLabelAttribute(): string
    {
        return match ($this->niveau_partenariat) {
            'bronze'    => 'Bronze',
            'argent'    => 'Argent',
            'or'        => 'Or',
            'platine'   => 'Platine',
            'sur_mesure' => 'Sur Mesure',
            default     => ucfirst($this->niveau_partenariat),
        };
    }

    // Couleur du niveau
    public function getNiveauCouleurAttribute(): string
    {
        return match ($this->niveau_partenariat) {
            'bronze'    => '#8b5e3c',
            'argent'    => '#607d8b',
            'or'        => '#f5a623',
            'platine'   => '#0d1b3e',
            'sur_mesure' => '#162552',
            default     => '#718096',
        };
    }

    // Statuts
    public function getStatutLabelAttribute(): string
    {
        return match ($this->statut) {
            'en_attente' => 'En attente',
            'en_cours'   => 'En cours de traitement',
            'accepte'    => 'Acceptée',
            'refuse'     => 'Refusée',
            default      => ucfirst($this->statut),
        };
    }

    public function estAccepte(): bool
    {
        return $this->statut === 'accepte';
    }
}
