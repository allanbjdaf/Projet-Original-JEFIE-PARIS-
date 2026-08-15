<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Création de l'intention de paiement Stripe.
     */
    public function creerIntent(Request $request)
    {
        // Logique Stripe à ajouter ici
    }

    /**
     * Page de confirmation après inscription.
     */
    public function confirmation()
    {
        return view('inscription.confirmation');
    }
}
