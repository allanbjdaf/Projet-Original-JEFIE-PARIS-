{{-- resources/views/programme/activite.blade.php --}}
@extends('layouts.app')
@section('title', ($typeInfo['label'] ?? 'Activités').' — Programme JEFIE Paris 2026')
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
        text-transform: uppercase;
        line-height: 1.3;
    }

    .nav-logo-text span {
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .8);
        font-size: 13px;
        text-decoration: none;
        transition: color .2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: #f5c518;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-inscr {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .btn-inscr:hover {
        opacity: .9;
    }

    /* HERO */
    .hero {
        padding: 3rem 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        max-width: 700px;
    }

    .hero-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, .7);
        font-size: 12px;
        text-decoration: none;
        margin-bottom: 1rem;
        transition: color .2s;
    }

    .hero-back:hover {
        color: #fff;
    }

    .hero-back svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .hero-type {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: .85rem;
    }

    .hero-type svg {
        width: 14px;
        height: 14px;
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
        margin-bottom: .6rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .7);
        font-size: .9rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
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

    .h-stat-icon {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, .1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .h-stat-icon svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
        fill: none;
        stroke-width: 1.7;
    }

    .h-stat-num {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 900;
        display: block;
        line-height: 1;
    }

    .h-stat-lbl {
        color: rgba(255, 255, 255, .55);
        font-size: 10px;
    }

    /* TYPES TABS */
    .types-nav {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        overflow-x: auto;
    }

    .types-inner {
        display: flex;
        gap: 0;
        padding: 0 2.5rem;
        max-width: 1300px;
        margin: 0 auto;
    }

    .type-tab {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        padding: 1rem 1.25rem;
        text-decoration: none;
        border-bottom: 3px solid transparent;
        transition: all .2s;
        white-space: nowrap;
    }

    .type-tab:hover {
        background: #fafbfc;
    }

    .type-tab.active {
        border-bottom-color: var(--tc);
    }

    .type-tab-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .type-tab-icon svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.7;
    }

    .type-tab-label {
        font-size: 11px;
        font-weight: 700;
        color: #718096;
    }

    .type-tab.active .type-tab-label {
        color: #0f284e;
        font-weight: 800;
    }

    /* PAGE WRAP */
    .page-wrap {
        max-width: 1300px;
        margin: 0 auto;
        padding: 2rem 2.5rem;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 2rem;
        align-items: start;
    }

    /* FILTRES */
    .filter-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
        margin-bottom: 1.25rem;
    }

    .fc-title {
        font-size: 11px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: .85rem;
        border-left: 3px solid #f5c518;
        padding-left: 8px;
    }

    .fc-label {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        display: block;
        margin-bottom: 4px;
    }

    .fc-select {
        width: 100%;
        padding: 9px 26px 9px 12px;
        border: 1.5px solid #d1d9e6;
        border-radius: 7px;
        font-size: 12px;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 13px;
        cursor: pointer;
        font-family: inherit;
        color: #1a2744;
        margin-bottom: .75rem;
    }

    .fc-select:focus {
        border-color: #0f284e;
    }

    .btn-filtre {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 10px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        width: 100%;
        font-family: inherit;
        transition: background .2s;
    }

    .btn-filtre:hover {
        background: #0a1e38;
    }

    .btn-reset {
        background: #f4f6fa;
        color: #718096;
        font-weight: 600;
        font-size: 12px;
        padding: 8px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        cursor: pointer;
        width: 100%;
        font-family: inherit;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 6px;
        transition: all .2s;
    }

    .btn-reset:hover {
        color: #0f284e;
    }

    /* SESSION CARDS */
    .sessions-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .sessions-title {
        font-size: 13px;
        font-weight: 800;
        color: #0f284e;
    }

    .sessions-count {
        font-size: 12px;
        color: #a0aec0;
    }

    .sessions-list {
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
    }

    .session-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        transition: box-shadow .2s, transform .2s;
        position: relative;
    }

    .session-card:hover {
        box-shadow: 0 4px 18px rgba(15, 40, 78, .1);
        transform: translateY(-2px);
    }

    .session-card.vedette {
        border-left: 4px solid #f5c518;
    }

    .session-couleur {
        width: 6px;
        flex-shrink: 0;
    }

    .session-body {
        padding: 1.25rem;
        flex: 1;
    }

    .session-meta-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: .65rem;
        flex-wrap: wrap;
    }

    .session-type-badge {
        font-size: 10px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .session-heure {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #718096;
        font-weight: 600;
    }

    .session-heure svg {
        width: 13px;
        height: 13px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .session-salle {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #a0aec0;
    }

    .session-salle svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .vedette-star {
        color: #f5c518;
        font-size: 11px;
        font-weight: 700;
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .session-titre {
        font-size: 1rem;
        font-weight: 800;
        color: #0a1e38;
        line-height: 1.3;
        margin-bottom: .5rem;
    }

    .session-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.55;
        margin-bottom: .85rem;
    }

    .session-intervenants {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: .85rem;
    }

    .interv-chip {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
        color: #0a1e38;
    }

    .interv-av {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #0f284e;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f5c518;
        font-size: 9px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .session-footer {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .session-places {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #718096;
    }

    .session-places svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .places-bar {
        flex: 1;
        height: 5px;
        background: #f0f4f8;
        border-radius: 3px;
        overflow: hidden;
        max-width: 80px;
    }

    .places-fill {
        height: 100%;
        border-radius: 3px;
    }

    .btn-session {
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all .2s;
        font-family: inherit;
        margin-left: auto;
    }

    .btn-session svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .statut-complet {
        background: #fce4ec;
        color: #c2185b;
    }

    .statut-confirme {
        background: #0f284e;
        color: #fff;
    }

    .statut-confirme:hover {
        background: #0a1e38;
    }

    /* SIDEBAR droite */
    .sidebar-right {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .sr-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .sr-card-head {
        background: #0f284e;
        padding: .85rem 1.1rem;
    }

    .sr-card-title {
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .sr-card-title svg {
        width: 14px;
        height: 14px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2;
    }

    .sr-item {
        padding: .85rem 1.1rem;
        border-bottom: 1px solid #f0f4f8;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .sr-item:last-child {
        border-bottom: none;
    }

    .sr-item-titre {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
    }

    .sr-item-meta {
        font-size: 11px;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sr-item-meta svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .nl-mini {
        background: #0f284e;
        border-radius: 10px;
        padding: 1.25rem;
    }

    .nl-mini-title {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .nl-mini-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 11px;
        margin-bottom: .85rem;
    }

    .nl-mini input {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-size: 12px;
        outline: none;
        margin-bottom: 7px;
        font-family: inherit;
    }

    .nl-mini input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .nl-mini-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-family: inherit;
    }

    /* Footer */
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
    }

    .fc a:hover {
        color: #fff;
    }

    .fb p {
        font-size: 12px;
        line-height: 1.6;
        margin: .5rem 0 .75rem;
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

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #a0aec0;
    }

    .empty-state svg {
        width: 52px;
        height: 52px;
        stroke: #d1d9e6;
        fill: none;
        stroke-width: 1.2;
        display: block;
        margin: 0 auto .75rem;
    }

    .empty-state p {
        font-size: 14px;
        font-weight: 700;
        color: #718096;
        margin-bottom: .5rem;
    }

    @media (max-width:1100px) {
        .page-wrap {
            grid-template-columns: 1fr;
        }

        .sidebar-right {
            display: none;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .types-inner {
            padding: 0 1rem;
        }

        .page-wrap {
            padding: 1.5rem 1rem;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@include('components.navbar')

@section('content')


{{-- HERO --}}
<section class="hero" style="background:linear-gradient(108deg,{{ $typeInfo['color'] ?? '#0f284e' }}dd,#0f284e 100%)">
    <div class="hero-inner">
        <a href="{{ route('programme') }}" class="hero-back">
            <svg viewBox="0 0 24 24">
                <path d="M19 12H5M12 5l-7 7 7 7" />
            </svg>
            Retour au programme
        </a>
        <div class="hero-type">
            <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2">{!! $typeInfo['icon'] ?? '' !!}</svg>
            {{ $typeInfo['label'] ?? 'Activités' }}
        </div>
        <h1>{{ $typeInfo['label'] ?? 'Activités' }}</h1>
        <p class="hero-desc">{{ $typeInfo['desc'] ?? '' }}</p>
        <div class="hero-stats">
            @foreach ([
            [$sessions->count(), 'Sessions', '
            <rect x="3" y="4" width="18" height="18" rx="2" />'],
            [$sessions->sum('inscrits'), 'Inscrits', '
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
            <circle cx="9" cy="7" r="4" />'],
            [$sessions->filter(fn($s)=>$s['statut']==='confirme')->count(), 'Confirmées', '
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
            <polyline points="22 4 12 14.01 9 11.01" />'],
            ] as [$n,$l,$ic])
            <div class="h-stat">
                <div class="h-stat-icon"><svg viewBox="0 0 24 24" stroke="#fff" fill="none" stroke-width="1.7">{!! $ic !!}</svg></div>
                <div><span class="h-stat-num">{{ $n }}</span>
                    <div class="h-stat-lbl">{{ $l }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- TABS TYPES --}}
<div class="types-nav">
    <div class="types-inner">
        @foreach ([
        ['conference','Conférences','#0f284e','#e3f2fd','
        <path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z" />
        <path d="M19 10v2a7 7 0 01-14 0v-2" />'],
        ['panel', 'Panels', '#6a1b9a','#ede7f6','
        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
        <circle cx="9" cy="7" r="4" />
        <path d="M23 21v-2a4 4 0 00-3-3.87" />'],
        ['atelier', 'Ateliers', '#2e7d32','#e8f5e9','
        <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77" />'],
        ['networking','Networking','#f5c518','#fff3e0','
        <circle cx="12" cy="12" r="10" />'],
        ['b2b', 'B2B', '#b07d10','#fff8e6','
        <rect x="3" y="4" width="18" height="18" rx="2" />
        <path d="M16 2v4M8 2v4M3 10h18" />'],
        ['pitch', 'Pitchs', '#c2185b','#fce4ec','
        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />'],
        ] as [$t,$l,$c,$bg,$ic])
        @php
        // ✅ Rend compatible la variable $slugActif du contrôleur avec le $type attendu par la vue
        if (!isset($type)) {
        $type = $slugActif ?? request()->route('type') ?? request()->route('slug') ?? 'atelier';
        }
        @endphp
        <a href="{{ route('programme.activite', $t) }}"
            class="type-tab {{ $type === $t ? 'active' : '' }}"
            style="--tc:{{ $c }}">
            <div class="type-tab-icon" style="background:{{ $bg }};color:{{ $c }}">
                <svg viewBox="0 0 24 24" stroke="{{ $c }}" fill="none" stroke-width="1.7">{!! $ic !!}</svg>
            </div>
            <div class="type-tab-label">{{ $l }}</div>
        </a>
        @endforeach
    </div>
</div>

{{-- CONTENU --}}
<div class="page-wrap">

    {{-- COLONNE PRINCIPALE --}}
    <div>
        {{-- Filtres --}}
        <div class="filter-card">
            <div class="fc-title">Filtrer les sessions</div>
            <form action="{{ route('programme.activite', $type) }}" method="GET">
                <label class="fc-label">Jour</label>
                <select name="jour" class="fc-select">
                    <option value="">Tous les jours</option>
                    @foreach ($jours as $num => $j)
                    <option value="{{ $num }}" {{ request('jour') == $num ? 'selected' : '' }}>{{ $j['label'] }} — {{ $j['date'] }}</option>
                    @endforeach
                </select>
                <label class="fc-label">Thématique</label>
                <select name="thematique" class="fc-select">
                    <option value="">Toutes les thématiques</option>
                    @foreach ($thematiques as $t)
                    <option value="{{ $t }}" {{ request('thematique') === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-filtre">Appliquer les filtres</button>
                <a href="{{ route('programme.activite', $type) }}" class="btn-reset">Réinitialiser</a>
            </form>
        </div>

        {{-- À insérer juste au-dessus de la ligne 1003 --}}
        @php
        if (!isset($typeInfo)) {
        // Détecte le type actuel (ex: 'atelier', 'conference')
        $currentType = $type ?? $slugActif ?? request()->route('type') ?? request()->route('slug') ?? 'atelier';

        // Dictionnaire des labels pour afficher le bon nom dans le titre
        $labels = [
        'conference' => 'Conférences',
        'panel' => 'Panels',
        'atelier' => 'Ateliers',
        'networking' => 'Networking',
        'pitch' => 'Pitchs partenaires',
        'pitch' => 'Pitchs entrepreneuriaux'
        ];

        $typeInfo = [
        'label' => $labels[$currentType] ?? ucfirst($currentType) . 's',
        'desc' => 'Liste des sessions programmées.'
        ];
        }
        @endphp


        {{-- Liste sessions --}}
        <div class="sessions-header">
            <div class="sessions-title">{{ $typeInfo['label'] }}</div>
            <div class="sessions-count">{{ $sessions->count() }} session{{ $sessions->count() > 1 ? 's' : '' }}</div>
        </div>

        @if ($sessions->isEmpty())
        <div class="empty-state">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            <p>Aucune session disponible</p>
            <span style="font-size:12px">Essayez d'autres filtres ou revenez bientôt.</span>
        </div>
        @else
        <div class="sessions-list">
            @foreach ($sessions as $s)
            @php
            $couleur = $s['couleur'] ?? '#0f284e';
            $bg = $typeInfo['bg'] ?? '#eef2ff';

            // ✅ CORRECTION DU CALCUL : Utilisation de places_total et places_restantes
            $placesTotal = $s['places_total'] ?? $s['places'] ?? 0;
            $placesRestantes = $s['places_restantes'] ?? 0;
            $inscrits = $s['inscrits'] ?? ($placesTotal - $placesRestantes);

            // Calcul propre du pourcentage sans division par zéro
            $pct = $placesTotal > 0 ? round(($inscrits / $placesTotal) * 100) : 0;
            $barColor = $pct >= 90 ? '#e53935' : ($pct >= 70 ? '#f5c518' : '#2e7d32');

            // Sécurité pour la clé 'vedette'
            $isVedette = $s['vedette'] ?? false;
            @endphp
            <div class="session-card {{ $s['vedette'] ? 'vedette' : '' }}">
                <div class="session-couleur" style="background:{{ $couleur }}"></div>
                <div class="session-body">
                    <div class="session-meta-top">
                        <span class="session-type-badge" style="background:{{ $bg }};color:{{ $couleur }}">
                            {{ $typeInfo['label'] }}
                        </span>
                        <div class="session-heure">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ $s['heure_debut'] }} – {{ $s['heure_fin'] }}
                        </div>
                        <div class="session-salle">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $s['salle'] }}
                        </div>
                        {{-- À la ligne 1081 de votre fichier activité.blade.php --}}
                        <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:8px;background:#f0faf0;color:#2e7d32">
                            Jour {{ $s['jour'] ?? $jourActif ?? 1 }}
                        </span>
                        @if ($s['vedette'])
                        <div class="vedette-star">⭐ À ne pas manquer</div>
                        @endif
                    </div>
                    <div class="session-titre">{{ $s['titre'] }}</div>
                    <div class="session-desc">{{ $s['description'] }}</div>

                    @if (!empty($s['intervenants']))
                    <div class="session-intervenants">
                        @foreach ($s['intervenants'] as $interv)
                        @php
                        // Si c'est un tableau, on récupère le premier élément, sinon on garde la chaîne
                        $intervName = is_array($interv) ? reset($interv) : $interv;
                        @endphp
                        <div class="interv-chip">
                            {{-- ATTENTION : On utilise bien $intervName ici --}}
                            <div class="interv-av">{{ strtoupper(substr($intervName, 0, 1)) }}</div>
                            {{-- Et ici aussi --}}
                            {{ $intervName }}
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="session-footer">
                        <div class="session-places">
                            <svg viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                            {{ $s['inscrits'] }}/{{ $s['places'] }} inscrits
                        </div>
                        <div class="places-bar">
                            <div class="places-fill" style="width:{{ $pct }}%;background:{{ $barColor }}"></div>
                        </div>
                        <span style="font-size:10px;color:{{ $barColor }};font-weight:700">{{ $pct }}%</span>

                        @if ($s['statut'] === 'complet')
                        <span class="btn-session statut-complet">Complet</span>
                        @else
                        <a href="{{ route('inscription') }}" class="btn-session statut-confirme">
                            <svg viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                                <line x1="19" y1="8" x2="19" y2="14" />
                                <line x1="22" y1="11" x2="16" y2="11" />
                            </svg>
                            S'inscrire
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- SIDEBAR --}}
    <aside class="sidebar-right">
        {{-- Sessions vedettes --}}
        <div class="sr-card">
            <div class="sr-card-head">
                <div class="sr-card-title">
                    <svg viewBox="0 0 24 24">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                    À ne pas manquer
                </div>
            </div>
            @foreach ($sessions->where('vedette',true)->take(3) as $s)
            <div class="sr-item">
                <div class="sr-item-titre">{{ $s['titre'] }}</div>
                <div class="sr-item-meta">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    {{ $s['heure_debut'] }} — Jour {{ $s['jour'] }}
                </div>
            </div>
            @endforeach
        </div>

        {{-- Programme complet --}}
        <div class="sr-card">
            <div class="sr-card-head">
                <div class="sr-card-title">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Autres activités
                </div>
            </div>
            @foreach ([
            ['conference','Conférences','#0f284e'],
            ['panel','Panels','#6a1b9a'],
            ['atelier','Ateliers','#2e7d32'],
            ['networking','Networking','#f5c518'],
            ['pitch','Pitchs','#c2185b'],
            ] as [$t,$l,$c])
            @if ($t !== $type)
            <div class="sr-item">
                <a href="{{ route('programme.activite', $t) }}" style="display:flex;align-items:center;gap:8px;text-decoration:none">
                    <div style="width:8px;height:8px;background:{{ $c }};border-radius:50%;flex-shrink:0"></div>
                    <span style="font-size:12px;font-weight:600;color:#0a1e38;transition:color .2s">{{ $l }}</span>
                    <svg viewBox="0 0 24 24" width="12" height="12" stroke="#a0aec0" fill="none" stroke-width="2" style="margin-left:auto">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            @endif
            @endforeach
        </div>

        {{-- Newsletter --}}
        <div class="nl-mini">
            <div class="nl-mini-title">Alertes programme</div>
            <div class="nl-mini-desc">Soyez notifié des nouvelles sessions et mises à jour.</div>
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email_newsletter" placeholder="Votre email" required>
                <button type="submit" class="nl-mini-btn">S'abonner aux alertes</button>
            </form>
        </div>
    </aside>
</div>

{{-- ══ FOOTER ══ --}}

@include('components.footer')

</body>

</html>