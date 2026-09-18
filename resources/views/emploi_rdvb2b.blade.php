{{-- resources/views/emploi_rdvb2b.blade.php --}}
@extends('layouts.app')
@section('title', 'Mes Rendez-vous B2B')
@section('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .rdv-wrap {
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

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0f284e;
    }

    .page-subtitle {
        font-size: 13px;
        color: #718096;
        margin-top: 2px;
    }

    .btn-or {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: opacity .2s;
    }

    .btn-or:hover {
        opacity: .9;
    }

    .btn-or svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 8px;
        padding: .85rem 1.25rem;
        font-size: 13px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-success svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.75rem;
        margin-bottom: 1.25rem;
    }

    .card-title {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 10px;
        margin-bottom: 1.25rem;
    }

    .rdv-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #f4f6fa;
    }

    .rdv-card:last-child {
        border-bottom: none;
    }

    .rdv-date {
        width: 54px;
        height: 54px;
        flex-shrink: 0;
        background: #0f284e;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .rdv-day {
        font-size: 1.15rem;
        font-weight: 900;
        line-height: 1;
    }

    .rdv-month {
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        color: #f5c518;
        margin-top: 2px;
    }

    .rdv-info {
        flex: 1;
        min-width: 0;
    }

    .rdv-title {
        font-size: 13.5px;
        font-weight: 700;
        color: #1a2744;
    }

    .rdv-sub {
        font-size: 11.5px;
        color: #718096;
        margin-top: 2px;
    }

    .rdv-statut,
    .statut-badge {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 4px 12px;
        border-radius: 12px;
        white-space: nowrap;
    }

    .s-accept {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .s-attente {
        background: #fff8e6;
        color: #b8860b;
    }

    .s-refuse {
        background: #fce4ec;
        color: #c2185b;
    }

    .table-wrap {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    thead th {
        text-align: left;
        font-size: 10.5px;
        font-weight: 800;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: .06em;
        padding: 0 10px 10px;
        border-bottom: 1.5px solid #e2e8f0;
    }

    tbody td {
        padding: 12px 10px;
        border-bottom: 1px solid #f4f6fa;
        vertical-align: middle;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .btn-sm {
        font-size: 11.5px;
        font-weight: 700;
        padding: 7px 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
    }

    .btn-sm-del {
        background: #fce4ec;
        color: #c2185b;
    }

    .btn-sm-del:hover {
        background: #f8bbd0;
    }

    .empty-state {
        text-align: center;
        padding: 2.5rem 1rem;
    }

    .empty-state svg {
        width: 38px;
        height: 38px;
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

    .btn-primary {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 22px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: #0a1e38;
    }

    @media (max-width: 900px) {
        .rdv-wrap {
            grid-template-columns: 1fr;
        }

        .table-wrap table {
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
@include('components.navbar')

<div class="rdv-wrap">

    {{-- ══ SIDEBAR (identique aux autres pages Mon espace) ══ --}}
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
        <a href="{{ route('mon-espace.candidatures') }}">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
            </svg>
            Mes candidatures
        </a>
        <a href="{{ route('emploi.rdvb2b') }}" class="active">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            Rendez-vous B2B
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
        <div class="page-header">
            <div>
                <div class="page-title">Mes Rendez-vous B2B</div>
                <div class="page-subtitle">Planifiez vos rencontres avec les recruteurs</div>
            </div>
            <a href="{{ route('emploi.rdvb2b') }}#nouveau" class="btn-or">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Nouveau RDV
            </a>
        </div>

        @if (session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if (isset($prochains) && $prochains->count() > 0)
        <div class="card">
            <div class="card-title">Prochains rendez-vous</div>
            @foreach ($prochains as $rdv)
            <div class="rdv-card">
                <div class="rdv-date">
                    <span class="rdv-day">{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d') }}</span>
                    <span class="rdv-month">{{ \Carbon\Carbon::parse($rdv->date_heure)->translatedFormat('M') }}</span>
                </div>
                <div class="rdv-info">
                    <div class="rdv-title">{{ $rdv->objet }}</div>
                    <div class="rdv-sub">{{ $rdv->recruteur_id }} &bull; {{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}</div>
                </div>
                <span class="rdv-statut s-accept">Confirmé</span>
            </div>
            @endforeach
        </div>
        @endif

        <div class="card">
            <div class="card-title">Tous mes rendez-vous</div>
            @if ($rdvs->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Objet</th>
                            <th>Recruteur</th>
                            <th>Date &amp; Heure</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rdvs as $rdv)
                        <tr>
                            <td><strong>{{ $rdv->objet }}</strong></td>
                            <td style="color:#718096">{{ $rdv->recruteur_id }}</td>
                            <td style="font-size:12px">{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y à H:i') }}</td>
                            <td>
                                <span class="statut-badge s-{{ $rdv->statut === 'en_attente' ? 'attente' : ($rdv->statut === 'confirme' ? 'accept' : 'refuse') }}">
                                    {{ match($rdv->statut) { 'en_attente'=>'En attente','confirme'=>'Confirmé','annule'=>'Annulé', default=>$rdv->statut } }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('emploi.rdvb2b.destroy', $rdv->id) }}" method="POST" onsubmit="return confirm('Annuler ce rendez-vous ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm btn-sm-del">Annuler</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                <p>Aucun rendez-vous planifié.</p>
                <a href="{{ route('emploi.rdvb2b') }}#nouveau" class="btn-primary">Prendre un RDV B2B</a>
            </div>
            @endif
        </div>
    </div>
</div>

@include('components.footer')
@endsection