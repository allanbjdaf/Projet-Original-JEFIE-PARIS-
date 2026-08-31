{{-- resources/views/recruteur/offre-form.blade.php --}}
@extends('layouts.app')
@section('title', isset($offre) ? 'Modifier l\'offre — Recruteur' : 'Publier une offre — Recruteur')
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

    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 5px;
        display: flex;
    }

    .nav-icon-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-sinscrire {
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
    }

    .rec-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        min-height: calc(100vh - 64px);
    }

    .rec-sidebar {
        background: #0f284e;
        display: flex;
        flex-direction: column;
        padding: 1.5rem 0;
    }

    .rs-brand {
        padding: .5rem 1.5rem 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        margin-bottom: .75rem;
    }

    .rs-brand-title {
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rs-brand-title svg {
        stroke: #f5c518;
    }

    .rs-brand-sub {
        color: rgba(255, 255, 255, .5);
        font-size: 10px;
        margin-top: 2px;
    }

    .rs-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 1.5rem;
        font-size: 13px;
        color: rgba(255, 255, 255, .65);
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all .15s;
    }

    .rs-item:hover {
        background: rgba(255, 255, 255, .06);
        color: #fff;
    }

    .rs-item.active {
        background: rgba(245, 166, 35, .12);
        color: #f5c518;
        border-left-color: #f5c518;
        font-weight: 700;
    }

    .rs-item svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .rs-badge {
        margin-left: auto;
        background: #e53935;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 1px 7px;
        border-radius: 10px;
    }

    .rs-section {
        padding: .75rem 1.5rem .25rem;
        font-size: 10px;
        font-weight: 700;
        color: rgba(255, 255, 255, .3);
        text-transform: uppercase;
        letter-spacing: .1em;
    }

    .rs-bottom {
        margin-top: auto;
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, .08);
    }

    .rs-logout {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, .5);
        font-size: 12px;
        text-decoration: none;
        background: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
    }

    .rs-logout:hover {
        color: #e53935;
    }

    .rs-logout svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .rec-main {
        padding: 1.75rem 2rem;
    }

    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: .75rem;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0f284e;
    }

    .page-subtitle {
        font-size: 12px;
        color: #718096;
        margin-top: 3px;
    }

    .btn-primary {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 22px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: background .2s;
        font-family: inherit;
    }

    .btn-primary:hover {
        background: #0a1e38;
    }

    .btn-primary svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-or {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 22px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
        font-family: inherit;
    }

    .btn-or:hover {
        opacity: .9;
    }

    .btn-outline {
        background: transparent;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border-radius: 6px;
        border: 1.5px solid #d1d9e6;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: all .2s;
        font-family: inherit;
    }

    .btn-outline:hover {
        border-color: #0f284e;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-error {
        background: #fce4ec;
        border: 1px solid #f48fb1;
        color: #c2185b;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        margin-bottom: 1.25rem;
    }

    .form-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        align-items: start;
    }

    .form-section {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .form-section-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 8px;
        margin-bottom: 1.25rem;
        display: block;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .fg1 {
        grid-column: 1/-1;
    }

    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        display: block;
        margin-bottom: 5px;
    }

    .req {
        color: #e53935;
    }

    .form-control {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid #d1d9e6;
        border-radius: 7px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
        background: #fff;
    }

    .form-control:focus {
        border-color: #0f284e;
        box-shadow: 0 0 0 3px rgba(15, 40, 78, .06);
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        padding-right: 30px;
        cursor: pointer;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 180px;
    }

    .field-error {
        color: #e53935;
        font-size: 11px;
        margin-top: 3px;
        display: block;
    }

    .check-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #4a5568;
        cursor: pointer;
    }

    .check-row input {
        width: 16px;
        height: 16px;
        accent-color: #f5c518;
        cursor: pointer;
    }

    .form-hint {
        font-size: 11px;
        color: #a0aec0;
        margin-top: 4px;
    }

    .side-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.1rem;
    }

    .side-card-title {
        font-size: 11px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: .85rem;
        border-left: 3px solid #f5c518;
        padding-left: 8px;
    }

    .preview-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 10px;
        margin-bottom: 6px;
    }

    .tip-item {
        display: flex;
        gap: 8px;
        padding: 7px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: 12px;
        color: #4a5568;
    }

    .tip-item:last-child {
        border-bottom: none;
    }

    .tip-item svg {
        width: 14px;
        height: 14px;
        stroke: #2e7d32;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .logo-upload {
        border: 2px dashed #d1d9e6;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all .2s;
    }

    .logo-upload:hover {
        border-color: #0f284e;
        background: #f8fafc;
    }

    .logo-upload input {
        display: none;
    }

    .logo-upload svg {
        width: 24px;
        height: 24px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.5;
        display: block;
        margin: 0 auto .5rem;
    }

    .logo-upload p {
        font-size: 11px;
        color: #718096;
    }

    .logo-preview {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        object-fit: contain;
        border: 1px solid #e2e8f0;
        display: none;
        margin: 0 auto .5rem;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-top: 1.25rem;
    }

    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr;
        gap: 2rem;
        margin-bottom: 1.5rem;
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

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    @media (max-width:1100px) {
        .rec-layout {
            grid-template-columns: 1fr;
        }

        .rec-sidebar {
            display: none;
        }

        .form-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<nav class="nav">
    <a href="{{ route('index') }}" class="nav-logo">
        <div class="nav-logo-icon"><svg width="22" height="22" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="1.8">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg></div>
        <div class="nav-logo-text"><span>JEFIE</span>Paris 2026</div>
    </a>
    <div class="nav-links">
        <a href="{{ route('index') }}">Accueil</a>
        <a href="{{ route('emploi') }}" class="active">Emploi &amp; Recrutement</a>
        <a href="{{ route('actualites') }}">Actualités</a>
        <a href="{{ route('contact') }}">Contact</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('recruteur.dashboard') }}" style="color:rgba(255,255,255,.7);font-size:12px;text-decoration:none">← Tableau de bord</a>
        <a href="{{ route('inscription') }}" class="btn-sinscrire">S'inscrire</a>
    </div>
</nav>

<div class="rec-layout">
    <aside class="rec-sidebar">
        <div class="rs-brand">
            <div class="rs-brand-title"><svg width="16" height="16" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>Espace Recruteur</div>
            <div class="rs-brand-sub">Portail employeur JEFIE 2026</div>
        </div>
        <a href="{{ route('recruteur.dashboard') }}" class="rs-item"><svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>Tableau de bord</a>
        <a href="{{ route('recruteur.offre.creer') }}" class="rs-item active"><svg viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>Publier une offre</a>
        <a href="{{ route('recruteur.offres') }}" class="rs-item"><svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>Mes offres publiées</a>
        <a href="{{ route('recruteur.candidatures') }}" class="rs-item"><svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
            </svg>Candidatures reçues</a>
        <div class="rs-section">Communication</div>
        <a href="{{ route('recruteur.newsletter') }}" class="rs-item"><svg viewBox="0 0 24 24">
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="M2 7l10 7 10-7" />
            </svg>Newsletter &amp; Emails</a>
        <div class="rs-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="rs-logout"><svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                    </svg>Se déconnecter</button>
            </form>
        </div>
    </aside>

    <main class="rec-main">
        <div class="page-header">
            <div>
                <div class="page-title">{{ isset($offre) ? 'Modifier l\'offre' : 'Publier une nouvelle offre' }}</div>
                <div class="page-subtitle">{{ isset($offre) ? 'Modifiez les informations de votre offre' : 'Rédigez votre offre d\'emploi et touchez des milliers de candidats qualifiés' }}</div>
            </div>
            <a href="{{ route('recruteur.offres') }}" class="btn-outline">
                <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                Retour aux offres
            </a>
        </div>

        @if (session('success'))
        <div class="alert-success"><svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>{{ session('success') }}</div>
        @endif
        @if ($errors->any())
        <div class="alert-error">Veuillez corriger les erreurs ci-dessous.</div>
        @endif

        <form action="{{ isset($offre) ? route('recruteur.offre.update', $offre->id) : route('recruteur.offre.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($offre)) @method('PUT') @endif

            <div class="form-layout">
                {{-- Colonne principale --}}
                <div>
                    {{-- Infos poste --}}
                    <div class="form-section">
                        <span class="form-section-title">Informations du poste</span>
                        <div class="form-grid">
                            <div class="fg1">
                                <label class="form-label">Titre du poste <span class="req">*</span></label>
                                <input type="text" name="titre" class="form-control" placeholder="Ex: Développeur Full Stack Senior"
                                    value="{{ old('titre', $offre->titre ?? '') }}" required>
                                @error('titre')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="form-label">Entreprise <span class="req">*</span></label>
                                <input type="text" name="entreprise" class="form-control" placeholder="Nom de votre entreprise"
                                    value="{{ old('entreprise', $offre->entreprise ?? auth()->user()->name ?? '') }}" required>
                                @error('entreprise')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="form-label">Type de contrat <span class="req">*</span></label>
                                <select name="type_contrat" class="form-control" required>
                                    @foreach (['CDI','CDD','Stage','Freelance','Alternance'] as $t)
                                    <option value="{{ $t }}" {{ old('type_contrat', $offre->type_contrat ?? '') === $t ? 'selected' : '' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Lieu de travail <span class="req">*</span></label>
                                <input type="text" name="lieu" class="form-control" placeholder="Ex: Paris, France / Remote"
                                    value="{{ old('lieu', $offre->lieu ?? '') }}" required>
                            </div>
                            <div>
                                <label class="form-label">Secteur d'activité <span class="req">*</span></label>
                                <select name="secteur" class="form-control" required>
                                    <option value="">Sélectionnez...</option>
                                    @foreach (['Technologies','Finance','Commerce','Santé','Éducation','Industrie','Agriculture','Services','Conseil','Énergie','Médias','Transport','Immobilier'] as $s)
                                    <option value="{{ $s }}" {{ old('secteur', $offre->secteur ?? '') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Expérience requise</label>
                                <select name="experience" class="form-control">
                                    <option value="">Non spécifié</option>
                                    @foreach (['Débutant (0-1 an)','Junior (1-3 ans)','Confirmé (3-5 ans)','Senior (5-10 ans)','Expert (10+ ans)'] as $e)
                                    <option value="{{ $e }}" {{ old('experience', $offre->experience ?? '') === $e ? 'selected' : '' }}>{{ $e }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Salaire / Rémunération</label>
                                <input type="text" name="salaire" class="form-control" placeholder="Ex: 45 000 - 60 000 € / an"
                                    value="{{ old('salaire', $offre->salaire ?? '') }}">
                                <span class="form-hint">Indiquer une fourchette augmente les candidatures de 40%</span>
                            </div>
                            <div>
                                <label class="form-label">Date limite de candidature</label>
                                <input type="date" name="date_limite" class="form-control"
                                    value="{{ old('date_limite', isset($offre->date_limite) ? $offre->date_limite->format('Y-m-d') : '') }}"
                                    min="{{ now()->addDay()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-section">
                        <span class="form-section-title">Description du poste</span>
                        <div class="form-grid">
                            <div class="fg1">
                                <label class="form-label">Description complète <span class="req">*</span></label>
                                <textarea name="description" class="form-control" style="min-height:220px"
                                    placeholder="Décrivez le poste, les responsabilités, le contexte de l'entreprise..." required>{{ old('description', $offre->description ?? '') }}</textarea>
                                @error('description')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    @if (isset($offre))
                    {{-- Statut si modification --}}
                    <div class="form-section">
                        <span class="form-section-title">Statut de l'offre</span>
                        <div class="form-grid">
                            <div>
                                <label class="form-label">Statut <span class="req">*</span></label>
                                <select name="statut" class="form-control" required>
                                    @foreach (['active'=>'Active — Visible par les candidats','inactive'=>'Inactive — Masquée','pourvue'=>'Pourvue — Poste occupé'] as $val => $lbl)
                                    <option value="{{ $val }}" {{ ($offre->statut ?? 'active') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Actions --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-or">
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ isset($offre) ? 'Mettre à jour l\'offre' : 'Publier l\'offre maintenant' }}
                        </button>
                        <a href="{{ route('recruteur.offres') }}" class="btn-outline">Annuler</a>
                    </div>
                </div>

                {{-- Colonne latérale --}}
                <div>
                    {{-- Logo entreprise --}}
                    <div class="side-card">
                        <div class="side-card-title">Logo de l'entreprise</div>
                        <label class="logo-upload" id="logo-label">
                            <img id="logo-preview" class="logo-preview" src="" alt="Logo">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                            <p><strong>Cliquez</strong> pour télécharger<br><span style="font-size:10px">PNG, JPG — Max 2 Mo</span></p>
                            <input type="file" name="logo_entreprise" accept="image/*"
                                onchange="previewLogo(this)">
                        </label>
                    </div>

                    {{-- Option vedette --}}
                    <div class="side-card">
                        <div class="side-card-title">Options de mise en avant</div>
                        <label class="check-row" style="margin-bottom:.75rem">
                            <input type="checkbox" name="en_vedette" value="1"
                                {{ old('en_vedette', $offre->en_vedette ?? false) ? 'checked' : '' }}>
                            Mettre en vedette
                        </label>
                        <p style="font-size:11px;color:#718096;line-height:1.55">Les offres en vedette apparaissent en tête de liste et génèrent <strong>3× plus de candidatures</strong>.</p>
                    </div>

                    {{-- Aperçu --}}
                    <div class="side-card">
                        <div class="side-card-title">Aperçu de l'offre</div>
                        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:.85rem">
                            <div style="font-size:13px;font-weight:700;color:#0a1e38;margin-bottom:4px" id="prev-titre">Titre du poste</div>
                            <div style="font-size:11px;color:#718096;margin-bottom:6px" id="prev-meta">Entreprise — Lieu</div>
                            <div style="display:flex;gap:6px;flex-wrap:wrap">
                                <span class="preview-badge" style="background:#e3f2fd;color:#0f284e" id="prev-contrat">CDI</span>
                                <span class="preview-badge" style="background:#e8f5e9;color:#2e7d32">Active</span>
                            </div>
                        </div>
                    </div>

                    {{-- Conseils --}}
                    <div class="side-card">
                        <div class="side-card-title">Conseils pour une bonne offre</div>
                        @foreach (['Utilisez un titre clair et précis','Mentionnez la fourchette de salaire','Précisez le mode de travail (remote/présentiel)','Décrivez la culture d\'entreprise','Indiquez les avantages et bénéfices'] as $tip)
                        <div class="tip-item">
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ $tip }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </main>
</div>

@include('components.footer')

@push('scripts')
<script>
    // Preview logo
    function previewLogo(input) {
        if (input.files?.[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const prev = document.getElementById('logo-preview');
                prev.src = e.target.result;
                prev.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Preview offre en temps réel
    function updatePreview() {
        const titre = document.querySelector('[name=titre]')?.value || 'Titre du poste';
        const ent = document.querySelector('[name=entreprise]')?.value || 'Entreprise';
        const lieu = document.querySelector('[name=lieu]')?.value || 'Lieu';
        const cont = document.querySelector('[name=type_contrat]')?.value || 'CDI';
        document.getElementById('prev-titre').textContent = titre;
        document.getElementById('prev-meta').textContent = ent + ' — ' + lieu;
        document.getElementById('prev-contrat').textContent = cont;
    }

    ['titre', 'entreprise', 'lieu'].forEach(n => {
        document.querySelector(`[name=${n}]`)?.addEventListener('input', updatePreview);
    });
    document.querySelector('[name=type_contrat]')?.addEventListener('change', updatePreview);
    updatePreview();
</script>
@endpush
@endsection