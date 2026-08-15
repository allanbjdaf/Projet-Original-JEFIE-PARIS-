<?php
// app/Models/Communique.php
// (Compléter le modèle existant avec l'accessor badge_key)

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Communique extends Model
{
    use HasFactory;

    protected $table = 'communiques';

    protected $fillable = ['titre', 'slug', 'extrait', 'contenu', 'categorie', 'date'];

    protected $casts = [
        'date' => 'date',
    ];

    // Clé CSS du badge : b-ann | b-par | b-prog | b-ins
    public function getBadgeKeyAttribute(): string
    {
        return match (strtolower($this->categorie)) {
            'annonce'      => 'ann',
            'partenariat'  => 'par',
            'programme'    => 'prog',
            'inscriptions' => 'ins',
            default        => 'ann',
        };
    }

    // Classe CSS complète (utilisée dans galerie)
    public function getBadgeClassAttribute(): string
    {
        return 'b-' . $this->badge_key;
    }
}
