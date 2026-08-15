{{-- resources/views/forum/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Forum de discussion — Forum International de l\'Innovation 2026')

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
        text-decoration: none;
        transition: background .2s;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-inscr {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 22px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .btn-inscr:hover {
        opacity: .9;
    }

    .btn-inscr svg {
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

    /* ── HERO ── */
    .hero {
        background: linear-gradient(108deg, rgba(6, 14, 32, 0.90) 0%, rgba(13, 27, 62, 0.85) 55%, rgba(15, 42, 94, 0.85) 100%),
        url("{{ asset('images/div.png') }}") no-repeat center center/cover;
        padding: 3rem 2.5rem 2.75rem;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        right: -80px;
        top: -80px;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(245, 166, 35, .05);
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .hero-left {
        max-width: 500px;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(245, 166, 35, .12);
        border: 1px solid rgba(245, 166, 35, .3);
        color: #f5a623;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 3px;
        margin-bottom: 1rem;
    }

    .hero-eyebrow svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .hero h1 {
        color: #fff;
        font-size: 2.4rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -.02em;
        line-height: 1.05;
        margin-bottom: .5rem;
    }

    .hero h1 span {
        color: #f5a623;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .9rem;
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .hero-actions {
        display: flex;
        gap: 10px;
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
        gap: 7px;
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background .2s;
    }

    .btn-outline-w:hover {
        background: rgba(255, 255, 255, .08);
    }

    /* Stats hero */
    .hero-stats {
        display: flex;
        gap: 1.25rem;
        flex-wrap: wrap;
    }

    .hstat {
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 10px;
        padding: .85rem 1.25rem;
        text-align: center;
        min-width: 90px;
    }

    .hstat-num {
        font-size: 1.4rem;
        font-weight: 900;
        color: #fff;
        display: block;
    }

    .hstat-lbl {
        font-size: 10px;
        color: rgba(255, 255, 255, .55);
        margin-top: 2px;
    }

    /* ── LAYOUT PAGE ── */
    .page-layout {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 2rem;
        padding: 2rem 2.5rem;
        max-width: 1440px;
        margin: 0 auto;
        align-items: start;
    }

    /* ── CATÉGORIES ── */
    .main-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 12px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5a623;
        padding-left: 10px;
    }

    .section-link {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .section-link svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Grille catégories */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1px;
        background: #e2e8f0;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .cat-card {
        background: #fff;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: background .15s;
    }

    .cat-card:hover {
        background: #f8fafc;
    }

    .cat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cat-icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .cat-body {
        flex: 1;
        min-width: 0;
    }

    .cat-nom {
        font-size: 14px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 3px;
    }

    .cat-desc {
        font-size: 11px;
        color: #718096;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .cat-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
        flex-shrink: 0;
    }

    .cat-count {
        font-size: 11px;
        font-weight: 700;
        color: #162552;
    }

    .cat-count span {
        font-weight: 400;
        color: #a0aec0;
    }

    .cat-arrow {
        width: 28px;
        height: 28px;
        background: #f4f6fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cat-arrow svg {
        width: 13px;
        height: 13px;
        stroke: #718096;
        fill: none;
        stroke-width: 2;
    }

    /* Sujets récents */
    .sujets-recents {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .sr-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f0f4f8;
        text-decoration: none;
        transition: background .15s;
    }

    .sr-item:last-child {
        border-bottom: none;
    }

    .sr-item:hover {
        background: #f8fafc;
    }

    .sr-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d1b3e, #162552);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f5a623;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
        overflow: hidden;
    }

    .sr-avatar img {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
    }

    .sr-body {
        flex: 1;
        min-width: 0;
    }

    .sr-titre {
        font-size: 13px;
        font-weight: 600;
        color: #162552;
        line-height: 1.35;
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sr-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        color: #a0aec0;
    }

    .sr-cat-badge {
        font-size: 9px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 3px;
    }

    .sr-stats {
        display: flex;
        gap: 6px;
        align-items: center;
        flex-shrink: 0;
    }

    .sr-stat {
        display: flex;
        align-items: center;
        gap: 3px;
        font-size: 11px;
        color: #a0aec0;
    }

    .sr-stat svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    /* Badges sujet */
    .badge-epingle {
        background: #fff8e6;
        color: #b07d10;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 3px;
        text-transform: uppercase;
    }

    .badge-resolu {
        background: #e8f5e9;
        color: #2e7d32;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 3px;
    }

    .badge-verrou {
        background: #fce4ec;
        color: #c2185b;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 3px;
    }

    /* ── SIDEBAR ── */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        position: sticky;
        top: 80px;
    }

    .sw-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .sw-title {
        font-size: 11px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: .9rem;
    }

    /* Nouveau sujet card */
    .nouveau-card {
        background: linear-gradient(135deg, #0d1b3e, #162552);
        border-radius: 12px;
        padding: 1.4rem;
    }

    .nc-icon {
        width: 44px;
        height: 44px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .85rem;
    }

    .nc-icon svg {
        width: 22px;
        height: 22px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
    }

    .nc-title {
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .nc-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 11px;
        line-height: 1.5;
        margin-bottom: 14px;
    }

    .nc-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .nc-btn:hover {
        opacity: .9;
    }

    .nc-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Stats sidebar */
    .stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .stat-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: .75rem;
        text-align: center;
    }

    .stat-num {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0d1b3e;
        display: block;
    }

    .stat-lbl {
        font-size: 10px;
        color: #718096;
        margin-top: 2px;
    }

    .online-dot {
        display: inline-block;
        width: 7px;
        height: 7px;
        background: #2e7d32;
        border-radius: 50%;
        margin-right: 4px;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .5
        }
    }

    /* Membres actifs */
    .member-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .member-row:last-child {
        border-bottom: none;
    }

    .m-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d1b3e, #162552);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f5a623;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .m-name {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        flex: 1;
    }

    .m-posts {
        font-size: 10px;
        color: #a0aec0;
    }

    /* Règles */
    .regle-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: 12px;
        color: #4a5568;
        line-height: 1.45;
    }

    .regle-item:last-child {
        border-bottom: none;
    }

    .regle-num {
        width: 20px;
        height: 20px;
        background: #0d1b3e;
        color: #f5a623;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0d1b3e;
        color: rgba(255, 255, 255, .7);
        padding: 2rem 2.5rem 0;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: .85rem 0;
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

    .footer-links {
        display: flex;
        gap: 1rem;
    }

    .footer-links a {
        font-size: 11px;
        color: rgba(255, 255, 255, .4);
        text-decoration: none;
    }

    .footer-links a:hover {
        color: rgba(255, 255, 255, .7);
    }

    .footer-main {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 2rem;
        padding-bottom: 2rem;
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

    @media (max-width:1100px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .sidebar {
            position: static;
        }

        .categories-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .hero h1 {
            font-size: 1.9rem;
        }

        .hero-inner {
            flex-direction: column;
        }

        .footer-main {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:480px) {
        .hero-stats {
            flex-direction: column;
        }

        .stat-grid {
            grid-template-columns: 1fr 1fr;
        }

        .footer-main {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')

{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-left">
            <div class="hero-eyebrow">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                </svg>
                Communauté & Échanges
            </div>
            <h1>Forum de <span>Discussion</span></h1>
            <p class="hero-desc">
                Échangez avec les entrepreneurs, décideurs et innovateurs de la diaspora africaine.
                Posez vos questions, partagez vos expériences et construisons ensemble.
            </p>
            <div class="hero-actions">
                @auth
                <a href="{{ route('forum.creer') }}" class="btn-gold">
                    <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Créer un sujet
                </a>
                @else
                <a href="{{ route('login') }}" class="btn-gold">
                    <svg viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                    </svg>
                    Se connecter pour participer
                </a>
                @endauth
                <a href="{{ route('Faq') }}" class="btn-outline-w">Voir la FAQ</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="hstat">
                <span class="hstat-num">{{ number_format($stats['sujets']) }}</span>
                <div class="hstat-lbl">Sujets</div>
            </div>
            <div class="hstat">
                <span class="hstat-num">{{ number_format($stats['reponses']) }}</span>
                <div class="hstat-lbl">Réponses</div>
            </div>
            <div class="hstat">
                <span class="hstat-num">{{ number_format($stats['membres']) }}</span>
                <div class="hstat-lbl">Membres</div>
            </div>
            <div class="hstat">
                <span class="hstat-num" style="color:#4caf50">
                    <span class="online-dot"></span>{{ $stats['en_ligne'] }}
                </span>
                <div class="hstat-lbl">En ligne</div>
            </div>
        </div>
    </div>
</section>

{{-- ══ PAGE LAYOUT ══ --}}
<div class="page-layout">

    {{-- ── MAIN ── --}}
    <main class="main-content">

        {{-- Flash message --}}
        @if (session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;border-radius:8px;padding:12px 16px;font-size:13px;display:flex;align-items:center;gap:8px">
            <svg width="16" height="16" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Catégories --}}
        <div>
            <div class="section-header">
                <h2 class="section-title">Catégories de discussion</h2>
            </div>
            <div class="categories-grid">
                @forelse ($categories as $cat)
                <a href="{{ route('forum.categorie', $cat->slug) }}" class="cat-card">
                    <div class="cat-icon" style="background:<?php echo $cat->couleur . '18'; ?>;color:<?php echo $cat->couleur; ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                        </svg>
                    </div>
                    <div class="cat-body">
                        <div class="cat-nom">{{ $cat->nom }}</div>
                        <div class="cat-desc">{{ $cat->description }}</div>
                    </div>
                    <div class="cat-meta">
                        <div class="cat-count">{{ number_format($cat->sujets_count) }} <span>sujets</span></div>
                        <div class="cat-count">{{ number_format($cat->reponses_count) }} <span>rép.</span></div>
                        <div class="cat-arrow">
                            <svg viewBox="0 0 24 24">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg>
                        </div>
                    </div>
                </a>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:2rem;color:#a0aec0;font-size:13px">
                    Aucune catégorie disponible. Exécutez : <code>php artisan db:seed --class=ForumSeeder</code>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Sujets récents --}}
        <div>
            <div class="section-header">
                <h2 class="section-title">Discussions récentes</h2>
                <a href="{{ route('forum.categorie', 'annonces') }}" class="section-link">
                    Voir tout
                    <svg viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            </div>
            <div class="sujets-recents">
                @forelse ($sujetsRecents as $sujet)
                <a href="{{ route('forum.sujet', [$sujet->categorie->slug ?? 'general', $sujet->slug]) }}" class="sr-item">
                    <div class="sr-avatar">
                        @if ($sujet->user?->photo)
                        <img src="{{ asset('storage/'.$sujet->user->photo) }}" alt="{{ $sujet->user->name }}">
                        @else
                        {{ strtoupper(substr($sujet->user?->name ?? 'A', 0, 1)) }}
                        @endif
                    </div>
                    <div class="sr-body">
                        <div style="display:flex;align-items:center;gap:6px;margin-bottom:3px;flex-wrap:wrap">
                            @if ($sujet->epingle) <span class="badge-epingle">📌 Épinglé</span> @endif
                            @if ($sujet->resolu) <span class="badge-resolu">✓ Résolu</span> @endif
                            @if ($sujet->verrouille)<span class="badge-verrou">🔒 Verrouillé</span> @endif
                            @if ($sujet->categorie)
                            <span class="sr-cat-badge" style="background:<?php echo $sujet->categorie->couleur . '15'; ?>;color:<?php echo $sujet->categorie->couleur; ?>">
                                {{ $sujet->categorie->nom }}
                            </span>
                            @endif
                        </div>
                        <div class="sr-titre">{{ $sujet->titre }}</div>
                        <div class="sr-meta">
                            <span>{{ $sujet->user?->name ?? 'Anonyme' }}</span>
                            <span>·</span>
                            <span>{{ $sujet->created_at?->diffForHumans() }}</span>
                            @if ($sujet->derniereReponse)
                            <span>·</span>
                            <span>Dernière réponse : {{ $sujet->derniereReponse->created_at?->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sr-stats">
                        <div class="sr-stat">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                            </svg>
                            {{ $sujet->nb_reponses }}
                        </div>
                        <div class="sr-stat">
                            <svg viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            {{ number_format($sujet->vues) }}
                        </div>
                    </div>
                </a>
                @empty
                <div style="text-align:center;padding:2rem;color:#a0aec0;font-size:13px">
                    Aucune discussion pour le moment. Soyez le premier à créer un sujet !
                </div>
                @endforelse
            </div>
        </div>

    </main>

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">

        {{-- Nouveau sujet --}}
        <div class="nouveau-card">
            <div class="nc-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                </svg>
            </div>
            <div class="nc-title">Participez à la discussion</div>
            <p class="nc-desc">Posez vos questions ou partagez vos expériences avec la communauté.</p>
            @auth
            <a href="{{ route('forum.creer') }}" class="nc-btn">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Créer un nouveau sujet
            </a>
            @else
            <a href="{{ route('login') }}" class="nc-btn">
                <svg viewBox="0 0 24 24">
                    <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                </svg>
                Se connecter pour participer
            </a>
            @endauth
        </div>

        {{-- Statistiques --}}
        <div class="sw-card">
            <div class="sw-title">Statistiques du forum</div>
            <div class="stat-grid">
                <div class="stat-box">
                    <span class="stat-num">{{ number_format($stats['sujets']) }}</span>
                    <div class="stat-lbl">Discussions</div>
                </div>
                <div class="stat-box">
                    <span class="stat-num">{{ number_format($stats['reponses']) }}</span>
                    <div class="stat-lbl">Réponses</div>
                </div>
                <div class="stat-box">
                    <span class="stat-num">{{ number_format($stats['membres']) }}</span>
                    <div class="stat-lbl">Membres</div>
                </div>
                <div class="stat-box">
                    <span class="stat-num" style="color:#2e7d32">
                        <span class="online-dot"></span>{{ $stats['en_ligne'] }}
                    </span>
                    <div class="stat-lbl">En ligne</div>
                </div>
            </div>
        </div>

        {{-- Catégories rapides --}}
        <div class="sw-card">
            <div class="sw-title">Catégories</div>
            @foreach ($categories->take(6) as $cat)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:7px 0;border-bottom:1px solid #f0f4f8">
                <a href="{{ route('forum.categorie', $cat->slug) }}"
                    style="font-size:12px;font-weight:600;color:#162552;text-decoration:none;display:flex;align-items:center;gap:7px;transition:color .2s">
                    <span style="width:8px;height:8px;border-radius:50%;background:<?php echo $cat->couleur; ?>;flex-shrink:0"></span>
                    {{ $cat->nom }}
                </a>
                <span style="font-size:10px;color:#a0aec0;font-weight:600">{{ $cat->sujets_count }}</span>
            </div>
            @endforeach
        </div>

        {{-- Règles du forum --}}
        <div class="sw-card">
            <div class="sw-title">Règles du forum</div>
            @foreach ([
            'Respectez les autres membres en tout temps.',
            'Publiez dans la bonne catégorie.',
            'Pas de spam ni de contenu hors sujet.',
            'Sourcez vos informations importantes.',
            'Utilisez la recherche avant de poster.',
            ] as $i => $regle)
            <div class="regle-item">
                <div class="regle-num">{{ $i + 1 }}</div>
                <span>{{ $regle }}</span>
            </div>
            @endforeach
        </div>

    </aside>
</div>{{-- /.page-layout --}}

{{-- ══ FOOTER ══ --}}
<footer class="site-footer">
    <div class="footer-main">
        <div class="fb">
            <a href="{{ route('index') }}" class="nav-logo" style="margin-bottom:.4rem">
                <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                    <img src="http://127.0.0.1:8000/images/264.png"
                        alt="Logo JEFIE Paris 2026"
                        style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                </div>
                <div class="nav-logo-text" style="color:#fff"><span>Forum International</span>de l'Innovation<br><small>2026</small></div>
            </a>
            <p>Communauté de discussion du Forum International de l'Innovation 2026.</p>
            <nav class="socials">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="Twitter">&#120143;</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Navigation</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="fc">
            <h4>Forum</h4>
            @foreach ($categories->take(5) as $cat)
            <a href="{{ route('forum.categorie', $cat->slug) }}">{{ $cat->nom }}</a>
            @endforeach
        </div>
        <div class="fc">
            <h4>Aide</h4>
            <a href="{{ route('Faq') }}">FAQ</a>
            <a href="{{ route('contact') }}">Support</a>
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Confidentialité</a>
            <a href="{{ route('conditions') }}">CGU</a>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} Forum International de l'Innovation. Tous droits réservés.</span>
        <div class="footer-links">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Confidentialité</a>
        </div>
    </div>
</footer>

@endsection