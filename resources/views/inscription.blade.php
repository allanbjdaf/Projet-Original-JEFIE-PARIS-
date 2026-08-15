{{-- resources/views/inscription/index.blade.php --}}
@extends('layouts.app')

@section('title', 'JEFIE-PARIS 2026')

@section('styles')
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        color: #1a2744;
        background: #f4f6fa;
    }

    /* ── NAV ── */
    .nav {
        background: #0d1b3e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .nav-logo-icon {
        width: 42px;
        height: 42px;
        border: 2px solid #f5a623;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        color: #f5a623;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5a623;
        font-size: 9px;
        font-weight: 700;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .75);
        font-size: 13px;
        text-decoration: none;
        white-space: nowrap;
        transition: color .2s;
    }

    .nav-links a:hover {
        color: #fff;
    }

    .nav-links a.active {
        color: #fff;
        border-bottom: 2px solid #f5a623;
        padding-bottom: 2px;
        font-weight: 600;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-login {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 18px;
        border-radius: 4px;
        border: 1.5px solid rgba(255, 255, 255, .35);
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background .2s;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-login svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-inscr-nav {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 22px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .btn-inscr-nav:hover {
        opacity: .9;
    }

    .btn-inscr-nav svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── LANGUAGE SWITCHER ── */
    * Styles optionnels pour que le sélecteur de langue et le bouton s'alignent parfaitement en hauteur */
 .lang-switcher {
        position: relative;
        display: inline-block;
    }

    .lang-btn,
    .nav-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 5px;
        padding: 7px 12px;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        font-family: inherit;
    }

    .lang-btn:hover {
        background: rgba(255, 255, 255, .14);
    }

    .lang-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .lang-flag {
        font-size: 14px;
        line-height: 1;
    }

    .lang-dropdown {
        display: none;
        /* Caché par défaut */
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        background: #ffffff;
        /* Ou couleur sombre selon votre thème */
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        min-width: 150px;
        z-index: 1000;
    }

    .lang-switcher:hover .lang-dropdown,
    .lang-dropdown.open {
        display: block;
    }

    .lang-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 1rem;
        color: #333;
        text-decoration: none;
        transition: background 0.2s;
    }

    .lang-item:last-child {
        border-bottom: none;
    }

    .lang-item:hover {
        background: #f4f4f4;
    }

    .lang-item.active {
        font-weight: bold;
    }

    .lang-item.active .lang-item-flag {
        filter: brightness(1);
    }

    .lang-item-flag {
        font-size: 16px;
        flex-shrink: 0;
    }

    .lang-item-name {
        font-weight: 400;
    }

    .lang-item-code {
        color: #888888;
        /* Remplacez par le code gris de votre choix, ex: #6b7280 */
        font-size: 0.75rem;
        font-weight: 500;
    }

    .lang-item.active .lang-item-code {
        color: #888888;
        ;
    }

    .lang-check {
        margin-left: auto;
    }

    .lang-check svg {
        width: 14px;
        height: 14px;
        fill: none;
        stroke-width: 2.5;
    }

    /* ── PAGE LAYOUT ── */
    .page-layout {
        display: grid;
        grid-template-columns: 1fr 480px;
        min-height: calc(100vh - 64px);
        background: #f4f6fa;
        align-items: start;
    }

    /* ══ COLONNE GAUCHE ══ */
    .left-col {
        padding: 0;
    }

    /* HERO */
    .hero {
        /* Remplacement du dégradé par l'image avec un voile sombre pour le contraste */
        /* Le dégradé va de gauche (sombre à 85%) vers la droite (totalement transparent) */
        background: linear-gradient(to right, rgba(9, 18, 37, 0.85) 30%, rgba(6, 14, 32, 0) 80%), url('/images/pcb.png') no-repeat center center;
        background-size: cover;
        /* Permet à l'image de couvrir tout le bloc */
        padding: 3rem 2.5rem 2.5rem;
        position: relative;
        overflow: hidden;
        min-height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    /* Pensez également à masquer définitivement l'ancien calque de droite s'il y est encore */
    .hero::after {
        display: none;
    }


    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 460px;
    }

    .hero-content h1 {
        color: #fff;
        font-size: 2.2rem;
        /* Taille adaptative : s'ajuste à la largeur de l'écran */
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -.02em;
        line-height: 1.1;
        margin-bottom: 1rem;
        white-space: nowrap;
        /* Force le texte à tenir sur une seule ligne */
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 1.8rem;
            /* Diminue la taille pour que ça rentre sur un écran de téléphone */
            white-space: nowrap;
        }
    }

    .hero-content h1 span {
        color: #f5a623;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .95rem;
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 22px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .btn-gold:hover {
        opacity: .9;
    }

    .btn-gold svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-outline-w {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 20px;
        border-radius: 5px;
        border: 1.5px solid rgba(255, 255, 255, .35);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: background .2s;
    }

    .btn-outline-w:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-outline-w svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Stats bar */
    .stats-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        padding: 1.25rem 2.5rem;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stat-item-icon {
        width: 36px;
        height: 36px;
        background: #eef2ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-item-icon svg {
        width: 18px;
        height: 18px;
        stroke: #162552;
        fill: none;
        stroke-width: 1.8;
    }

    .stat-item-num {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0d1b3e;
        display: block;
        line-height: 1;
    }

    .stat-item-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 2px;
    }

    /* Passes */
    .passes-section {
        padding: 2rem 2.5rem;
    }

    .sec-title {
        font-size: 13px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 1.25rem;
    }

    .passes-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .pass-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: relative;
        transition: box-shadow .2s;
    }

    .pass-card:hover {
        box-shadow: 0 4px 16px rgba(13, 27, 62, .1);
    }

    .pass-card.populaire {
        border: 2px solid #1565c0;
    }

    .popular-badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #1565c0;
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 14px;
        border-radius: 10px;
        letter-spacing: .06em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .pass-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pass-icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .pass-nom {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .07em;
    }

    .pass-prix {
        font-size: 1.8rem;
        font-weight: 900;
        line-height: 1;
    }

    .pass-avantages {
        display: flex;
        flex-direction: column;
        gap: 7px;
        flex: 1;
    }

    .pass-av-item {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        font-size: 12px;
        color: #4a5568;
    }

    .pass-av-item svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        margin-top: 1px;
        fill: none;
        stroke-width: 2.5;
    }

    .pass-btn {
        padding: 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        border: 1.5px solid;
        transition: all .2s;
        text-decoration: none;
        display: block;
    }

    /* Raisons */
    .raisons-section {
        padding: 1.5rem 2.5rem 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .raisons-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .raison-item {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 7px;
    }

    .raison-icon {
        width: 40px;
        height: 40px;
        background: #eef2ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .raison-icon svg {
        width: 20px;
        height: 20px;
        stroke: #162552;
        fill: none;
        stroke-width: 1.8;
    }

    .raison-titre {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
    }

    .raison-desc {
        font-size: 11px;
        color: #718096;
        line-height: 1.45;
    }

    /* ══ COLONNE DROITE ══ */
    .right-col {
        background: #fff;
        border-left: 1px solid #e2e8f0;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        min-height: 100%;
    }

    /* Stepper */
    .stepper {
        display: flex;
        align-items: center;
        gap: 0;
        margin-bottom: .5rem;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
    }

    .step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 15px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: 0;
    }

    .step.done::after {
        background: #0d1b3e;
    }

    .step-num {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #718096;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        position: relative;
    }

    .step.active .step-num {
        background: #0d1b3e;
        color: #fff;
    }

    .step.done .step-num {
        background: #0d1b3e;
        color: #fff;
    }

    .step-label {
        font-size: 10px;
        color: #a0aec0;
        margin-top: 4px;
        text-align: center;
        font-weight: 600;
    }

    .step.active .step-label {
        color: #0d1b3e;
        font-weight: 700;
    }

    /* Formulaire */
    .form-title {
        font-size: 14px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .fg2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    .ff {
        margin-bottom: 12px;
    }

    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 4px;
    }

    .req {
        color: #e53e3e;
    }

    .form-control {
        width: 100%;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        padding: 10px 13px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        transition: border-color .2s;
    }

    .form-control:focus {
        border-color: #0d1b3e;
        box-shadow: 0 0 0 3px rgba(13, 27, 62, .06);
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        cursor: pointer;
    }

    .field-error {
        color: #e53e3e;
        font-size: 11px;
        margin-top: 3px;
        display: block;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 6px;
        padding: 12px 14px;
        font-size: 13px;
        margin-bottom: 1rem;
    }

    .alert-errors {
        background: #fce4ec;
        border: 1px solid #f48fb1;
        color: #c2185b;
        border-radius: 6px;
        padding: 12px 14px;
        font-size: 13px;
        margin-bottom: 1rem;
    }

    .cb-accept {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 10px;
    }

    .cb-accept input {
        width: 15px;
        height: 15px;
        margin-top: 2px;
        flex-shrink: 0;
        accent-color: #0d1b3e;
        cursor: pointer;
    }

    .cb-accept label {
        font-size: 12px;
        color: #4a5568;
        cursor: pointer;
        line-height: 1.5;
    }

    .btn-continuer {
        background: #0d1b3e;
        color: #fff;
        width: 100%;
        padding: 13px;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .2s;
    }

    .btn-continuer:hover {
        background: #162552;
    }

    .btn-continuer svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Paiement */
    .paiement-title {
        font-size: 13px;
        font-weight: 800;
        color: #0d1b3e;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
    }

    .paiement-title svg {
        width: 16px;
        height: 16px;
        stroke: #2e7d32;
        fill: none;
        stroke-width: 2;
    }

    .paiement-sub {
        font-size: 12px;
        color: #718096;
        margin-bottom: 1rem;
    }

    .paiement-methods {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .pm-btn {
        padding: 8px 14px;
        border: 1.5px solid #d1d9e6;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        background: #fff;
        cursor: pointer;
        transition: all .2s;
    }

    .pm-btn:hover {
        border-color: #0d1b3e;
    }

    .pm-btn.active {
        border-color: #0d1b3e;
        background: #eef2ff;
    }

    .pm-logos {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 1rem;
    }

    .pm-logo-item {
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: 8px 12px;
        cursor: pointer;
        transition: border-color .2s;
        background: #fff;
    }

    .pm-logo-item:hover {
        border-color: #0d1b3e;
    }

    .pm-logo-icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 10px;
        font-weight: 800;
    }

    .pm-logo-name {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
    }

    /* Bouton principal d'appel à l'action */
    .btn-paiement {
        width: 100%;
        background: #f5a623;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 12px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(245, 166, 35, 0.2);
    }

    .btn-paiement:hover {
        opacity: .9;
    }


    .btn-paiement svg {
        width: 15px;
        height: 15px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2.2;
    }


    /* Confirmation & Badge */
    .confirmation-block {
        background: #f0fdf4;
        border: 1px solid #86efac;
        border-radius: 8px;
        padding: 1rem;
    }

    /* ── COMPOSANT CONFIRMATION AUTOMATIQUE (BLOC DROIT) ── */
    .conf-title {
        font-size: 13px;
        font-weight: 800;
        color: #2f855a;
        /* Thématique verte conforme à la maquette */
        letter-spacing: 0.05em;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .conf-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .conf-item svg {
        width: 15px;
        height: 15px;
        stroke: #16a34a;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }


    .badge-preview {
        background: #0d1b3e;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: .75rem;
    }



    /* Conteneur global */
    .badge-preview-container {
        max-width: 380px;
        /* Format compact réaliste d'un badge de salon */
        width: 100%;
    }

    /* La carte du badge style maquette */
    .badge-preview-card {
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    /* Header bleu marine */
    .badge-header {
        background: #060e20;
        padding: 10px 14px;
        color: #ffffff;
    }

    .badge-logo-area {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .badge-logo-icon {
        width: 22px;
        height: 22px;
        fill: none;
        stroke: #f5a623;
        stroke-width: 2;
    }

    .badge-logo-text {
        font-size: 8px;
        font-weight: bold;
        line-height: 1.1;
        letter-spacing: 0.05em;
    }

    .badge-logo-text span {
        color: #f5a623;
    }

    .badge-logo-text small {
        color: rgba(255, 255, 255, 0.6);
        font-size: 7px;
    }

    /* Structure à 3 colonnes horizontales pour le corps */
    .badge-body {
        display: flex;
        align-items: center;
        padding: 15px;
        gap: 12px;
        background: #ffffff;
    }

    /* 1. Bloc Photo à gauche */
    .badge-photo-wrapper {
        width: 65px;
        height: 75px;
        border-radius: 6px;
        overflow: hidden;
        background: #edf2f7;
        flex-shrink: 0;
        border: 1px solid #e2e8f0;
    }

    .badge-user-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* 2. Bloc Infos au milieu */
    .badge-user-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .badge-user-name {
        font-size: 13px;
        font-weight: 700;
        color: #060e20;
        margin: 0 0 2px 0;
        line-height: 1.2;
    }

    .badge-user-role {
        font-size: 10px;
        color: #4a5568;
        margin: 0;
        line-height: 1.3;
    }

    .badge-user-company {
        font-size: 10px;
        color: #718096;
        margin: 0 0 6px 0;
        line-height: 1.3;
    }

    /* Badge vert PARTICIPANT clignotant/lumineux de la maquette */
    .badge-tag-status {
        align-self: flex-start;
        background-color: rgba(46, 204, 113, 0.15);
        /* Fond vert très clair transparent */
        color: #2ecc71;
        font-size: 8px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 4px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    /* 3. Bloc QR Code à droite */
    .badge-qr-wrapper {
        width: 50px;
        height: 50px;
        padding: 4px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        background: #fff;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge-fake-qrcode {
        display: flex;
        flex-direction: column;
        gap: 2px;
        width: 100%;
        height: 100%;
    }

    .qr-row {
        display: flex;
        gap: 2px;
        flex: 1;
    }

    .qr-pixel {
        flex: 1;
        border-radius: 1px;
    }

    /* Bouton de téléchargement PDF sous le badge */
    .btn-download-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        margin-top: 12px;
        background: transparent;
        border: 1.5px solid #3182ce;
        color: #3182ce;
        font-size: 12px;
        font-weight: 700;
        padding: 10px;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-download-badge:hover {
        background: #3182ce;
        color: #ffffff;
    }




    .badge-logo {
        width: 36px;
        height: 36px;
        border: 2px solid #f5a623;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .badge-logo svg {
        width: 18px;
        height: 18px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
    }

    .badge-info {
        flex: 1;
    }

    .badge-name {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .badge-role {
        color: rgba(255, 255, 255, .65);
        font-size: 11px;
    }

    .badge-type {
        display: inline-block;
        background: rgba(245, 166, 35, .2);
        color: #f5a623;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 3px;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-top: 4px;
    }

    .badge-qr {
        width: 48px;
        height: 48px;
        background: #fff;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .badge-qr-inner {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 2px;
        width: 36px;
        height: 36px;
    }

    .badge-qr-inner span {
        background: #0d1b3e;
        border-radius: 1px;
    }

    .badge-dl-btn {
        width: 100%;
        padding: 10px;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 6px;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        transition: background .2s;
    }

    .badge-dl-btn:hover {
        background: rgba(255, 255, 255, .15);
    }

    .badge-dl-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Automatisation */
    .auto-block {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .auto-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        flex: 1;
        min-width: 60px;
    }

    .auto-icon {
        width: 36px;
        height: 36px;
        background: #eef2ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auto-icon svg {
        width: 17px;
        height: 17px;
        stroke: #162552;
        fill: none;
        stroke-width: 1.8;
    }

    .auto-lbl {
        font-size: 10px;
        color: #718096;
        text-align: center;
        font-weight: 600;
        line-height: 1.3;
    }

    /* ── CTA BOTTOM ── */
    .cta-bottom {
        background: #0d1b3e;
        padding: 1.5rem 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .cta-bottom-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cta-bottom-icon {
        width: 48px;
        height: 48px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cta-bottom-icon svg {
        width: 24px;
        height: 24px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.6;
    }

    .cta-bottom-title {
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .cta-bottom-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
        line-height: 1.4;
    }

    .cta-bottom-right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .cta-btn-final {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 800;
        font-size: 14px;
        padding: 13px 28px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .cta-btn-final:hover {
        opacity: .9;
    }

    .cta-btn-final svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .cta-help {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 3px;
    }

    .cta-help-txt {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
    }

    .cta-help-icon {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, .15);
    }

    .cta-help-icon svg {
        width: 16px;
        height: 16px;
        stroke: rgba(255, 255, 255, .7);
        fill: none;
        stroke-width: 1.8;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0d1b3e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .fb p {
        font-size: 12px;
        line-height: 1.6;
        margin: .5rem 0 .75rem;
    }

    .socials {
        display: flex;
        gap: 8px;
    }

    .socials a {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: background .2s;
    }

    .socials a:hover {
        background: rgba(255, 255, 255, .2);
    }

    .fc h4 {
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .75rem;
    }

    .fc a {
        display: block;
        color: rgba(255, 255, 255, .6);
        text-decoration: none;
        font-size: 12px;
        margin-bottom: 5px;
        transition: color .2s;
    }

    .fc a:hover {
        color: #fff;
    }

    .fci {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        font-size: 12px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .footer-copy {
        font-size: 11px;
        color: rgba(255, 255, 255, .35);
    }

    .footer-legal {
        display: flex;
        gap: 1rem;
    }

    .footer-legal a {
        font-size: 11px;
        color: rgba(255, 255, 255, .4);
        text-decoration: none;
        transition: color .2s;
    }

    .footer-legal a:hover {
        color: rgba(255, 255, 255, .7);
    }

    @media (max-width: 1100px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .right-col {
            border-left: none;
            border-top: 1px solid #e2e8f0;
        }

        .passes-grid {
            grid-template-columns: 1fr 1fr;
        }

        .raisons-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .passes-grid {
            grid-template-columns: 1fr;
        }

        .raisons-grid {
            grid-template-columns: 1fr 1fr;
        }

        .fg2 {
            grid-template-columns: 1fr;
        }

        .stats-bar {
            gap: 1.5rem;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }

        .cta-bottom {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .raisons-grid {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }






    /* ── PAGE GRID ── */
    .page-grid {
        display: grid;
        grid-template-columns: 1fr 480px;
        gap: 0;
        align-items: start;
        background: #f4f6fa;
    }

    /* ── COLONNE GAUCHE ── */
    .left-col {
        padding: 2rem 2rem 2rem 2.5rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Stats bar */
    .stats-bar {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 1.25rem 1.5rem;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: .5rem;
    }

    .stat-item-icon {
        width: 44px;
        height: 44px;
        background: #eef2ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-item-icon svg {
        width: 22px;
        height: 22px;
        stroke: #0d1b3e;
        fill: none;
        stroke-width: 1.7;
    }

    .stat-item-num {
        font-size: 1.5rem;
        font-weight: 900;
        color: #0d1b3e;
        display: block;
        line-height: 1;
    }

    .stat-item-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 2px;
    }

    /* Passes */
    .sec-title {
        font-size: 13px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5a623;
        padding-left: 10px;
        margin-bottom: 1rem;
    }

    .passes-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .pass-card {
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: relative;
        transition: box-shadow .2s, transform .2s;
    }

    .pass-card:hover {
        box-shadow: 0 4px 18px rgba(13, 27, 62, .1);
        transform: translateY(-2px);
    }

    .pass-card.populaire {
        border-color: #1565c0;
        border-width: 2px;
    }

    .popular-badge {
        position: absolute;
        top: -11px;
        left: 50%;
        transform: translateX(-50%);
        background: #1565c0;
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 14px;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: .07em;
        white-space: nowrap;
    }

    .pass-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pass-icon svg {
        width: 24px;
        height: 24px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.7;
    }

    .pass-nom {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 2px;
    }

    .pass-prix {
        font-size: 1.5rem;
        font-weight: 900;
        display: flex;
        align-items: baseline;
        gap: 4px;
    }

    .pass-prix small {
        font-size: 13px;
        font-weight: 600;
    }

    .pass-avantages {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .pass-av-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 12px;
        color: #4a5568;
        line-height: 1.4;
    }

    .pass-av-item svg {
        width: 14px;
        height: 14px;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .pass-btn {
        padding: 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        border-width: 1.5px;
        border-style: solid;
        transition: all .2s;
        font-family: inherit;
    }

    .pass-btn:hover {
        opacity: .85;
    }

    /* Raisons */
    .raisons-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .raison-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 8px;
        padding: .75rem;
    }

    .raison-icon {
        width: 50px;
        height: 50px;
        background: #0d1b3e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .raison-icon svg {
        width: 22px;
        height: 22px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.7;
    }

    .raison-titre {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
    }

    .raison-desc {
        font-size: 11px;
        color: #718096;
        line-height: 1.5;
    }

    /* ── COLONNE DROITE ── */
    .right-col {
        background: #fff;
        border-left: 1px solid #e2e8f0;
        padding: 1.5rem;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        position: sticky;
        top: 64px;
        max-height: calc(100vh - 64px);
        overflow-y: auto;
    }

    /* Stepper */
    .stepper {
        display: flex;
        align-items: center;
        gap: 0;
        margin-bottom: .5rem;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        flex: 1;
        position: relative;
    }

    .step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 14px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: 0;
    }

    .step.active:not(:last-child)::after {
        background: #0d1b3e;
    }

    .step-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: #a0aec0;
        background: #fff;
        z-index: 1;
        transition: all .3s;
    }

    .step.active .step-num {
        background: #0d1b3e;
        border-color: #0d1b3e;
        color: #fff;
    }

    .step.done .step-num {
        background: #2e7d32;
        border-color: #2e7d32;
        color: #fff;
    }

    .step-label {
        font-size: 10px;
        font-weight: 600;
        color: #a0aec0;
        text-align: center;
        line-height: 1.3;
    }

    .step.active .step-label {
        color: #0d1b3e;
        font-weight: 700;
    }

    /* Formulaire */
    .form-title {
        font-size: 14px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 1rem;
        border-left: 3px solid #f5a623;
        padding-left: 8px;
    }

    .fg2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 10px;
    }

    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 4px;
    }

    .req {
        color: #e53935;
    }

    .form-control {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        font-size: 12px;
        color: #1a2744;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
        background: #fff;
    }

    .form-control:focus {
        border-color: #0d1b3e;
        box-shadow: 0 0 0 3px rgba(13, 27, 62, .07);
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        cursor: pointer;
        padding-right: 28px;
    }

    .cb-accept {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 12px;
        color: #4a5568;
        margin: 12px 0;
    }

    .cb-accept input {
        width: 14px;
        height: 14px;
        accent-color: #0d1b3e;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .field-error {
        color: #e53935;
        font-size: 11px;
        margin-top: 3px;
        display: block;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 7px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: .75rem;
    }

    .alert-errors {
        background: #fce4ec;
        border: 1px solid #f48fb1;
        color: #c2185b;
        border-radius: 7px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: .75rem;
    }

    .btn-continuer {
        background: #0d1b3e;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        padding: 13px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .2s;
        font-family: inherit;
        margin-top: 4px;
    }

    .btn-continuer:hover {
        background: #162552;
    }

    .btn-continuer svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Paiement sécurisé */
    .secure-payment-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .paiement-title {
        font-size: 12px;
        font-weight: 800;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
    }

    .icon-lock {
        width: 14px;
        height: 14px;
        stroke: #0d1b3e;
        fill: none;
        stroke-width: 2;
    }

    .paiement-sub {
        font-size: 11px;
        color: #718096;
        margin-bottom: .85rem;
    }

    .paiement-methods {
        display: flex;
        gap: 6px;
        margin-bottom: .85rem;
    }

    .pm-btn {
        padding: 6px 12px;
        border: 1.5px solid #d1d9e6;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        background: #fff;
        color: #718096;
        font-family: inherit;
        transition: all .2s;
    }

    .pm-btn.active {
        background: #0d1b3e;
        border-color: #0d1b3e;
        color: #fff;
    }

    .payment-sub-section {
        display: none;
    }

    .payment-sub-section.active {
        display: block;
    }

    .pm-logos {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: .75rem;
    }

    .pm-logo-item {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        cursor: pointer;
        background: #fff;
        transition: border-color .2s;
    }

    .pm-logo-item:hover {
        border-color: #0d1b3e;
    }

    .pm-logo-item.selected {
        border-color: #f5a623;
        background: #fff8e6;
    }

    .pm-logo-icon {
        width: 28px;
        height: 28px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
    }

    .pm-logo-name {
        font-size: 11px;
        font-weight: 600;
        color: #162552;
    }

    .stripe-card-form {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .stripe-card-form label {
        font-size: 11px;
        font-weight: 600;
        color: #162552;
        display: block;
        margin-bottom: 3px;
    }

    .stripe-card-form input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        outline: none;
        font-family: inherit;
    }

    .stripe-card-form .form-row {
        display: flex;
        gap: 8px;
    }

    .stripe-card-form .form-row>div {
        flex: 1;
    }

    .btn-paiement {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        transition: opacity .2s;
        font-family: inherit;
    }

    .btn-paiement:hover {
        opacity: .9;
    }

    .btn-paiement svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Confirmation auto */
    .confirmation-block {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .conf-title {
        font-size: 11px;
        font-weight: 800;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: .85rem;
    }

    .conf-list-wrapper {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .conf-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        color: #162552;
    }

    .conf-check-circle {
        width: 22px;
        height: 22px;
        background: #2e7d32;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .conf-check-circle svg {
        width: 12px;
        height: 12px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.5;
    }

    /* Badge preview */
    .badge-preview-card {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .badge-header {
        background: #0d1b3e;
        padding: .85rem 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .badge-logo-icon {
        width: 28px;
        height: 28px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
    }

    .badge-logo-text {
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 1.4;
    }

    .badge-logo-text span {
        color: #f5a623;
    }

    .badge-body {
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fff;
    }

    .badge-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d1b3e, #162552);
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge-avatar img {
        width: 56px;
        height: 56px;
        object-fit: cover;
    }

    .badge-avatar-init {
        color: #fff;
        font-size: 20px;
        font-weight: 700;
    }

    .badge-info {
        flex: 1;
        min-width: 0;
    }

    .badge-name {
        font-size: 14px;
        font-weight: 800;
        color: #0d1b3e;
    }

    .badge-poste {
        font-size: 11px;
        color: #718096;
    }

    .badge-company {
        font-size: 11px;
        color: #4a5568;
        font-weight: 600;
    }

    .badge-type {
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 3px;
        display: inline-block;
        margin-top: 4px;
        background: #e3f2fd;
        color: #1565c0;
    }

    .badge-qr {
        width: 54px;
        height: 54px;
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .badge-qr svg {
        width: 38px;
        height: 38px;
    }

    .btn-dl-badge {
        background: #fff;
        border: 1px solid #0d1b3e;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin-top: .85rem;
        font-family: inherit;
        transition: all .2s;
        text-decoration: none;
    }

    .btn-dl-badge:hover {
        background: #0d1b3e;
        color: #fff;
    }

    .btn-dl-badge svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* CTA bottom bar */
    .cta-bar {
        background: #0d1b3e;
        padding: 1.5rem 2.5rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .cta-bar-left {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex: 1;
    }

    .cta-bar-icon {
        width: 52px;
        height: 52px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cta-bar-icon svg {
        width: 26px;
        height: 26px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.6;
    }

    .cta-bar-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .cta-bar-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
    }

    .cta-bar-right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .btn-finaliser {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 14px;
        padding: 13px 30px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: opacity .2s;
        white-space: nowrap;
        font-family: inherit;
    }

    .btn-finaliser:hover {
        opacity: .9;
    }

    .btn-finaliser svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .cta-help {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    .cta-help a {
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        font-size: 11px;
    }

    /* Responsive */
    @media (max-width:1200px) {
        .page-grid {
            grid-template-columns: 1fr;
        }

        .right-col {
            position: static;
            max-height: none;
            border-left: none;
            border-top: 1px solid #e2e8f0;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .passes-grid,
        .raisons-grid {
            grid-template-columns: 1fr;
        }

        .fg2 {
            grid-template-columns: 1fr;
        }

        .hero h1 {
            font-size: 1.8rem;
        }
    }

    @media (max-width:480px) {
        .passes-grid {
            grid-template-columns: 1fr;
        }

        .raisons-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


<div class="page-layout">

    {{-- ══ COLONNE GAUCHE ══ --}}
    <div class="left-col">

        {{-- HERO --}}
        <section class="hero">
            <div class="hero-content">
                <h1>Inscriptions <span>&amp; Billetterie</span></h1>
                <p class="hero-desc">
                    Réservez votre participation au Forum International de l'Innovation
                    et rejoignez les décideurs, entrepreneurs, investisseurs et experts du monde entier.
                </p>
                <div class="hero-actions">
                    <a href="#form-inscription" class="btn-gold">
                        Je m'inscris
                        <svg viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </a>
                    <a href="#passes" class="btn-outline-w">
                        Voir les tarifs
                        <svg viewBox="0 0 24 24">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                            <line x1="7" y1="7" x2="7.01" y2="7" />
                        </svg>
                    </a>
                </div>
            </div>

        </section>

        {{-- STATS BAR --}}
        <div class="stats-bar" role="region" aria-label="Statistiques">
            @foreach ($stats ?? [] as $s)
            <div class="stat-item">
                <div class="stat-item-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">{!! $s['icon'] !!}</svg>
                </div>
                <div>
                    <span class="stat-item-num">{{ $s['valeur'] }}</span>
                    <div class="stat-item-lbl">{{ $s['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>


        {{-- PASSES --}}
        <div class="passes-section" id="passes">
            <div class="sec-title">Choisissez Votre Pass</div>
            <div class="passes-grid">
                @foreach ($passes as $pass)
                <div class="pass-card {{ $pass['populaire'] ? 'populaire' : '' }}">
                    @if ($pass['populaire'])
                    <div class="popular-badge">Populaire</div>
                    @endif
                    <div class="pass-icon" style="background:<?php echo $pass['couleur'] . '15'; ?>;color:<?php echo $pass['couleur']; ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $pass['icon'] !!}</svg>
                    </div>
                    <div>
                        <div class="pass-nom" style="color:<?php echo $pass['couleur']; ?>">{{ $pass['nom'] }}</div>
                        <div class="pass-prix" style="color:<?php echo $pass['couleur']; ?>">{{ $pass['prix'] }}</div>
                    </div>
                    <div class="pass-avantages">
                        @foreach ($pass['avantages'] as $av)
                        <div class="pass-av-item">
                            <svg viewBox="0 0 24 24" style="stroke:<?php echo $pass['couleur']; ?>">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ $av }}
                        </div>
                        @endforeach
                    </div>
                    @php
                    $passBtnBg = $pass['populaire'] ? $pass['couleur'] : 'transparent';
                    $passBtnColor = $pass['populaire'] ? '#fff' : $pass['couleur'];
                    @endphp
                    <button type="button"
                        class="pass-btn"
                        style="border-color:<?php echo $pass['couleur']; ?>;color:<?php echo $passBtnColor; ?>;background:<?php echo $passBtnBg; ?>"
                        onclick="document.getElementById('pass-choisi').value='{{ $pass['slug'] }}'">
                        Choisir ce pass
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RAISONS --}}
        <div class="raisons-section">
            <div class="sec-title" style="margin-bottom:1rem">Pourquoi S'inscrire ?</div>
            <div class="raisons-grid">
                @foreach ($raisons as $r)
                <div class="raison-item">
                    <div class="raison-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $r['icon'] !!}</svg>
                    </div>
                    <div class="raison-titre">{{ $r['titre'] }}</div>
                    <div class="raison-desc">{{ $r['desc'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

    </div>{{-- /.left-col --}}

    {{-- ══ COLONNE DROITE ══ --}}
    <aside class="right-col" id="form-inscription">

        {{-- Stepper --}}
        <div class="stepper" role="list" aria-label="Étapes d'inscription">
            @foreach ([['1','Informations personnelles'],['2','Choix du pass'],['3','Paiement'],['4','Confirmation']] as $i => [$num, $label])
            <div class="step {{ $num === '1' ? 'active' : '' }}" role="listitem">
                <div class="step-num">{{ $num }}</div>
                <div class="step-label">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        {{-- Alertes --}}
        @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
        <div class="alert-errors" role="alert">Veuillez corriger les erreurs ci-dessous.</div>
        @endif

        {{-- FORMULAIRE D'INSCRIPTION --}}
        <div>
            <div class="form-title">Formulaire d'Inscription</div>
            <form action="{{ route('inscription.store') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" id="pass-choisi" name="pass_choisi" value="{{ old('pass_choisi', 'standard') }}">

                <div class="fg2">
                    <div>
                        <label class="form-label" for="nom_complet">Nom complet <span class="req">*</span></label>
                        <input type="text" id="nom_complet" name="nom_complet" class="form-control"
                            placeholder="Votre nom complet" value="{{ old('nom_complet') }}" required autocomplete="family-name">
                        @error('nom_complet')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="prenom">Prénom <span class="req">*</span></label>
                        <input type="text" id="prenom" name="prenom" class="form-control"
                            placeholder="Votre prénom" value="{{ old('prenom') }}" required autocomplete="given-name">
                        @error('prenom')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="fg2">
                    <div>
                        <label class="form-label" for="email">Email <span class="req">*</span></label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="exemple@email.com" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="telephone">Téléphone <span class="req">*</span></label>
                        <input type="tel" id="telephone" name="telephone" class="form-control"
                            placeholder="+225 07 00 00 00 00" value="{{ old('telephone') }}" required autocomplete="tel">
                        @error('telephone')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="fg2">
                    <div>
                        <label class="form-label" for="organisation">Organisation / Entreprise</label>
                        <input type="text" id="organisation" name="organisation" class="form-control"
                            placeholder="Nom de votre organisation" value="{{ old('organisation') }}" autocomplete="organization">
                        @error('organisation')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="fonction">Fonction</label>
                        <input type="text" id="fonction" name="fonction" class="form-control"
                            placeholder="Votre fonction" value="{{ old('fonction') }}" autocomplete="organization-title">
                        @error('fonction')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="fg2">
                    <div>
                        <label class="form-label" for="pays">Pays <span class="req">*</span></label>
                        <select id="pays" name="pays" class="form-control" required>
                            <option value="">Sélectionnez votre pays</option>
                            @foreach ($pays as $p)
                            <option value="{{ $p }}" {{ old('pays') === $p ? 'selected' : '' }}>{{ $p }}</option>
                            @endforeach
                        </select>
                        @error('pays')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="type_participant">Type de participant <span class="req">*</span></label>
                        <select id="type_participant" name="type_participant" class="form-control" required>
                            <option value="">Sélectionnez le type</option>
                            @foreach ($types as $t)
                            <option value="{{ $t }}" {{ old('type_participant') === $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                        @error('type_participant')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="cb-accept">
                    <input type="checkbox" id="accepte_conditions" name="accepte_conditions" value="1"
                        {{ old('accepte_conditions') ? 'checked' : '' }} required>
                    <label for="accepte_conditions">
                        J'accepte les <a href="{{ route('conditions') }}" target="_blank" style="color:#0d1b3e;font-weight:700">conditions générales</a>
                        et la <a href="{{ route('confidentialite') }}" target="_blank" style="color:#0d1b3e;font-weight:700">politique de confidentialité</a>
                        <span class="req">*</span>
                    </label>
                </div>
                @error('accepte_conditions')<span class="field-error" style="margin-bottom:8px;display:block">{{ $message }}</span>@enderror

                <button type="submit" class="btn-continuer">
                    Continuer
                    <svg viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </button>
            </form>
        </div>


        <div class="checkout-grid-layout">
            <div class="secure-payment-card">
                <div class="paiement-title">
                    <svg viewBox="0 0 24 24" class="icon-lock">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0110 0v4" />
                    </svg>
                    PAIEMENT SÉCURISÉ
                </div>
                <p class="paiement-sub">Choisissez votre méthode de paiement européenne</p>

                <!-- Boutons de sélection principale -->
                <div class="paiement-methods">
                    <button type="button" class="pm-btn active" data-target="card-section">Carte Bancaire</button>
                    <button type="button" class="pm-btn" data-target="wallets-section">Portefeuilles</button>
                    <button type="button" class="pm-btn" data-target="other-section">Virement & Autre</button>
                </div>

                <!-- ZONE DYNAMIQUE : Le contenu change selon le bouton cliqué -->
                <div class="payment-dynamic-container">

                    <!-- 1. MODULE CARTE BANCAIRE -->
                    <div id="card-section" class="payment-sub-section active">
                        <div class="pm-logos mb-3" style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                            <div class="pm-logo-item" style="display: flex; align-items: center; gap: 5px;">
                                <div class="pm-logo-icon" style="background: #635bff; color: #ffffff; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">CB</div>
                                <span class="pm-logo-name" style="font-size: 13px;">CB</span>
                            </div>
                            <div class="pm-logo-item" style="display: flex; align-items: center; gap: 5px;">
                                <div class="pm-logo-icon" style="background: #1a1f71; color: #ffffff; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">VISA</div>
                                <span class="pm-logo-name" style="font-size: 13px;">Visa</span>
                            </div>
                            <div class="pm-logo-item" style="display: flex; align-items: center; gap: 5px;">
                                <div class="pm-logo-icon" style="background: #eb001b; color: #ffffff; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px;">MC</div>
                                <span class="pm-logo-name" style="font-size: 13px;">Mastercard</span>
                            </div>
                        </div>

                        <!-- Formulaire intégré style Stripe Elements -->
                        <div class="stripe-card-form">
                            <div class="form-group mb-2">
                                <label>Numéro de carte</label>
                                <input type="text" placeholder="1234 5678 9012 3456" class="form-control" />
                            </div>
                            <div class="form-row" style="display: flex; gap: 10px;">
                                <div class="form-group mb-2" style="flex: 1;">
                                    <label>Expiration</label>
                                    <input type="text" placeholder="MM/AA" class="form-control" />
                                </div>
                                <div class="form-group mb-2" style="flex: 1;">
                                    <label>CVC / CVV</label>
                                    <input type="text" placeholder="123" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. MODULE PORTEFEUILLES ÉLECTRONIQUES -->
                    <div id="wallets-section" class="payment-sub-section" style="display: none;">
                        <p class="sub-instruction">Sélectionnez votre portefeuille :</p>
                        <div class="pm-logos">
                            <div class="pm-logo-item selectable-wallet" data-wallet="apple">
                                <div class="pm-logo-icon" style="background: #000000; color: #ffffff;">P</div>
                                <span class="pm-logo-name">Apple Pay</span>
                            </div>
                            <div class="pm-logo-item selectable-wallet" data-wallet="google">
                                <div class="pm-logo-icon" style="background: #4285F4; color: #ffffff;">GP</div>
                                <span class="pm-logo-name">Google Pay</span>
                            </div>
                            <div class="pm-logo-item selectable-wallet" data-wallet="paypal">
                                <div class="pm-logo-icon" style="background: #003087; color: #ffffff;">PP</div>
                                <span class="pm-logo-name">PayPal</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. MODULE VIREMENT & AUTRE (Options européennes enrichies) -->
                    <div id="other-section" class="payment-sub-section" style="display: none;">
                        <p class="sub-instruction">Choisissez une option de paiement alternatif :</p>
                        <div class="pm-logos">
                            <div class="pm-logo-item selectable-alt" data-alt="klarna">
                                <div class="pm-logo-icon" style="background: #ffb3c7; color: #000000;">Kl</div>
                                <span class="pm-logo-name">Klarna (Payer en 3x / 4x)</span>
                            </div>
                            <div class="pm-logo-item selectable-alt" data-alt="sepa">
                                <div class="pm-logo-icon" style="background: #2b6cb0; color: #ffffff;">SE</div>
                                <span class="pm-logo-name">Virement SEPA Instantané</span>
                            </div>
                            <div class="pm-logo-item selectable-alt" data-alt="ideal">
                                <div class="pm-logo-icon" style="background: #cc0066; color: #ffffff;">iL</div>
                                <span class="pm-logo-name">iDEAL / Bancontact</span>
                            </div>
                        </div>
                    </div>

                </div>

                <button type="button" class="btn-paiement" style="margin-top: 20px;">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0110 0v4" />
                    </svg>
                    Pour un paiement sécurisé contacter-nous
                </button>
            </div>
        </div>

        {{-- CONFIRMATION AUTOMATIQUE --}}
        <div class="confirmation-block" style="margin-top: 25px;">
            <div class="conf-title">CONFIRMATION AUTOMATIQUE</div>
            <div class="conf-list-wrapper">
                @foreach (['Paiement validé','Email de confirmation envoyé','Badge généré','QR Code généré'] as $item)
                <div class="conf-item">
                    <div class="conf-check-circle">
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <span class="conf-item-text">{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Étape A : Inclusion du moteur de conversion PDF fonctionnel (CDNJS officiel) --}}
        <script src="https://cloudflare.com"></script>

        {{-- APERÇU DU BADGE --}}
        <div class="badge-preview-container" style="margin-top: 25px;">
            <div class="form-title" style="margin-bottom:.75rem">Aperçu du Badge</div>

            {{-- AJOUT DE L'IDENTIFIANT id="badge-to-download" ICI POUR CIBLER LE BLOC EN PDF --}}
            <div class="badge-preview-card" id="badge-to-download" style="background:#fff; border-radius:12px; padding:20px; box-shadow:0 4px 6px rgba(0,0,0,0.05); width:320px; margin:0 auto;">
                <!-- ── BANDEAU SUPÉRIEUR (Header) ── -->
                <header class="badge-header" style="height:40px;">
                    <div class="badge-logo-area"></div>
                </header>

                <!-- ── CORPS DU BADGE ── -->
                <div class="badge-body" style="text-align:center;">
                    <div class="badge-photo-wrapper" style="margin-bottom:15px;">
                        <img src="{{ asset('images/baoo.jpeg') }}" alt="Photo de profil" class="badge-user-photo" style="width:100px; height:100px; border-radius:50%; object-fit:cover;">
                    </div>

                    <div class="badge-user-info">
                        <h4 class="badge-user-name">{{ auth()->check() ? auth()->user()->name : 'Jean Kouadio' }}</h4>
                        <p class="badge-user-role">Directeur Innovation</p>
                        <p class="badge-user-company">Tech Solutions SA</p>
                        <div class="badge-tag-status">PARTICIPANT</div>
                    </div>

                    <div class="badge-qr-wrapper" aria-label="QR Code du badge">
                        <div class="badge-fake-qrcode">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="qr-row">
                                @for ($j = 0; $j < 4; $j++)
                                    <span class="qr-pixel" style="background: {{ in_array($i+$j, [0,2,3,5,6]) ? '#111' : 'transparent' }}"></span>
                                    @endfor
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        {{-- Bouton de téléchargement activé avec l'événement onclick --}}
        <a href="javascript:void(0);" id="download-badge-btn" onclick="downloadBadgeAsPDF()" class="btn-download-badge" style="margin-top: 15px; display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3" />
            </svg>
            Télécharger mon badge (PDF)
        </a>

</div>

{{-- Étape B : Script JavaScript pour générer et télécharger instantanément le fichier --}}
<script>
    function downloadBadgeAsPDF() {
        // Sélectionne uniquement la carte du badge
        const element = document.getElementById('badge-to-download');

        // Nom dynamique basé sur l'utilisateur connecté ou le nom par défaut
        const userName = "{{ auth()->check() ? auth()->user()->name : 'Jean_Kouadio' }}".replace(/\s+/g, '_');

        // Options d'optimisation pour conserver la netteté de la photo et du QR Code
        const options = {
            margin: ,
            filename: 'Badge_Forum_Innovation_' + userName + '.pdf',
            image: {
                type: 'jpeg',
                quality: 1.0
            },
            html2canvas: {
                scale: 3, // Augmente la résolution pour éviter les flous
                useCORS: true, // Autorise le chargement correct des images locales/externes
                letterRendering: true
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        // Lance la compilation et le téléchargement automatique du fichier
        html2pdf().set(options).from(element).save();
    }
</script>

{{-- AUTOMATISATION & CONFIRMATIONS --}}
<div style="margin-top: 25px;">
    <div class="form-title" style="margin-bottom:.75rem">Automatisation &amp; Confirmations</div>
    <div class="auto-block">
        @foreach ([
        ['Confirmation instantanée', '
        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
        <polyline points="22 4 12 14.01 9 11.01" />'],
        ['Email automatique', '
        <rect x="2" y="4" width="20" height="16" rx="2" />
        <path d="M2 7l10 7 10-7" />'],
        ['QR Code unique', '
        <rect x="3" y="3" width="5" height="5" />
        <rect x="16" y="3" width="5" height="5" />
        <rect x="3" y="16" width="5" height="5" />
        <path d="M21 16h-3a2 2 0 00-2 2v3M21 21v.01M12 7v3M12 16v.01M7 12h3M16 12h.01" />'],
        ['Badge téléchargeable', '
        <circle cx="12" cy="8" r="6" />
        <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11" />'],
        ] as [$lbl, $ic])
        <div class="auto-item">
            <div class="auto-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $ic !!}</svg>
            </div>
            <span class="auto-lbl">{{ $lbl }}</span>
        </div>
        @endforeach
    </div>
</div>
</div>

{{-- ══ CTA BOTTOM ══ --}}
<div class="cta-bottom">
    <div class="cta-bottom-left">
        <div class="cta-bottom-icon">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>
        </div>
        <div>
            <div class="cta-bottom-title">Rejoignez les leaders de l'innovation</div>
            <p class="cta-bottom-desc">Ne manquez pas l'opportunité de participer au plus grand rendez-vous de l'innovation en Afrique.</p>
        </div>
    </div>
    <div class="cta-bottom-right">
        <a href="#form-inscription" class="cta-btn-final">
            Finaliser mon inscription
            <svg viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
            </svg>
        </a>
        <div class="cta-help">
            <span class="cta-help-txt">Besoin d'aide ? Contactez notre équipe</span>
            <div class="cta-help-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const mainButtons = document.querySelectorAll(".pm-btn");
        const subSections = document.querySelectorAll(".payment-sub-section");

        mainButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Retirer la classe active de tous les boutons principaux
                mainButtons.forEach(btn => btn.classList.remove("active"));
                // Activer le bouton cliqué
                this.classList.add("active");

                // Récupérer la cible correspondante
                const targetId = this.getAttribute("data-target");

                // Masquer toutes les sous-sections et afficher uniquement la ciblée
                subSections.forEach(section => {
                    if (section.id === targetId) {
                        section.style.display = "block";
                    } else {
                        section.style.display = "none";
                    }
                });
            });
        });

        // Optionnel : Gérer la sélection visuelle des sous-éléments (ex: choisir PayPal ou Klarna)
        const selectableItems = document.querySelectorAll(".selectable-wallet, .selectable-alt");
        selectableItems.forEach(item => {
            item.addEventListener("click", function() {
                // Retirer la sélection des frères et sœurs
                this.parentNode.querySelectorAll(".pm-logo-item").forEach(el => el.style.border = "none");
                // Mettre en valeur l'élément sélectionné
                this.style.border = "2px solid #635bff";
                this.style.borderRadius = "8px";
            });
        });
    });
</script>

{{-- ══ FOOTER ══ --}}
<footer class="site-footer">
    <div class="footer-grid">
        <div class="fb">
            <a href="{{ route('index') }}" class="nav-logo" style="margin-bottom:.4rem">
                <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                    <img src="http://127.0.0.1:8000/images/264.png"
                        alt="Logo JEFIE Paris 2026"
                        style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                </div>
                <div class="nav-logo-text" style="color:#fff"><span>Journées économiques et Forum international </span>de l'emploi de la diaspora Gabonaise<br><small>2026</small></div>
            </a>
            <p>Le rendez-vous mondial des décideurs, innovateurs et entrepreneurs engagés pour un avenir durable.</p>
            <nav class="socials" aria-label="Réseaux sociaux">
                <a href="#" aria-label="Facebook">f</a><a href="#" aria-label="Twitter">&#120143;</a>
                <a href="#" aria-label="LinkedIn">in</a><a href="#" aria-label="YouTube">&#9654;</a>
                <a href="#" aria-label="Instagram">&#9752;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Liens Rapides</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="#">Intervenants</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
        </div>
        <div class="fc">
            <h4>Participer</h4>
            <a href="{{ route('inscription') }}">S'inscrire</a>
            <a href="{{ route('partenaires.devenir') }}">Devenir partenaire</a>
            <a href="#">Soumettre un pitch</a>
            <a href="#">Planifier un RDV B2B</a>
            <a href="{{ route('Faq') }}">FAQ</a>
        </div>
        <div class="fc">
            <h4>Informations</h4>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>15 – 18 Juin 2026</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>Palais des Congrès, Abidjan</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>contact@forum-innovation.org</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
                </svg>+225 01 23 45 67 89</div>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} CDC site. Tous droits réservés.</span>
        <div class="footer-legal">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Confidentialité</a>
            <a href="{{ route('conditions') }}">CGU</a>
        </div>
    </div>
</footer>

@endsection