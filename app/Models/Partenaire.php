<?php
// app/Models/Partenaire.php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'logo',
        'description',
        'secteur',
        'site_web',
        'email_contact',
        'telephone',
        'ville',
        'pays',
        'adresse',
        'type',      // 'gold' | 'silver' | 'bronze' | 'media' | 'institutionnel'
        'statut',    // 'actif' | 'inactif' | 'en_attente'
        'qr_token',  // token unique pour déverrouiller les offres
        'stand',     // numéro de stand au forum
        'description_courte',
        'nombre_employes',
        'chiffre_affaires',
        'reseaux_sociaux', // JSON
        'visible_offres_public', // si true, offres visibles sans QR
    ];

    protected $casts = [
        'reseaux_sociaux'      => 'array',
        'visible_offres_public' => 'boolean',
    ];

    // Slug automatique
    protected static function booted(): void
    {
        static::creating(function ($m) {
            if (empty($m->slug))     $m->slug      = Str::slug($m->nom) . '-' . Str::random(4);
            if (empty($m->qr_token)) $m->qr_token  = Str::random(40);
        });
    }

    // URL publique de la page entreprise
    public function getUrlAttribute(): string
    {
        return route('partenaires.show', $this->slug);
    }

    // URL QR Code (celle qui est encodée dans le QR)
    public function getQrUrlAttribute(): string
    {
        return route('partenaires.qr-acces', [$this->slug, $this->qr_token]);
    }

    // URL image QR générée via l'API Google Charts (sans librairie)
    public function getQrImageUrlAttribute(): string
    {
        $url = urlencode($this->qr_url);
        return "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={$url}&bgcolor=ffffff&color=0d1b3e&margin=10";
    }

    // Badge type partenaire
    public function getBadgeTypeAttribute(): array
    {
        return match ($this->type) {
            'gold'           => ['Or',            '#f5a623', '#fff8e6'],
            'silver'         => ['Argent',        '#718096', '#f0f4f8'],
            'bronze'         => ['Bronze',        '#cd7f32', '#fdf3e7'],
            'media'          => ['Média',         '#1565c0', '#e3f2fd'],
            'institutionnel' => ['Institutionnel', '#2e7d32', '#e8f5e9'],
            default          => ['Partenaire',    '#a0aec0', '#f4f6fa'],
        };
    }

    // Relations
    public function offres()
    {
        return $this->hasMany(OffreEmploi::class, 'partenaire_id');
    }

    public function offresActives()
    {
        return $this->hasMany(OffreEmploi::class, 'partenaire_id')
            ->where('statut', 'active');
    }
}
