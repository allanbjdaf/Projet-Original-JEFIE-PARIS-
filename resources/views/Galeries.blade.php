{{-- resources/views/galerie/index.blade.php --}}

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





    /* ── À LA UNE ── */
    .une-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.1rem;
        margin-bottom: 2rem;
    }

    .une-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow .2s, transform .2s;
        cursor: pointer;
    }

    .une-card:hover {
        box-shadow: 0 4px 18px rgba(13, 27, 62, .11);
        transform: translateY(-2px);
    }

    .une-thumb {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #0d1b3e;
        flex-shrink: 0;
    }

    .une-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .thumb-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0d1b3e, #1e3472);
    }

    .une-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 3px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .05em;
        z-index: 2;
    }

    .badge-communique {
        background: #1565c0;
    }

    .badge-interview {
        background: #2e7d32;
    }

    .badge-video {
        background: #162552;
    }

    .badge-podcast {
        background: #f5a623;
        color: #0d1b3e;
    }

    .badge-photo,
    .badge-photos {
        background: #43a047;
    }

    .badge-livestream {
        background: #e53935;
    }

    .badge-presse {
        background: #fb8c00;
    }

    .live-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #e53935;
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 3px;
        z-index: 3;
        animation: blink 1.2s infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .6
        }
    }

    .play-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .play-btn {
        width: 44px;
        height: 44px;
        background: rgba(245, 166, 35, .92);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .2s;
    }

    .une-card:hover .play-btn {
        transform: scale(1.1);
    }

    .play-btn svg {
        width: 18px;
        height: 18px;
        fill: #0d1b3e;
        margin-left: 3px;
    }

    .duration {
        position: absolute;
        bottom: 8px;
        right: 10px;
        background: rgba(0, 0, 0, .7);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 3px;
        z-index: 2;
    }

    .plus-count {
        position: absolute;
        bottom: 8px;
        right: 10px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 3px;
        z-index: 2;
    }

    .une-body {
        padding: .9rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .une-date {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #718096;
    }

    .une-date svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        flex-shrink: 0;
    }

    .une-title {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        line-height: 1.4;
        flex: 1;
    }

    .une-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        text-decoration: none;
        margin-top: 6px;
        transition: color .2s;
    }

    .une-link:hover {
        color: #f5a623;
    }

    .une-link svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── DERNIERS CONTENUS ── */
    .section-heading {
        font-size: 13px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5a623;
        padding-left: 10px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .sort-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #718096;
    }

    .sort-row select {
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        padding: 6px 24px 6px 10px;
        font-size: 12px;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 13px;
        cursor: pointer;
        font-family: inherit;
    }

    .derniers-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.1rem;
        margin-bottom: 2rem;
    }

    /* ── SIDEBAR DROITE ── */
    .right-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .rs-block {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.1rem;
        max-width: 320px;
        /* Réduit la largeur si nécessaire (ajustez selon vos besoins) */
    }

    .rs-title {
        font-size: 11px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .9rem;
    }

    /* Populaires */
    .pop-item {
        display: flex;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
        text-decoration: none;
    }

    .pop-item:last-child {
        border-bottom: none;
    }

    .pop-thumb {
        width: 60px;
        height: 46px;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
        background: #0d1b3e;
    }

    .pop-thumb img {
        width: 60px;
        height: 46px;
        object-fit: cover;
        display: block;
    }

    .pop-body {
        flex: 1;
        min-width: 0;
    }

    .pop-title {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        line-height: 1.35;
        margin-bottom: 3px;
        transition: color .2s;
    }

    .pop-item:hover .pop-title {
        color: #f5a623;
    }

    .pop-vues {
        font-size: 11px;
        color: #a0aec0;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .pop-vues svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    /* Newsletter */
    .nl-block {
        background: #0d1b3e;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .nl-title {
        font-size: 12px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 5px;
    }

    .nl-desc {
        font-size: 11px;
        color: rgba(255, 255, 255, .6);
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .nl-row {
        display: flex;
        gap: 7px;
    }

    .nl-input {
        flex: 1;
        padding: 9px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-size: 12px;
        outline: none;
        font-family: inherit;
    }

    .nl-input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .nl-btn {
        background: #0d1b3e;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 16px;
        border: 1.5px solid rgba(255, 255, 255, .3);
        border-radius: 5px;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s;
        font-family: inherit;
    }

    .nl-btn:hover {
        background: #162552;
    }

    /* Stats médias */
    .stats-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .stat-media-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: .85rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stat-media-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-media-icon svg {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .stat-media-num {
        font-size: 1.2rem;
        font-weight: 900;
        color: #0d1b3e;
        line-height: 1;
        display: block;
    }

    .stat-media-lbl {
        font-size: 10px;
        color: #718096;
        margin-top: 2px;
    }

    @media (max-width:1100px) {

        .une-grid,
        .derniers-grid {
            grid-template-columns: 1fr 1fr;
        }

        .right-sidebar {
            display: none;
        }
    }

    @media (max-width:600px) {

        .une-grid,
        .derniers-grid {
            grid-template-columns: 1fr;
        }
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
        letter-spacing: .04em;
    }

    .nav-logo-text span {
        color: #f5a623;
        display: block;
        font-size: 12px;
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
        border-bottom: 2px solid #f5a623;
        padding-bottom: 2px;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
        transition: color .2s;
    }

    .nav-icon-btn:hover {
        color: #fff;
    }

    .nav-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 22px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
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



    /* ── HERO ── */
    .hero {
        background: linear-gradient(135deg, #0a1628 0%, #0d1b3e 50%, #1a3060 100%);
        padding: 3rem 2.5rem 2.5rem;
        position: relative;
        overflow: hidden;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .hero::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 55%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 400'%3E%3Cellipse cx='600' cy='200' rx='400' ry='300' fill='rgba(245,166,35,0.04)'/%3E%3C/svg%3E") no-repeat right center / cover;
        pointer-events: none;
    }

    .hero h1 {
        color: #fff;
        font-size: 2.8rem;
        font-weight: 900;
        letter-spacing: -.01em;
        text-transform: uppercase;
        margin-bottom: .75rem;
        position: relative;
        z-index: 1;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .9rem;
        max-width: 560px;
        line-height: 1.6;
        margin-bottom: 1.75rem;
        position: relative;
        z-index: 1;
    }

    /* Positionnement de l'image du projecteur */
    .hero-image-wrap {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        width: 45%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        pointer-events: none;
    }

    .hero-image {
        height: 100%;
        object-fit: contain;
        opacity: 0.85;
    }

    .hero-title .text-yellow {
        color: #f5a623;
        /* Le jaune/orange officiel de votre maquette */
    }

    .hero-section {
        /* Superposition : 1er dégradé pour la transparence et la couleur à gauche, 2ème pour l'image de fond */
        background-image:
            linear-gradient(to right, #061026 40%, rgba(6, 16, 38, 0.65) 70%, rgba(6, 16, 38, 0.3) 100%),
            url('/images/aaa.jpg');

        background-color: #061026;
        /* Couleur de secours si l'image ne charge pas */
        background-repeat: no-repeat;
        background-position: right center;
        /* Positionne l'image bien à droite */
        background-size: contain;
        /* Adapte l'image à la hauteur du conteneur sans la déformer */
        color: #ffffff;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .hero-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 4.5rem 2rem 6rem 2rem;
        display: flex;
        align-items: center;
    }

    .hero-content {
        max-width: 650px;
        position: relative;
        z-index: 10;
        /* Assure que le texte reste lisible au-dessus du fond */
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 1.2rem;
        color: #ffffff;
    }

    .hero-title .text-yellow {
        color: #f5a623;
        /* Applique le jaune sur "Actualités" */
    }

    .hero-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #cbd5e1;
    }

    /* ── BARRE DE FILTRES EN BAS ── */
    .hero-filters-bar {
        background: rgba(0, 0, 0, 0.3);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        width: 100%;
    }

    .filters-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0.8rem 2rem;
        display: flex;
        gap: 0.75rem;
        overflow-x: auto;
        white-space: nowrap;
    }

    .filters-container::-webkit-scrollbar {
        display: none;
    }

    .filter-btn {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 4px;
        color: #ffffff;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease-in-out;
    }

    .filter-btn svg {
        width: 14px;
        height: 14px;
    }

    .filter-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #ffffff;
    }

    .filter-btn.active {
        background: #e29513;
        border-color: #e29513;
        color: #0d1b3e;
        font-weight: 700;
    }

    /* Cacher la scrollbar horizontale sur mobile */
    .filters-container::-webkit-scrollbar {
        display: none;
    }


    /* TABS */
    .tabs {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .tab {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, .15);
        color: rgba(255, 255, 255, .75);
        background: rgba(255, 255, 255, .07);
        transition: all .2s;
    }

    .tab:hover {
        background: rgba(255, 255, 255, .12);
        color: #fff;
    }

    .tab.active {
        background: #f5a623;
        color: #0d1b3e;
        border-color: #f5a623;
    }

    .tab svg {
        flex-shrink: 0;
    }

    /* ── PAGE BODY ── */
    .page-body {
        display: grid;
        grid-template-columns: 220px 1fr 280px;
        gap: 0;
        background: #f4f6fa;
    }

    /* ── SIDEBAR FILTRES ── */
    .sidebar {
        padding: 2rem 1.5rem;
        background: #fff;
        border-right: 1px solid #e2e8f0;
    }

    .filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .filter-title {
        font-size: 14px;
        font-weight: 800;
        color: #0d1b3e;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .filter-reset {
        font-size: 12px;
        color: #f5a623;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .filter-section {
        margin-bottom: 1.5rem;
    }

    .filter-label {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        margin-bottom: .6rem;
        display: block;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 8px 36px 8px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        color: #1a2744;
        outline: none;
    }

    .search-box input::placeholder {
        color: #a0aec0;
    }

    .search-box button {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #718096;
        padding: 2px;
    }

    .checkbox-list {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .cb-item {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .cb-item input[type="checkbox"] {
        width: 14px;
        height: 14px;
        accent-color: #0d1b3e;
        cursor: pointer;
        flex-shrink: 0;
    }

    .cb-item label {
        font-size: 12px;
        color: #4a5568;
        cursor: pointer;
        line-height: 1.3;
    }

    .cb-item label span {
        color: #a0aec0;
        font-size: 11px;
    }

    .filter-select {
        width: 100%;
        padding: 8px 32px 8px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        color: #4a5568;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 15px;
        cursor: pointer;
    }

    .apply-btn {
        background: #0d1b3e;
        color: #fff;
        width: 100%;
        padding: 11px;
        border: none;
        border-radius: 5px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        margin-top: .5rem;
        transition: background .2s;
    }

    .apply-btn:hover {
        background: #162552;
    }

    /* ── MAIN CONTENT ── */
    .main-content {
        padding: 2rem;
    }

    /* À LA UNE */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .section-heading {
        font-size: 14px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .12em;
        text-transform: uppercase;
        border-left: 3px solid #f5a623;
        padding-left: 10px;
    }

    .sort-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #718096;
    }

    .sort-row select {
        border: 1px solid #d1d9e6;
        border-radius: 4px;
        padding: 5px 28px 5px 10px;
        font-size: 12px;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 14px;
        cursor: pointer;
    }

    /* CARDS À LA UNE */
    .une-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .une-card {
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e2e8f0;
    }

    .une-thumb {
        position: relative;
        height: 160px;
        background: linear-gradient(135deg, #1a2744 0%, #162552 100%);
    }

    .une-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .une-thumb .thumb-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .une-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 9px;
        border-radius: 3px;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .badge-communique {
        background: #1565c0;
        color: #fff;
    }

    .badge-interview {
        background: #2e7d32;
        color: #fff;
    }

    .badge-video {
        background: #d32f2f;
        color: #fff;
    }

    .badge-podcast {
        background: #e65100;
        color: #fff;
    }

    .badge-photos {
        background: #2e7d32;
        color: #fff;
    }

    .badge-livestream {
        background: #d32f2f;
        color: #fff;
    }

    .badge-presse {
        background: #6a1b9a;
        color: #fff;
    }

    .play-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, .9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .play-btn svg {
        width: 14px;
        height: 14px;
        fill: #0d1b3e;
        margin-left: 2px;
    }

    .duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, .7);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 7px;
        border-radius: 3px;
    }

    .live-badge {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: #d32f2f;
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 3px;
        letter-spacing: .06em;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .7;
        }
    }

    .plus-count {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 3px;
    }

    .une-body {
        padding: 12px 14px 14px;
    }

    .une-date {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #718096;
        margin-bottom: 6px;
    }

    .une-date svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        flex-shrink: 0;
    }

    .une-title {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .une-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        text-decoration: none;
        transition: color .2s;
    }

    .une-link:hover {
        color: #f5a623;
    }

    .une-link svg {
        width: 12px;
        height: 12px;
    }

    /* DERNIERS CONTENUS */
    .derniers-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    /* --- Mise en page de la Grille --- */
    .une-grid,
    .derniers-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        /* Gère automatiquement les 4 colonnes */
        gap: 1.5rem;
        /* Espace entre les cartes */
        margin-bottom: 2.5rem;
    }

    /* --- Style de la Carte --- */
    .card {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
    }

    .card-image-container {
        position: relative;
        width: 100%;
        height: 160px;
        /* Ajustez selon vos images */
        background-color: #f7fafc;
    }

    .card-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* --- Badges de catégorie --- */
    .badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        color: white;
        border-radius: 4px;
        z-index: 10;
    }

    .badge-photos {
        background-color: #3182ce;
    }

    .badge-live {
        background-color: #e53e3e;
    }

    .badge-presse {
        background-color: #dd6b20;
    }

    .badge-interview {
        background-color: #38a169;
    }

    /* --- Éléments superposés sur image (Durée, Compteur) --- */
    .video-duration,
    .image-overlay-count,
    .live-indicator {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 4px;
    }

    .live-indicator {
        left: 10px;
        right: auto;
        background: #e53e3e;
        font-weight: bold;
    }

    /* --- Corps de la carte --- */
    .card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-date {
        font-size: 12px;
        color: #a0aec0;
        margin-bottom: 0.5rem;
    }

    .card-title {
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        line-height: 1.4;
        margin-bottom: 1rem;
        flex-grow: 1;
        /* Aligne les liens du bas sur la même ligne */
    }

    .card-link {
        font-size: 13px;
        color: #3182ce;
        text-decoration: none;
        font-weight: 500;
    }

    .card-link:hover {
        text-decoration: underline;
    }

    /* --- Adaptabilité Mobile (Responsive) --- */
    @media (max-width: 1024px) {

        .une-grid,
        .derniers-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            /* 2 colonnes sur tablette */
        }
    }

    @media (max-width: 640px) {

        .une-grid,
        .derniers-grid {
            grid-template-columns: 1fr;
            /* 1 seule colonne sur mobile */
        }
    }

    /* --- Conteneur de la colonne de droite --- */
    .sidebar-right {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
        width: 100%;
        max-width: 320px;
        /* Aligné sur la largeur de l'image */
    }

    /* --- Titres des sections --- */
    .rs-title,
    .nl-title {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        color: #1a202c;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 0.75rem;
        margin-bottom: 1.25rem;
        letter-spacing: 0.5px;
    }

    /* --- Liste des Contenus Populaires --- */
    .popular-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .popular-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        color: inherit;
        transition: opacity 0.2s ease;
    }

    .popular-item:hover {
        opacity: 0.8;
    }

    .popular-img-wrapper {
        width: 80px;
        height: 50px;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
        background-color: #edf2f7;
    }

    .popular-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popular-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .popular-info h4 {
        font-size: 13px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* Limite à deux lignes maximum */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .popular-views {
        font-size: 11px;
        color: #718096;
    }

    /* --- Section Newsletter --- */
    .nl-rs {
        display: flex;
        flex-direction: column;
    }

    .nl-desc {
        font-size: 13px;
        color: #718096;
        line-height: 1.4;
        margin-bottom: 1.25rem;
    }

    /* --- Formulaire d'abonnement --- */
    .nl-rs-form {
        display: flex;
        width: 100%;
        height: 42px;
        /* Hauteur fixe comme sur l'image */
    }

    .nl-rs-form input[type="email"] {
        flex-grow: 1;
        border: 1px solid #cbd5e0;
        border-radius: 4px 0 0 4px;
        /* Coins arrondis à gauche uniquement */
        padding: 0 1rem;
        font-size: 13px;
        color: #4a5568;
        outline: none;
    }

    .nl-rs-form input[type="email"]::placeholder {
        color: #a0aec0;
    }

    .nl-rs-form button {
        background-color: #0b1c3f;
        /* Bleu nuit de la charte graphique */
        color: #ffffff;
        border: none;
        border-radius: 0 4px 4px 0;
        /* Coins arrondis à droite uniquement */
        padding: 0 1.25rem;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        white-space: nowrap;
    }

    .nl-rs-form button:hover {
        background-color: #1a2e5a;
    }

    /* --- Grille --- */
    .une-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* --- Style de la Carte --- */
    .card {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .card-image-container {
        position: relative;
        width: 100%;
        height: 160px;
        background-color: #f7fafc;
    }

    .card-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb-placeholder {
        width: 100%;
        height: 100%;
        background: #2d3748;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* --- Badges de catégorie (Couleurs de l'image) --- */
    .badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        color: white;
        border-radius: 4px;
        z-index: 10;
    }

    .badge-communiqué,
    .badge-communique {
        background-color: #3182ce;
    }

    /* Bleu */
    .badge-interview {
        background-color: #38a169;
    }

    /* Vert */
    .badge-vidéo,
    .badge-video {
        background-color: #805ad5;
    }

    /* Violet */
    .badge-podcast {
        background-color: #dd6b20;
    }

    /* Orange */
    .badge-photos {
        background-color: #3182ce;
    }

    /* Bleu clair galerie */
    .badge-livestream,
    .badge-live {
        background-color: #e53e3e;
    }

    /* Rouge */

    /* --- Éléments superposés sur image --- */
    .video-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 4px;
    }

    .live-indicator {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: #e53e3e;
        color: #fff;
        padding: 2px 6px;
        font-size: 11px;
        font-weight: bold;
        border-radius: 4px;
    }

    /* --- Corps de la carte --- */
    .card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-date {
        font-size: 12px;
        color: #a0aec0;
        margin-bottom: 0.5rem;
    }

    .card-title {
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        line-height: 1.4;
        margin-bottom: 1rem;
        flex-grow: 1;
        /* Aligne le bouton du bas */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-link {
        font-size: 13px;
        color: #3182ce;
        text-decoration: none;
        font-weight: 500;
    }

    .card-link:hover {
        text-decoration: underline;
    }

    /* --- Responsiveness --- */
    @media (max-width: 1024px) {
        .une-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .une-grid {
            grid-template-columns: 1fr;
        }
    }





    /* ── RIGHT SIDEBAR ── */
    .right-sidebar {
        padding: 2rem 1.5rem;
        border-left: 1px solid #e2e8f0;
        background: #fff;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Populaires */
    .rs-title {
        font-size: 12px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5a623;
        padding-left: 8px;
        margin-bottom: 1rem;
    }

    .pop-item {
        display: flex;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .pop-item:last-child {
        border-bottom: none;
    }

    .pop-thumb {
        width: 52px;
        height: 40px;
        border-radius: 4px;
        background: linear-gradient(135deg, #0d1b3e 0%, #162552 100%);
        flex-shrink: 0;
        overflow: hidden;
    }

    .pop-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pop-info .pop-title {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        line-height: 1.35;
        margin-bottom: 4px;
    }

    .pop-meta {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #718096;
    }

    .pop-meta svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
    }

    /* Newsletter RS */
    .nl-rs {
        background: #f4f6fa;
        border-radius: 8px;
        padding: 1.25rem;
    }

    .nl-rs p {
        font-size: 13px;
        font-weight: 700;
        color: #0d1b3e;
        margin-bottom: 5px;
    }

    .nl-rs span {
        font-size: 12px;
        color: #718096;
        line-height: 1.5;
        display: block;
        margin-bottom: 12px;
    }

    .nl-rs-form {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .nl-rs-form input {
        padding: 9px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        outline: none;
        width: 100%;
    }

    .nl-rs-form button {
        background: #0d1b3e;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 9px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background .2s;
    }

    .nl-rs-form button:hover {
        background: #162552;
    }

    /* Stats médias */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .stat-card {
        background: #f4f6fa;
        border-radius: 7px;
        padding: 12px;
        text-align: center;
    }

    .stat-card .snum {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0d1b3e;
        display: block;
    }

    .stat-card .slbl {
        font-size: 11px;
        color: #718096;
        margin-top: 2px;
    }

    .stat-card .sico {
        margin-bottom: 4px;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0d1b3e;
        color: rgba(255, 255, 255, .7);
        padding: 3rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr 1.2fr;
        gap: 2rem;
        margin-bottom: 2.5rem;
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
        align-items: center;
        gap: 8px;
        font-size: 13px;
        margin-bottom: 8px;
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

    /* ── RESPONSIVE ── */
    @media (max-width: 1200px) {
        .page-body {
            grid-template-columns: 200px 1fr;
        }

        .right-sidebar {
            display: none;
        }
    }

    @media (max-width: 900px) {
        .page-body {
            grid-template-columns: 1fr;
        }

        .sidebar {
            display: none;
        }

        .une-grid,
        .derniers-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {

        .une-grid,
        .derniers-grid {
            grid-template-columns: 1fr;
        }

        .tabs {
            gap: 4px;
        }

        .tab {
            font-size: 11px;
            padding: 6px 10px;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
<section class="hero-section">
    <div class="hero-container">
        <!-- Contenu textuel à gauche -->
        <div class="hero-content">
            <h1 class="hero-title">Galerie Médias &amp; <span class="text-yellow">Actualités</span></h1>
            <p class="hero-description">
                Retrouvez tous les contenus médias du Forum International de l'Innovation :<br>
                communiqués, interviews, vidéos, podcasts, galeries photos, livestreams et contenus presse.
            </p>
        </div>
    </div>

    <!-- Barre des boutons de filtrage par type de média (En bas) -->
    <div class="hero-filters-bar">
        <div class="filters-container">
            <button class="filter-btn active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
                Tous les contenus
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Communiqués
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                </svg>
                Interviews
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="23 7 16 12 23 17 23 7" />
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
                </svg>
                Vidéos
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z" />
                    <path d="M19 10v1a7 7 0 0 1-14 0v-1" />
                    <line x1="12" y1="19" x2="12" y2="23" />
                    <line x1="8" y1="23" x2="16" y2="23" />
                </svg>
                Podcasts
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <polyline points="21 15 16 10 5 21" />
                </svg>
                Photos
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" />
                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" />
                </svg>
                Livestreams
            </button>
            <button class="filter-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22 6 12 13 2 6" />
                </svg>
                Presse
            </button>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════
     PAGE BODY — 3 colonnes
══════════════════════════════════════════ --}}
<div class="page-body">

    {{-- ── SIDEBAR FILTRES ── --}}
    <aside class="sidebar" aria-label="Filtres">
        <div class="filter-header">
            <span class="filter-title">Filtres</span>
            <a href="{{ route('galerie') }}" class="filter-reset">Réinitialiser</a>
        </div>

        <form action="{{ route('galerie') }}" method="GET">
            @if (request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
            @endif

            {{-- Recherche --}}
            <div class="filter-section">
                <span class="filter-label">Recherche</span>
                <div class="search-box">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Rechercher un contenu…"
                        aria-label="Rechercher">
                    <button type="submit" aria-label="Lancer la recherche">
                        <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Type de contenu --}}
            <div class="filter-section">
                <span class="filter-label">Type de contenu</span>
                <div class="checkbox-list">
                    @foreach ($types as $type)
                    <div class="cb-item">
                        <input
                            type="checkbox"
                            id="type_{{ $type['slug'] }}"
                            name="types[]"
                            value="{{ $type['slug'] }}"
                            {{ in_array($type['slug'], (array) request('types', [])) ? 'checked' : '' }}>
                        <label for="type_{{ $type['slug'] }}">
                            {{ $type['label'] }} <span>({{ $type['count'] ?? 0 }})</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Thématiques --}}
            <div class="filter-section">
                <span class="filter-label">Thématiques</span>
                <select name="thematique" class="filter-select">
                    <option value="">Toutes les thématiques</option>
                    @foreach ($thematiques as $th)
                    <option value="{{ $th }}" {{ request('thematique') === $th ? 'selected' : '' }}>
                        {{ $th }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Année --}}
            <div class="filter-section">
                <span class="filter-label">Année</span>
                <select name="annee" class="filter-select">
                    <option value="">Toutes les années</option>
                    @foreach ($annees as $a)
                    <option value="{{ $a }}" {{ request('annee') == $a ? 'selected' : '' }}>
                        {{ $a }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Date --}}
            <div class="filter-section">
                <span class="filter-label">Date</span>
                <div class="search-box">
                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="filter-select"
                        style="padding:8px 12px;background-image:none"
                        aria-label="Choisir une période">
                </div>
            </div>

            <button type="submit" class="apply-btn">Appliquer les filtres</button>
        </form>
    </aside>

    {{-- ── CONTENU PRINCIPAL ── --}}
    <main class="main-content">

        <div style="margin-bottom:.75rem">
            <h2 class="section-heading">À La Une</h2>
        </div>

        <div class="une-grid" aria-label="Contenus à la une">

            @php
            // Données statiques identiques à la maquette
            $aLaUneStatic = [
            [
            'type' => 'communique',
            'badge_label' => 'COMMUNIQUÉ',
            'badge_bg' => '#1565c0',
            'image' => 'Cooo.jpg',
            'duree' => null,
            'show_play' => false,
            'date' => '15 Mai 2026',
            'titre' => "Lancement officiel du Forum International de l'Innovation 2026",
            'cta_label' => 'Lire le communiqué',
            'slug' => 'lancement-forum-2026',
            ],
            [
            'type' => 'interview',
            'badge_label' => 'INTERVIEW',
            'badge_bg' => '#2e7d32',
            'image' => 'dio.jpg',
            'duree' => '12:45',
            'show_play' => true,
            'date' => '10 Mai 2026',
            'titre' => "Interview exclusive avec le Ministre de l'Économie et de l'Innovation",
            'cta_label' => "Voir l'interview",
            'slug' => 'interview-ministre',
            ],
            [
            'type' => 'video',
            'badge_label' => 'VIDÉO',
            'badge_bg' => '#162552',
            'image' => 'Ctr.jpg',
            'duree' => '03:21',
            'show_play' => true,
            'date' => '08 Mai 2026',
            'titre' => "Retour en vidéo sur l'édition 2025",
            'cta_label' => 'Regarder la vidéo',
            'slug' => 'retour-2025',
            ],
            [
            'type' => 'podcast',
            'badge_label' => 'PODCAST',
            'badge_bg' => '#f5a623',
            'image' => 'bo.jpg',
            'duree' => '22:18',
            'show_play' => true,
            'date' => '05 Mai 2026',
            'titre' => "Podcast : Innover pour l'Afrique de demain",
            'cta_label' => 'Écouter le podcast',
            'slug' => 'podcast-innover-afrique',
            ],
            ];

            // Utiliser BDD si disponible, sinon statiques
            $items = (isset($aLaUne) && $aLaUne->count() > 0)
            ? $aLaUne
            : collect($aLaUneStatic);
            @endphp

            @foreach ($items as $item)
            @php
            // Compatibilité objet Eloquent ↔ tableau statique
            $img = is_array($item) ? $item['image'] : ($item->image ?? $item->thumbnail ?? null);
            $type = is_array($item) ? $item['type'] : ($item->type ?? 'video');
            $titre = is_array($item) ? $item['titre'] : ($item->titre ?? '');
            $duree = is_array($item) ? $item['duree'] : ($item->duree ?? null);
            $slug = is_array($item) ? $item['slug'] : ($item->slug ?? '#');
            $cta = is_array($item) ? $item['cta_label'] : ($item->cta_label ?? 'Voir le contenu');
            $date = is_array($item) ? $item['date'] : ($item->date ?? now());
            $badgeBg = is_array($item) ? $item['badge_bg'] : ($item->badge_bg ?? '#162552');
            $badgeLbl = is_array($item) ? $item['badge_label'] : ($item->badge_label ?? strtoupper($type));
            $showPlay = is_array($item) ? $item['show_play'] : in_array($type, ['video','interview','podcast','livestream']);

            $dateStr = is_string($date) ? $date : \Carbon\Carbon::parse($date)->translatedFormat('d M Y');
            @endphp

            <article class="une-card">
                {{-- THUMBNAIL --}}
                <div class="une-thumb">
                    @if ($img)
                    <img src="{{ asset('images/'.$img) }}" alt="{{ $titre }}" loading="lazy">
                    @else
                    <div class="thumb-placeholder">
                        <svg width="36" height="36" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.25)" fill="none" stroke-width="1.2">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                        </svg>
                    </div>
                    @endif

                    {{-- Badge type --}}
                    <span class="une-badge" style="background:{{ $badgeBg }};{{ $badgeBg === '#f5a623' ? 'color:#0d1b3e' : 'color:#fff' }}">
                        {{ $badgeLbl }}
                    </span>

                    {{-- Bouton play --}}
                    @if ($showPlay)
                    <div class="play-overlay">
                        <div class="play-btn">
                            <svg viewBox="0 0 24 24" fill="#0d1b3e" width="18" height="18">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg>
                        </div>
                    </div>
                    @endif

                    {{-- Durée --}}
                    @if ($duree)
                    <span class="duration">{{ $duree }}</span>
                    @endif
                </div>

                {{-- CORPS --}}
                <div class="une-body">
                    <div class="une-date">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" width="12" height="12" stroke="#a0aec0">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        {{ $dateStr }}
                    </div>
                    <div class="une-title">{{ $titre }}</div>
                    {{ $cta }}
                    <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" width="12" height="12">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                    </a>
                </div>
            </article>
            @endforeach

        </div>{{-- /.une-grid --}}

        {{-- ══════════════════════════════════════════════
     SECTION DERNIERS CONTENUS
══════════════════════════════════════════════ --}}
        <div class="section-header">
            <h2 class="section-heading">Derniers Contenus</h2>
            <div class="sort-row">
                <span>Trier par :</span>
                <form method="GET" action="{{ route('galerie') }}" style="display:inline">
                    @foreach (request()->except('sort') as $k => $v)
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <select name="sort" onchange="this.form.submit()">
                        <option value="recent" {{ request('sort','recent') === 'recent'    ? 'selected' : '' }}>Plus récents</option>
                        <option value="populaire" {{ request('sort') === 'populaire' ? 'selected' : '' }}>Les plus vus</option>
                        <option value="ancien" {{ request('sort') === 'ancien'    ? 'selected' : '' }}>Plus anciens</option>
                    </select>
                </form>
            </div>
        </div>




        <!-- Exemple pour la section "Derniers Contenus" -->
        <div class="derniers-grid" aria-label="Derniers contenus">

            <!-- Carte 1: Photos -->
            <article class="card">
                <div class="card-image-container">
                    <span class="badge badge-photos">Photos</span>
                    <img src="{{ asset('images/Cooo.jpg') }}" alt="Soirée de lancement">
                    <span class="image-overlay-count">+24</span>
                </div>
                <div class="card-body">
                    <span class="card-date">📅 14 Mai 2026</span>
                    <h3 class="card-title">Galerie photos - Soirée de lancement du Forum 2026</h3>
                    <a href="#" class="card-link">Voir la galerie →</a>
                </div>
            </article>

            <!-- Carte 2: Livestream -->
            <article class="card">
                <div class="card-image-container">
                    <span class="badge badge-live">Livestream</span>
                    <img src="{{ asset('images/Cooo.jpg') }}" alt="Soirée de lancement">
                    <span class="live-indicator">LIVE</span>
                </div>
                <div class="card-body">
                    <span class="card-date">📅 12 Mai 2026</span>
                    <h3 class="card-title">Live : Conférence inaugurale du Forum 2026</h3>
                    <a href="#" class="card-link">Voir le livestream →</a>
                </div>
            </article>

            <!-- Carte 3: Presse -->
            <article class="card">
                <div class="card-image-container">
                    <span class="badge badge-presse">Presse</span>
                    <img src="{{ asset('images/boaa.jpg') }}" alt="Soirée de lancement">
                </div>
                <div class="card-body">
                    <span class="card-date">📅 09 Mai 2026</span>
                    <h3 class="card-title">Revue de presse - Forum 2026 : ce qu'en dit la presse</h3>
                    <a href="#" class="card-link">Lire l'article →</a>
                </div>
            </article>

            <!-- Carte 4: Interview -->
            <article class="card">
                <div class="card-image-container">
                    <span class="badge badge-interview">Interview</span>
                    <img src="{{ asset('images/Cooo.jpg') }}" alt="Soirée de lancement">
                    <span class="video-duration">08:32</span>
                </div>
                <div class="card-body">
                    <span class="card-date">📅 07 Mai 2026</span>
                    <h3 class="card-title">Interview : Les femmes au cœur de l'innovation</h3>
                    <a href="#" class="card-link">Voir l'interview →</a>
                </div>
            </article>

        </div>



    </main>


    {{-- ══════════════════════════════════════════════
     SIDEBAR DROITE (coller dans votre aside)
══════════════════════════════════════════════ --}}

    {{-- CONTENUS POPULAIRES --}}
    <aside class="sidebar-right">

        <!-- Section: Contenus Populaires -->
        <div class="rs-block">
            <div class="rs-title">Contenus Populaires</div>

            <div class="popular-list">
                <!-- Article Populaire 1 -->
                <a href="#" class="popular-item">
                    <div class="popular-img-wrapper">
                        <img src="{{ asset('images/Cooo.jpg') }}" alt="Soirée de lancement">
                    </div>
                    <div class="popular-info">
                        <h4>Lancement officiel du Forum 2026</h4>
                        <span class="popular-views">👁️ 12.5K vues</span>
                    </div>
                </a>

                <!-- Article Populaire 2 -->
                <a href="#" class="popular-item">
                    <div class="popular-img-wrapper">
                        <img src="{{ asset('images/boaa.jpg') }}" alt="Soirée de lancement">
                    </div>
                    <div class="popular-info">
                        <h4>Retour en vidéo sur l'édition 2025</h4>
                        <span class="popular-views">👁️ 8.2K vues</span>
                    </div>
                </a>

                <!-- Article Populaire 3 -->
                <a href="#" class="popular-item">
                    <div class="popular-img-wrapper">
                        <img src="{{ asset('images/Cooo.jpg') }}" alt="Soirée de lancement">
                    </div>
                    <div class="popular-info">
                        <h4>Interview avec le Ministre</h4>
                        <span class="popular-views">👁️ 6.7K vues</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Section: Newsletter -->
        {{-- SECTION NEWSLETTER --}}
        <div class="newsletter-section">
            <h3 class="rs-title">Abonnez-vous à notre newsletter</h3>
            <p>Recevez nos derniers contenus médias et actualités directement dans votre boîte mail.</p>
            <form action="..." method="POST">
                @csrf
                <input type="email" name="email" placeholder="Votre adresse email" required>
                <button type="submit">S'abonner</button>
            </form>
        </div>

        {{-- SECTION STATISTIQUES MÉDIAS (déplacée ici) --}}
        <div class="stats-section-wrapper">
            <h3 class="rs-title">Statistiques Médias</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="sico">
                        <svg width="20" height="20" viewBox="0 0 24 24" stroke="#162552" fill="none" stroke-width="1.8" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                    </div>
                    <span class="snum">{{ $stats['contenus'] }}</span>
                    <div class="slbl">Contenus publiés</div>
                </div>
                <div class="stat-card">
                    <div class="sico">
                        <svg width="20" height="20" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <span class="snum">{{ number_format($stats['vues'] / 1000) }}K</span>
                    <div class="slbl">Vues totales</div>
                </div>
                <div class="stat-card">
                    <div class="sico">
                        <svg width="20" height="20" viewBox="0 0 24 24" stroke="#d32f2f" fill="none" stroke-width="1.8" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <span class="snum">{{ $stats['interviews'] }}</span>
                    <div class="slbl">Interviews</div>
                </div>
                <div class="stat-card">
                    <div class="sico">
                        <svg width="20" height="20" viewBox="0 0 24 24" stroke="#2e7d32" fill="none" stroke-width="1.8" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20" />
                        </svg>
                    </div>
                    <span class="snum">{{ $stats['pays'] }}</span>
                    <div class="slbl">Pays touchés</div>
                </div>
            </div>
        </div>

    </aside>
</div>{{-- /.page-body --}}


{{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}
<footer class="site-footer">
    <div class="footer-grid">

        <div class="fb">
            <a href="{{ route('index') }}" class="nav-logo" style="margin-bottom:.5rem">
                <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                    <img src="http://127.0.0.1:8000/images/264.png"
                        alt="Logo JEFIE Paris 2026"
                        style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                </div>
                <div class="nav-logo-text">
                    <span>Journées économiques et Forum international de</span>l’Emploi de la diaspora gabonaise<br>
                    <small style="color:#f5a623;font-size:10px">2026</small>
                </div>
            </a>
            <p>Ensemble, construisons l'avenir par l'innovation.</p>
            <nav class="socials" aria-label="Réseaux sociaux">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="Twitter / X">&#120143;</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
            </nav>
        </div>

        <div class="fc">
            <h4>Liens Utiles</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('institutionnel') }}">Institutionnel</a>
            <a href="{{ route('emploi') }}">Emploi &amp; Recrutement</a>
            <a href="{{ route('cartographie') }}">Cartographie Diaspora</a>
        </div>

        <div class="fc">
            <h4>Ressources</h4>
            <a href="{{ route('actualites') }}">Communiqués</a>
            <a href="{{ route('dossiers') }}">Dossiers de presse</a>
            <a href="{{ route('galerie') }}">Galerie médias</a>
            <a href="{{ route('rapports') }}">Rapports &amp; Études</a>
            <a href="{{ route('Faq') }}">FAQ</a>
        </div>

        <div class="fc">
            <h4>Informations</h4>
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Politique de confidentialité</a>
            <a href="{{ route('conditions') }}">Conditions d'utilisation</a>
        </div>

        <div class="fc">
            <h4>Contact</h4>
            <div class="fci">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
                </svg>
                +241 11 22 33 44
            </div>
            <div class="fci">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>
                contact@forum-innovation.org
            </div>
            <div class="fci">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                Libreville, Gabon
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} CDC site. Tous droits réservés.
    </div>
</footer>

@endsection