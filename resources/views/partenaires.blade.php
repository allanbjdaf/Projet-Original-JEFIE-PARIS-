{{-- resources/views/partenaires/index.blade.php --}}

@extends('layouts.app')

@section('title', 'JEFIE - PARIS 2026')

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

    /* NAV  */
    .nav {
        background: #0f284e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.75rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 200;
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
        letter-spacing: .04em;
    }

    .nav-logo-text span {
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5c518;
        font-size: 10px;
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
        gap: 12px;
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

    .nav-cta {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 20px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .nav-cta:hover {
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


    /*  LAYOUT : sidebar + content  */
    .page-wrapper {
        display: flex;
        min-height: calc(100vh - 64px);
    }

    /* ══════════════════════════════════
   SIDEBAR GAUCHE (Thème sombre & doré)
══════════════════════════════════ */
    .left-sidebar {
        width: 215px;
        flex-shrink: 0;
        background: #0f284e;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 64px;
        height: calc(100vh - 64px);
        overflow-y: auto;
    }

    .ls-section {
        padding: 1.1rem 1.25rem .5rem;
    }

    .ls-section-title {
        font-size: 10px;
        font-weight: 800;
        color: #f5c518;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: .6rem;
    }

    .ls-item {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 7px 10px;
        border-radius: 6px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: all .15s;
        cursor: pointer;
        margin-bottom: 2px;
        border-left: 3px solid transparent;
    }

    .ls-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    .ls-item.active {
        background: rgba(245, 166, 35, .15);
        color: #f5c518;
        font-weight: 700;
    }

    .ls-item svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .ls-item.active svg {
        stroke: #f5c518;
    }

    .ls-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: .5rem 1.25rem;
    }

    .ls-help {
        margin: auto 1.25rem 1.25rem;
        background: #0a2156ff;
        border: 1px solid rgba(245, 166, 35, 0.3);
        border-radius: 8px;
        padding: 1rem;
    }

    .ls-help-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: .5rem;
    }

    .ls-help-title {
        font-size: 12px;
        font-weight: 800;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .ls-help-icon {
        color: #f5c518;
        font-size: 16px;
    }

    .ls-help p {
        font-size: 11px;
        color: #888888;
        line-height: 1.5;
        margin-bottom: .75rem;
    }

    .ls-help-btn {
        background: #f5c518;
        color: #0f284e;
        font-size: 11px;
        font-weight: 700;
        padding: 7px 12px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .ls-help-btn:hover {
        opacity: .9;
    }

    /*  MAIN AREA  */
    .main-area {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    /* HERO */
    .hero {
        background: linear-gradient(108deg, #060e20 0%, #0f284e 45%, rgba(15, 40, 78, 0.75) 75%, rgba(15, 42, 94, 0.4) 100%),
            url('/images/pc.jpg');
        padding: 2.5rem 2.5rem 2rem;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        min-height: 220px;
    }

    .hero-img {
        max-width: 100%;
        height: 100%;
        /* Assurez-vous que l'image prend toute la hauteur du conteneur */
        object-fit: cover;
        /* Important pour remplir l'espace sans déformer */

        /* C'EST ICI QUE L'ON AJUSTE LA POSITION */
        /* Option A : Positionner le point focal plus haut (recommandé pour les visages) */
        object-position: center 20%;
        /* 20% depuis le haut, au lieu de 50% (center) */

        /* Option B : Si vous avez besoin de plus de contrôle (valeurs négatives si nécessaire) */
        /* object-position: center -10px; */
    }

    .hero::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 40%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400'%3E%3Cellipse cx='400' cy='200' rx='350' ry='280' fill='rgba(245,166,35,0.04)'/%3E%3C/svg%3E") no-repeat right / cover;
        pointer-events: none;
    }

    .hero-left {
        position: relative;
        z-index: 1;
        max-width: 400px;
    }

    .hero h1 {
        color: #fff;
        font-size: 2.4rem;
        font-weight: 900;
        line-height: 1.15;
        margin-bottom: .75rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .88rem;
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .hero-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f5c518;
        color: #0f284e;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 20px;
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

    .btn-outline {
        background: transparent;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 5px;
        border: 1.5px solid rgba(255, 255, 255, .4);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: border-color .2s;
    }

    .btn-outline:hover {
        border-color: #fff;
    }

    .hero-stats {
        display: flex;
        gap: 12px;
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
    }

    .hstat {
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 10px;
        padding: 1rem 1.25rem;
        text-align: center;
        min-width: 90px;
    }

    .hstat-icon {
        margin-bottom: 6px;
    }

    .hstat-num {
        color: #fff;
        font-size: 1.6rem;
        font-weight: 800;
        display: block;
    }

    .hstat-lbl {
        color: rgba(255, 255, 255, .55);
        font-size: 11px;
        line-height: 1.3;
        margin-top: 3px;
    }

    /* CONTENT GRID */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 0;
        flex: 1;
    }

    .content-main {
        padding: 2rem;
        background: #f4f6fa;
    }

    .content-right {
        padding: 1.75rem 1.5rem;
        background: #fff;
        border-left: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* SECTION HEADER  */
    .sh {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .sh-title {
        font-size: 13px;
        font-weight: 900;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5c518;
        padding-left: 10px;
    }

    .sh-link {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color .2s;
    }

    .sh-link:hover {
        color: #f5c518;
    }

    .sh-link svg {
        width: 12px;
        height: 12px;
    }

    /*  PARTENAIRES GRILLE */
    .partenaires-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 2rem;
    }

    .part-card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 1.25rem;
        position: relative;
        overflow: hidden;
    }

    .part-card.platinum {
        border-color: #0f284e;
        border-width: 2px;
        background: #0f284e;
    }

    .part-card.gold {
        border-color: #f5c518;
        border-width: 2px;
    }

    .part-level {
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .part-level.platinum-lv {
        color: #a0aec0;
    }

    .part-level.gold-lv {
        color: #f5c518;
    }

    .part-level.silver-lv {
        color: #718096;
    }

    .part-level.bronze-lv {
        color: #f5c518;
    }

    .part-logo-zone {
        height: 52px;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .part-logo-placeholder {
        font-size: 18px;
        font-weight: 900;
        color: #fff;
    }

    /* Couleur du placeholder pour les niveaux non-platinum */
    .part-logo-placeholder.part-logo-dark {
        color: #0a1e38;
    }

    .part-sub {
        font-size: 11px;
        color: #a0aec0;
        margin-bottom: 12px;
    }

    .part-sub.dark {
        color: #718096;
    }

    .part-link {
        font-size: 12px;
        font-weight: 700;
        color: #f5c518;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .part-link.dark-link {
        color: #0a1e38;
    }

    .part-link svg {
        width: 12px;
        height: 12px;
    }

    /* OPPORTUNITÉS */
    .opport-list {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .opp-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f0f4f8;
        transition: background .15s;
    }

    .opp-item:last-child {
        border-bottom: none;
    }

    .opp-item:hover {
        background: #f8fafc;
    }

    .opp-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .opp-icon.commercial {
        background: #e3f2fd;
    }

    .opp-icon.invest {
        background: #e8f5e9;
    }

    .opp-icon.coop {
        background: #fff3e0;
    }

    .opp-icon svg {
        width: 18px;
        height: 18px;
    }

    .opp-body {
        flex: 1;
        min-width: 0;
    }

    .opp-type {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #718096;
        margin-bottom: 3px;
    }

    .opp-title {
        font-size: 13px;
        font-weight: 600;
        color: #0a1e38;
        line-height: 1.4;
        margin-bottom: 2px;
    }

    .opp-org {
        font-size: 11px;
        color: #718096;
    }

    .opp-date {
        font-size: 11px;
        color: #a0aec0;
        white-space: nowrap;
        flex-shrink: 0;
        padding-top: 2px;
    }

    /* STAND */
    .stand-block {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .stand-inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .stand-img {
        background: linear-gradient(135deg, #1a2744 0%, #0f284e 100%);
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .stand-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .stand-info {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .stand-info p {
        font-size: 13px;
        color: #4a5568;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .stand-feature {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #4a5568;
        margin-bottom: 6px;
    }

    .stand-feature svg {
        width: 14px;
        height: 14px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2;
        flex-shrink: 0;
    }

    .btn-navy {
        background: #0f284e;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        margin-top: 1rem;
        transition: background .2s;
    }

    .btn-navy:hover {
        background: #0a1e38;
    }

    /* PACKS */
    .packs-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .pack-card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 1.25rem;
        position: relative;
    }

    .pack-card.featured {
        border-color: #f5c518;
        border-width: 2px;
    }

    .pack-badge-top {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #f5c518;
        color: #0f284e;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .pack-level {
        font-size: 14px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 4px;
    }

    .pack-level.bronze-c {
        color: #f5c518;
    }

    .pack-level.silver-c {
        color: #607d8b;
    }

    .pack-level.gold-c {
        color: #f5c518;
    }

    .pack-level.plat-c {
        color: #0f284e;
    }

    .pack-price {
        font-size: 12px;
        color: #718096;
        margin-bottom: 12px;
    }

    .pack-feature {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #4a5568;
        margin-bottom: 6px;
    }

    .pack-feature svg {
        width: 13px;
        height: 13px;
        stroke: #2e7d32;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .pack-btn {
        background: #0f284e;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 9px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 12px;
        transition: background .2s;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .pack-btn:hover {
        background: #0a1e38;
    }

    .pack-card.featured .pack-btn {
        background: #f5c518;
        color: #0f284e;
    }

    .pack-card.featured .pack-btn:hover {
        opacity: .9;
    }

    /* RIGHT SIDEBAR */
    .rs-title {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 13px;
        color: #4a5568;
        margin-bottom: 8px;
    }

    .benefit-item svg {
        width: 16px;
        height: 16px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .btn-full-navy {
        background: #0f284e;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 11px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        transition: background .2s;
    }

    .btn-full-navy:hover {
        background: #0a1e38;
    }

    /* Visibilité */
    .visibility-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .period-select {
        border: 1px solid #d1d9e6;
        border-radius: 4px;
        padding: 5px 28px 5px 10px;
        font-size: 11px;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 13px;
        cursor: pointer;
    }

    .vis-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .vis-stat {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 10px;
        background: #f8fafc;
        border-radius: 6px;
    }

    .vis-stat-icon {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .vis-stat svg {
        width: 16px;
        height: 16px;
    }

    .vis-num {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f284e;
        display: block;
        line-height: 1.2;
    }

    .vis-lbl {
        font-size: 10px;
        color: #718096;
    }

    /* Niveau partenariat */
    .level-card {
        background: #0f284e;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .level-badge {
        background: #f5c518;
        color: #0f284e;
        font-size: 13px;
        font-weight: 900;
        padding: 4px 12px;
        border-radius: 4px;
        letter-spacing: .05em;
    }

    .level-validity {
        font-size: 11px;
        color: rgba(255, 255, 255, .55);
        margin-top: 4px;
    }

    .level-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .avantages-btn {
        background: rgba(255, 255, 255, .1);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 7px 12px;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        white-space: nowrap;
        transition: background .2s;
    }

    .avantages-btn:hover {
        background: rgba(255, 255, 255, .15);
    }

    .star-icon {
        width: 36px;
        height: 36px;
        background: #f5c518;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Question bloc */
    .question-card {
        background: #0f284e;
        border-radius: 8px;
        overflow: hidden;
    }

    .question-inner {
        display: flex;
        gap: 0;
    }

    .question-text {
        padding: 1.25rem;
        flex: 1;
    }

    .question-text h4 {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: .75rem;
    }

    .q-contact-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: rgba(255, 255, 255, .7);
        margin-bottom: 6px;
    }

    .q-contact-item svg {
        width: 13px;
        height: 13px;
        stroke: rgba(255, 255, 255, .5);
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .q-btn {
        background: #f5c518;
        color: #0f284e;
        font-size: 12px;
        font-weight: 700;
        padding: 8px 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: .75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .q-btn:hover {
        opacity: .9;
    }

    .question-photo {
        width: 90px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0a1e38 0%, #1a3060 100%);
        position: relative;
        overflow: hidden;
    }

    .question-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* FOOTER */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr 1.2fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .fb p {
        font-size: 13px;
        line-height: 1.65;
        margin: .75rem 0 1rem;
    }

    .socials {
        display: flex;
        gap: 10px;
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
        margin-bottom: .9rem;
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
        align-items: center;
        gap: 8px;
        font-size: 12px;
        margin-bottom: 7px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1.25rem 0;
        text-align: center;
        font-size: 12px;
        color: rgba(255, 255, 255, .35);
    }

    @media (max-width: 1200px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .content-right {
            display: none;
        }
    }

    @media (max-width: 900px) {
        .left-sidebar {
            display: none;
        }

        .partenaires-grid,
        .packs-grid {
            grid-template-columns: 1fr 1fr;
        }

        .hero {
            flex-direction: column;
        }
    }

    @media (max-width: 600px) {

        .partenaires-grid,
        .packs-grid,
        .stand-inner {
            grid-template-columns: 1fr;
        }

        .nav-links {
            display: none;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


{{-- PAGE WRAPPER  --}}
<div class="page-wrapper">

    {{-- ══════════════════════════════════════
         LEFT SIDEBAR — ESPACE PARTENAIRE
    ══════════════════════════════════════ --}}
    <aside class="left-sidebar" aria-label="Navigation espace partenaire">

        <div class="ls-section">
            <div class="ls-section-title">Espace Partenaire</div>
            <a href="{{ route('partenaires') }}" class="ls-item active">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Tableau de bord
            </a>
        </div>

        <div class="ls-divider"></div>

        <div class="ls-section">
            <div class="ls-section-title">Présentation</div>
            <a href="{{ route('partenaires.profil') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" />
                    <path d="M8 21h8M12 17v4" />
                </svg>
                Mon entreprise
            </a>
            <a href="{{ route('partenaires.activites') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                Mes activités &amp; offres
            </a>
            <a href="{{ route('partenaires.media') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <polyline points="21 15 16 10 5 21" />
                </svg>
                Galerie média
            </a>
        </div>

        <div class="ls-divider"></div>

        <div class="ls-section">
            <div class="ls-section-title">Opportunités</div>
            <a href="{{ route('partenaires.opportunites.create') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="16" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                Publier une opportunité
            </a>
            <a href="{{ route('partenaires.opportunites.index') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                </svg>
                Mes opportunités
            </a>
        </div>

        <div class="ls-divider"></div>

        <div class="ls-section">
            <div class="ls-section-title">Participation</div>
            <a href="{{ route('partenaires.stands.reserver') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <rect x="2" y="7" width="20" height="15" rx="2" />
                    <polyline points="17 2 12 7 7 2" />
                </svg>
                Réserver un stand
            </a>
            <a href="{{ route('partenaires.reservations') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                Mes réservations
            </a>
            <a href="{{ route('partenaires.badges') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2" />
                    <path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z" />
                </svg>
                Mes badges
            </a>
        </div>

        <div class="ls-divider"></div>

        <div class="ls-section">
            <div class="ls-section-title">Communication</div>
            <a href="{{ route('actualites') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M18 20V10M12 20V4M6 20v-6" />
                </svg>
                Actualités &amp; annonces
            </a>
            <a href="{{ route('partenaires.offres') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                    <line x1="7" y1="7" x2="7.01" y2="7" />
                </svg>
                Offres &amp; promotions
            </a>
            <a href="{{ route('partenaires.docs') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Vos documentations
            </a>
        </div>

        <div class="ls-divider"></div>

        <div class="ls-section">
            <div class="ls-section-title">Analytiques</div>
            <a href="{{ route('partenaires.stats') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <line x1="18" y1="20" x2="18" y2="10" />
                    <line x1="12" y1="20" x2="12" y2="4" />
                    <line x1="6" y1="20" x2="6" y2="14" />
                </svg>
                Statistiques
            </a>
            <a href="{{ route('partenaires.visibilite') }}" class="ls-item">
                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                Visibilité &amp; engagement
            </a>
        </div>

        {{-- Aide --}}
        <div class="ls-help">
            <div class="ls-help-header">
                <span class="ls-help-title">Besoin d'aide ?</span>
                <span class="ls-help-icon">&#8594;</span>
            </div>
            <p>Notre équipe partenaire est à votre disposition.</p>
            <a href="{{ route('contact') }}" class="ls-help-btn">
                <svg width="13" height="13" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07" />
                </svg>
                Nous contacter
            </a>
        </div>

    </aside>

    {{-- MAIN AREA  --}}
    <div class="main-area">

        {{-- ══ HERO ══ --}}
        <section class="hero">
            <div class="hero-left">
                <h1>Espace Entreprises<br>et Partenaires</h1>
                <p class="hero-desc">
                    Valorisez votre entreprise, développez votre réseau,
                    publiez vos opportunités et réservez votre stand
                    au Forum International de l'Innovation – Paris 2026.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('partenaires.stands.reserver') }}" class="btn-gold">
                        <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        Réserver un stand
                    </a>
                    <a href="{{ route('partenaires.devenir') }}" class="btn-outline">
                        <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                        </svg>
                        Devenir partenaire
                    </a>
                </div>
            </div>
            <div class="hero-stats" aria-label="Statistiques">
                @foreach ([['325','Entreprises','inscrites'],['128','Partenaires','engagés'],['76','Opportunités','publiées'],['52','Stands','disponibles']] as [$num,$l1,$l2])
                <div class="hstat">
                    <div class="hstat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" stroke="rgba(245,166,35,0.7)" fill="none" stroke-width="1.5" aria-hidden="true">
                            <rect x="2" y="7" width="20" height="14" rx="2" />
                            <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                        </svg>
                    </div>
                    <span class="hstat-num">{{ $num }}</span>
                    <div class="hstat-lbl">{{ $l1 }}<br>{{ $l2 }}</div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- CONTENT GRID  --}}
        <div class="content-grid">

            {{-- MAIN CONTENT  --}}
            <div class="content-main">

                {{-- Partenaires officiels --}}
                <div class="sh">
                    <h2 class="sh-title">Nos Partenaires Officiels</h2>
                    <a href="{{ route('partenaires.liste') }}" class="sh-link">
                        Voir tous les partenaires
                        <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="partenaires-grid">
                    @forelse ($partenairesUne as $p)
                    <div class="part-card {{ strtolower($p->niveau) === 'platinum' ? 'platinum' : (strtolower($p->niveau) === 'gold' ? 'gold' : '') }}">
                        <div class="part-level {{ strtolower($p->niveau) }}-lv">
                            @if(strtolower($p->niveau) === 'platinum')
                            <svg width="12" height="12" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                            @endif
                            Partenaire {{ strtoupper($p->niveau) }}
                        </div>
                        <div class="part-logo-zone">
                            @if ($p->logo)
                            <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->nom }}" style="max-height:52px;max-width:100%;object-fit:contain">
                            @else
                            <span class="part-logo-placeholder {{ strtolower($p->niveau) !== 'platinum' ? 'part-logo-dark' : '' }}">
                                {{ str($p->nom)->substr(0, 2)->upper() }}
                            </span>

                            @endif
                        </div>
                        <div class="part-sub {{ strtolower($p->niveau) !== 'platinum' ? 'dark' : '' }}">
                            Partenaire {{ $p->niveau }}
                        </div>
                        <a href="{{ route('partenaires', $p->slug) }}" class="part-link {{ strtolower($p->niveau) !== 'platinum' ? 'dark-link' : '' }}">
                            Voir le profil
                            <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @empty
                    <p style="grid-column:1/-1;color:#718096;font-size:13px">Aucun partenaire pour le moment.</p>
                    @endforelse
                </div>

                {{-- Opportunités + Stand --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem">

                    {{-- Opportunités récentes --}}
                    <div>
                        <div class="sh">
                            <h2 class="sh-title">Opportunités Récentes</h2>
                            <a href="{{ route('partenaires.opportunites.index') }}" class="sh-link">
                                Voir toutes les opportunités
                                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="opport-list">
                            @forelse ($opportunites as $opp)
                            <div class="opp-item">
                                <div class="opp-icon {{ strtolower($opp->type_class) }}">
                                    @if (strtolower($opp->type) === 'partenariat commercial')
                                    <svg viewBox="0 0 24 24" stroke="#0f284e" fill="none" stroke-width="2" aria-hidden="true">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                                    </svg>
                                    @elseif (strtolower($opp->type) === 'investissement')
                                    <svg viewBox="0 0 24 24" stroke="#2e7d32" fill="none" stroke-width="2" aria-hidden="true">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                                        <polyline points="17 6 23 6 23 12" />
                                    </svg>
                                    @else
                                    <svg viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="2" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M12 8v4l3 3" />
                                    </svg>
                                    @endif
                                </div>
                                <div class="opp-body">
                                    <div class="opp-type">{{ strtoupper($opp->type) }}</div>
                                    <div class="opp-title">{{ $opp->titre }}</div>
                                    <div class="opp-org">{{ $opp->organisation }}</div>
                                </div>
                                <div class="opp-date">{{ $opp->date->translatedFormat('d M Y') }}</div>
                            </div>
                            @empty
                            <div style="padding:1.5rem;text-align:center;color:#718096;font-size:13px">Aucune opportunité disponible.</div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Réserver un stand --}}
                    <div>
                        <div class="sh">
                            <h2 class="sh-title">Réserver un Stand</h2>
                            <a href="{{ route('partenaires.plan') }}" class="sh-link">
                                Voir le plan du salon
                                <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="stand-block">
                            <div class="stand-inner">
                                <div class="stand-img">
                                    @if (isset($standImage))
                                    <img src="{{ asset('storage/' . $standImage) }}" alt="Stand Forum Innovation">
                                    @else
                                    <svg width="48" height="48" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.15)" fill="none" stroke-width="1" aria-hidden="true">
                                        <rect x="2" y="7" width="20" height="14" rx="2" />
                                        <polyline points="17 2 12 7 7 2" />
                                    </svg>
                                    @endif
                                </div>
                                <div class="stand-info">
                                    <p>Réservez votre stand et présentez vos solutions à des milliers de visiteurs et décideurs.</p>
                                    <div>
                                        <div class="stand-feature"><svg viewBox="0 0 24 24">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>Stands équipés</div>
                                        <div class="stand-feature"><svg viewBox="0 0 24 24">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>Emplacements premium</div>
                                        <div class="stand-feature"><svg viewBox="0 0 24 24">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>Visibilité maximale</div>
                                    </div>
                                    <a href="{{ route('partenaires.stands.reserver') }}" class="btn-navy">
                                        <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        Choisir mon emplacement
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Packs de partenariat --}}
                <div class="sh">
                    <h2 class="sh-title">Nos Packs de Partenariat</h2>
                </div>
                <p style="font-size:13px;color:#718096;margin-bottom:1.25rem">Des solutions adaptées à vos objectifs</p>

                <div class="packs-grid">
                    @foreach ($packs as $pack)
                    <div class="pack-card {{ $pack['featured'] ? 'featured' : '' }}">
                        @if ($pack['featured'])
                        <div class="pack-badge-top">Le plus choisi</div>
                        @endif
                        <div class="pack-level {{ $pack['color_class'] }}">{{ strtoupper($pack['niveau']) }}</div>
                        <div class="pack-price">à partir de {{ $pack['prix'] }}</div>
                        @foreach ($pack['features'] as $feat)
                        <div class="pack-feature">
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ $feat }}
                        </div>
                        @endforeach
                        <a href="{{ route('partenaires.pack', $pack['slug']) }}" class="pack-btn">Découvrir</a>
                    </div>
                    @endforeach
                </div>

            </div>{{-- /.content-main --}}

            {{-- ── RIGHT SIDEBAR ── --}}
            <aside class="content-right" aria-label="Avantages et statistiques">

                {{-- Devenir partenaire --}}
                <div>
                    <h3 class="rs-title">Devenir Partenaire</h3>
                    <p style="font-size:12px;color:#718096;line-height:1.6;margin-bottom:1rem">
                        Rejoignez un réseau d'entreprises engagées et bénéficiez d'avantages exclusifs.
                    </p>
                    @foreach (['Visibilité internationale','Accès aux décideurs',"Opportunités d'affaires",'Espaces premium dédiés','Communication ciblée'] as $benefit)
                    <div class="benefit-item">
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        {{ $benefit }}
                    </div>
                    @endforeach
                    <a href="{{ route('partenaires.devenir') }}" class="btn-full-navy">
                        Découvrir nos offres
                        <svg width="13" height="13" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Votre visibilité --}}
                <div>
                    <div class="visibility-header">
                        <h3 class="rs-title" style="margin-bottom:0">Votre Visibilité</h3>
                        <select class="period-select" aria-label="Période">
                            <option>30 derniers jours</option>
                            <option>7 derniers jours</option>
                            <option>90 derniers jours</option>
                        </select>
                    </div>
                    <div class="vis-stats">
                        @foreach ($visibilite as $stat)
                        <div class="vis-stat">
                            <div class="vis-stat-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" stroke="{{ $stat['color'] }}" fill="none" stroke-width="2" aria-hidden="true">
                                    {!! $stat['icon_path'] !!}
                                </svg>
                            </div>
                            <div>
                                <span class="vis-num">{{ $stat['valeur'] }}</span>
                                <div class="vis-lbl">{{ $stat['label'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Niveau de partenariat --}}
                <div>
                    <h3 class="rs-title">Votre Niveau de Partenariat</h3>
                    <div class="level-card">
                        <div>
                            <div class="level-badge">{{ strtoupper($niveauPartenariat['niveau']) }}</div>
                            <div class="level-validity">Valide jusqu'au {{ $niveauPartenariat['expiration'] }}</div>
                        </div>
                        <div class="level-right">
                            <a href="{{ route('partenaires.avantages') }}" class="avantages-btn">
                                Voir mes avantages
                                <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                            <div class="star-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" stroke="#0f284e" fill="#0f284e" stroke-width="1">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Une question ? --}}
                <div class="question-card">
                    <div class="question-inner">
                        <div class="question-text">
                            <h4>Une question ?</h4>
                            <div class="q-contact-item">
                                <svg viewBox="0 0 24 24">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="M2 7l10 7 10-7" />
                                </svg>
                                partenaires@forum-innovation.org
                            </div>
                            <div class="q-contact-item">
                                <svg viewBox="0 0 24 24">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07" />
                                </svg>
                                +33 1 45 67 89 10
                            </div>
                            <a href="{{ route('contact') }}" class="q-btn">
                                Nous contacter
                                <svg width="11" height="11" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="question-photo" aria-hidden="true">
                            @if (isset($conseillerPhoto))
                            <img src="{{ asset('storage/' . $conseillerPhoto) }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>

            </aside>

        </div>{{-- /.content-grid --}}
    </div>{{-- /.main-area --}}

</div>{{-- /.page-wrapper --}}

{{-- FOOTER  --}}

@include('components.footer')

@endsection