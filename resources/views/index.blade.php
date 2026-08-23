{{-- resources/views/index.blade.php --}}
@extends('layouts.app')
@section('title', 'JEFIE – PARIS 2026')
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
        background: #fff;
    }

    /* ══ NAV ══ */
    .nav {
        background: #0d1b3e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2.5rem;
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
        width: 46px;
        height: 46px;
        border: 2px solid #f5a623;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #0d1b3e;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        display: block;
        font-size: 12px;
        font-weight: 800;
        color: #f5a623;
    }

    .nav-logo-text small {
        color: rgba(255, 255, 255, .7);
        font-size: 10px;
    }

    .nav-links {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .85);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: color .2s;
        white-space: nowrap;
        padding-bottom: 3px;
        letter-spacing: .01em;
    }

    .nav-links a:hover {
        color: #f5a623;
    }

    .nav-links a.active {
        color: #f5a623;
        border-bottom: 2px solid #f5a623;
        font-weight: 700;
    }

    .nav-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 26px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .nav-btn:hover {
        opacity: .9;
    }

    .nav-btn svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }




    /* 2. Le conteneur de droite (Langue + Bouton Inscription) doit être en flex horizontal */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 1rem;
        /* Espace souhaité entre le sélecteur de langue et le bouton */
    }

    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
    }

    .nav-icon-btn svg {
        width: 18px;
        height: 18px;
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

    .nav-dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    .nav-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #ffffff;
        min-width: 160px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 6px;
        z-index: 100;
        padding: 0.5rem 0;
    }

    .nav-dropdown-menu a {
        display: block;
        padding: 0.5rem 1rem;
        color: #333333 !important;
        text-decoration: none;
        white-space: nowrap;
    }

    .nav-dropdown-menu a:hover {
        background: #f4f4f4;
        color: #f5a623 !important;
    }


    /* Style du conteneur déroulant */
    .nav-dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    /* Masquer le menu par défaut */
    .nav-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        min-width: 180px;
        background-color: #ffffff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
        border-radius: 4px;

        /* Gestion du défilement si le menu est trop long */
        max-height: 250px;
        overflow-y: auto;
    }

    /* Afficher le menu au survol (alternative ou complément au clic) */
    .nav-dropdown-wrapper:hover .nav-dropdown-menu {
        display: block;
    }

    /* Style des liens à l'intérieur du menu déroulant */
    .nav-dropdown-menu a {
        color: #333333;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        white-space: nowrap;
    }

    /* Effet au survol des options du menu */
    .nav-dropdown-menu a:hover {
        background-color: #f1f1f1;
    }

    /* ══ HERO ══ */
    .hero {
        background-size: cover;
        background-position: center top;
        background-repeat: no-repeat;
        padding: 3.5rem 3rem;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 2.5rem;
        min-height: 500px;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .42);
        z-index: 0;
        pointer-events: none;
    }

    .hero-left {
        flex: 1;
        position: relative;
        z-index: 1;
        max-width: 52%;
    }

    .hero-left h1 {
        color: #fff;
        font-size: 2.1rem;
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -.01em;
        text-transform: uppercase;
        margin-bottom: .5rem;
    }

    .hero-left h1 .gold {
        color: #f5a623;
        display: block;
    }

    .hero-tagline {
        color: rgba(255, 255, 255, .75);
        font-size: .95rem;
        font-style: italic;
        margin-bottom: 1.25rem;
    }

    .hero-meta {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .hero-meta-item {
        display: flex;
        align-items: center;
        gap: 7px;
        color: rgba(255, 255, 255, .85);
        font-size: 13px;
    }

    .hero-meta-item svg {
        width: 16px;
        height: 16px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-hero-gold {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 14px;
        padding: 13px 26px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .btn-hero-gold:hover {
        opacity: .9;
    }

    .btn-hero-outline {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        padding: 12px 24px;
        border-radius: 5px;
        border: 1.5px solid rgba(255, 255, 255, .45);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: background .2s;
    }

    .btn-hero-outline:hover {
        background: rgba(255, 255, 255, .1);
    }

    .btn-hero-gold svg,
    .btn-hero-outline svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Vidéo hero */
    .hero-video {
        position: relative;
        z-index: 1;
        width: 380px;
        flex-shrink: 0;
    }

    .video-box {
        width: 100%;
        aspect-ratio: 16/10;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        cursor: pointer;
        border: 2px solid rgba(255, 255, 255, .2);
    }

    .video-box video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .video-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .play-circle {
        width: 58px;
        height: 58px;
        background: rgba(245, 166, 35, .92);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        transition: transform .2s;
        z-index: 2;
    }

    .video-box:hover .play-circle {
        transform: scale(1.1);
    }

    .play-circle svg {
        width: 22px;
        height: 22px;
        fill: #0d1b3e;
        margin-left: 4px;
    }

    .video-caption {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 8px;
        color: rgba(255, 255, 255, .65);
        font-size: 12px;
        position: relative;
        z-index: 1;
    }

    .video-caption svg {
        width: 13px;
        height: 13px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 2;
    }

    /* ══ VISION & MESSAGE ══ */
    .section-pad {
        padding: 3.5rem 2.5rem;
    }

    .bg-light {
        background: #f8fafc;
    }

    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .card-border {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 2rem;
    }

    .card-title {
        font-size: 13px;
        font-weight: 900;
        color: #0d1b3e;
        text-transform: uppercase;
        letter-spacing: .1em;
        border-left: 3px solid #f5a623;
        padding-left: 10px;
        margin-bottom: .25rem;
    }

    .card-bar {
        width: 36px;
        height: 2px;
        background: #f5a623;
        margin-bottom: 1rem;
    }

    .card-p {
        font-size: 13px;
        color: #4a5568;
        line-height: 1.75;
        margin-bottom: 1.25rem;
    }

    .vision-inner {
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
    }

    .vision-img {
        width: 130px;
        height: 130px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .btn-sm-dark {
        display: inline-block;
        background: #0d1b3e;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background .2s;
    }

    .btn-sm-dark:hover {
        background: #162552;
    }

    .message-inner {
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
    }

    .msg-avatar {
        width: 90px;
        height: 90px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .msg-quote {
        font-size: 13px;
        color: #4a5568;
        line-height: 1.7;
        font-style: italic;
        margin-bottom: .75rem;
    }

    .msg-author-name {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
    }

    .msg-author-role {
        font-size: 11px;
        color: #718096;
    }

    .quote-mark {
        float: right;
        color: #f5a623;
        font-size: 2.5rem;
        line-height: 1;
        margin-left: 6px;
    }

    /* ══ CHIFFRES CLÉS ══ */
    .sec-h {
        font-size: 14px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .12em;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: .5rem;
    }

    .sec-bar {
        width: 48px;
        height: 3px;
        background: #f5a623;
        border-radius: 2px;
        margin: 0 auto 2.5rem;
    }

    .chiffres-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.25rem;
    }

    .chiffre-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.75rem 1rem;
        text-align: center;
        transition: box-shadow .2s;
    }

    .chiffre-card:hover {
        box-shadow: 0 4px 16px rgba(13, 27, 62, .08);
    }

    .chiffre-card svg {
        width: 30px;
        height: 30px;
        stroke: #0d1b3e;
        fill: none;
        stroke-width: 1.6;
        margin: 0 auto .85rem;
        display: block;
    }

    .chiffre-num {
        font-size: 1.9rem;
        font-weight: 900;
        color: #0d1b3e;
        display: block;
        line-height: 1;
    }

    .chiffre-lbl {
        font-size: 12px;
        color: #718096;
        margin-top: 6px;
        line-height: 1.35;
    }

    /* ══ APPEL + INSCRIPTION ══ */
    .two-col-appel {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .appel-card {
        background: #0d1b3e;
        border-radius: 12px;
        padding: 2rem;
        color: #fff;
    }

    .appel-card .card-title {
        color: #fff;
    }

    .appel-desc {
        color: rgba(255, 255, 255, .65);
        font-size: 13px;
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .roles-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .role-box {
        text-align: center;
    }

    .role-icon {
        width: 46px;
        height: 46px;
        background: rgba(255, 255, 255, .09);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto .5rem;
    }

    .role-icon svg {
        width: 22px;
        height: 22px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.7;
    }

    .role-lbl {
        font-size: 11px;
        color: rgba(255, 255, 255, .75);
        font-weight: 600;
    }

    .btn-appel {
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

    .btn-appel:hover {
        opacity: .9;
    }

    .btn-appel svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .inscr-card {
        display: flex;
        background-color: #eef4fc;
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .inscr-form {
        flex: 1.3;
        background-color: #fff;
        padding: 2rem;
        border-radius: 12px 0 0 12px;
    }

    .inscr-sub {
        font-size: 13px;
        color: #718096;
        margin-bottom: 1.25rem;
    }

    .inscr-field {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        padding: 10px 14px;
        margin-bottom: 10px;
    }

    .inscr-field svg {
        width: 16px;
        height: 16px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .inscr-field input {
        flex: 1;
        border: none;
        outline: none;
        font-size: 13px;
        color: #1a2744;
        background: transparent;
    }

    .inscr-field input::placeholder {
        color: #a0aec0;
    }

    .btn-inscr-form {
        background: #0d1b3e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 12px;
        border: none;
        border-radius: 6px;
        width: 100%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .2s;
    }

    .btn-inscr-form:hover {
        background: #162552;
    }

    .btn-inscr-form svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .inscr-illus {
        width: 160px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: #eef4fc;
    }

    .inscr-illus img {
        width: 140px;
        object-fit: contain;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 6px;
        padding: 12px 16px;
        margin-bottom: 1rem;
        font-size: 13px;
    }

    /* ══ ACTUALITÉS + VIDÉOS ══ */
    .two-col-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
    }

    .sec-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .sec-header-row .sec-h {
        margin-bottom: 0;
        text-align: left;
    }

    .sec-header-row a {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color .2s;
        white-space: nowrap;
    }

    .sec-header-row a:hover {
        color: #f5a623;
    }

    .sec-header-row a svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Cards actualités */
    .actu-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .actu-card {
        display: flex;
        gap: 0;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow .2s;
        text-decoration: none;
    }

    .actu-card:hover {
        box-shadow: 0 2px 12px rgba(13, 27, 62, .07);
    }

    .actu-thumb {
        width: 90px;
        height: 85px;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }

    .actu-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .actu-date-tag {
        position: absolute;
        top: 5px;
        left: 5px;
        background: #f5a623;
        color: #0d1b3e;
        font-size: 9px;
        font-weight: 800;
        padding: 3px 7px;
        border-radius: 3px;
        text-align: center;
        line-height: 1.3;
    }

    .actu-date-tag .day {
        font-size: 13px;
        font-weight: 900;
        display: block;
    }

    .actu-body {
        padding: .75rem;
        flex: 1;
        min-width: 0;
    }

    .actu-title {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        line-height: 1.4;
        margin-bottom: 4px;
    }

    .actu-excerpt {
        font-size: 11px;
        color: #718096;
        line-height: 1.45;
        margin-bottom: 6px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .actu-link {
        font-size: 11px;
        font-weight: 700;
        color: #162552;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        transition: color .2s;
    }

    .actu-link:hover {
        color: #f5a623;
    }

    .actu-link svg {
        width: 10px;
        height: 10px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Vidéos grid 3 colonnes */
    .videos-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: .75rem;
    }

    .video-item {
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        background: #0d1b3e;
        aspect-ratio: 16/9;
    }

    .video-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        opacity: .7;
    }

    .video-item-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .vid-play-btn {
        width: 38px;
        height: 38px;
        background: rgba(245, 166, 35, .9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .2s;
    }

    .video-item:hover .vid-play-btn {
        transform: scale(1.1);
        background: #f5a623;
    }

    .vid-play-btn svg {
        width: 14px;
        height: 14px;
        fill: #0d1b3e;
        margin-left: 2px;
    }

    .video-item-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: .5rem .6rem;
        background: linear-gradient(transparent, rgba(0, 0, 0, .75));
    }

    .video-item-label p {
        color: #fff;
        font-size: 10px;
        font-weight: 600;
        line-height: 1.3;
    }

    /* ══ PARTENAIRES ══ */
    .partners-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .partners-scroll {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        overflow-x: auto;
        padding: .5rem 0;
        flex: 1;
        scrollbar-width: none;
        scroll-behavior: smooth;
    }

    .partners-scroll::-webkit-scrollbar {
        display: none;
    }

    .partner-logo-box {
        height: 60px;
        min-width: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
        flex-shrink: 0;
        transition: box-shadow .2s;
    }

    .partner-logo-box:hover {
        box-shadow: 0 2px 10px rgba(13, 27, 62, .08);
    }

    .partner-logo-box img {
        max-height: 42px;
        max-width: 100px;
        object-fit: contain;
    }

    .partner-logo-box span {
        font-size: 12px;
        font-weight: 700;
        color: #718096;
        white-space: nowrap;
    }

    .scroll-btn {
        width: 40px;
        height: 40px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .2s;
    }

    .scroll-btn:hover {
        background: #f4f6fa;
    }

    .scroll-btn svg {
        width: 18px;
        height: 18px;
        stroke: #162552;
        fill: none;
        stroke-width: 2;
    }

    /* ══ FOOTER ══ */
    .site-footer {
        background: #0d1b3e;
        color: rgba(255, 255, 255, .7);
        padding: 3rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 2.5rem;
        margin-bottom: 2.5rem;
    }

    .fb-brand p {
        font-size: 13px;
        line-height: 1.65;
        margin: .75rem 0 1rem;
    }

    .socials {
        display: flex;
        gap: 10px;
    }

    .socials a {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
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
        margin-bottom: 1rem;
    }

    .fc a {
        display: block;
        color: rgba(255, 255, 255, .6);
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 6px;
        transition: color .2s;
    }

    .fc a:hover {
        color: #fff;
    }

    .fci {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 13px;
        margin-bottom: 7px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .footer-nl {
        display: flex;
        gap: 8px;
        margin-top: 10px;
    }

    .footer-nl input {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .07);
        color: #fff;
        font-size: 12px;
        outline: none;
    }

    .footer-nl input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .footer-nl button {
        background: #f5a623;
        border: none;
        border-radius: 5px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 700;
        color: #0d1b3e;
        cursor: pointer;
        white-space: nowrap;
        transition: opacity .2s;
    }

    .footer-nl button:hover {
        opacity: .9;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1.25rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .footer-copy {
        font-size: 12px;
        color: rgba(255, 255, 255, .35);
    }

    .footer-legal-links {
        display: flex;
        gap: 1.5rem;
    }

    .footer-legal-links a {
        font-size: 12px;
        color: rgba(255, 255, 255, .4);
        text-decoration: none;
    }

    .footer-legal-links a:hover {
        color: rgba(255, 255, 255, .7);
    }

    @media (max-width:1100px) {

        .two-col,
        .two-col-appel,
        .two-col-content {
            grid-template-columns: 1fr;
        }

        .chiffres-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }

        .hero-video {
            display: none;
        }

        .hero-left {
            max-width: 100%;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .hero {
            padding: 2.5rem 1.5rem;
        }

        .chiffres-grid {
            grid-template-columns: 1fr 1fr;
        }

        .roles-row {
            grid-template-columns: 1fr 1fr;
        }

        .section-pad {
            padding: 2.5rem 1.5rem;
        }

        .videos-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:480px) {
        .chiffres-grid {
            grid-template-columns: 1fr;
        }

        .hero-left h1 {
            font-size: 1.6rem;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }

        .videos-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')





<div class="lang-dropdown" id="langDropdown" role="menu">


    {{-- Français --}}
    <a href="{{ route('lang.switch',['locale'=>'fr']) }}"
        class="lang-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}"
        hreflang="fr">

        <span class="lang-item-name">Français</span>
        <span class="lang-item-code">fr</span>

        @if(app()->getLocale() === 'fr')
        <span class="lang-check">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </span>
        @endif

    </a>



    {{-- English --}}
    <a href="{{ route('lang.switch',['locale'=>'en']) }}"
        class="lang-item {{ app()->getLocale() === 'en' ? 'active' : '' }}"
        hreflang="en">

        <span class="lang-item-name">English</span>
        <span class="lang-item-code">en</span>

        @if(app()->getLocale() === 'en')
        <span class="lang-check">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </span>
        @endif

    </a>



    {{-- Português --}}
    <a href="{{ route('lang.switch',['locale'=>'pt']) }}"
        class="lang-item {{ app()->getLocale() === 'pt' ? 'active' : '' }}"
        hreflang="pt">

        <span class="lang-item-name">Português</span>
        <span class="lang-item-code">pt</span>

        @if(app()->getLocale() === 'pt')
        <span class="lang-check">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </span>
        @endif

    </a>



    {{-- Italiano --}}
    <a href="{{ route('lang.switch',['locale'=>'it']) }}"
        class="lang-item {{ app()->getLocale() === 'it' ? 'active' : '' }}"
        hreflang="it">

        <span class="lang-item-name">Italiano</span>
        <span class="lang-item-code">it</span>

        @if(app()->getLocale() === 'it')
        <span class="lang-check">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </span>
        @endif

    </a>



    {{-- Deutsch --}}
    <a href="{{ route('lang.switch',['locale'=>'de']) }}"
        class="lang-item {{ app()->getLocale() === 'de' ? 'active' : '' }}"
        hreflang="de">

        <span class="lang-item-name">Deutsch</span>
        <span class="lang-item-code">de</span>

        @if(app()->getLocale() === 'de')
        <span class="lang-check">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </span>
        @endif

    </a>



    {{-- 中文 --}}
    <a href="{{ route('lang.switch',['locale'=>'zh']) }}"
        class="lang-item {{ app()->getLocale() === 'zh' ? 'active' : '' }}"
        hreflang="zh">

        <span class="lang-item-name">中文</span>
        <span class="lang-item-code">zh</span>

        @if(app()->getLocale() === 'zh')
        <span class="lang-check">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </span>
        @endif

    </a>


</div>
</div>
{{-- Intégration du script --}}
<script>
    function toggleLang() {
        const dropdown = document.getElementById('langDropdown');
        const switcher = document.getElementById('langSwitcher');
        const btn = switcher?.querySelector('.lang-btn') || switcher;
        if (!dropdown) return;

        const isVisible = dropdown.style.display === 'block';
        dropdown.style.display = isVisible ? 'none' : 'block';
        btn.setAttribute('aria-expanded', !isVisible);
    }

    window.addEventListener('click', function(e) {
        const switcher = document.getElementById('langSwitcher');
        const dropdown = document.getElementById('langDropdown');

        if (switcher && !switcher.contains(e.target)) {
            if (dropdown) dropdown.style.display = 'none';
            const btn = switcher.querySelector('.lang-btn') || switcher;
            if (btn) btn.setAttribute('aria-expanded', 'false');
        }
    });
</script>
<script>
    function toggleSearch() {
        const form = document.getElementById('searchForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
            form.querySelector('input').focus();
        } else {
            // Si le champ est déjà visible et contient du texte, on soumet la recherche
            if (form.querySelector('input').value.trim() !== '') {
                form.submit();
            } else {
                form.style.display = 'none';
            }
        }
    }
</script>

</div>
</div>
</nav>

{{-- ══ HERO ══ --}}
<section class="hero" style="background-image: url('{{ asset('images/coo.jpg') }}')">
    <div class="hero-left">
        <h1>
            Journées économiques et Forum international de
            <span class="gold">l'Emploi de la diaspora gabonaise 2026</span>
        </h1>
        <p class="hero-tagline">&ldquo;Transformer les idées en opportunités durables&rdquo;</p>
        <div class="hero-meta">
            <div class="hero-meta-item">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                15 - 17 Juin 2026
            </div>
            <div class="hero-meta-item">
                <svg viewBox="0 0 24 24">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                Palais des Congrès,Paris, France
            </div>
        </div>
        <div class="hero-actions">
            <a href="{{ route('inscription') }}" class="btn-hero-gold">
                Participer au forum
                <svg viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </a>
            <a href="{{ route('programme') }}" class="btn-hero-outline">
                Découvrir le programme
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <polygon points="10 8 16 12 10 16 10 8" fill="currentColor" stroke="none" />
                </svg>
            </a>
        </div>
    </div>

    {{-- Vidéo à droite --}}
    <div class="hero-video">
        <div class="video-box" style="position: relative; cursor: pointer;">
            {{-- ✅ Ajout de id="heroVideo" --}}
            <video id="heroVideo" autoplay loop muted playsinline style="width:100%;height:100%;object-fit:cover">
                <source src="{{ asset('images/vd.mp4') }}" type="video/mp4">
            </video>

            {{-- ✅ Ajout de id="playBtn" --}}
            <div class="play-circle" id="playBtn">
                <svg viewBox="0 0 24 24">
                    <polygon points="5 3 19 12 5 21 5 3" fill="#0d1b3e" />
                </svg>
            </div>
        </div>

        {{-- ✅ Ajout de id="captionBtn" --}}
        <div class="video-caption" id="captionBtn" style="cursor: pointer;">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polygon points="10 8 16 12 10 16 10 8" fill="#f5a623" stroke="none" />
            </svg>
            Voir la vidéo officielle
        </div>
    </div>

</section>

{{-- ══ VISION & MESSAGE ══ --}}
<section class="section-pad">
    <div class="two-col">
        <div class="card-border">
            <div class="card-title">Notre Vision</div>
            <div class="card-bar"></div>
            <div class="vision-inner">
                <div style="flex:1">
                    <p class="card-p">{{ $vision }}</p>
                    <a href="{{ route('Apropos') }}" class="btn-sm-dark">En savoir plus</a>
                </div>
                {{-- ✅ 263.png --}}
                <img src="{{ asset('images/'.$visionImage) }}" alt="Notre vision" class="vision-img">
            </div>
        </div>
        <div class="card-border">
            <div class="card-title">Message Institutionnel</div>
            <div class="card-bar"></div>
            <div class="message-inner">
                {{-- ✅ dio.jpg --}}
                <img src="{{ asset('images/'.$messageAvatar) }}" alt="{{ $messageNom }}" class="msg-avatar">
                <div style="flex:1">
                    <p class="msg-quote">
                        <span class="quote-mark" aria-hidden="true">&rdquo;</span>
                        {{ $messageContenu }}
                    </p>
                    <div class="msg-author-name">{{ $messageNom }}</div>
                    <div class="msg-author-role">{{ $messageRole }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ CHIFFRES CLÉS ══ --}}
<section class="section-pad bg-light">
    <h2 class="sec-h">Chiffres Clés</h2>
    <div class="sec-bar"></div>
    <div class="chiffres-grid">
        @foreach ($chiffres as $c)
        <div class="chiffre-card">
            <svg viewBox="0 0 24 24" aria-hidden="true">{!! $c['icon'] !!}</svg>
            <span class="chiffre-num">{{ $c['valeur'] }}</span>
            <div class="chiffre-lbl">{{ $c['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ APPEL + INSCRIPTION ══ --}}
<section class="section-pad">
    <div class="two-col-appel">
        <div class="appel-card">
            <div class="card-title">Appel à Participation</div>
            <div class="card-bar"></div>
            <p class="appel-desc">Devenez exposant, partenaire, sponsor ou intervenant et participez activement à la réussite du Forum.</p>
            <div class="roles-row">
                @foreach ($appels as $a)
                <div class="role-box">
                    <div class="role-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.7" aria-hidden="true">{!! $a['icon'] !!}</svg>
                    </div>
                    <div class="role-lbl">{{ $a['label'] }}</div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('inscription.formulaire') }}" class="btn-appel">
                Soumettre une candidature
                <svg viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </a>

        </div>

        <div class="inscr-card">
            <div class="inscr-form">
                <div class="card-title" style="color:#0d1b3e">Inscription</div>
                <div class="card-bar"></div>
                <p class="inscr-sub">Réservez votre place dès maintenant !</p>
                @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('inscription.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="inscr-field">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <input type="text" name="nom_complet" placeholder="Nom complet" value="{{ old('nom_complet') }}" required autocomplete="name">
                    </div>
                    @error('nom_complet')<span style="color:#e53e3e;font-size:11px;display:block;margin:-6px 0 6px">{{ $message }}</span>@enderror
                    <div class="inscr-field">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')<span style="color:#e53e3e;font-size:11px;display:block;margin:-6px 0 6px">{{ $message }}</span>@enderror
                    <div class="inscr-field">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <input type="text" name="organisation" placeholder="Organisation / Entreprise" value="{{ old('organisation') }}">
                    </div>
                    <button type="submit" class="btn-inscr-form">
                        S'inscrire maintenant
                        <svg viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
                        </svg>
                    </button>
                </form>
            </div>
            {{-- ✅ ins.png --}}
            <div class="inscr-illus" aria-hidden="true">
                <img src="{{ asset('images/ins.png') }}" alt="Badge inscription Forum 2026">
            </div>
        </div>
    </div>
</section>

{{-- ══ ACTUALITÉS + VIDÉOS ══ --}}
<section class="section-pad bg-light">
    <div class="two-col-content">

        {{-- Actualités --}}
        <div>
            <div class="sec-header-row">
                <h2 class="sec-h">Actualités</h2>
                <a href="{{ route('actualites') }}">
                    Voir toutes les actualités
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="actu-list">
                @foreach ($actualites as $actu)
                <a href="{{ route('actualites.show', $actu['slug']) }}" class="actu-card">
                    <div class="actu-thumb">
                        {{-- ✅ Vos vraies images : Cooo.jpg, Ctr.jpg, CGFjpg.jpg --}}
                        <img src="{{ asset('images/'.$actu['image']) }}" alt="{{ $actu['titre'] }}" loading="lazy">
                        <div class="actu-date-tag">
                            <span class="day">{{ explode(' ', $actu['date'])[0] }}</span>
                            {{ explode(' ', $actu['date'])[1] ?? '' }}
                        </div>
                    </div>
                    <div class="actu-body">
                        <div class="actu-title">{{ $actu['titre'] }}</div>
                        <div class="actu-excerpt">{{ $actu['resume'] }}</div>
                        <span class="actu-link">
                            Lire la suite
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Vidéos --}}
        <div>
            <div class="sec-header-row">
                <h2 class="sec-h">Vidéos Promotionnelles &amp; Teasers</h2>
                <a href="{{ route('galerie') }}">
                    Voir toutes les vidéos
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="videos-grid">
                @foreach ($videos as $vid)
                <div class="video-item">
                    {{-- ✅ Thumbnails : bo.jpg, boaa.jpg, son.jpg --}}
                    <img src="{{ asset('images/'.$vid['thumbnail']) }}" alt="{{ $vid['titre'] }}" loading="lazy">
                    <div class="video-item-overlay">
                        <div class="vid-play-btn">
                            <svg viewBox="0 0 24 24">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg>
                        </div>
                    </div>
                    <div class="video-item-label">
                        <p>{{ $vid['titre'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- ══ PARTENAIRES ══ --}}
<section class="section-pad">
    <h2 class="sec-h">Nos Partenaires</h2>
    <div class="sec-bar"></div>
    <div class="partners-wrap">
        <button class="scroll-btn" onclick="document.getElementById('partners-row').scrollBy(-240,0)" aria-label="Précédent">
            <svg viewBox="0 0 24 24">
                <path d="M15 18l-6-6 6-6" />
            </svg>
        </button>
        <div class="partners-scroll" id="partners-row" role="list">
            @foreach ($partenaires as $p)
            <div class="partner-logo-box" role="listitem">
                {{-- ✅ Vos vrais logos : Pnp.jpg, ba.jpg, ue.png, etc. --}}
                @if ($p['logo'])
                <img src="{{ asset('images/'.$p['logo']) }}" alt="{{ $p['nom'] }}" loading="lazy">
                @else
                <span>{{ $p['nom'] }}</span>
                @endif
            </div>
            @endforeach
        </div>
        <button class="scroll-btn" onclick="document.getElementById('partners-row').scrollBy(240,0)" aria-label="Suivant">
            <svg viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6" />
            </svg>
        </button>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('heroVideo');
        const playBtn = document.getElementById('playBtn');
        const captionBtn = document.getElementById('captionBtn');

        // Fonction pour basculer entre Play et Pause
        function toggleVideo() {
            if (video.paused) {
                video.play();
                // Optionnel : Masquer le bouton play quand la vidéo tourne
                playBtn.style.opacity = '0';
            } else {
                video.pause();
                // Optionnel : Réafficher le bouton play quand la vidéo est en pause
                playBtn.style.opacity = '1';
            }
        }

        // Activer le clic sur le bouton Play central
        playBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Évite les doubles clics conflictuels
            toggleVideo();
        });

        // Activer le clic sur toute la zone de la vidéo
        video.addEventListener('click', toggleVideo);

        // Activer le clic sur le texte "Voir la vidéo officielle" en bas
        captionBtn.addEventListener('click', toggleVideo);
    });
</script>


{{-- ══ FOOTER ══ --}}
<footer class="site-footer">
    <div class="footer-grid">
        <div class="fb-brand">
            <a href="{{ route('index') }}" class="nav-logo" style="margin-bottom:.5rem">
                <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                    <img src="http://127.0.0.1:8000/images/264.png"
                        alt="Logo JEFIE Paris 2026"
                        style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                </div>
                <div class="nav-logo-text" style="color:#fff"><span>JEFIE</span><small>Paris 2026</small></div>
            </a>
            <p>Plateforme de référence pour promouvoir l'innovation, la collaboration et le développement durable en Afrique et dans le monde.</p>
            <nav class="socials">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="Twitter">&#120143;</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Liens Rapides</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('Apropos') }}">À propos</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('actualites') }}">Actualités</a>
            <a href="#">Appels</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="fc">
            <h4>Informations</h4>
            <div class="fci"><svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>15 - 17 Juin 2026</div>
            <div class="fci"><svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>Palais des Congrès,<br>Abidjan, Côte d'Ivoire</div>
            <div class="fci"><svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>contact@forum-innovation.org</div>
            <div class="fci"><svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81" />
                </svg>+225 01 23 45 67 89</div>
        </div>
        <div class="fc">
            <h4>Newsletter</h4>
            <p style="font-size:12px;color:rgba(255,255,255,.6);line-height:1.55;margin-bottom:0">Inscrivez-vous pour recevoir nos actualités.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <div class="footer-nl">
                    <input type="email" name="email_newsletter" placeholder="Votre email" required>
                    <button type="submit">S'abonner</button>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} CDC site. Tous droits réservés.</span>
        <div class="footer-legal-links">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Politique de confidentialité</a>
        </div>
    </div>
</footer>

@endsection