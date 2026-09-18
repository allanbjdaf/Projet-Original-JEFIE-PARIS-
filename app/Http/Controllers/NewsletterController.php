<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterAbonne; // Utilisation de votre modèle existant

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validation de l'email (reçu sous le nom 'email_newsletter')
        $request->validate([
            'email_newsletter' => 'required|email|unique:newsletter_abonnes,email'
        ], [
            'email_newsletter.required' => 'L\'adresse e-mail est obligatoire.',
            'email_newsletter.email'    => 'L\'adresse e-mail n\'est pas valide.',
            'email_newsletter.unique'   => 'Cet e-mail est déjà inscrit à la newsletter !'
        ]);

        // 2. Enregistrement en utilisant votre modèle "NewsletterAbonne"
        NewsletterAbonne::create([
            'email' => strtolower(trim($request->email_newsletter)), // Convertit en minuscule
            'actif' => true // Valeur par défaut
        ]);

        // 3. Redirection avec un message de succès
        return redirect()->back()->with('success_newsletter', 'Merci ! Votre inscription à la newsletter a bien été prise en compte.');
    }
}
