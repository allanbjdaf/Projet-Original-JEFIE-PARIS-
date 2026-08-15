<?php
// ══════════════════════════════════════════════════════════════
// Modèles manquants à créer
// ══════════════════════════════════════════════════════════════

// app/Models/Contact.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['nom_complet', 'email', 'telephone', 'sujet', 'message', 'lu'];
    protected $casts = ['lu' => 'boolean'];
}

// app/Models/DemandePartenariat.php
class DemandePartenariat extends Model
{
    protected $fillable = ['nom_organisme', 'contact_nom', 'email', 'telephone', 'niveau_souhaite', 'message', 'statut'];
}

// app/Models/NewsletterAbonne.php
class NewsletterAbonne extends Model
{
    protected $table = 'newsletter_abonnes';
    protected $fillable = ['email', 'actif', 'source'];
    protected $casts = ['actif' => 'boolean'];
}
