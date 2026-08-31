{{-- resources/views/entrepreneurs/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'JEFIE PARIS 2026')

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
        background: #0f284e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.75rem;
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
        border: 2px solid #f5c518;
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
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5c518;
        font-size: 9px;
        font-weight: 700;
    }

    .nav-links {
        display: flex;
        gap: 1.3rem;
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
        border-bottom: 2px solid #f5c518;
        padding-bottom: 2px;
        font-weight: 600;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
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

    .nav-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        transition: opacity .2s;
    }

    .nav-btn:hover {
        opacity: .9;
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

    /* ── PAGE LAYOUT 3 colonnes ── */
    .page-layout {
        display: grid;
        grid-template-columns: 215px 1fr 290px;
        min-height: calc(100vh - 64px);
    }

    /* ══════════════════════════════════
   SIDEBAR GAUCHE
══════════════════════════════════ */
    .left-sidebar {
        background: #0f284e;
        border-right: 1px solid #fff;
        padding: 1.25rem 0;
        display: flex;
        flex-direction: column;
    }

    .ls-header {
        padding: .75rem 1.25rem 1rem;
    }

    .ls-header-title {
        font-size: 11px;
        font-weight: 900;
        color: #f5c518;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .ls-header-sub {
        font-size: 12px;
        font-weight: 800;
        color: #f5c518;
        letter-spacing: .05em;
    }

    .ls-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 1.25rem;
        font-size: 13px;
        color: #4a5568;
        text-decoration: none;
        transition: background .15s, color .15s;
        border-left: 3px solid transparent;
        position: relative;
    }

    .ls-item:hover {
        background: #f4f6fa;
        color: #0f284e;
    }

    .ls-item.active {
        background: rgba(245, 166, 35, .1);
        color: #fff;

        font-weight: 700;
        border-left-color: #f5c518;
    }

    .ls-item svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .ls-item.active svg {
        stroke: #f5c518;
    }

    .ls-badge-count {
        margin-left: auto;
        background: #f5c518;
        color: #0f284e;
        font-size: 10px;
        font-weight: 800;
        min-width: 18px;
        height: 18px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
    }

    .ls-sep {
        height: 1px;
        background: #f0f4f8;
        margin: .75rem 1.25rem;
    }

    .ls-section-label {
        font-size: 10px;
        font-weight: 800;
        color: #a0aec0;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: .4rem 1.25rem .25rem;
    }

    .ls-community {
        margin: auto 1.25rem 1.25rem;
        background: #0a2156ff;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
    }

    .ls-community-icon {
        width: 36px;
        height: 36px;
        margin: 0 auto .5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ls-community-icon svg {
        width: 32px;
        height: 32px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.5;
    }

    .ls-community strong {
        color: #fff;
        display: block;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .ls-community p {
        color: rgba(255, 255, 255, .65);
        font-size: 11px;
        line-height: 1.5;
        margin-bottom: 10px;
    }

    .ls-community-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 11px;
        padding: 8px 12px;
        border-radius: 5px;
        width: 100%;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: opacity .2s;
    }

    .ls-community-btn:hover {
        opacity: .9;
    }

    /* ══════════════════════════════════
   CONTENU CENTRAL
══════════════════════════════════ */
    .main-content {
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }


    /* HERO BANNER */
    .hero-banner {
        background: linear-gradient(108deg, #060e20 0%, #0f284e 45%, rgba(15, 40, 78, 0.75) 75%, rgba(15, 42, 94, 0.4) 100%),
            url('/images/dov.png');
        padding: 4rem 2.5rem 3.5rem;
        overflow: hidden;
        margin-bottom: 20px;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 1rem;
        min-height: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    /* Carte monde SVG en fond côté droit */
    .hero-banner::before {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 65%;
        height: 100%;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        pointer-events: none;
        z-index: 0;
    }

    /* Silhouette Afrique/Gabon décorative */
    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: 15px;
        right: 140px;
        width: 60px;
        height: 60px;
        background-repeat: no-repeat;
        background-size: contain;
        pointer-events: none;
        z-index: 1;
        opacity: .7;
    }

    /* Texte gauche */
    .hero-left {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        color: #fff;
        font-size: 2.6rem;
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.05;
        letter-spacing: -.02em;
        margin-bottom: .6rem;
    }

    .hero-title span {
        color: #f5c518;
        display: block;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .68);
        font-size: 13px;
        line-height: 1.65;
        margin-bottom: 1.4rem;
        max-width: 360px;
    }

    .hero-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 22px;
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
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-outline-w {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border-radius: 5px;
        border: 1.5px solid rgba(255, 255, 255, .4);
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background .2s;
    }

    .btn-outline-w:hover {
        background: rgba(255, 255, 255, .1);
    }

    /* Stats à droite */
    .hero-stats {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        /* Aligne les cartes collées les unes aux autres */
        /* Réduit l'espace horizontal (passez de 1rem à 0.5rem ou 0.3rem selon l'effet souhaité) */
        margin-top: 1.5rem;

    }


    .hstat {
        background: rgba(151, 24, 24, 0.07);
        border: 1px solid rgba(255, 255, 255, .11);
        border-radius: 9px;
        padding: .65rem 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 175px;
        backdrop-filter: blur(4px);
    }

    .hstat-icon {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hstat-icon svg {
        width: 16px;
        height: 16px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .hstat-num {
        font-size: 1rem;
        font-weight: 900;
        color: #0f284e;
        display: block;
        line-height: 1;
    }

    .hstat-lbl {
        font-size: 10px;
        color: #0f284e;
        margin-top: 2px;
    }

    /* Pins animés */
    .hero-pin {
        position: absolute;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: pinFloat 3s ease-in-out infinite;
    }

    .hero-pin:nth-child(2) {
        animation-delay: 1s;
    }

    @keyframes pinFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .hero-pin svg {
        width: 20px;
        height: 20px;
        fill: #f5c518;
    }

    .hero-pin-pulse {
        width: 8px;
        height: 8px;
        background: rgba(245, 166, 35, .5);
        border-radius: 50%;
        animation: ripple 1.6s infinite;
    }

    @keyframes ripple {
        0% {
            transform: scale(1);
            opacity: .7;
        }

        100% {
            transform: scale(3);
            opacity: 0;
        }
    }

    @media (max-width:900px) {
        .hero-banner {
            grid-template-columns: 1fr;
        }

        .hero-stats {
            align-items: flex-start;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .hstat {
            min-width: 140px;
        }

        .hero-banner::after {
            display: none;
        }
    }

    /* Section headers */
    .content-pad {
        padding: 1.75rem 2rem;
    }

    .sec-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .sec-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5c518;
        padding-left: 10px;
    }

    .sec-link {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color .2s;
        white-space: nowrap;
    }

    .sec-link:hover {
        color: #f5c518;
    }

    .sec-link svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* RECHERCHE */
    .search-bar {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.1rem 1.25rem;
        margin-bottom: 1.75rem;
    }

    .search-bar-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f284e;
        margin-bottom: .75rem;
    }

    .search-filters {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr auto;
        gap: 10px;
        align-items: end;
    }

    .sf-group label {
        font-size: 11px;
        font-weight: 600;
        color: #718096;
        display: block;
        margin-bottom: 4px;
    }

    .sf-select {
        width: 100%;
        padding: 8px 28px 8px 10px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        color: #1a2744;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 14px;
        cursor: pointer;
    }

    .search-btn {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
        transition: background .2s;
    }

    .search-btn:hover {
        background: #0a1e38;
    }

    .search-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .search-avancee {
        font-size: 12px;
        color: #718096;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* ENTREPRENEURS GRID */
    .ent-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .ent-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: box-shadow .2s;
    }

    .ent-card:hover {
        box-shadow: 0 2px 12px rgba(15, 40, 78, .08);
    }

    .ent-card-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ent-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        flex-shrink: 0;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ent-avatar img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
    }

    .ent-avatar-init {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
    }

    .ent-name {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
        line-height: 1.3;
    }

    .ent-company {
        font-size: 11px;
        color: #718096;
    }

    .ent-sector {
        display: inline-block;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
        width: fit-content;
    }

    .sector-tech {
        background: #e3f2fd;
        color: #0f284e;
    }

    .sector-agri {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .sector-conseil {
        background: #ede7f6;
        color: #6a1b9a;
    }

    .sector-commerce {
        background: #fff3e0;
        color: #f5c518;
    }

    .ent-meta {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .ent-meta-row {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #718096;
    }

    .ent-meta-row svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .ent-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 2px;
    }

    .ent-profile-btn {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 5px 10px;
        transition: all .2s;
    }

    .ent-profile-btn:hover {
        background: #0f284e;
        color: #fff;
        border-color: #0f284e;
    }

    .ent-profile-btn svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .fav-btn {
        width: 28px;
        height: 28px;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #fff;
        transition: all .2s;
        flex-shrink: 0;
    }

    .fav-btn:hover {
        border-color: #f5c518;
    }

    .fav-btn svg {
        width: 13px;
        height: 13px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 2;
    }

    /* BOTTOM GRID 3 colonnes */
    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 1.25rem;
    }

    /* Opportunités */
    .opp-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;

    }

    .opp-item:last-child {
        border-bottom: none;
    }

    .opp-icon {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .opp-icon.part {
        background: #e3f2fd;
    }

    .opp-icon.part svg {
        stroke: #0f284e;
    }

    .opp-icon.inv {
        background: #e8f5e9;
    }

    .opp-icon.inv svg {
        stroke: #2e7d32;
    }

    .opp-icon.coop {
        background: #fff3e0;
    }

    .opp-icon.coop svg {
        stroke: #f5c518;
    }

    .opp-icon svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .opp-type {
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #718096;
    }

    .opp-title {
        font-size: 12px;
        font-weight: 600;
        color: #0a1e38;
        line-height: 1.35;
    }

    .opp-company {
        font-size: 11px;
        color: #a0aec0;
    }

    .opp-date {
        font-size: 10px;
        color: #a0aec0;
        margin-left: auto;
        flex-shrink: 0;
        white-space: nowrap;
        padding-top: 2px;
    }

    /* Forum card */
    .forum-card {
        background: #0f284e;
        border-radius: 8px;
        padding: 1.25rem;
    }

    .forum-card-title {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .forum-card-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 11px;
        line-height: 1.55;
        margin-bottom: 12px;
    }

    .forum-checks {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-bottom: 14px;
    }

    .forum-check {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 11px;
        color: rgba(255, 255, 255, .8);
    }

    .forum-check svg {
        width: 13px;
        height: 13px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .forum-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .forum-btn:hover {
        opacity: .9;
    }

    .forum-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Rendez-vous */
    .rdv-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .rdv-item:last-child {
        border-bottom: none;
    }

    .rdv-date-box {
        width: 36px;
        height: 36px;
        background: #eef2ff;
        border-radius: 7px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .rdv-day {
        font-size: 13px;
        font-weight: 800;
        color: #0f284e;
        line-height: 1;
    }

    .rdv-month {
        font-size: 9px;
        font-weight: 700;
        color: #718096;
        text-transform: uppercase;
    }

    .rdv-title {
        font-size: 12px;
        font-weight: 600;
        color: #0a1e38;
        margin-bottom: 2px;
    }

    .rdv-loc {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #718096;
    }

    .rdv-loc svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    /* ══════════════════════════════════
   SIDEBAR DROITE
══════════════════════════════════ */
    .right-sidebar {
        background: #fff;
        border-left: 1px solid #e2e8f0;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        overflow-y: auto;
    }

    .rs-title {
        font-size: 11px;
        font-weight: 800;
        color: #0f284e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: .75rem;
    }

    .rs-row-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: .75rem;
        margin-top: 1.5rem;
        /* Ajustez cette valeur selon l'espace souhaité (ex: 1rem, 2rem...) */
    }

    .rs-row-header .rs-title {
        margin-bottom: 0;

    }

    .rs-link {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .rs-link svg {
        width: 10px;
        height: 10px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Profil sidebar */
    .profil-card {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: .75rem;
    }

    .profil-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profil-avatar img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
    }

    .profil-name {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
    }

    .profil-role {
        font-size: 11px;
        color: #718096;
        margin: 2px 0;
    }

    .profil-loc {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #718096;
    }

    .profil-loc svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .profil-verified {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #2e7d32;
        font-weight: 600;
        margin-top: 4px;
    }

    .profil-verified svg {
        width: 13px;
        height: 13px;
        stroke: #2e7d32;
        fill: none;
        stroke-width: 2.5;
    }

    .progress-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 11px;
        color: #718096;
        margin-bottom: 5px;
    }

    .progress-label strong {
        color: #0f284e;
        font-weight: 700;
    }

    .progress-bar {
        height: 7px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #f5c518, #e09010);
        border-radius: 4px;
    }

    /* Infos clés */
    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 6px 0;
        margin-top: 1rem;
        /* Ajustez cette valeur selon l'espace souhaité (ex: 0.5rem, 1rem...) */
        border-bottom: 1px solid #f0f4f8;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row svg {
        width: 14px;
        height: 14px;
        stroke: #0a1e38;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .info-key {
        font-size: 11px;
        color: #718096;
        min-width: 85px;
        flex-shrink: 0;
    }

    .info-val {
        font-size: 11px;
        color: #0a1e38;
        font-weight: 600;
        line-height: 1.35;
    }

    .edit-link {
        font-size: 11px;
        color: #f5c518;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .edit-link svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Participation */
    .participation-ok {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        border-radius: 7px;
        padding: .75rem 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: .75rem;
        margin-top: 1.5rem;
        /* Ajustez cette valeur selon l'espace souhaité (ex: 1rem, 1.5rem, etc.) */
    }

    .participation-ok svg {
        width: 22px;
        height: 22px;
        stroke: #2e7d32;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .participation-ok .pc-title {
        font-size: 13px;
        font-weight: 700;
        color: #2e7d32;
    }

    .participation-ok .pc-sub {
        font-size: 11px;
        color: #4a5568;
    }

    .part-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: 12px;
    }

    .part-row:last-child {
        border-bottom: none;
    }

    .part-row-key {
        color: #718096;
    }

    .part-row-val {
        color: #0a1e38;
        font-weight: 600;
    }

    .part-row-val.ok {
        color: #2e7d32;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr 1fr 1fr;
        gap: 1.5rem;
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
        width: 28px;
        height: 28px;
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
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .6rem;
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
        align-items: center;
        gap: 7px;
        font-size: 12px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
    }

    .footer-nl-form {
        display: flex;
        gap: 6px;
        margin-top: 8px;
    }

    .footer-nl-form input {
        flex: 1;
        padding: 8px 10px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 4px;
        background: rgba(255, 255, 255, .07);
        color: #fff;
        font-size: 12px;
        outline: none;
    }

    .footer-nl-form input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .footer-nl-form button {
        background: #f5c518;
        border: none;
        border-radius: 4px;
        width: 36px;
        height: 36px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: opacity .2s;
    }

    .footer-nl-form button:hover {
        opacity: .9;
    }

    .footer-nl-form button svg {
        width: 14px;
        height: 14px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 2;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1rem 0;
        text-align: center;
        font-size: 11px;
        color: rgba(255, 255, 255, .35);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .page-layout {
            grid-template-columns: 215px 1fr;
        }

        .right-sidebar {
            display: none;
        }
    }

    @media (max-width: 900px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .left-sidebar {
            display: none;
        }

        .ent-grid {
            grid-template-columns: 1fr 1fr;
        }

        .bottom-grid {
            grid-template-columns: 1fr;
        }

        .search-filters {
            grid-template-columns: 1fr 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .ent-grid {
            grid-template-columns: 1fr;
        }

        .hero-stats {
            flex-direction: column;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


<div class="page-layout">

    {{-- ══ SIDEBAR GAUCHE ══ --}}
    <aside class="left-sidebar" aria-label="Menu espace entrepreneurs">
        <div class="ls-header">
            <div class="ls-header-title">Espace Entrepreneurs</div>
            <div class="ls-header-sub">Diaspora</div>
        </div>

        <a href="{{ route('entrepreneurs.dashboard') }}" class="ls-item active">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
            Tableau de bord
        </a>
        <a href="{{ route('entrepreneurs.profil') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Mon profil
        </a>
        <a href="{{ route('entrepreneurs.annuaire') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z" />
                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" />
            </svg>
            Annuaire des entrepreneurs
        </a>
        <a href="{{ route('entrepreneurs.opportunites') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
            </svg>
            Mes opportunités
        </a>
        <a href="{{ route('entrepreneurs.rendez-vous') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            Mes rendez-vous
        </a>
        <a href="{{ route('entrepreneurs.favoris') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
            </svg>
            Mes favoris
        </a>
        <a href="{{ route('entrepreneurs.messages') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
            </svg>
            Messages
            @if (isset($nbMessages) && $nbMessages > 0)
            <span class="ls-badge-count">{{ $nbMessages }}</span>
            @endif
        </a>
        <a href="{{ route('entrepreneurs.participation') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>
            Ma participation au Forum
        </a>

        <div class="ls-sep"></div>
        <div class="ls-section-label">Ressources</div>

        <a href="{{ route('entrepreneurs.guides') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            Guides &amp; outils
        </a>
        <a href="{{ route('entrepreneurs.financements') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <line x1="12" y1="1" x2="12" y2="23" />
                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
            </svg>
            Financements &amp; aides
        </a>
        <a href="{{ route('actualites') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a4 4 0 01-4-4V6a2 2 0 012-2" />
            </svg>
            Actualités Diaspora
        </a>
        <a href="{{ route('entrepreneurs.evenements') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 6v6l4 2" />
            </svg>
            Événements
        </a>

        {{-- Communauté --}}
        <div class="ls-community">
            <div class="ls-community-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
            </div>
            <strong>Rejoignez la communauté</strong>
            <p>Valorisons ensemble l'expertise gabonaise en Europe.</p>
            <a href="{{ route('entrepreneurs.inviter') }}" class="ls-community-btn">Inviter un entrepreneur</a>
        </div>
    </aside>

    {{-- ══ CONTENU CENTRAL ══ --}}
    <main class="main-content">

        {{-- HERO --}}
        <div class="hero-banner">
            <div class="hero-left">
                <h1 class="hero-title">
                    Espace Entrepreneurs<br>
                    <span>de la Diaspora Gabonaise</span>
                </h1>
                <p class="hero-desc">
                    Valorisez votre entreprise, développez votre réseau
                    et participez au Forum International de l'Innovation – Paris 2026.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('entrepreneurs.profil') }}" class="btn-gold">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                        Créer mon profil
                    </a>
                    <a href="{{ route('entrepreneurs.annuaire') }}" class="btn-outline-w">En savoir plus</a>
                </div>


            </div>
        </div>


        {{-- STATISTIQUES --}}
        <div class="hero-stats">

            @foreach ($heroStats as $s)

            @php
            $hstatBg = ($s['color'] ?? '#2563eb').'25';
            @endphp

            <div class="hstat">

                <div class="hstat-icon" style="background:{{ $hstatBg }}">

                    <svg viewBox="0 0 24 24">
                        {!! $s['icon'] !!}
                    </svg>

                </div>

                <div>

                    <div class="hstat-num">
                        {{ $s['valeur'] }}
                    </div>

                    <div class="hstat-lbl">
                        {{ $s['label'] }}
                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="content-pad">

            {{-- RECHERCHE --}}
            <div class="search-bar">
                <div class="sec-header" style="margin-bottom:.75rem">
                    <div class="search-bar-title">Rechercher un Entrepreneur</div>
                    <a href="{{ route('entrepreneurs.annuaire') }}" class="search-avancee">
                        Recherche avancée
                        <svg width="13" height="13" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                            <line x1="4" y1="6" x2="20" y2="6" />
                            <line x1="4" y1="12" x2="14" y2="12" />
                            <line x1="4" y1="18" x2="8" y2="18" />
                        </svg>
                    </a>
                </div>
                <form action="{{ route('entrepreneurs.annuaire') }}" method="GET">
                    <div class="search-filters">
                        <div class="sf-group">
                            <label for="secteur">Secteur d'activité</label>
                            <select id="secteur" name="secteur" class="sf-select">
                                <option value="">Tous les secteurs</option>
                                @foreach ($secteurs as $s)
                                <option value="{{ $s }}" {{ request('secteur') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sf-group">
                            <label for="pays">Pays</label>
                            <select id="pays" name="pays" class="sf-select">
                                <option value="">Tous les pays</option>
                                @foreach ($pays as $p)
                                <option value="{{ $p }}" {{ request('pays') === $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sf-group">
                            <label for="ville">Ville</label>
                            <select id="ville" name="ville" class="sf-select">
                                <option value="">Toutes les villes</option>
                                @foreach ($villes as $v)
                                <option value="{{ $v }}" {{ request('ville') === $v ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sf-group">
                            <label for="taille">Taille de l'entreprise</label>
                            <select id="taille" name="taille" class="sf-select">
                                <option value="">Toutes tailles</option>
                                @foreach ($tailles as $t)
                                <option value="{{ $t }}" {{ request('taille') === $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="search-btn">
                            <svg viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>

            {{-- ENTREPRENEURS À LA UNE --}}
            <div class="sec-header">
                <h2 class="sec-title">Entrepreneurs à la Une</h2>
                <a href="{{ route('entrepreneurs.annuaire') }}" class="sec-link">
                    Voir tout <svg viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="ent-grid">
                @forelse ($entrepreneursUne as $ent)
                <article class="ent-card">
                    <div class="ent-card-top">
                        <div class="ent-avatar">
                            @if ($ent->photo)
                            <img src="{{ asset('storage/' . $ent->photo) }}" alt="{{ $ent->nom_complet }}">
                            @else
                            <span class="ent-avatar-init">{{ strtoupper(substr($ent->nom_complet, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div>
                            <div class="ent-name">{{ $ent->nom_complet }}</div>
                            <div class="ent-company">{{ $ent->entreprise }}</div>
                        </div>
                    </div>
                    <span class="ent-sector sector-{{ $ent->secteur_css ?? 'tech' }}">
                        {{ $ent->secteur_activite }}
                    </span>
                    <div class="ent-meta">
                        <div class="ent-meta-row">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $ent->ville }}, {{ $ent->pays_residence }}
                        </div>
                        <div class="ent-meta-row">
                            <svg viewBox="0 0 24 24">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                            </svg>
                            CA : {{ $ent->chiffre_affaires }}
                        </div>
                        <div class="ent-meta-row">
                            <svg viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                            {{ $ent->taille_employes }} employés
                        </div>
                    </div>
                    <div class="ent-card-footer">
                        <a href="{{ route('entrepreneurs.show', $ent->slug) }}" class="ent-profile-btn">
                            Voir le profil
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                        <button class="fav-btn" aria-label="Ajouter aux favoris" type="button">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                            </svg>
                        </button>
                    </div>
                </article>
                @empty
                <p style="color:#718096;font-size:13px;grid-column:1/-1">Aucun entrepreneur à la une pour le moment.</p>
                @endforelse
            </div>

            {{-- BOTTOM GRID : Opps | Forum | Rendez-vous --}}
            <div class="bottom-grid">

                {{-- Opportunités récentes --}}
                <div>
                    <div class="sec-header">
                        <h2 class="sec-title">Opportunités Récentes</h2>
                        <a href="{{ route('entrepreneurs.opportunites') }}" class="sec-link">
                            Voir toutes <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @forelse ($opportunites as $opp)
                    <div class="opp-item">
                        <div class="opp-icon {{ $opp->type_css }}">
                            <svg viewBox="0 0 24 24">{!! $opp->icon_path !!}</svg>
                        </div>
                        <div style="flex:1;min-width:0">
                            <div class="opp-type">{{ $opp->type_label }}</div>
                            <div class="opp-title">{{ $opp->titre }}</div>
                            <div class="opp-company">{{ $opp->entreprise }}</div>
                        </div>
                        <div class="opp-date">{{ $opp->date->translatedFormat('d M Y') }}</div>
                    </div>
                    @empty
                    <p style="color:#718096;font-size:12px;padding:.5rem 0">Aucune opportunité disponible.</p>
                    @endforelse
                </div>

                {{-- Inscription Forum --}}
                <div>
                    <div class="sec-header">
                        <h2 class="sec-title">Inscription au Forum</h2>
                    </div>
                    <div class="forum-card">
                        <div class="forum-card-title">Participez au Forum</div>
                        <div class="forum-card-desc">
                            Développez votre réseau, présentez vos projets et saisissez de nouvelles opportunités.
                        </div>
                        <div class="forum-checks">
                            @foreach (['Participant', 'Exposant', 'Investisseur', 'Speaker'] as $role)
                            <div class="forum-check">
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                {{ $role }}
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('inscription') }}" class="forum-btn">
                            <svg viewBox="0 0 24 24">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
                            </svg>
                            Je m'inscris au Forum
                        </a>
                    </div>
                </div>

                {{-- Prochains Rendez-vous --}}
                <div>
                    <div class="sec-header">
                        <h2 class="sec-title">Prochains Rendez-vous</h2>
                        <a href="{{ route('entrepreneurs.rendez-vous') }}" class="sec-link">
                            Voir mon agenda <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @forelse ($rendezvous as $rdv)
                    <div class="rdv-item">
                        <div class="rdv-date-box">
                            <span class="rdv-day">{{ $rdv->date->format('d') }}</span>
                            <span class="rdv-month">{{ $rdv->date->translatedFormat('M') }}</span>
                        </div>
                        <div>
                            <div class="rdv-title">{{ $rdv->titre }}</div>
                            <div class="rdv-loc">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                {{ $rdv->lieu }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="color:#718096;font-size:12px;padding:.5rem 0">Aucun rendez-vous planifié.</p>
                    @endforelse
                </div>

            </div>{{-- /.bottom-grid --}}
        </div>{{-- /.content-pad --}}
    </main>

    {{-- ══ SIDEBAR DROITE ══ --}}
    <aside class="right-sidebar" aria-label="Mon profil et participation">

        {{-- Mon Profil --}}
        <div>
            <div class="rs-row-header">
                <div class="rs-title">Mon Profil</div>
                <a href="{{ route('entrepreneurs.profil') }}" class="rs-link">
                    Voir mon profil public
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="profil-card">
                <div class="profil-avatar">
                    @if ($monProfil?->photo)
                    <img src="{{ asset('storage/' . $monProfil->photo) }}" alt="{{ $monProfil->nom_complet }}">
                    @else
                    <svg width="24" height="24" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.4)" fill="none" stroke-width="1.5">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    @endif
                </div>
                <div>
                    <div class="profil-name">{{ $monProfil?->nom_complet ?? auth()->user()->name }}</div>
                    <div class="profil-role">{{ $monProfil?->poste ?? 'Entrepreneur' }}</div>
                    <div class="profil-loc">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ $monProfil?->ville ?? '' }}@if($monProfil?->pays_residence), {{ $monProfil->pays_residence }}@endif
                    </div>
                    @if ($monProfil?->profil_verifie)
                    <div class="profil-verified">
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        Profil vérifié
                    </div>
                    @endif
                </div>
            </div>
            <div class="progress-label">
                <span>Profil complété à <strong>{{ $monProfil?->completion ?? 0 }}%</strong></span>
            </div>
            @php
            $completion = isset($monProfil) ? ($monProfil->completion ?? 0) : 0;
            @endphp
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $completion }}%;"></div>
            </div>

            {{-- Informations Clés --}}
            <div>
                <div class="rs-row-header">
                    <div class="rs-title">Informations Clés</div>
                    <a href="{{ route('entrepreneurs.profil.edit') }}" class="edit-link">
                        <svg viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Modifier
                    </a>
                </div>
                @foreach ($infosClés as $info)
                <div class="info-row">
                    <svg viewBox="0 0 24 24" aria-hidden="true">{!! $info['icon'] !!}</svg>
                    <div class="info-key">{{ $info['label'] }}</div>
                    <div class="info-val">{{ $info['valeur'] }}</div>
                </div>
                @endforeach
            </div>

            {{-- Ma Participation au Forum --}}
            <div>
                <div class="rs-row-header">
                    <div class="rs-title">Ma Participation au Forum</div>
                    <a href="{{ route('entrepreneurs.participation') }}" class="rs-link">
                        Voir détails <svg viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @if ($participation?->confirmee)
                <div class="participation-ok">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <div>
                        <div class="pc-title">Participation confirmée</div>
                        <div class="pc-sub">Statut : {{ $participation->statut }}</div>
                    </div>
                </div>
                @endif
                @foreach ($detailsParticipation as $d)
                <div class="part-row">
                    <span class="part-row-key">{{ $d['label'] }}</span>
                    <span class="part-row-val {{ $d['style'] ?? '' }}">{{ $d['valeur'] }}</span>
                </div>
                @endforeach
            </div>

    </aside>
</div>{{-- /.page-layout --}}

{{-- ══ FOOTER ══ --}}

@include('components.footer')

@endsection