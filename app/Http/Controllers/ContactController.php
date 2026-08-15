<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        // Chargement sécurisé des communiqués
        try {
            $communiques = \App\Models\Communique::latest('date')->take(4)->get();
        } catch (\Exception $e) {
            $communiques = collect();
        }

        return view('contact', [
            'communiques' => $communiques,
            'sujets'      => $this->listeSujets(),
            'dossiers'    => $this->listeDossiers(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_complet' => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', 'max:255'],
            'sujet'       => ['required', 'string', 'max:150'],
            'telephone'   => ['nullable', 'string', 'max:30'],
            'message'     => ['required', 'string', 'min:10', 'max:3000'],
        ], [
            'nom_complet.required' => 'Le nom complet est obligatoire.',
            'email.required'       => "L'adresse email est obligatoire.",
            'email.email'          => "L'adresse email n'est pas valide.",
            'sujet.required'       => 'Veuillez sélectionner un sujet.',
            'message.required'     => 'Le message est obligatoire.',
            'message.min'          => 'Le message doit contenir au moins 10 caractères.',
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Votre message a bien été envoyé. Notre équipe vous répondra sous 24h.');
    }

    public function accreditation(): View
    {
        return view('contact');
    }

    private function listeSujets(): array
    {
        return [
            'Information générale',
            'Demande de partenariat',
            'Accréditation presse',
            'Demande d\'interview',
            'Inscription au Forum',
            'Ressources médias',
            'Autre demande',
        ];
    }

    private function listeDossiers(): array
    {
        return [
            ['nom' => 'Dossier de presse 2026',    'type_icon' => 'pdf',  'taille' => '4.2 Mo', 'url' => '#'],
            ['nom' => 'Présentation officielle',    'type_icon' => 'pptx', 'taille' => '8.7 Mo', 'url' => '#'],
            ['nom' => 'Kit média (Logos & Photos)', 'type_icon' => 'zip',  'taille' => '15.3 Mo', 'url' => '#'],
            ['nom' => "Rapport d'impact 2025",      'type_icon' => 'pdf',  'taille' => '6.1 Mo', 'url' => '#'],
        ];
    }
}
