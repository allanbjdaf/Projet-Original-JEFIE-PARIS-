@extends('layouts.app') {{-- Ou le nom de votre layout principal si existant --}}

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh; background-color: #f8fafc;">
    <div style="background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center; max-width: 450px; width: 100%;">

        <!-- Logo JEFIE -->
        <div style="margin-bottom: 2rem;">
            <img src="{{ asset('images/264.png') }}" alt="Logo JEFIE" style="max-height: 60px;">
        </div>

        <h2 style="font-size: 1.5rem; font-weight: bold; color: #1a202c; margin-bottom: 0.5rem;">Bienvenue sur votre espace</h2>
        <p style="color: #718096; font-size: 0.95rem; margin-bottom: 2rem;">Choisissez une option pour continuer vers votre tableau de bord.</p>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Bouton Connexion (Style bleu identique à votre capture) -->
            <a href="{{ route('login') }}" style="display: block; background-color: #0d6efd; color: white; text-decoration: none; padding: 0.75rem; border-radius: 6px; font-weight: 500; transition: background 0.2s;">
                Je possède déjà un compte (Connexion)
            </a>

            <!-- Bouton Inscription (Style contour ou couleur secondaire) -->
            <a href="{{ route('register') }}" style="display: block; background-color: transparent; color: #0d6efd; border: 2px solid #0d6efd; text-decoration: none; padding: 0.75rem; border-radius: 6px; font-weight: 500; transition: all 0.2s;">
                Je suis nouveau (Créer un compte)
            </a>
        </div>

    </div>
</div>
@endsection