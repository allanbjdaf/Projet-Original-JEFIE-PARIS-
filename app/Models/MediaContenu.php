<?php
// app/Models/MediaContenu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaContenu extends Model
{
    use HasFactory;

    protected $table = 'media_contenus';

    protected $fillable = [
        'titre',
        'slug',
        'type',
        'extrait',
        'contenu',
        'thumbnail',
        'duree',
        'vues',
        'thematique',
        'a_la_une',
        'is_live',
        'photos_count',
        'cta_label',
        'date',
    ];

    protected $casts = [
        'date'       => 'date',
        'a_la_une'   => 'boolean',
        'is_live'    => 'boolean',
        'vues'       => 'integer',
        'photos_count' => 'integer',
    ];

    // Libellé du CTA selon le type
    public function getCtaLabelAttribute(): string
    {
        if (isset($this->attributes['cta_label']) && $this->attributes['cta_label']) {
            return $this->attributes['cta_label'];
        }
        return match ($this->type) {
            'communique'  => 'Lire le communiqué',
            'interview'   => "Voir l'interview",
            'video'       => 'Regarder la vidéo',
            'podcast'     => 'Écouter le podcast',
            'photos'      => 'Voir la galerie',
            'livestream'  => 'Voir le livestream',
            'presse'      => "Lire l'article",
            default       => 'Voir le contenu',
        };
    }
}
