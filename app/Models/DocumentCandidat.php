<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentCandidat extends Model
{
    use HasFactory;

    /**
     * La table associée au modèle.
     * Optionnel, mais sécurise le nom au pluriel en français.
     */
    protected $table = 'documents';

    /**
     * Les attributs qui peuvent être assignés en masse.
     * Configuré d'après vos méthodes updateOrCreate() et create().
     */
    protected $fillable = [
        'user_id',
        'type',        // Contiendra 'cv', 'lettre_motivation' ou 'diplome'
        'nom_fichier', // Nom original du fichier (ex: mon_cv.pdf)
        'chemin',      // Chemin de stockage privé (ex: documents/1/abc.pdf)
        'taille',      // Taille du fichier en octets (getSize())
    ];

    /**
     * Les attributs à convertir (casting).
     */
    protected $casts = [
        'taille' => 'integer',
    ];
}
