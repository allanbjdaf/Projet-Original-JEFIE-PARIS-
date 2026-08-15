<?php
// app/Models/Opportunite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opportunite extends Model
{
    use HasFactory;

    protected $table = 'opportunites';

    protected $fillable = [
        'titre',
        'slug',
        'type',
        'type_label',
        'type_css',
        'icon_path',
        'entreprise',
        'description',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Retourne le CSS class selon le type
    public function getTypeCssAttribute(string $value = null): string
    {
        if ($value) return $value;
        return match (strtolower($this->type ?? '')) {
            'partenariat' => 'part',
            'investissement' => 'inv',
            'cooperation', 'collaboration' => 'coop',
            default => 'part',
        };
    }

    // Libellé lisible du type
    public function getTypeLabelAttribute(string $value = null): string
    {
        if ($value) return $value;
        return match (strtolower($this->type ?? '')) {
            'partenariat'   => 'Partenariat Commercial',
            'investissement' => 'Investissement',
            'cooperation'   => 'Coopération',
            'collaboration' => 'Collaboration',
            default         => ucfirst($this->type ?? ''),
        };
    }

    // Chemin SVG icon selon le type
    public function getIconPathAttribute(string $value = null): string
    {
        if ($value) return $value;
        return match (strtolower($this->type ?? '')) {
            'partenariat'   => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>',
            'investissement' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>',
            default         => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',
        };
    }
}
