{{-- resources/views/mon-espace/preferences.blade.php --}}
@extends('layouts.app')
@section('title', 'Préférences — JEFIE Paris 2026')
@section('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .pref-wrap {
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

    .pcard {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.75rem;
        margin-bottom: 1.25rem;
    }

    .pcard-title {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 10px;
        margin-bottom: 1.5rem;
    }

    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f4f6fa;
    }

    .toggle-row:last-child {
        border-bottom: none;
    }

    .toggle-info strong {
        display: block;
        font-size: 13px;
        color: #1a2744;
        font-weight: 700;
    }

    .toggle-info span {
        font-size: 11.5px;
        color: #718096;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 42px;
        height: 24px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background: #d1d9e6;
        transition: .2s;
        border-radius: 24px;
    }

    .slider::before {
        content: '';
        position: absolute;
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background: #fff;
        transition: .2s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background: #f5c518;
    }

    input:checked+.slider::before {
        transform: translateX(18px);
    }

    .pform-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        max-width: 320px;
    }

    .pform-label {
        font-size: 11px;
        font-weight: 700;
        color: #1e4a8a;
    }

    .pform-control {
        padding: 11px 14px;
        border: 1.5px solid #d1d9e6;
        border-radius: 8px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        width: 100%;
    }

    .btn-save {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 13px 28px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin-top: .5rem;
    }

    .btn-save:hover {
        background: #0a1e38;
    }

    .alert-success-pref {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 8px;
        padding: .85rem 1.25rem;
        font-size: 13px;
        margin-bottom: 1.25rem;
    }

    @media (max-width: 900px) {
        .pref-wrap {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
@include('components.navbar')

@php
$prefs = json_decode($user->preferences ?? '{}', true) ?: [];
@endphp

<div class="pref-wrap">
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
        <div class="side-section-lbl">Paramètres</div>
        <a href="{{ route('mon-espace.preferences') }}" class="active">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
            </svg>
            Préférences &amp; notifications
        </a>
    </aside>

    <div>
        <h1 class="page-title">Préférences &amp; notifications</h1>

        @if(session('success'))
        <div class="alert-success-pref">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('mon-espace.preferences.update') }}">
            @csrf
            @method('PUT')

            <div class="pcard">
                <div class="pcard-title">Langue</div>
                <div class="pform-group">
                    <label class="pform-label">Langue de l'interface</label>
                    <select name="langue" class="pform-control">
                        <option value="fr" {{ ($prefs['langue'] ?? 'fr') === 'fr' ? 'selected' : '' }}>Français</option>
                        <option value="en" {{ ($prefs['langue'] ?? '') === 'en' ? 'selected' : '' }}>English</option>
                        <option value="pt" {{ ($prefs['langue'] ?? '') === 'pt' ? 'selected' : '' }}>Português</option>
                    </select>
                </div>
            </div>

            <div class="pcard">
                <div class="pcard-title">Notifications par e-mail</div>

                <div class="toggle-row">
                    <div class="toggle-info"><strong>Notifications générales</strong><span>Recevoir les e-mails importants concernant votre compte</span></div>
                    <label class="switch">
                        <input type="checkbox" name="notif_email" value="1" {{ ($prefs['notif_email'] ?? true) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="toggle-row">
                    <div class="toggle-info"><strong>Suivi de candidatures</strong><span>Être notifié(e) des mises à jour sur vos candidatures</span></div>
                    <label class="switch">
                        <input type="checkbox" name="notif_candidature" value="1" {{ ($prefs['notif_candidature'] ?? true) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="toggle-row">
                    <div class="toggle-info"><strong>Alertes emploi</strong><span>Recevoir les nouvelles offres correspondant à vos alertes</span></div>
                    <label class="switch">
                        <input type="checkbox" name="notif_alerte" value="1" {{ ($prefs['notif_alerte'] ?? true) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="toggle-row">
                    <div class="toggle-info"><strong>Rendez-vous B2B</strong><span>Être notifié(e) des demandes et confirmations de RDV</span></div>
                    <label class="switch">
                        <input type="checkbox" name="notif_rdv" value="1" {{ ($prefs['notif_rdv'] ?? true) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="toggle-row">
                    <div class="toggle-info"><strong>Newsletter</strong><span>Actualités et informations sur le Forum JEFIE</span></div>
                    <label class="switch">
                        <input type="checkbox" name="notif_newsletter" value="1" {{ ($prefs['notif_newsletter'] ?? false) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <div class="pcard">
                <div class="pcard-title">Confidentialité</div>
                <div class="toggle-row">
                    <div class="toggle-info"><strong>Profil visible publiquement</strong><span>Les recruteurs peuvent consulter votre profil</span></div>
                    <label class="switch">
                        <input type="checkbox" name="profil_public" value="1" {{ ($prefs['profil_public'] ?? false) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-save">Enregistrer les préférences</button>
        </form>
    </div>
</div>

@include('components.footer')
@endsection