{{-- resources/views/mon-espace/profil.blade.php --}}
@extends('layouts.app')
@section('title', 'Mon Profil — JEFIE Paris 2026')
@section('styles')
<style>
    * {
        box-sizing: border-box;
    }

    .profil-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 4rem;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 2rem;
    }

    /* ── SIDEBAR (réutilise le style du site) ── */
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

    /* ── HEADER PROFIL ── */
    .profil-header {
        background: linear-gradient(135deg, #0f284e 0%, #163a6b 100%);
        border-radius: 14px;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .profil-header::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 260px;
        height: 260px;
        background: rgba(245, 197, 24, .08);
        border-radius: 50%;
    }

    .avatar-wrap {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
    }

    .avatar-img {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f5c518;
        background: #1a3a63;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f5c518;
        font-size: 2rem;
        font-weight: 900;
    }

    .avatar-edit-btn {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 30px;
        height: 30px;
        background: #f5c518;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2px solid #0f284e;
    }

    .avatar-edit-btn svg {
        width: 14px;
        height: 14px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 2;
    }

    .avatar-edit-btn input {
        display: none;
    }

    .profil-header-info {
        position: relative;
        z-index: 1;
        flex: 1;
        min-width: 0;
    }

    .ph-name {
        color: #fff;
        font-size: 1.35rem;
        font-weight: 900;
        margin-bottom: 2px;
    }

    .ph-title {
        color: #f5c518;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ph-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .ph-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        color: rgba(255, 255, 255, .75);
        font-size: 12px;
    }

    .ph-meta-item svg {
        width: 13px;
        height: 13px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2;
    }

    .ph-completion {
        position: relative;
        z-index: 1;
        text-align: center;
        flex-shrink: 0;
    }

    .ph-completion-ring {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 900;
        color: #fff;
        background: conic-gradient(#f5c518 calc(var(--pct) * 1%), rgba(255, 255, 255, .15) 0);
        margin: 0 auto 6px;
        position: relative;
    }

    .ph-completion-ring::before {
        content: '';
        position: absolute;
        inset: 5px;
        background: #0f284e;
        border-radius: 50%;
    }

    .ph-completion-ring span {
        position: relative;
        z-index: 1;
    }

    .ph-completion-lbl {
        font-size: 10px;
        color: rgba(255, 255, 255, .6);
        font-weight: 600;
    }

    /* ── CARDS ── */
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

    .pform-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .pfg1 {
        grid-column: 1 / -1;
    }

    .pform-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
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
        transition: border-color .2s, box-shadow .2s;
        font-family: inherit;
        width: 100%;
        background: #fff;
    }

    .pform-control:focus {
        border-color: #2a5aa2;
        box-shadow: 0 0 0 3px rgba(42, 90, 162, .08);
    }

    textarea.pform-control {
        resize: vertical;
        min-height: 100px;
    }

    .pform-disponibilite {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .pdisp-opt {
        flex: 1;
        min-width: 140px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        text-align: center;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        color: #4a5568;
        transition: all .15s;
    }

    .pdisp-opt input {
        display: none;
    }

    .pdisp-opt.checked {
        border-color: #f5c518;
        background: #fffbf0;
        color: #0f284e;
    }

    .btn-save-profil {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 13px 28px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
        margin-top: .5rem;
    }

    .btn-save-profil:hover {
        background: #0a1e38;
    }

    .btn-save-profil svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .alert-success-profil {
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

    .alert-success-profil svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .field-err {
        color: #e53935;
        font-size: 10.5px;
        margin-top: -1px;
    }

    @media (max-width: 900px) {
        .profil-wrap {
            grid-template-columns: 1fr;
        }

        .pform-grid {
            grid-template-columns: 1fr;
        }

        .profil-header {
            flex-direction: column;
            text-align: center;
        }

        .ph-meta {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
@include('components.navbar')

@php
$p = $profil ?? null; // instance ProfilCandidat ou null
$completion = 0;
if ($p) {
$champs = ['nom_complet','email','telephone','localisation','titre_pro','bio','secteur','linkedin','disponibilite','photo'];
$remplis = collect($champs)->filter(fn($c) => !empty($p->$c))->count();
$completion = (int) round(($remplis / count($champs)) * 100);
}
$initiales = $p && $p->nom_complet
? collect(explode(' ', $p->nom_complet))->map(fn($m) => mb_substr($m, 0, 1))->take(2)->implode('')
: mb_substr($user->name ?? 'U', 0, 1);
@endphp

<div class="profil-wrap">

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
        <a href="{{ route('mon-espace.profil') }}" class="active">
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
        <a href="{{ route('mon-espace.preferences') }}">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
            </svg>
            Préférences &amp; notifications
        </a>
    </aside>

    {{-- ══ CONTENU PRINCIPAL ══ --}}
    <div>
        @if (session('success'))
        <div class="alert-success-profil">
            <svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Header avec avatar + complétion --}}
        <div class="profil-header">
            <div class="avatar-wrap">
                @if($p && $p->photo)
                <img src="{{ asset('storage/'.$p->photo) }}" alt="Photo de profil" class="avatar-img">
                @else
                <div class="avatar-img">{{ strtoupper($initiales) }}</div>
                @endif
                <label class="avatar-edit-btn" title="Changer la photo">
                    <svg viewBox="0 0 24 24">
                        <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" />
                        <circle cx="12" cy="13" r="4" />
                    </svg>
                    <input type="file" name="photo_trigger" id="photoTriggerInput" accept="image/*">
                </label>
            </div>
            <div class="profil-header-info">
                <div class="ph-name">{{ $p->nom_complet ?? $user->name ?? 'Nom non renseigné' }}</div>
                <div class="ph-title">{{ $p->titre_pro ?? 'Titre professionnel non renseigné' }}</div>
                <div class="ph-meta">
                    <div class="ph-meta-item">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                        {{ $p->email ?? $user->email }}
                    </div>
                    @if($p && $p->localisation)
                    <div class="ph-meta-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ $p->localisation }}
                    </div>
                    @endif
                    @if($p && $p->secteur)
                    <div class="ph-meta-item">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        {{ $p->secteur }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="ph-completion">
                <div class="ph-completion-ring" style="--pct: {{ $completion }}">
                    <span>{{ $completion }}%</span>
                </div>
                <div class="ph-completion-lbl">Profil complété</div>
            </div>
        </div>

        {{-- Formulaire d'édition --}}
        <form method="POST" action="{{ route('mon-espace.profil.update') }}" enctype="multipart/form-data" id="formProfil">
            @csrf
            @method('PUT')
            <input type="file" name="photo" id="photoRealInput" accept="image/*" style="display:none">

            {{-- Identité --}}
            <div class="pcard">
                <div class="pcard-title">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Identité
                </div>
                <div class="pform-grid">
                    <div class="pform-group">
                        <label class="pform-label">Nom complet</label>
                        <input type="text" name="nom_complet" class="pform-control" placeholder="Prénom Nom" value="{{ old('nom_complet', $p->nom_complet ?? $user->name) }}">
                        @error('nom_complet')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="pform-group">
                        <label class="pform-label">Adresse e-mail</label>
                        <input type="email" name="email" class="pform-control" placeholder="vous@email.com" value="{{ old('email', $p->email ?? $user->email) }}">
                        @error('email')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="pform-group">
                        <label class="pform-label">Téléphone / WhatsApp</label>
                        <input type="tel" name="telephone" class="pform-control" placeholder="+33 6 00 00 00 00" value="{{ old('telephone', $p->telephone ?? '') }}">
                        @error('telephone')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="pform-group">
                        <label class="pform-label">Localisation</label>
                        <input type="text" name="localisation" class="pform-control" placeholder="Ville, Pays" value="{{ old('localisation', $p->localisation ?? '') }}">
                        @error('localisation')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Profil professionnel --}}
            <div class="pcard">
                <div class="pcard-title">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    Profil professionnel
                </div>
                <div class="pform-grid">
                    <div class="pform-group">
                        <label class="pform-label">Titre professionnel</label>
                        <input type="text" name="titre_pro" class="pform-control" placeholder="Ex : Développeur Full-Stack" value="{{ old('titre_pro', $p->titre_pro ?? '') }}">
                        @error('titre_pro')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="pform-group">
                        <label class="pform-label">Secteur d'activité</label>
                        <input type="text" name="secteur" class="pform-control" placeholder="Ex : Informatique, Finance..." value="{{ old('secteur', $p->secteur ?? '') }}">
                        @error('secteur')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="pform-group pfg1">
                        <label class="pform-label">LinkedIn</label>
                        <input type="url" name="linkedin" class="pform-control" placeholder="https://linkedin.com/in/votre-profil" value="{{ old('linkedin', $p->linkedin ?? '') }}">
                        @error('linkedin')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="pform-group pfg1">
                        <label class="pform-label">Présentation / Bio</label>
                        <textarea name="bio" class="pform-control" placeholder="Parlez de votre parcours, vos compétences, vos objectifs...">{{ old('bio', $p->bio ?? '') }}</textarea>
                        @error('bio')<span class="field-err">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Disponibilité --}}
            <div class="pcard">
                <div class="pcard-title">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Disponibilité
                </div>
                <div class="pform-disponibilite">
                    @foreach(['immediate' => 'Immédiate', '1_mois' => 'Sous 1 mois', '3_mois' => 'Sous 3 mois', 'non_disponible' => 'Non disponible'] as $val => $label)
                    <label class="pdisp-opt {{ old('disponibilite', $p->disponibilite ?? '') === $val ? 'checked' : '' }}">
                        <input type="radio" name="disponibilite" value="{{ $val }}" {{ old('disponibilite', $p->disponibilite ?? '') === $val ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn-save-profil">
                <svg viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Enregistrer les modifications
            </button>
        </form>
    </div>
</div>

<script>
    // Ouvrir le vrai input file depuis le bouton avatar
    document.getElementById('photoTriggerInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const realInput = document.getElementById('photoRealInput');
            const dt = new DataTransfer();
            dt.items.add(e.target.files[0]);
            realInput.files = dt.files;
            document.getElementById('formProfil').requestSubmit();
        }
    });

    // Style visuel des options de disponibilité
    document.querySelectorAll('.pdisp-opt input').forEach(input => {
        input.addEventListener('change', function() {
            document.querySelectorAll('.pdisp-opt').forEach(el => el.classList.remove('checked'));
            this.closest('.pdisp-opt').classList.add('checked');
        });
    });
</script>

@include('components.footer')
@endsection