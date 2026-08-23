namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatForumEdition extends Model
{
use HasFactory;

protected $table = 'stat_forum_editions';

protected $fillable = [
'annee',
'lieu',
'pays',
'inscrits',
'entreprises',
'pays_representes',
'partenariats',
'investissements_fcfa',
'emplois_crees',
'offres_publiees',
'rdv_b2b',
'edition_active', // boolean — édition en cours
];

protected $casts = [
'edition_active' => 'boolean',
'inscrits' => 'integer',
'entreprises' => 'integer',
'pays_representes' => 'integer',
'partenariats' => 'integer',
'emplois_crees' => 'integer',
'offres_publiees' => 'integer',
'rdv_b2b' => 'integer',
'investissements_fcfa'=> 'decimal:2',
];

// ── Scopes ────────────────────────────────────────────────
public function scopeEditionActive($query)
{
return $query->where('edition_active', true);
}

public function scopeParAnnee($query)
{
return $query->orderBy('annee', 'asc');
}

// ── Accesseurs ────────────────────────────────────────────
public function getInvestissementsFormatesAttribute(): string
{
if ($this->investissements_fcfa >= 1_000_000_000_000) {
return number_format($this->investissements_fcfa / 1_000_000_000_000, 1).' Tn FCFA';
}
if ($this->investissements_fcfa >= 1_000_000_000) {
return number_format($this->investissements_fcfa / 1_000_000_000, 0).' Mds FCFA';
}
return number_format($this->investissements_fcfa / 1_000_000, 0).' M FCFA';
}

public function getInscritsFormatesAttribute(): string
{
return number_format($this->inscrits).' participants';
}
}