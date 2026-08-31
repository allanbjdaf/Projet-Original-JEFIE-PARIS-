{{-- resources/views/rapports/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Rapports & Documents — JEFIE Paris 2026')
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
        padding: 0 2rem;
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
        width: 44px;
        height: 44px;
        border: 2px solid #f5c518;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-logo-icon svg {
        width: 22px;
        height: 22px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .8);
        font-size: 13px;
        text-decoration: none;
        transition: color .2s;
        white-space: nowrap;
    }

    .nav-links a:hover {
        color: #fff;
    }

    .nav-links a.active {
        color: #f5c518;
        border-bottom: 2px solid #f5c518;
        padding-bottom: 2px;
        font-weight: 700;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-nav {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 20px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .btn-nav:hover {
        opacity: .9;
    }

    /* ── HERO ── */
    .hero {
        background: linear-gradient(108deg, #060e20 0%, #0f284e 55%, #0f2a5e 100%);
        padding: 2.5rem 2.5rem 3rem;
        position: relative;
        overflow: hidden;
    }

    .hero::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 40%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Ccircle cx='300' cy='80' r='120' fill='rgba(245,166,35,0.04)'/%3E%3Ccircle cx='350' cy='220' r='80' fill='rgba(245,166,35,0.03)'/%3E%3C/svg%3E") no-repeat center;
        pointer-events: none;
        z-index: 0;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        max-width: 600px;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(245, 166, 35, .12);
        border: 1px solid rgba(245, 166, 35, .3);
        color: #f5c518;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 3px;
        margin-bottom: .85rem;
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
        font-size: 2rem;
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.1;
        margin-bottom: .5rem;
    }

    .hero h1 span {
        color: #f5c518;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .88rem;
        line-height: 1.65;
        margin-bottom: 1.5rem;
        max-width: 480px;
    }

    .hero-stats {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .h-stat {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .h-stat-num {
        color: #fff;
        font-size: 1.2rem;
        font-weight: 900;
    }

    .h-stat-lbl {
        color: rgba(255, 255, 255, .55);
        font-size: 11px;
    }

    /* ── PAGE WRAP ── */
    .page-wrap {
        max-width: 1300px;
        margin: 0 auto;
        padding: 2rem 2.5rem;
    }

    /* ── BARRE ACTIONS ── */
    .action-bar {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .search-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 8px 14px;
        flex: 1;
        min-width: 220px;
    }

    .search-wrap svg {
        width: 15px;
        height: 15px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 2;
        flex-shrink: 0;
    }

    .search-wrap input {
        border: none;
        background: transparent;
        outline: none;
        font-size: 13px;
        color: #1a2744;
        width: 100%;
        font-family: inherit;
    }

    .search-wrap input::placeholder {
        color: #a0aec0;
    }

    .filter-select {
        padding: 8px 24px 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 13px;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 13px;
        cursor: pointer;
        color: #1a2744;
        font-family: inherit;
        background-color: #fff;
    }

    .btn-dl-sel {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 18px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background .2s;
        font-family: inherit;
        white-space: nowrap;
    }

    .btn-dl-sel:hover {
        background: #0a1e38;
    }

    .btn-dl-sel:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    .btn-dl-sel svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .sel-count {
        font-size: 12px;
        color: #718096;
        white-space: nowrap;
    }

    .sel-count strong {
        color: #0f284e;
    }

    /* ── CATÉGORIES TABS ── */
    .cats-bar {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .cat-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        border: 1.5px solid #e2e8f0;
        color: #718096;
        background: #fff;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
        white-space: nowrap;
    }

    .cat-tab:hover {
        border-color: #0f284e;
        color: #0f284e;
    }

    .cat-tab.active {
        background: #0f284e;
        color: #fff;
        border-color: #0f284e;
    }

    .cat-tab svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .cat-count {
        background: rgba(255, 255, 255, .2);
        padding: 1px 6px;
        border-radius: 8px;
        font-size: 10px;
    }

    .cat-tab:not(.active) .cat-count {
        background: #f0f4f8;
        color: #718096;
    }

    /* ── GRID RAPPORTS ── */
    .rapports-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .rapports-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 10px;
    }

    .rapports-count {
        font-size: 12px;
        color: #a0aec0;
    }

    .rapports-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    /* ── CARTE RAPPORT ── */
    .rapport-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow .2s, transform .2s;
        position: relative;
    }

    .rapport-card:hover {
        box-shadow: 0 6px 22px rgba(15, 40, 78, .1);
        transform: translateY(-2px);
    }

    .rapport-card.featured {
        border: 2px solid #f5c518;
    }

    .featured-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #f5c518;
        color: #0f284e;
        font-size: 9px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: .06em;
        z-index: 2;
    }

    /* Preview PDF */
    .rapport-preview {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    .preview-bg-pdf {
        background: linear-gradient(135deg, #c2185b, #e91e63);
    }

    .preview-bg-pptx {
        background: linear-gradient(135deg, #f5c518, #d4a800);
    }

    .preview-bg-xlsx {
        background: linear-gradient(135deg, #1b5e20, #43a047);
    }

    .preview-bg-docx {
        background: linear-gradient(135deg, #0f284e, #1976d2);
    }

    .preview-bg-zip {
        background: linear-gradient(135deg, #4a148c, #7b1fa2);
    }

    .preview-bg-default {
        background: linear-gradient(135deg, #0f284e, #0a1e38);
    }

    .preview-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        position: relative;
        z-index: 1;
    }

    .preview-icon svg {
        width: 48px;
        height: 48px;
        stroke: rgba(255, 255, 255, .9);
        fill: none;
        stroke-width: 1.4;
    }

    .preview-ext {
        color: rgba(255, 255, 255, .7);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
    }

    .preview-pattern {
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(45deg, rgba(255, 255, 255, .03) 0, rgba(255, 255, 255, .03) 1px, transparent 0, transparent 50%) 0 0/20px 20px;
    }

    .preview-select {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 3;
    }

    .preview-select input[type=checkbox] {
        width: 18px;
        height: 18px;
        accent-color: #f5c518;
        cursor: pointer;
        border-radius: 3px;
    }

    /* Corps carte */
    .rapport-body {
        padding: 1.1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .rapport-cat {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: .05em;
        width: fit-content;
    }

    .rapport-titre {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
        line-height: 1.35;
    }

    .rapport-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.55;
        flex: 1;
    }

    .rapport-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .rapport-meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #a0aec0;
    }

    .rapport-meta-item svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .statut-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .statut-badge svg {
        width: 9px;
        height: 9px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .s-pret {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .s-cours {
        background: #e3f2fd;
        color: #0f284e;
    }

    .s-bientot {
        background: #fff8e6;
        color: #b07d10;
    }

    /* Footer carte */
    .rapport-footer {
        padding: .85rem 1.1rem;
        border-top: 1px solid #f0f4f8;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-dl {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .2s;
        text-decoration: none;
        flex: 1;
        justify-content: center;
    }

    .btn-dl:hover {
        background: #0a1e38;
    }

    .btn-dl svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-preview {
        width: 34px;
        height: 34px;
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .2s;
        text-decoration: none;
    }

    .btn-preview:hover {
        background: #e2e8f0;
    }

    .btn-preview svg {
        width: 15px;
        height: 15px;
        stroke: #718096;
        fill: none;
        stroke-width: 1.8;
    }

    .dl-count {
        font-size: 10px;
        color: #a0aec0;
        display: flex;
        align-items: center;
        gap: 3px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .dl-count svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    /* ── RAPPORT VEDETTE (large) ── */
    .rapport-card.large {
        grid-column: 1/-1;
        flex-direction: row;
    }

    .rapport-card.large .rapport-preview {
        width: 280px;
        height: auto;
        flex-shrink: 0;
    }

    .rapport-card.large .rapport-body {
        padding: 1.5rem;
    }

    .rapport-card.large .rapport-titre {
        font-size: 1.1rem;
    }

    /* ── SECTION NL ── */
    .nl-section {
        background: #0f284e;
        border-radius: 12px;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .nl-icon-wrap {
        width: 56px;
        height: 56px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nl-icon-wrap svg {
        width: 26px;
        height: 26px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.6;
    }

    .nl-content {
        flex: 1;
    }

    .nl-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .nl-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
        line-height: 1.5;
    }

    .nl-form {
        display: flex;
        gap: 8px;
        min-width: 280px;
    }

    .nl-input {
        flex: 1;
        padding: 10px 14px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 6px;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-size: 13px;
        outline: none;
        font-family: inherit;
    }

    .nl-input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .nl-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        white-space: nowrap;
        transition: opacity .2s;
        font-family: inherit;
    }

    .nl-btn:hover {
        opacity: .9;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
        margin-top: 2rem;
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
        gap: 7px;
        font-size: 12px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, .7);
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
    }

    .footer-legal a:hover {
        color: rgba(255, 255, 255, .7);
    }

    @media (max-width:1100px) {
        .rapports-grid {
            grid-template-columns: 1fr 1fr;
        }

        .rapport-card.large {
            flex-direction: column;
        }

        .rapport-card.large .rapport-preview {
            width: 100%;
            height: 160px;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .rapports-grid {
            grid-template-columns: 1fr;
        }

        .page-wrap {
            padding: 1.5rem 1rem;
        }

        .nl-section {
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


{{-- HERO --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            Centre de ressources officiel
        </div>
        <h1>Rapports <span>&amp; Documents</span></h1>
        <p class="hero-desc">Accédez à tous les rapports officiels, études stratégiques, présentations et ressources documentaires du Forum JEFIE Paris 2026.</p>
        <div class="hero-stats">
            @foreach ([['24','Documents disponibles'],['8','Catégories'],['3','Langues'],['100%','Gratuit']] as [$n,$l])
            <div class="h-stat">
                <div>
                    <div class="h-stat-num">{{ $n }}</div>
                    <div class="h-stat-lbl">{{ $l }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PAGE CONTENT --}}
<div class="page-wrap">

    {{-- Barre d'actions --}}
    <div class="action-bar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" />
                <path d="M21 21l-4.35-4.35" />
            </svg>
            <input type="text" id="searchInput" placeholder="Rechercher un rapport, une étude..." oninput="filterRapports()">
        </div>
        <select class="filter-select" id="filterCat" onchange="filterRapports()">
            <option value="">Toutes les catégories</option>
            @foreach (['rapport-annuel','etude','presentation','guide','communique','programme','bilan','ressource'] as $cat)
            <option value="{{ $cat }}">{{ ucfirst(str_replace('-',' ',$cat)) }}</option>
            @endforeach
        </select>
        <select class="filter-select" id="filterAnnee" onchange="filterRapports()">
            <option value="">Toutes les années</option>
            @foreach (['2026','2025','2024','2023'] as $a)
            <option value="{{ $a }}">{{ $a }}</option>
            @endforeach
        </select>
        <span class="sel-count"><strong id="selCount">0</strong> sélectionné(s)</span>
        <button class="btn-dl-sel" id="btnDlSel" disabled onclick="telechargerSelection()">
            <svg viewBox="0 0 24 24">
                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                <polyline points="7 10 12 15 17 10" />
                <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
            Télécharger la sélection
        </button>
    </div>

    {{-- Catégories --}}
    <div class="cats-bar">
        @foreach ([
        ['', 'Tous les documents', '
        <rect x="3" y="3" width="7" height="7" rx="1" />
        <rect x="14" y="3" width="7" height="7" rx="1" />
        <rect x="3" y="14" width="7" height="7" rx="1" />
        <rect x="14" y="14" width="7" height="7" rx="1" />', 24],
        ['rapport-annuel','Rapports annuels','
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />',6],
        ['etude', 'Études & Recherches','
        <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z" />
        <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" />',5],
        ['presentation', 'Présentations', '
        <rect x="2" y="3" width="20" height="14" rx="2" />',4],
        ['guide', 'Guides pratiques', '
        <path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />',4],
        ['programme', 'Programme officiel', '
        <rect x="3" y="4" width="18" height="18" rx="2" />',2],
        ['bilan', 'Bilans & Comptes', '
        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />',3],
        ] as [$val,$lbl,$ic,$cnt])
        <a href="#" class="cat-tab {{ $val === '' ? 'active' : '' }}"
            data-cat="{{ $val }}" onclick="setCat(this,'{{ $val }}'); return false;">
            <svg viewBox="0 0 24 24" width="13" height="13" stroke="currentColor" fill="none" stroke-width="1.8">{!! $ic !!}</svg>
            {{ $lbl }}
            <span class="cat-count">{{ $cnt }}</span>
        </a>
        @endforeach
    </div>

    {{-- Header --}}
    <div class="rapports-header">
        <div class="rapports-title">Tous les Documents</div>
        <div class="rapports-count" id="resultsCount">24 résultats</div>
    </div>

    {{-- GRID --}}
    <div class="rapports-grid" id="rapportsGrid">

        @php
        $rapports = [
        // VEDETTE (large)
        ['large'=>true,'featured'=>true,'cat'=>'rapport-annuel','cat_label'=>'Rapport Annuel','cat_color'=>'#c2185b','cat_bg'=>'#fce4ec','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Rapport Annuel du Forum JEFIE 2025','desc'=>'Bilan complet de l\'édition 2025 : participants, opportunités créées, impact économique sur la diaspora gabonaise et résultats des tables rondes.','periode'=>'Décembre 2025','taille'=>'8.2 MB','telechargements'=>'1 247','annee'=>'2025','statut'=>'pret','url'=>'#'],
        // NORMAUX
        ['large'=>false,'featured'=>false,'cat'=>'rapport-annuel','cat_label'=>'Rapport Annuel','cat_color'=>'#c2185b','cat_bg'=>'#fce4ec','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Rapport Financier Q4 2025','desc'=>'Analyse financière du dernier trimestre 2025 incluant les budgets alloués et les résultats des partenariats conclus.','periode'=>'Oct - Déc 2025','taille'=>'4.2 MB','telechargements'=>'342','annee'=>'2025','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'etude','cat_label'=>'Étude','cat_color'=>'#0f284e','cat_bg'=>'#e3f2fd','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Étude sur l\'Emploi de la Diaspora Gabonaise en Europe','desc'=>'Analyse approfondie du marché de l\'emploi pour les Gabonais d\'Europe : secteurs porteurs, rémunérations et perspectives.','periode'=>'Novembre 2025','taille'=>'6.8 MB','telechargements'=>'892','annee'=>'2025','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'presentation','cat_label'=>'Présentation','cat_color'=>'#f5c518','cat_bg'=>'#fff3e0','ext'=>'PPTX','preview_class'=>'preview-bg-pptx','titre'=>'Présentation Officielle du Forum JEFIE Paris 2026','desc'=>'Dossier de présentation complet du Forum : objectifs, programme, intervenants et opportunités de partenariat.','periode'=>'Janvier 2026','taille'=>'12.4 MB','telechargements'=>'2 103','annee'=>'2026','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'guide','cat_label'=>'Guide','cat_color'=>'#2e7d32','cat_bg'=>'#e8f5e9','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Guide du Participant — JEFIE 2026','desc'=>'Tout ce que vous devez savoir pour préparer votre participation : logistique, programme, networking et opportunités.','periode'=>'Mars 2026','taille'=>'3.1 MB','telechargements'=>'4 521','annee'=>'2026','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'etude','cat_label'=>'Étude','cat_color'=>'#0f284e','cat_bg'=>'#e3f2fd','ext'=>'XLSX','preview_class'=>'preview-bg-xlsx','titre'=>'Base de Données — Entrepreneurs Diaspora 2025','desc'=>'Données structurées des 3 811 entrepreneurs référencés : secteur, pays, chiffre d\'affaires et contacts clés.','periode'=>'Décembre 2025','taille'=>'15.3 MB','telechargements'=>'678','annee'=>'2025','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'guide','cat_label'=>'Guide','cat_color'=>'#2e7d32','cat_bg'=>'#e8f5e9','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Guide du Recruteur — Talent de la Diaspora','desc'=>'Manuel pratique pour les recruteurs souhaitant attirer et intégrer les talents de la diaspora africaine.','periode'=>'Février 2026','taille'=>'2.8 MB','telechargements'=>'1 034','annee'=>'2026','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'programme','cat_label'=>'Programme','cat_color'=>'#6a1b9a','cat_bg'=>'#ede7f6','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Programme Complet — Forum JEFIE Paris 2026','desc'=>'Programme détaillé des 4 jours : conférences, ateliers, tables rondes, rendez-vous B2B et événements de networking.','periode'=>'2026','taille'=>'5.6 MB','telechargements'=>'8 902','annee'=>'2026','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'bilan','cat_label'=>'Bilan','cat_color'=>'#b07d10','cat_bg'=>'#fff8e6','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Bilan d\'Impact Économique — Forum 2024','desc'=>'Mesure de l\'impact économique du Forum 2024 : emplois créés, partenariats signés, investissements générés.','periode'=>'2024','taille'=>'7.1 MB','telechargements'=>'445','annee'=>'2024','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'presentation','cat_label'=>'Présentation','cat_color'=>'#f5c518','cat_bg'=>'#fff3e0','ext'=>'PPTX','preview_class'=>'preview-bg-pptx','titre'=>'Pitch Deck Partenaires & Sponsors 2026','desc'=>'Présentation destinée aux partenaires potentiels : visibilité, avantages, niveaux de partenariat et ROI attendu.','periode'=>'Janvier 2026','taille'=>'9.7 MB','telechargements'=>'312','annee'=>'2026','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'rapport-annuel','cat_label'=>'Rapport Annuel','cat_color'=>'#c2185b','cat_bg'=>'#fce4ec','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Performance Marketing & Stratégie Digitale','desc'=>'Analyse des actions marketing menées en 2025 : réseaux sociaux, SEO, campagnes email et résultats.','periode'=>'Novembre 2025','taille'=>'1.8 MB','telechargements'=>'219','annee'=>'2025','statut'=>'pret','url'=>'#'],
        ['large'=>false,'featured'=>false,'cat'=>'etude','cat_label'=>'Étude','cat_color'=>'#0f284e','cat_bg'=>'#e3f2fd','ext'=>'PDF','preview_class'=>'preview-bg-pdf','titre'=>'Cartographie des Secteurs Porteurs en Afrique 2026','desc'=>'Analyse sectorielle des opportunités d\'investissement et d\'emploi en Afrique subsaharienne pour la diaspora.','periode'=>'Janvier 2026','taille'=>'11.2 MB','telechargements'=>'1 567','annee'=>'2026','statut'=>'pret','url'=>'#'],
        ];
        @endphp

        @foreach ($rapports as $i => $r)
        <div class="rapport-card {{ $r['large'] ? 'large' : '' }} {{ $r['featured'] ? 'featured' : '' }}"
            data-cat="{{ $r['cat'] }}" data-annee="{{ $r['annee'] }}"
            data-titre="{{ strtolower($r['titre']) }}">

            @if ($r['featured'])
            <div class="featured-badge">⭐ À la une</div>
            @endif

            {{-- Preview --}}
            <div class="rapport-preview {{ $r['preview_class'] }}">
                <div class="preview-pattern"></div>
                <label class="preview-select" onclick="event.stopPropagation()">
                    <input type="checkbox" value="{{ $i }}" class="rapport-check" onchange="updateSelection()">
                </label>
                <div class="preview-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                        <polyline points="10 9 9 9 8 9" />
                    </svg>
                    <div class="preview-ext">{{ $r['ext'] }} • {{ $r['taille'] }}</div>
                </div>
            </div>

            {{-- Corps --}}
            <div class="rapport-body">
                <span class="rapport-cat" style="background:{{ $r['cat_bg'] }};color:{{ $r['cat_color'] }}">
                    {{ $r['cat_label'] }}
                </span>
                <div class="rapport-titre">{{ $r['titre'] }}</div>
                <div class="rapport-desc">{{ $r['desc'] }}</div>
                <div class="rapport-meta">
                    <div class="rapport-meta-item">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        {{ $r['periode'] }}
                    </div>
                    <div class="rapport-meta-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        </svg>
                        {{ $r['ext'] }}
                    </div>
                    <span class="statut-badge {{ $r['statut'] === 'pret' ? 's-pret' : ($r['statut'] === 'cours' ? 's-cours' : 's-bientot') }}">
                        @if ($r['statut'] === 'pret')
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg> Disponible
                        @elseif ($r['statut'] === 'cours')
                        En cours
                        @else
                        Bientôt
                        @endif
                    </span>
                </div>
            </div>

            {{-- Footer --}}
            <div class="rapport-footer">
                @if ($r['statut'] === 'pret')
                <a href="{{ $r['url'] }}" class="btn-dl" download>
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Télécharger
                </a>
                @else
                <button class="btn-dl" disabled style="opacity:.5;cursor:not-allowed">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Bientôt disponible
                </button>
                @endif
                <a href="{{ $r['url'] }}" class="btn-preview" title="Aperçu">
                    <svg viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </a>
                <div class="dl-count">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                    </svg>
                    {{ $r['telechargements'] }}
                </div>
            </div>
        </div>
        @endforeach

    </div>{{-- /.rapports-grid --}}

    {{-- Newsletter --}}
    <div class="nl-section">
        <div class="nl-icon-wrap">
            <svg viewBox="0 0 24 24">
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="M2 7l10 7 10-7" />
            </svg>
        </div>
        <div class="nl-content">
            <div class="nl-title">Soyez alerté des nouvelles publications</div>
            <div class="nl-desc">Recevez nos nouveaux rapports, études et ressources directement dans votre boîte mail.</div>
        </div>
        <form action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <div class="nl-form">
                <input type="email" name="email_newsletter" class="nl-input" placeholder="Votre adresse email" required>
                <button type="submit" class="nl-btn">S'abonner</button>
            </div>
        </form>
    </div>

</div>{{-- /.page-wrap --}}

@include('components.footer')
@push('scripts')
<script>
    // ── Sélection multiple ─────────────────────────────────────────
    function updateSelection() {
        const checks = document.querySelectorAll('.rapport-check:checked');
        const count = checks.length;
        document.getElementById('selCount').textContent = count;
        document.getElementById('btnDlSel').disabled = count === 0;
    }

    function telechargerSelection() {
        const checks = document.querySelectorAll('.rapport-check:checked');
        if (checks.length === 0) return;
        alert(`Téléchargement de ${checks.length} document(s) en cours...`);
        checks.forEach(c => c.checked = false);
        updateSelection();
    }

    // ── Filtre recherche + catégorie + année ───────────────────────
    function filterRapports() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        const cat = document.getElementById('filterCat').value;
        const year = document.getElementById('filterAnnee').value;
        const cards = document.querySelectorAll('#rapportsGrid .rapport-card');
        let visible = 0;

        cards.forEach(card => {
            const matchQ = !q || card.dataset.titre.includes(q);
            const matchCat = !cat || card.dataset.cat === cat;
            const matchYear = !year || card.dataset.annee === year;
            const show = matchQ && matchCat && matchYear;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        document.getElementById('resultsCount').textContent = visible + ' résultat' + (visible > 1 ? 's' : '');
    }

    // ── Catégorie tabs ─────────────────────────────────────────────
    function setCat(el, val) {
        document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('filterCat').value = val;
        filterRapports();
    }
</script>
@endpush
@endsection