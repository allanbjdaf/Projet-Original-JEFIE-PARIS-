<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterAbonne;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsletterController extends Controller
{
    // NEWSLETTER
    // ════════════════════════════════════════════════════════════
    public function newsletter(Request $request): View
    {
        try {
            $query = NewsletterAbonne::latest();

            // Filtrer par statut (actif / inactif)
            if ($request->actif !== null) {
                $query->where('actif', $request->actif === '1');
            }

            // Filtrer par recherche textuelle sur l'email
            if ($request->q) {
                $query->where('email', 'like', "%{$request->q}%");
            }

            $abonnes = $query->paginate(30)->withQueryString();
        } catch (\Exception) {
            // Correction : Évite le crash si la base de données est inaccessible
            $abonnes = new LengthAwarePaginator([], 0, 30);
        }

        $counts = $this->getCounts();

        return view('admin.newsletter', compact('abonnes', 'counts'));
    }

    /**
     * Calcule les statistiques pour les badges de la vue d'administration.
     */
    private function getCounts(): array
    {
        try {
            return [
                'total'    => NewsletterAbonne::count(),
                'actifs'   => NewsletterAbonne::where('actif', true)->count(),
                'inactifs' => NewsletterAbonne::where('actif', false)->count(),
            ];
        } catch (\Exception) {
            return [
                'total'    => 0,
                'actifs'   => 0,
                'inactifs' => 0,
            ];
        }
    }
}
