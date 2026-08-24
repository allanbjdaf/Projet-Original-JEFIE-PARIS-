<?php
// ══════════════════════════════════════════════════════════════
// FICHIER 1 — app/Models/Inscription.php
// ══════════════════════════════════════════════════════════════
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
 
class Inscription extends Model
{
    use HasFactory;
 
    protected $table = 'inscriptions';
 
    protected $fillable = [
        // Type
        'type_inscription',   // 'participant' | 'entreprise'
        'profil',             // 'participant' | 'ecoute' | 'entrepreneur' | 'acteur_economique'
        'sous_profil',
 
        // Identité commune
        'civilite',           // 'M' | 'Mme'
        'nom',
        'prenom',
        'email',
        'whatsapp',
        'nationalite',
        'pays_residence',
        'fonction',
        'admin_profil',
 
        // Thématiques & préférences participant
        'thematiques',        // JSON
        'participe_b2b',      // boolean
 
        // Écoute d'opportunité
        'nationalite_type',
        'niveau_etudes',
        'diplome',
        'domaine_formation',
        'situation_pro',
        'experience',
        'postes_recherches',  // JSON
        'cv_path',
 
        // Entrepreneur individuel
        'forme_juridique',
        'domaine_activite',
        'secteur_eco',
        'pays_siege',
 
        // Entreprise
        'entreprise_nom',
        'activite_principale',
        'taille_entreprise',
        'site_internet',
        'logo_path',
        'objectifs',          // JSON
        'profils_recherches', // JSON
        'publie_offres',      // boolean
 
        // Badge & sécurité
        'numero_badge',
        'qr_token',
        'statut',             // 'confirme' | 'en_attente' | 'annule'
        'badge_envoye_le',
    ];
 
    protected $casts = [
        'thematiques'        => 'array',
        'postes_recherches'  => 'array',
        'objectifs'          => 'array',
        'profils_recherches' => 'array',
        'participe_b2b'      => 'boolean',
        'publie_offres'      => 'boolean',
        'badge_envoye_le'    => 'datetime',
    ];
 
    // ── Accesseurs ────────────────────────────────────────────
    public function getNomCompletAttribute(): string
    {
        return trim($this->civilite . ' ' . $this->prenom . ' ' . $this->nom);
    }
 
    public function getQrImageUrlAttribute(): string
    {
        $url = route('inscription.badge', [$this->numero_badge, $this->qr_token]);
        return 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($url) . '&color=0d1b3e&bgcolor=ffffff&margin=10';
    }
 
    public function getProfilLabelAttribute(): string
    {
        return match($this->profil) {
            'participant'     => 'Participant',
            'ecoute'          => 'Écoute d\'opportunité',
            'entrepreneur'    => 'Entrepreneur / Porteur de projet',
            'acteur_economique' => 'Acteur Économique',
            default           => ucfirst($this->profil ?? ''),
        };
    }
 
    public function getBadgeCouleursAttribute(): array
    {
        return match($this->profil) {
            'participant'       => ['#1565c0', '#e3f2fd'],
            'ecoute'            => ['#2e7d32', '#e8f5e9'],
            'entrepreneur'      => ['#f5a623', '#fff8e6'],
            'acteur_economique' => ['#6a1b9a', '#ede7f6'],
            default             => ['#718096', '#f0f4f8'],
        };
    }
 
    // ── Relations ─────────────────────────────────────────────
    public function collaborateurs()
    {
        return $this->hasMany(CollaborateurForum::class, 'inscription_id');
    }
 
    public function offres()
    {
        return $this->hasMany(OffreEmploi::class, 'inscription_id');
    }
 
    // ── Scopes ────────────────────────────────────────────────
    public function scopeConfirmes($q) { return $q->where('statut', 'confirme'); }
    public function scopeParticipants($q) { return $q->where('type_inscription', 'participant'); }
    public function scopeEntreprises($q) { return $q->where('type_inscription', 'entreprise'); }
}
 
 
// ══════════════════════════════════════════════════════════════
// FICHIER 2 — app/Models/CollaborateurForum.php
// ══════════════════════════════════════════════════════════════
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class CollaborateurForum extends Model
{
    protected $table = 'collaborateurs_forum';
 
    protected $fillable = [
        'inscription_id',
        'nom', 'prenom', 'fonction',
        'email', 'telephone',
        'numero_badge', 'statut',
        'badge_envoye_le',
    ];
 
    protected $casts = [
        'badge_envoye_le' => 'datetime',
    ];
 
    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }
 
    public function getNomCompletAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }
 
    public function getQrImageUrlAttribute(): string
    {
        $url = 'JEFIE-2026-BADGE-' . $this->numero_badge;
        return 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($url) . '&color=0d1b3e&bgcolor=ffffff&margin=8';
    }
}
 




































