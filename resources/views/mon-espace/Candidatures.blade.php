{{-- resources/views/mon-espace/candidatures.blade.php --}}
@extends('layouts.app')
@section('title', 'Mes Candidatures — JEFIE Paris 2026')
@section('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .cand-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 4rem;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 2rem;
    }

    .side-nav {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        height: fit-content;
    }

    .side-nav a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 8px;
        color: #4a5568;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 3px;
        transition: all .15s;
    }

    .side-nav a:hover {
        background: #f4f6fa;
        color: #0f284e;
    }

    .side-nav a.active {
        background: #0f284e;
        color: #fff;
    }

    .side-nav a svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .side-section-lbl {
        font-size: 10px;
        font-weight: 800;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin: 1.1rem 0 .5rem 12px;
    }

    .side-section-lbl:first-child {
        margin-top: 0;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0f284e;
        margin-bottom: 1.25rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-box {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
        text-align: center;
    }

    .stat-num {
        font-size: 1.6rem;
        font-weight: 900;
        color: #0f284e;
    }

    .stat-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 3px;
    }

    .cand-item {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.25rem 1.5rem;
        margin-bottom: .85rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .cand-poste {
        font-size: 14px;
        font-weight: 700;
        color: #1a2744;
        margin-bottom: 2px;
    }

    .cand-entreprise {
        font-size: 12px;
        color: #718096;
    }

    .cand-date {
        font-size: 11px;
        color: #a0aec0;
        margin-top: 4px;
    }

    .cand-statut {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 4px 12px;
        border-radius: 12px;
        white-space: nowrap;
    }

    .statut-en_attente {
        background: #fff8e6;
        color: #b8860b;
    }

    .statut-accepte {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .statut-refuse {
        background: #fce4ec;
        color: #c2185b;
    }

    .statut-en_cours {
        background: #e3f2fd;
        color: #1565c0;
    }

    .empty-state {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-state svg {
        width: 40px;
        height: 40px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.5;
        margin-bottom: 1rem;
    }

    .empty-state p {
        font-size: 13px;
        color: #718096;
        margin-bottom: 1.25rem;
    }

    .btn-empty {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 22px;
        border-radius: 8px;
        text-decoration: none;
    }

    .pagination-wrap {
        margin-top: 1.5rem;
    }

    @media (max-width: 900px) {
        .cand-wrap {
            grid-template-columns: 1fr;
        }

        .stats-row {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@section('content')
@include('components.navbar')

<div class="cand-wrap">
    <aside class="side-nav">
        <div class="side-section-lbl">Mon compte</div>
        <a href="{{ route('mon-espace.dashboard') }}">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Tableau de bord
        </a>
        <a href="{{ route('mon-espace.profil') }}">
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Mon profil
        </a>
        <a href="{{ route('mon-espace.billet') }}">
            <svg viewBox="0 0 24 24">
                <path d="M21 12V7a2 2 0 00-2-2H5a2 2 0 00-2 2v5m18 0v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5m18 0a2 2 0 01-2 2h-3a2 2 0 01-2-2 2 2 0 00-2-2h0a2 2 0 00-2 2 2 2 0 01-2 2H5a2 2 0 01-2-2" />
            </svg>
            Mon billet d'accès
        </a>
        <div class="side-section-lbl">Emploi &amp; carrière</div>
        <a href="{{ route('mon-espace.candidatures') }}" class="active">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
            </svg>
            Mes candidatures
        </a>
        <div class="side-section-lbl">Paramètres</div>
        <a href="{{ route('mon-espace.preferences') }}">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
            </svg>
            Préférences &amp; notifications
        </a>
    </aside>

    <div>
        <h1 class="page-title">Mes candidatures</h1>

        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-num">{{ $stats['total'] ?? 0 }}</div>
                <div class="stat-lbl">Total</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['en_attente'] ?? 0 }}</div>
                <div class="stat-lbl">En attente</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['acceptees'] ?? 0 }}</div>
                <div class="stat-lbl">Acceptées</div>
            </div>
            <div class="stat-box">
                <div class="stat-num">{{ $stats['refusees'] ?? 0 }}</div>
                <div class="stat-lbl">Refusées</div>
            </div>
        </div>

        @if($candidatures->count() === 0)
        <div class="empty-state">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
            </svg>
            <p>Vous n'avez encore postulé à aucune offre.</p>
            <a href="{{ route('emploi') }}" class="btn-empty">Parcourir les offres d'emploi</a>
        </div>
        @else
        @foreach($candidatures as $c)
        <div class="cand-item">
            <div>
                <div class="cand-poste">{{ $c->offreEmploi->titre ?? 'Offre supprimée' }}</div>
                <div class="cand-entreprise">{{ $c->offreEmploi->entreprise ?? '—' }}</div>
                <div class="cand-date">Candidature envoyée le {{ optional($c->created_at)->format('d/m/Y') }}</div>
            </div>
            <span class="cand-statut statut-{{ $c->statut }}">{{ str_replace('_',' ', $c->statut) }}</span>
        </div>
        @endforeach

        <div class="pagination-wrap">
            {{ $candidatures->links() }}
        </div>
        @endif
    </div>
</div>

@include('components.footer')
@endsection