{{-- resources/views/mon-espace/billet.blade.php --}}
@extends('layouts.app')
@section('title', 'Mon Billet — JEFIE Paris 2026')
@section('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .billet-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 4rem;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 2rem;
    }

    /* ── SIDEBAR (identique aux autres pages mon-espace) ── */
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

    /* ── ÉTAT SANS BILLET ── */
    .empty-billet {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-billet-icon {
        width: 64px;
        height: 64px;
        background: #fff8e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
    }

    .empty-billet-icon svg {
        width: 28px;
        height: 28px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .empty-billet h2 {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f284e;
        margin-bottom: .5rem;
    }

    .empty-billet p {
        font-size: 13px;
        color: #718096;
        margin-bottom: 1.5rem;
    }

    .btn-empty-inscrire {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .btn-empty-inscrire:hover {
        opacity: .9;
    }

    .btn-empty-inscrire svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── BILLET / BADGE ── */
    .billet-card {
        background: linear-gradient(135deg, #0f284e 0%, #163a6b 100%);
        border-radius: 16px;
        padding: 2.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .billet-card::after {
        content: '';
        position: absolute;
        top: -30%;
        right: -8%;
        width: 280px;
        height: 280px;
        background: rgba(245, 197, 24, .08);
        border-radius: 50%;
    }

    .billet-eyebrow {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(245, 197, 24, .15);
        border: 1px solid rgba(245, 197, 24, .35);
        color: #f5c518;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 1rem;
    }

    .billet-eyebrow svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
    }

    .billet-title {
        position: relative;
        z-index: 1;
        font-size: 1.5rem;
        font-weight: 900;
        margin-bottom: .3rem;
    }

    .billet-sub {
        position: relative;
        z-index: 1;
        color: rgba(255, 255, 255, .65);
        font-size: 13px;
        margin-bottom: 2rem;
    }

    .billet-body {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 2rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .billet-qr-box {
        background: #fff;
        border-radius: 14px;
        padding: 1rem;
        flex-shrink: 0;
    }

    .billet-qr-box img {
        display: block;
        width: 170px;
        height: 170px;
        border-radius: 6px;
    }

    .billet-qr-placeholder {
        width: 170px;
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a0aec0;
        font-size: 11px;
        text-align: center;
        padding: 1rem;
    }

    .billet-info {
        flex: 1;
        min-width: 220px;
    }

    .bi-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, .12);
        font-size: 13px;
    }

    .bi-row:last-child {
        border-bottom: none;
    }

    .bi-label {
        color: rgba(255, 255, 255, .55);
    }

    .bi-value {
        color: #fff;
        font-weight: 700;
        text-align: right;
    }

    .bi-badge-num {
        color: #f5c518;
        font-size: 1.1rem;
        font-weight: 900;
        letter-spacing: .02em;
    }

    .bi-statut {
        display: inline-block;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
        padding: 3px 10px;
        border-radius: 12px;
        background: rgba(46, 125, 50, .2);
        color: #81c784;
    }

    /* ── ACTIONS ── */
    .billet-actions {
        display: flex;
        gap: 12px;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .btn-billet-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        padding: 11px 20px;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: opacity .2s, background .2s;
    }

    .btn-billet-download {
        background: #f5c518;
        color: #0f284e;
    }

    .btn-billet-download:hover {
        opacity: .9;
    }

    .btn-billet-print {
        background: #fff;
        color: #0f284e;
        border: 1.5px solid #e2e8f0;
    }

    .btn-billet-print:hover {
        background: #f4f6fa;
    }

    .btn-billet-action svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── INFOS ÉVÉNEMENT ── */
    .pcard {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.75rem;
    }

    .pcard-title {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 10px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pcard-title svg {
        width: 14px;
        height: 14px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2;
    }

    .event-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .event-info-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .event-info-item svg {
        width: 17px;
        height: 17px;
        stroke: #2a5aa2;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .event-info-item div {
        font-size: 12px;
        color: #718096;
        line-height: 1.5;
    }

    .event-info-item strong {
        display: block;
        font-size: 13px;
        color: #1a2744;
        font-weight: 700;
        margin-bottom: 2px;
    }

    @media print {

        .side-nav,
        .billet-actions,
        nav,
        footer {
            display: none !important;
        }

        .billet-wrap {
            grid-template-columns: 1fr;
            padding: 0;
        }

        body {
            background: #fff;
        }
    }

    @media (max-width: 900px) {
        .billet-wrap {
            grid-template-columns: 1fr;
        }

        .event-info-grid {
            grid-template-columns: 1fr;
        }

        .billet-body {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
@include('components.navbar')

<div class="billet-wrap">

    {{-- ══ SIDEBAR ══ --}}
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
        <a href="{{ route('mon-espace.billet') }}" class="active">
            <svg viewBox="0 0 24 24">
                <path d="M21 12V7a2 2 0 00-2-2H5a2 2 0 00-2 2v5m18 0v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5m18 0a2 2 0 01-2 2h-3a2 2 0 01-2-2 2 2 0 00-2-2h0a2 2 0 00-2 2 2 2 0 01-2 2H5a2 2 0 01-2-2" />
            </svg>
            Mon billet d'accès
        </a>

        <div class="side-section-lbl">Emploi &amp; carrière</div>
        <a href="{{ route('mon-espace.candidatures') }}">
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

    {{-- ══ CONTENU ══ --}}
    <div>
        @if (!$inscription)
        {{-- Aucune inscription trouvée --}}
        <div class="empty-billet">
            <div class="empty-billet-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M21 12V7a2 2 0 00-2-2H5a2 2 0 00-2 2v5m18 0v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5m18 0a2 2 0 01-2 2h-3a2 2 0 01-2-2 2 2 0 00-2-2h0a2 2 0 00-2 2 2 2 0 01-2 2H5a2 2 0 01-2-2" />
                </svg>
            </div>
            <h2>Vous n'avez pas encore de billet</h2>
            <p>Inscrivez-vous au Forum JEFIE Paris 2026 pour obtenir votre badge et QR Code d'accès.</p>
            <a href="{{ route('inscription') }}" class="btn-empty-inscrire">
                S'inscrire maintenant
                <svg viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </a>
        </div>

        @else
        {{-- Billet avec badge et QR code --}}
        <div class="billet-card">
            <div class="billet-eyebrow">
                <svg viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                {{ ($inscription->type_inscription ?? '') === 'entreprise' ? 'Badge entreprise' : 'Badge d\'accès personnel' }}
            </div>
            <div class="billet-title">Forum JEFIE Paris 2026</div>
            <div class="billet-sub">15 – 18 Septembre 2026 · CNIT Forest La Défense, Paris</div>

            <div class="billet-body">
                <div class="billet-qr-box">
                    @if(!empty($inscription->qr_token))
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($inscription->numero_badge.'|'.$inscription->qr_token) }}" alt="QR Code d'accès">
                    @else
                    <div class="billet-qr-placeholder">QR Code en cours de génération</div>
                    @endif
                </div>

                <div class="billet-info">
                    <div class="bi-row">
                        <span class="bi-label">Titulaire</span>
                        <span class="bi-value">{{ trim(($inscription->prenom ?? '').' '.($inscription->nom ?? '')) ?: ($user->name ?? '—') }}</span>
                    </div>
                    <div class="bi-row">
                        <span class="bi-label">Numéro de badge</span>
                        <span class="bi-value bi-badge-num">{{ $inscription->numero_badge ?? '—' }}</span>
                    </div>
                    <div class="bi-row">
                        <span class="bi-label">Type</span>
                        <span class="bi-value">
                            {{ ($inscription->type_inscription ?? '') === 'entreprise' ? 'Acteur économique' : 'Visiteur / Participant' }}
                        </span>
                    </div>
                    <div class="bi-row">
                        <span class="bi-label">Statut</span>
                        <span class="bi-value"><span class="bi-statut">{{ $inscription->statut ?? 'confirmé' }}</span></span>
                    </div>
                </div>
            </div>

            <div class="billet-actions">
                <button onclick="window.print()" class="btn-billet-action btn-billet-download">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Télécharger / Imprimer
                </button>
                <a href="{{ route('mon-espace.profil') }}" class="btn-billet-action btn-billet-print">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Modifier mon profil
                </a>
            </div>
        </div>

        {{-- Infos pratiques --}}
        <div class="pcard">
            <div class="pcard-title">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                Informations pratiques
            </div>
            <div class="event-info-grid">
                <div class="event-info-item">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    <div><strong>Dates</strong>15 – 18 Septembre 2026</div>
                </div>
                <div class="event-info-item">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <div><strong>Lieu</strong>CNIT Forest La Défense, 92800 Puteaux</div>
                </div>
                <div class="event-info-item">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <div><strong>À l'entrée</strong>Présentez ce QR Code à l'accueil pour récupérer votre badge physique</div>
                </div>
                <div class="event-info-item">
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="M2 7l10 7 10-7" />
                    </svg>
                    <div><strong>Besoin d'aide ?</strong>contact@jefieparis2026.net</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('components.footer')
@endsection