{{-- resources/views/actualites/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Actualités & Annonces — Forum International de l\'Innovation 2026')

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
        background: url("{{ asset('images/div.png') }}") no-repeat center center/cover;
        padding: 3.5rem 2.5rem 3rem;
        position: relative;
        overflow: hidden;

    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        /* Le dégradé occupe la partie gauche (environ 60% de la largeur) */
        width: 60%;
        height: 100%;
        /* Le dégradé part de votre bleu foncé (à gauche) pour aller vers la transparence (à droite) */
        background: linear-gradient(to right, #060e20, transparent);
        z-index: 1;
    }

    /* 3. Pour garder le texte au-dessus du dégradé */
    .hero-content {
        position: relative;
        z-index: 2;
    }


    .hero::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 45%;
        height: 100%;
        background: rgba(5, 15, 45, .45);
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        max-width: 560px;
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

    .hero h1 {
        color: #fff;
        font-size: 2.6rem;
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
        margin-bottom: 1.75rem;
    }

    .hero-search {
        display: flex;
        gap: 8px;
        max-width: 460px;
    }

    .hero-search-input {
        flex: 1;
        padding: 11px 16px;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 6px;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-size: 13px;
        outline: none;
        transition: border-color .2s;
    }

    .hero-search-input::placeholder {
        color: rgba(255, 255, 255, .4);
    }

    .hero-search-input:focus {
        border-color: #f5a623;
    }

    .hero-search-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: opacity .2s;
        white-space: nowrap;
    }

    .hero-search-btn:hover {
        opacity: .9;
    }

    .hero-search-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── STATS BAR ── */
    .stats-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3rem;
        padding: 1.1rem 2.5rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-num {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0d1b3e;
    }

    .stat-lbl {
        font-size: 11px;
        color: #718096;
    }

    .stat-sep {
        width: 1px;
        height: 24px;
        background: #e2e8f0;
    }

    /* ── CATEGORIES ── */
    .categories-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        padding: .85rem 2.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .categories-bar::-webkit-scrollbar {
        display: none;
    }

    .cat-btn {
        padding: 6px 16px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        border: 1.5px solid #e2e8f0;
        color: #718096;
        background: #fff;
        transition: all .2s;
        white-space: nowrap;
    }

    .cat-btn:hover {
        border-color: #0d1b3e;
        color: #0d1b3e;
    }

    .cat-btn.active {
        border-color: transparent;
        color: #fff;
    }

    /* ── PAGE LAYOUT ── */
    .page-wrap {
        display: grid;
        grid-template-columns: 1fr 300px;
        /* ✅ 2 colonnes fixes */
        gap: 2rem;
        padding: 2rem 2.5rem;
        max-width: 1400px;
        margin: 0 auto;
        align-items: start;
    }






    /* ── ARTICLES ── */
    .articles-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        padding-bottom: .75rem;
        border-bottom: 3px solid #f5a623;
    }

    .articles-title {
        font-size: 13px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .articles-title::before {
        content: '';
        width: 4px;
        height: 18px;
        background: #f5a623;
        border-radius: 2px;
    }

    .articles-count {
        font-size: 12px;
        color: #a0aec0;
    }

    /* Grid articles */
    .articles-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .article-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow .2s, transform .2s;
        text-decoration: none;
    }

    .article-card:hover {
        box-shadow: 0 4px 18px rgba(13, 27, 62, .1);
        transform: translateY(-2px);
    }

    .ac-thumb {
        height: 180px;
        overflow: hidden;
        position: relative;
        background: #0d1b3e;
        flex-shrink: 0;
    }

    .ac-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .ac-thumb-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0d1b3e, #162552);
    }

    .ac-thumb-placeholder svg {
        width: 40px;
        height: 40px;
        stroke: rgba(255, 255, 255, .2);
        fill: none;
        stroke-width: 1.2;
    }

    .ac-badge {
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
    }

    .ac-body {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .ac-date {
        font-size: 11px;
        color: #a0aec0;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ac-date svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .ac-title {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        line-height: 1.4;
        flex: 1;
    }

    .ac-excerpt {
        font-size: 12px;
        color: #718096;
        line-height: 1.55;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .ac-link {
        font-size: 12px;
        font-weight: 700;
        color: #0d1b3e;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 4px;
        transition: color .2s;
    }

    .ac-link:hover {
        color: #f5a623;
    }

    .ac-link svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Article featured (large) */
    .article-card.featured {
        grid-column: 1/-1;
        flex-direction: row;
    }

    .article-card.featured .ac-thumb {
        height: auto;
        width: 45%;
        flex-shrink: 0;
    }

    .article-card.featured .ac-body {
        padding: 1.5rem;
    }

    .article-card.featured .ac-title {
        font-size: 1.1rem;
    }

    /* Vide */
    .articles-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        color: #a0aec0;
        gap: 1rem;
        grid-column: 1/-1;
    }

    .articles-empty svg {
        width: 48px;
        height: 48px;
        stroke: #d1d9e6;
        fill: none;
        stroke-width: 1.2;
    }

    .articles-empty p {
        font-size: 13px;
    }

    /* Pagination */
    .pagination-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 1.5rem;
    }

    .page-btn {
        width: 34px;
        height: 34px;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 600;
        color: #162552;
        text-decoration: none;
        transition: all .2s;
        background: #fff;
        cursor: pointer;
    }

    .page-btn:hover {
        border-color: #0d1b3e;
        color: #0d1b3e;
    }

    .page-btn.active {
        background: #0d1b3e;
        color: #fff;
        border-color: #0d1b3e;
    }

    .page-btn.arrow svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── SIDEBAR DROITE ── */
    .right-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        position: sticky;
        top: 80px;
        /* colle sous la nav */
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        scrollbar-width: none;
    }

    .right-sidebar::-webkit-scrollbar {
        display: none;
    }

    .rs-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .rs-title {
        font-size: 11px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .85rem;
        border-left: 3px solid #f5a623;
        padding-left: 8px;
    }


    /* Articles récents sidebar */
    .rec-item {
        display: flex;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
        text-decoration: none;
    }

    .rec-item:last-child {
        border-bottom: none;
    }

    .rec-thumb {
        width: 58px;
        height: 46px;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
        background: #0d1b3e;
    }

    .rec-thumb img {
        width: 58px;
        height: 46px;
        object-fit: cover;
        display: block;
    }

    .rec-body {
        flex: 1;
        min-width: 0;
    }

    .rec-title {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        line-height: 1.35;
        margin-bottom: 3px;
        transition: color .2s;
    }

    .rec-item:hover .rec-title {
        color: #f5a623;
    }

    .rec-date {
        font-size: 10px;
        color: #a0aec0;
    }

    /* ── NEWSLETTER SIDEBAR ── */
    .nl-card {
        background: #0d1b3e;
        border-radius: 10px;
        padding: 1.25rem;
    }

    .nl-icon {
        width: 42px;
        height: 42px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .75rem;
    }

    .nl-icon svg {
        width: 20px;
        height: 20px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
    }

    .nl-title {
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .nl-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 11px;
        line-height: 1.5;
        margin-bottom: .85rem;
    }

    .nl-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-size: 12px;
        outline: none;
        font-family: inherit;
        margin-bottom: 8px;
        transition: border-color .2s;
    }

    .nl-input:focus {
        border-color: rgba(255, 255, 255, .4);
    }

    .nl-input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .nl-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        transition: opacity .2s;
        font-family: inherit;
    }

    .nl-btn:hover {
        opacity: .9;
    }

    .nl-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── ARTICLES RÉCENTS ── */
    .rec-item {
        display: flex;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
        text-decoration: none;
    }

    .rec-item:last-child {
        border-bottom: none;
    }

    .rec-thumb {
        width: 58px;
        height: 46px;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
        background: #0d1b3e;
    }

    .rec-thumb img {
        width: 58px;
        height: 46px;
        object-fit: cover;
        display: block;
        border-radius: 6px;
    }

    .rec-body {
        flex: 1;
        min-width: 0;
    }

    .rec-title {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        line-height: 1.35;
        margin-bottom: 3px;
        transition: color .2s;
    }

    .rec-item:hover .rec-title {
        color: #f5a623;
    }

    .rec-date {
        font-size: 10px;
        color: #a0aec0;
    }

    /* ── CATÉGORIES ── */
    .cat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
        text-decoration: none;
        transition: color .2s;
    }

    .cat-item:last-child {
        border-bottom: none;
    }

    .cat-name {
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cat-name svg {
        width: 13px;
        height: 13px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .cat-item:hover .cat-name {
        color: #f5a623;
    }

    .cat-item:hover .cat-name svg {
        stroke: #f5a623;
    }

    .cat-count {
        font-size: 11px;
        font-weight: 700;
        color: #0d1b3e;
        background: #f0f4f8;
        padding: 2px 9px;
        border-radius: 10px;
        flex-shrink: 0;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0d1b3e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
        margin-top: 2rem;
        width: 100%;
        /* ✅ pleine largeur */
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        /* ✅ 4 colonnes */
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
        font-size: 10px;
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
        gap: 8px;
        font-size: 12px;
        margin-bottom: 7px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
        margin-top: 2px;
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
        font-size: 11px;
        color: rgba(255, 255, 255, .35);
    }

    .footer-legal {
        display: flex;
        gap: 1.25rem;
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

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .page-wrap {
            grid-template-columns: 1fr;
        }

        .right-sidebar {
            position: static;
            max-height: none;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-wrap {
            padding: 1.5rem 1rem;
        }

        .articles-grid {
            grid-template-columns: 1fr;
        }

        .article-card.featured {
            flex-direction: column;
        }

        .article-card.featured .ac-thumb {
            width: 100%;
            height: 200px;
        }

        .hero h1 {
            font-size: 1.8rem;
        }

        .stats-band {
            gap: 1rem;
            padding: .85rem 1rem;
        }

        .site-footer {
            padding: 2rem 1.25rem 0;
        }
    }

    @media (max-width: 480px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .filtres-row {
            gap: 5px;
        }

        .filtre-tab {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>




@endsection

@section('content')

@include('components.navbar')

</div>
</nav>

{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">
            <svg width="12" height="12" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                <path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a4 4 0 01-4-4V6a2 2 0 012-2" />
            </svg>
            Actualités & Annonces officielles
        </div>
        <h1>Actualités <span>&amp; Annonces</span></h1>
        <p class="hero-desc">Retrouvez toutes les actualités, annonces et informations officielles du Forum International de l'Innovation 2026.</p>
        <form action="{{ route('actualites') }}" method="GET" class="hero-search">
            <input type="text" name="q" class="hero-search-input"
                placeholder="Rechercher un article, une annonce..." value="{{ request('q') }}">
            <button type="submit" class="hero-search-btn">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
                Rechercher
            </button>
        </form>
    </div>
</section>

{{-- ══ STATS ══ --}}
<div class="stats-bar">
    @foreach ($stats as $i => $s)
    @if ($i > 0)<div class="stat-sep"></div>@endif
    <div class="stat-item">
        <span class="stat-num">{{ $s['valeur'] }}</span>
        <span class="stat-lbl">{{ $s['label'] }}</span>
    </div>
    @endforeach
</div>

{{-- ══ CATEGORIES ══ --}}
<div class="categories-bar" role="navigation" aria-label="Filtres par catégorie">
    @foreach ($categories as $cat)
    <a href="{{ route('actualites', ['categorie' => $cat['slug']]) }}"
        class="cat-btn {{ $categorieActive === $cat['slug'] ? 'active' : '' }}"
        style="{{ $categorieActive === $cat['slug'] ? 'background:'.$cat['color'].';border-color:'.$cat['color'] : '' }}">
        {{ $cat['label'] }}
    </a>
    @endforeach
</div>

{{-- ══ PAGE LAYOUT ══ --}}
<div class="page-layout">

    {{-- ── COLONNE PRINCIPALE ── --}}
    <main>


        {{-- ══ CONTENU PRINCIPAL ══ --}}
        <div class="page-wrap">

            {{-- ── Colonne articles ── --}}
            <div>
                <div class="articles-header">
                    <div class="articles-title">
                        {{ request('categorie') ? ucfirst(request('categorie')) : 'Toutes les Actualités' }}
                    </div>
                    <span class="articles-count">
                        {{ isset($actualites) ? $actualites->total() : count($articlesStatiques ?? []) }} article{{ (isset($actualites) ? $actualites->total() : count($articlesStatiques ?? [])) > 1 ? 's' : '' }}
                    </span>
                </div>

                @php
                // Données statiques identiques à la maquette
                $articlesStatiques = [
                [
                'featured' => true,
                'image' => 'Cooo.jpg',
                'categorie' => 'annonce',
                'badge' => 'ANNONCE',
                'badge_bg' => '#1565c0',
                'date' => '15 Mai 2026',
                'titre' => "Lancement officiel du Forum International de l'Innovation 2026",
                'extrait' => "Le Forum International de l'Innovation 2026 ouvre officiellement ses portes. Rejoignez plus de 5 000 participants venus de 50 pays pour trois jours d'échanges, de rencontres et d'opportunités uniques.",
                'slug' => 'lancement-forum-2026',
                ],
                [
                'featured' => false,
                'image' => 'Ctr.jpg',
                'categorie' => 'programme',
                'badge' => 'PROGRAMME',
                'badge_bg' => '#2e7d32',
                'date' => '10 Mai 2026',
                'titre' => "Découvrez le programme complet du Forum",
                'extrait' => "Consultez le programme des conférences, ateliers et tables rondes prévus lors des 3 jours.",
                'slug' => 'programme-complet',
                ],
                [
                'featured' => false,
                'image' => 'CGFjpg.jpg',
                'categorie' => 'annonce',
                'badge' => 'APPEL',
                'badge_bg' => '#f5a623',
                'date' => '28 Avr. 2026',
                'titre' => "Appel à communication ouvert aux chercheurs et experts",
                'extrait' => "Soumettez vos propositions d'interventions avant le 30 mai 2026.",
                'slug' => 'appel-communication',
                ],
                [
                'featured' => false,
                'image' => 'Cooo.jpg',
                'categorie' => 'partenariat',
                'badge' => 'PARTENARIAT',
                'badge_bg' => '#8e24aa',
                'date' => '20 Avr. 2026',
                'titre' => "Annonce des premiers partenaires institutionnels du Forum",
                'extrait' => "Le Forum est fier d'annoncer ses premiers grands partenaires institutionnels pour l'édition 2026.",
                'slug' => 'premiers-partenaires',
                ],
                [
                'featured' => false,
                'image' => 'dio.jpg',
                'categorie' => 'interview',
                'badge' => 'INTERVIEW',
                'badge_bg' => '#00838f',
                'date' => '15 Avr. 2026',
                'titre' => "Interview du Président du Comité d'Organisation",
                'extrait' => "SEM. Amadou Koné partage sa vision du Forum et ses ambitions pour la diaspora africaine.",
                'slug' => 'interview-president',
                ],
                [
                'featured' => false,
                'image' => 'Ctr.jpg',
                'categorie' => 'innovation',
                'badge' => 'INNOVATION',
                'badge_bg' => '#e53935',
                'date' => '10 Avr. 2026',
                'titre' => "Ouverture des inscriptions et de la billetterie en ligne",
                'extrait' => "Les inscriptions pour le Forum 2026 sont désormais ouvertes. Réservez votre place dès maintenant.",
                'slug' => 'ouverture-inscriptions',
                ],
                ];

                // Filtrer par catégorie si demandé
                if (request('categorie')) {
                $articlesStatiques = array_filter($articlesStatiques, fn($a) => $a['categorie'] === request('categorie'));
                }
                if (request('q')) {
                $q = strtolower(request('q'));
                $articlesStatiques = array_filter($articlesStatiques, fn($a) => str_contains(strtolower($a['titre']), $q) || str_contains(strtolower($a['extrait']), $q));
                }

                // Utiliser BDD si disponible
                $items = (isset($actualites) && $actualites->count() > 0) ? $actualites : collect($articlesStatiques);
                @endphp

                <div class="articles-grid">
                    @forelse ($items as $actu)
                    @php
                    $img = is_array($actu) ? $actu['image'] : ($actu->image ?? null);
                    $titre = is_array($actu) ? $actu['titre'] : ($actu->titre ?? '');
                    $extrait = is_array($actu) ? $actu['extrait'] : ($actu->extrait ?? '');
                    $slug = is_array($actu) ? $actu['slug'] : ($actu->slug ?? '#');
                    $date = is_array($actu) ? $actu['date'] : ($actu->date ?? now());
                    $badge = is_array($actu) ? $actu['badge'] : strtoupper($actu->categorie ?? 'ACTUALITÉ');
                    $badgeBg = is_array($actu) ? $actu['badge_bg'] : '#162552';
                    $featured = is_array($actu) ? ($actu['featured'] ?? false) : false;
                    $dateStr = is_string($date) ? $date : \Carbon\Carbon::parse($date)->translatedFormat('d M Y');
                    @endphp
                    <a href="{{ route('actualites.show', $slug) }}" class="article-card {{ $featured ? 'featured' : '' }}">
                        <div class="ac-thumb">
                            @if ($img)
                            <img src="{{ asset('images/'.$img) }}" alt="{{ $titre }}" loading="lazy">
                            @else
                            <div class="ac-thumb-placeholder">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </div>
                            @endif
                            <span class="ac-badge" style="background:{{ $badgeBg }};{{ $badgeBg==='#f5a623'?'color:#0d1b3e':'' }}">{{ $badge }}</span>
                        </div>
                        <div class="ac-body">
                            <div class="ac-date">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg>
                                {{ $dateStr }}
                            </div>
                            <div class="ac-title">{{ $titre }}</div>
                            @if ($extrait)
                            <div class="ac-excerpt">{{ $extrait }}</div>
                            @endif
                            <span class="ac-link">
                                Lire la suite
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </a>
                    @empty
                    <div class="articles-empty">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                        <p>Aucun article disponible pour le moment.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if (isset($actualites) && $actualites->hasPages())
                <div class="pagination-wrap">
                    <a href="{{ $actualites->previousPageUrl() }}" class="page-btn arrow">
                        <svg viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </a>
                    @foreach ($actualites->getUrlRange(1, $actualites->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="page-btn {{ $actualites->currentPage() === $page ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach
                    <a href="{{ $actualites->nextPageUrl() }}" class="page-btn arrow">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </a>
                </div>
                @endif
            </div>

            {{-- ── SIDEBAR DROITE ── --}}
            <aside class="right-sidebar">

                {{-- Articles récents --}}
                <div class="rs-card">
                    <div class="rs-title">Articles Récents</div>
                    @foreach ([
                    ['Cooo.jpg', "Lancement officiel du Forum 2026", '15 Mai 2026', 'lancement-forum-2026'],
                    ['Ctr.jpg', "Programme complet du Forum dévoilé", '10 Mai 2026', 'programme-complet'],
                    ['dio.jpg', "Interview du Président du Comité", '15 Avr. 2026','interview-president'],
                    ['CGFjpg.jpg',"Premiers partenaires institutionnels", '20 Avr. 2026','premiers-partenaires'],
                    ] as [$img, $titre, $date, $slug])
                    <a href="{{ route('actualites.show', $slug) }}" class="rec-item">
                        <div class="rec-thumb">
                            <img src="{{ asset('images/'.$img) }}" alt="{{ $titre }}" loading="lazy">
                        </div>
                        <div class="rec-body">
                            <div class="rec-title">{{ $titre }}</div>
                            <div class="rec-date">{{ $date }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Newsletter --}}
                <div class="nl-card">
                    <div class="nl-icon"><svg viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg></div>
                    <div class="nl-title">Newsletter officielle</div>
                    <p class="nl-desc">Recevez nos actualités et communiqués en avant-première.</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input type="email" name="email_newsletter" class="nl-input" placeholder="Votre email" required>
                        <button type="submit" class="nl-btn">
                            <svg viewBox="0 0 24 24">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
                            </svg>
                            S'abonner
                        </button>
                    </form>
                </div>

                {{-- Catégories --}}
                <div class="rs-card">
                    <div class="rs-title">Catégories</div>
                    @foreach ([
                    ['
                    <path d="M4 22h16a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v16a4 4 0 01-4-4V6a2 2 0 012-2" />','Communiqués', 'communique', '12'],
                    ['
                    <path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z" />', 'Interviews', 'interview', '8'],
                    ['
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />', 'Annonces', 'annonce', '14'],
                    ['
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />', 'Programme', 'programme', '6'],
                    ['
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />', 'Partenariats', 'partenariat', '5'],
                    ['
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />', 'Innovation', 'innovation', '8'],
                    ['
                    <circle cx="12" cy="12" r="10" />
                    <path d="M2 12h20M12 2a15.3 15.3 0 010 20" />', 'Diaspora', 'diaspora', '7'],
                    ] as [$ic, $nom, $cat, $nb])
                    <a href="{{ route('actualites', ['categorie'=>$cat]) }}" class="cat-item">
                        <div class="cat-name">
                            <svg viewBox="0 0 24 24" stroke="#a0aec0" fill="none" stroke-width="1.7" width="13" height="13">{!! $ic !!}</svg>
                            {{ $nom }}
                        </div>
                        <span class="cat-count">{{ $nb }}</span>
                    </a>
                    @endforeach
                </div>

            </aside>

        </div>{{-- /.page-wrap --}}

        {{-- ══ FOOTER ══ --}}

        <footer class="site-footer">
            <div class="footer-grid">
                <div class="fb">
                    <a href="http://127.0.0.1:8000/accueil-alias-index" class="nav-logo" style="margin-bottom:.4rem">
                        <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                            <img src="http://127.0.0.1:8000/images/264.png"
                                alt="Logo JEFIE Paris 2026"
                                style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                        </div>
                        <div class="nav-logo-text" style="color:#fff"><span>Forum International</span>de l'Innovation<br><small>2026</small></div>
                    </a>
                    <p>Le rendez-vous mondial des décideurs, innovateurs et entrepreneurs engagés pour un avenir durable.</p>
                    <nav class="socials">
                        <a href="#" aria-label="Facebook">f</a>
                        <a href="#" aria-label="LinkedIn">in</a>
                        <a href="#" aria-label="Twitter">&#120143;</a>
                        <a href="#" aria-label="YouTube">&#9654;</a>
                        <a href="#" aria-label="Instagram">&#9752;</a>
                    </nav>
                </div>
                <div class="fc">
                    <h4>Navigation</h4>
                    <a href="http://127.0.0.1:8000/accueil-alias-index">Accueil</a>
                    <a href="http://127.0.0.1:8000/programme">Programme</a>
                    <a href="http://127.0.0.1:8000/institutionnel">Institutionnel</a>
                    <a href="http://127.0.0.1:8000">Partenaires</a>
                    <a href="http://127.0.0.1:8000/actualites">Actualités</a>
                    <a href="http://127.0.0.1:8000/a-propos">À propos</a>
                </div>
                <div class="fc">
                    <h4>Participer</h4>
                    <a href="http://127.0.0.1:8000/inscription">S'inscrire</a>
                    <a href="http://127.0.0.1:8000/partenaires/devenir">Devenir partenaire</a>
                    <a href="http://127.0.0.1:8000/emploi">Emploi &amp; Recrutement</a>
                    <a href="http://127.0.0.1:8000/cartographie">Cartographie Diaspora</a>
                    <a href="http://127.0.0.1:8000/faq">FAQ</a>
                </div>
                <div class="fc">
                    <h4>Contact</h4>
                    <div class="fci">
                        <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                        contact@forum-innovation.org
                    </div>
                    <div class="fci">
                        <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81" />
                        </svg>
                        +221 33 123 45 67
                    </div>
                    <div class="fci">
                        <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Paris, France &amp; Dakar, Sénégal
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <span class="footer-copy">&copy; 2026 Forum International de l'Innovation. Tous droits réservés.</span>
                <div class="footer-legal">
                    <a href="http://127.0.0.1:8000/mentions-legales">Mentions légales</a>
                    <a href="http://127.0.0.1:8000/confidentialite">Confidentialité</a>
                    <a href="http://127.0.0.1:8000/conditions-utilisation">CGU</a>
                </div>
            </div>
        </footer>




        <script>
            // Token CSRF pour les requêtes AJAX
            window.csrfToken = 'lNphTvSzaiTIMnvBYV5lNw18pwZFW5h1dawDk2zY';

            // Auto-disparition du message flash après 4 secondes
            document.addEventListener('DOMContentLoaded', function() {
                const flash = document.getElementById('flash-message');
                if (flash) {
                    setTimeout(() => {
                        flash.style.opacity = '0';
                        setTimeout(() => flash.remove(), 300);
                    }, 4000);
                }
            });
        </script>


        <script>
            function toggleFaq(index) {
                const item = document.getElementById('faq-' + index);
                const btn = item.querySelector('.faq-toggle');
                const isOpen = item.classList.contains('open');
                // Fermer tous
                document.querySelectorAll('.faq-item').forEach(el => {
                    el.classList.remove('open');
                    el.querySelector('.faq-toggle').setAttribute('aria-expanded', 'false');
                });
                // Ouvrir si fermé
                if (!isOpen) {
                    item.classList.add('open');
                    btn.setAttribute('aria-expanded', 'true');
                }
            }
        </script>


        </body>

        </html>