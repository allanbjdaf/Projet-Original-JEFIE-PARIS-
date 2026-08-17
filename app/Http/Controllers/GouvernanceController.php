<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class GouvernanceController extends Controller
{
    public function index()
    {
        // 1. Définition stricte des catégories et de leur ordre d'affichage
        $categories = [
            'bureau' => 'Bureau Exécutif',
            'scientifique' => 'Comité Scientifique',
            'organisation' => "Comité d'Organisation",
            'partenaires' => 'Partenaires Institutionnels',
        ];

        // 2. Récupération des membres triés par leur ordre de priorité
        $membres = Membre::orderBy('ordre', 'asc')
            ->get()
            ->groupBy('category'); // Regroupe automatiquement par le champ 'category'

        // 3. Envoi des variables à la vue Blade (Correction du symbole $)
        return view('gouvernance', compact('categories', 'membres'));
    }
}
