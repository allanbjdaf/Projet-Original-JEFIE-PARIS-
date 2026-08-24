<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Inscription — JEFIE Paris 2026</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Segoe UI',Arial,sans-serif;background:#f0f2f7;color:#1a2744;min-height:100vh}

/* NAV */
.nav{background:#0d1b3e;height:64px;display:flex;align-items:center;justify-content:space-between;padding:0 2rem;position:sticky;top:0;z-index:200}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.nav-logo img{height:44px;width:auto}
.nav-logo-text{color:#fff;font-size:9px;font-weight:700;text-transform:uppercase;line-height:1.3}
.nav-logo-text span{color:#f5a623;display:block;font-size:11px;font-weight:800}
.btn-back{color:rgba(255,255,255,.7);font-size:12px;text-decoration:none;border:1px solid rgba(255,255,255,.2);padding:7px 14px;border-radius:5px;display:inline-flex;align-items:center;gap:5px;transition:all .2s}
.btn-back:hover{background:rgba(255,255,255,.1);color:#fff}
.btn-back svg{width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2}

/* WRAPPER */
.page-wrap{max-width:780px;margin:0 auto;padding:2.5rem 1.5rem 4rem}

/* CHOIX TYPE */
.type-choice{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:2rem}
.tc-card{background:#fff;border:2px solid #e2e8f0;border-radius:14px;padding:2rem 1.5rem;cursor:pointer;text-align:center;transition:all .25s;position:relative}
.tc-card:hover{border-color:#0d1b3e;box-shadow:0 8px 28px rgba(13,27,62,.1);transform:translateY(-3px)}
.tc-card.selected{border-color:#f5a623;background:#fffbf0;box-shadow:0 0 0 3px rgba(245,166,35,.15)}
.tc-check{position:absolute;top:12px;right:12px;width:22px;height:22px;background:#f5a623;border-radius:50%;display:none;align-items:center;justify-content:center}
.tc-card.selected .tc-check{display:flex}
.tc-check svg{width:12px;height:12px;stroke:#fff;fill:none;stroke-width:2.5}
.tc-icon{width:60px;height:60px;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem}
.tc-icon svg{width:28px;height:28px;stroke:currentColor;fill:none;stroke-width:1.6}
.tc-title{font-size:1rem;font-weight:800;color:#0d1b3e;margin-bottom:.35rem}
.tc-desc{font-size:12px;color:#718096;line-height:1.55}

/* STEPPER */
.stepper{display:flex;align-items:center;margin-bottom:2.5rem;position:relative}
.stepper::before{content:'';position:absolute;top:18px;left:0;right:0;height:2px;background:#e2e8f0;z-index:0}
.step{display:flex;flex-direction:column;align-items:center;flex:1;position:relative;z-index:1}
.step-circle{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;border:2px solid #e2e8f0;background:#fff;color:#a0aec0;transition:all .3s;position:relative;z-index:1}
.step.done .step-circle{background:#2e7d32;border-color:#2e7d32;color:#fff}
.step.active .step-circle{background:#0d1b3e;border-color:#0d1b3e;color:#f5a623;box-shadow:0 0 0 4px rgba(13,27,62,.1)}
.step-label{font-size:10px;font-weight:700;color:#a0aec0;margin-top:6px;text-align:center;line-height:1.3;max-width:80px}
.step.active .step-label{color:#0d1b3e}
.step.done .step-label{color:#2e7d32}

/* CARD */
.card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:2rem;margin-bottom:1.25rem}
.card-title{font-size:13px;font-weight:800;color:#0d1b3e;text-transform:uppercase;letter-spacing:.08em;border-left:3px solid #f5a623;padding-left:10px;margin-bottom:1.5rem;display:flex;align-items:center;gap:8px}
.card-title svg{width:15px;height:15px;stroke:#f5a623;fill:none;stroke-width:2}

/* FORMS */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.fg1{grid-column:1/-1}
.form-group{display:flex;flex-direction:column;gap:5px}
.form-label{font-size:11px;font-weight:700;color:#162552;display:flex;align-items:center;gap:4px}
.req{color:#e53935;font-size:12px}
.form-hint{font-size:10px;color:#a0aec0;margin-top:1px}
.form-control{padding:11px 14px;border:1.5px solid #d1d9e6;border-radius:8px;font-size:13px;color:#1a2744;outline:none;transition:border-color .2s,box-shadow .2s;font-family:inherit;background:#fff;width:100%}
.form-control:focus{border-color:#0d1b3e;box-shadow:0 0 0 3px rgba(13,27,62,.06)}
.form-control::placeholder{color:#a0aec0}
.form-control.err{border-color:#e53935;background:#fff9f9}
select.form-control{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;background-size:13px;padding-right:34px;cursor:pointer}
textarea.form-control{resize:vertical;min-height:90px}
.err-msg{color:#e53935;font-size:10px;margin-top:2px;display:none}

/* CHECKBOXES */
.check-group{display:flex;flex-direction:column;gap:7px}
.check-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px}
.check-item{display:flex;align-items:flex-start;gap:8px;padding:9px 12px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:7px;cursor:pointer;transition:all .2s}
.check-item:hover{border-color:#0d1b3e;background:#fff}
.check-item input[type=checkbox]{width:16px;height:16px;accent-color:#0d1b3e;flex-shrink:0;margin-top:1px;cursor:pointer}
.check-item input[type=radio]{width:16px;height:16px;accent-color:#0d1b3e;flex-shrink:0;margin-top:1px;cursor:pointer}
.check-item label{font-size:12px;color:#162552;font-weight:600;cursor:pointer;line-height:1.45}
.check-item.selected{border-color:#f5a623;background:#fff8e6}
/* Profil type cards */
.profil-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}
.profil-card{border:1.5px solid #e2e8f0;border-radius:9px;padding:.85rem .6rem;cursor:pointer;text-align:center;transition:all .2s;position:relative;background:#fff}
.profil-card input{position:absolute;opacity:0;width:0;height:0}
.profil-card:hover{border-color:#0d1b3e}
.profil-card.pc-selected{border-color:#f5a623;background:#fffbf0}
.pc-icon{width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;margin:0 auto .35rem}
.pc-icon svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.7}
.pc-lbl{font-size:10px;font-weight:700;color:#162552;line-height:1.3}

/* UPLOAD */
.upload-zone{border:2px dashed #d1d9e6;border-radius:9px;padding:1.5rem;text-align:center;cursor:pointer;transition:all .2s;position:relative;background:#fafbfc}
.upload-zone:hover{border-color:#0d1b3e;background:#f4f6fa}
.upload-zone input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.upload-zone svg{width:28px;height:28px;stroke:#a0aec0;fill:none;stroke-width:1.4;display:block;margin:0 auto .5rem}
.upload-zone p{font-size:12px;color:#718096;line-height:1.5}
.upload-zone p strong{color:#0d1b3e}
.upload-name{font-size:11px;color:#2e7d32;font-weight:600;margin-top:4px;display:none}

/* COLLABORATEUR */
.collab-block{background:#f8fafc;border:1px solid #e2e8f0;border-radius:9px;padding:1.1rem;margin-bottom:.75rem;position:relative}
.collab-num{font-size:10px;font-weight:800;color:#a0aec0;text-transform:uppercase;margin-bottom:.75rem}
.btn-del-collab{position:absolute;top:.85rem;right:.85rem;background:none;border:none;color:#a0aec0;cursor:pointer;padding:3px;transition:color .2s}
.btn-del-collab:hover{color:#e53935}
.btn-del-collab svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2}
.btn-add-collab{display:inline-flex;align-items:center;gap:6px;background:#fff;border:1.5px dashed #d1d9e6;color:#162552;font-size:12px;font-weight:700;padding:10px 18px;border-radius:7px;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-add-collab:hover{border-color:#0d1b3e;background:#f4f6fa}
.btn-add-collab svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2}

/* OFFRE */
.offre-block{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:1.25rem;margin-bottom:.85rem;position:relative}
.offre-num{font-size:10px;font-weight:800;color:#a0aec0;text-transform:uppercase;letter-spacing:.07em;margin-bottom:.85rem;display:flex;align-items:center;gap:6px}
.offre-num::before{content:'';width:3px;height:14px;background:#f5a623;border-radius:2px}
.btn-del-offre{position:absolute;top:.85rem;right:.85rem;background:none;border:none;color:#a0aec0;cursor:pointer;padding:3px;transition:color .2s}
.btn-del-offre:hover{color:#e53935}
.btn-del-offre svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2}
.btn-add-offre{display:inline-flex;align-items:center;gap:7px;background:#0d1b3e;color:#fff;font-size:13px;font-weight:700;padding:11px 20px;border-radius:7px;cursor:pointer;transition:background .2s;border:none;font-family:inherit}
.btn-add-offre:hover{background:#162552}
.btn-add-offre svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2}

/* RÉCAP */
.recap-block{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:1.25rem;margin-bottom:1rem}
.rb-title{font-size:10px;font-weight:800;color:#0d1b3e;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.65rem;padding-bottom:.5rem;border-bottom:1px solid #e2e8f0}
.rb-row{display:flex;align-items:baseline;justify-content:space-between;font-size:12px;padding:.35rem 0;border-bottom:1px solid #f4f6fa}
.rb-row:last-child{border-bottom:none}
.rb-row span:first-child{color:#718096;font-weight:600}
.rb-row span:last-child{color:#162552;font-weight:700;text-align:right;max-width:65%}

/* CONSENTEMENTS */
.consent-check{display:flex;align-items:flex-start;gap:10px;padding:.85rem 1rem;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:8px;margin-bottom:.6rem;cursor:pointer;transition:all .2s}
.consent-check:hover{border-color:#0d1b3e}
.consent-check input{width:17px;height:17px;accent-color:#0d1b3e;flex-shrink:0;margin-top:1px;cursor:pointer}
.consent-check label{font-size:12px;color:#162552;line-height:1.55;cursor:pointer}
.consent-check label strong{color:#0d1b3e}

/* NAVIGATION STEPS */
.step-nav{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:1.5rem}
.btn-prev{background:#fff;color:#162552;border:1.5px solid #d1d9e6;font-weight:700;font-size:13px;padding:12px 22px;border-radius:8px;cursor:pointer;font-family:inherit;display:inline-flex;align-items:center;gap:7px;transition:all .2s}
.btn-prev:hover{border-color:#0d1b3e}
.btn-prev svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2}
.btn-next{background:#0d1b3e;color:#fff;border:none;font-weight:700;font-size:13px;padding:12px 28px;border-radius:8px;cursor:pointer;font-family:inherit;display:inline-flex;align-items:center;gap:7px;transition:all .2s;margin-left:auto}
.btn-next:hover{background:#162552}
.btn-next svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2}
.btn-submit-final{background:#f5a623;color:#0d1b3e;border:none;font-weight:800;font-size:14px;padding:14px 32px;border-radius:8px;cursor:pointer;font-family:inherit;display:inline-flex;align-items:center;gap:8px;transition:all .2s;margin-left:auto}
.btn-submit-final:hover{opacity:.9;transform:translateY(-1px);box-shadow:0 6px 20px rgba(245,166,35,.3)}
.btn-submit-final svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2}
.btn-submit-final:disabled{opacity:.6;cursor:not-allowed;transform:none}

/* PROGRESS */
.progress-bar{height:4px;background:#f0f2f7;border-radius:2px;overflow:hidden;margin-bottom:2rem}
.progress-fill{height:100%;background:linear-gradient(90deg,#f5a623,#e09010);border-radius:2px;transition:width .4s ease}

/* SECTION CONDITIONNELLE */
.cond-section{display:none}
.cond-section.visible{display:block}

/* BADGE RECAP */
.badge-r{display:inline-block;font-size:10px;font-weight:700;padding:2px 9px;border-radius:8px;text-transform:uppercase}

/* ALERT */
.alert-success{background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;border-radius:10px;padding:1.25rem 1.5rem;display:flex;align-items:flex-start;gap:10px;margin-bottom:1.5rem}
.alert-success svg{width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:2.5;flex-shrink:0;margin-top:1px}
.alert-err-global{background:#fce4ec;border:1px solid #f48fb1;color:#c2185b;border-radius:8px;padding:.85rem 1.25rem;font-size:13px;margin-bottom:1rem;display:none}

/* HEADER PAGE */
.page-header{text-align:center;margin-bottom:2rem}
.ph-eyebrow{display:inline-flex;align-items:center;gap:6px;background:rgba(245,166,35,.12);border:1px solid rgba(245,166,35,.3);color:#f5a623;font-size:10px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:5px 14px;border-radius:20px;margin-bottom:.75rem}
.ph-eyebrow svg{width:11px;height:11px;stroke:currentColor;fill:none;stroke-width:2}
.ph-title{font-size:1.6rem;font-weight:900;color:#0d1b3e;margin-bottom:.4rem}
.ph-sub{font-size:13px;color:#718096;line-height:1.6}

@media(max-width:700px){.form-grid{grid-template-columns:1fr}.type-choice{grid-template-columns:1fr}.profil-grid{grid-template-columns:1fr 1fr}.check-grid{grid-template-columns:1fr}.page-wrap{padding:1.5rem .85rem 3rem}}
@media(max-width:400px){.profil-grid{grid-template-columns:1fr 1fr}}
</style>
</head>
<body>

<nav class="nav">
    <a href="{{ route('index') }}" class="nav-logo">
        <img src="{{ asset('images/264.png') }}" alt="JEFIE Paris 2026">
        <div class="nav-logo-text"><span>JEFIE</span>Paris 2026</div>
    </a>
    <a href="{{ route('index') }}" class="btn-back">
        <svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Retour à l'accueil
    </a>
</nav>

<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="ph-eyebrow"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Inscription officielle</div>
        <h1 class="ph-title">Forum JEFIE Paris 2026</h1>
        <p class="ph-sub">15 – 18 Septembre 2026 · Paris, France<br>Remplissez le formulaire ci-dessous pour valider votre inscription.</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <div><strong>Inscription enregistrée !</strong><br>{{ session('success') }}<br><span style="font-size:11px;opacity:.8">Un e-mail de confirmation avec votre badge QR Code vous a été envoyé.</span></div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-err-global" style="display:flex;align-items:center;gap:8px">
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Veuillez corriger les erreurs ci-dessous avant de continuer.
        </div>
    @endif

    {{-- ═══════════════════════════════════
         ÉTAPE 0 — CHOIX DU TYPE D'INSCRIPTION
    ═══════════════════════════════════ --}}
    <div id="step0">
        <h2 style="font-size:1.05rem;font-weight:800;color:#0d1b3e;margin-bottom:1.25rem;text-align:center">Quel est votre type d'inscription ?</h2>
        <div class="type-choice">
            <div class="tc-card" id="choixParticipant" onclick="selectType('participant')">
                <div class="tc-check"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
                <div class="tc-icon" style="background:#e3f2fd;color:#1565c0">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div class="tc-title">Visiteur / Participant</div>
                <div class="tc-desc">Particulier, candidat à l'emploi, entrepreneur en quête d'opportunités ou simple visiteur du Forum</div>
            </div>
            <div class="tc-card" id="choixEntreprise" onclick="selectType('entreprise')">
                <div class="tc-check"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
                <div class="tc-icon" style="background:#fff8e6;color:#f5a623">
                    <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                </div>
                <div class="tc-title">Acteur Économique</div>
                <div class="tc-desc">Entreprise, recruteur, investisseur ou institution souhaitant recruter, présenter des offres ou nouer des partenariats</div>
            </div>
        </div>
        <div style="text-align:center">
            <button onclick="goToForm()" class="btn-next">
                Continuer
                <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         FORMULAIRE PARTICIPANT / VISITEUR
    ═══════════════════════════════════════════════════════ --}}
    <div id="formParticipant" style="display:none">

        {{-- Progress + Stepper --}}
        <div class="progress-bar"><div class="progress-fill" id="progP" style="width:25%"></div></div>
        <div class="stepper" id="stepperP">
            @foreach([['1','Profil'],['2','Situation'],['3','Entrepreneur'],['4','Validation']] as $i => [$n,$l])
                <div class="step {{ $i===0?'active':'' }}" id="stepP{{ $n }}">
                    <div class="step-circle">{{ $n }}</div>
                    <div class="step-label">{{ $l }}</div>
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('inscription.store') }}" enctype="multipart/form-data" id="formP">
            @csrf
            <input type="hidden" name="type_inscription" value="participant">
            <input type="hidden" name="sous_profil" id="sousProfil" value="">

            {{-- ── ÉTAPE 1 — Profil ── --}}
            <div id="panelP1">
                {{-- Profil --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Quel est votre profil ? <span class="req">*</span></div>
                    <div class="profil-grid" id="profilChoix">
                        @foreach([
                            ['participant','Participant','<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>','#1565c0','#e3f2fd'],
                            ['ecoute','Écoute d\'opportunité','<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>','#2e7d32','#e8f5e9'],
                            ['entrepreneur','Entrepreneur / Porteur de projet','<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>','#f5a623','#fff8e6'],
                        ] as [$v,$l,$ic,$c,$bg])
                            <label class="profil-card" id="pc-{{ $v }}" onclick="selectSousProfil('{{ $v }}')">
                                <input type="radio" name="profil_visiteur" value="{{ $v }}" {{ old('profil_visiteur')===$v?'checked':'' }}>
                                <div class="pc-icon" style="background:{{ $bg }};color:{{ $c }}"><svg viewBox="0 0 24 24" stroke="{{ $c }}" fill="none" stroke-width="1.7">{!! $ic !!}</svg></div>
                                <div class="pc-lbl">{{ $l }}</div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Identité --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Identité</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Civilité <span class="req">*</span></label>
                            <select name="civilite" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                <option value="M" {{ old('civilite')==='M'?'selected':'' }}>Monsieur</option>
                                <option value="Mme" {{ old('civilite')==='Mme'?'selected':'' }}>Madame</option>
                            </select>
                        </div>
                        <div></div>
                        <div class="form-group">
                            <label class="form-label">Nom(s) <span class="req">*</span></label>
                            <input type="text" name="nom" class="form-control" placeholder="Votre nom de famille" value="{{ old('nom') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prénom(s) <span class="req">*</span></label>
                            <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nationalité <span class="req">*</span></label>
                            <select name="nationalite" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                @foreach(['Gabonaise','Française','Belge','Canadienne','Américaine','Britannique','Camerounaise','Sénégalaise','Ivoirienne','Congolaise','Marocaine','Autre'] as $n)
                                    <option value="{{ $n }}" {{ old('nationalite')===$n?'selected':'' }}>{{ $n }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pays de résidence <span class="req">*</span></label>
                            <select name="pays_residence" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                @foreach(['France','Gabon','Belgique','Canada','États-Unis','Royaume-Uni','Suisse','Espagne','Allemagne','Portugal','Sénégal','Côte d\'Ivoire','Cameroun','Maroc','Autre'] as $p)
                                    <option value="{{ $p }}" {{ old('pays_residence')===$p?'selected':'' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Numéro WhatsApp <span class="req">*</span></label>
                            <input type="tel" name="whatsapp" class="form-control" placeholder="+33 6 00 00 00 00" value="{{ old('whatsapp') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Adresse e-mail <span class="req">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="votre@email.com" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>
                </div>

                {{-- Thématiques --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/></svg>Thématiques d'intérêt</div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1rem">Quelles thématiques du Forum vous intéressent particulièrement ?</p>
                    <div class="check-grid">
                        @foreach(['Investissement','Entrepreneuriat','Emploi','Transformation numérique','Industrie','Agriculture','Énergie','Finance','Commerce','Autre'] as $t)
                            <label class="check-item">
                                <input type="checkbox" name="thematiques[]" value="{{ $t }}" {{ in_array($t, old('thematiques',[]))?'checked':'' }}>
                                <label style="cursor:pointer">{{ $t }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- B2B --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>Rencontres B2B</div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1rem">Souhaitez-vous participer aux rencontres B2B ?</p>
                    <div style="display:flex;gap:1rem">
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="participe_b2b" value="oui" {{ old('participe_b2b')==='oui'?'checked':'' }}>
                            <label>✅ Oui, je souhaite participer</label>
                        </label>
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="participe_b2b" value="non" {{ old('participe_b2b')==='non'?'checked':'' }}>
                            <label>Non merci</label>
                        </label>
                    </div>
                </div>

                <div class="step-nav">
                    <button type="button" onclick="backToChoice()" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Retour</button>
                    <button type="button" onclick="nextPanelP(1)" class="btn-next">Étape suivante<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 2 — Si "Écoute d'opportunité" ── --}}
            <div id="panelP2" style="display:none">
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>Profil — Écoute d'opportunité</div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1.25rem">Si vous êtes à l'écoute des opportunités au Gabon, cette étape est indispensable. Merci d'y répondre avec le plus grand intérêt et de communiquer des informations exactes.</p>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nationalité <span class="req">*</span></label>
                            <select name="nationalite_type" class="form-control">
                                <option value="">Sélectionnez...</option>
                                <option value="gabonaise">Gabonaise</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Niveau d'études <span class="req">*</span></label>
                            <select name="niveau_etudes" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['3ème','Terminale','BAC+2','BAC+3','BAC+4','BAC+5','Docteur','Autre'] as $n)
                                    <option value="{{ $n }}">{{ $n }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Diplôme le plus élevé <span class="req">*</span></label>
                            <select name="diplome" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['BEPC','Licence','Master 1','Master 2','Doctorat'] as $d)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Expérience pour ce poste</label>
                            <select name="experience" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['Junior (-2 ans)','Entre 2 et 5 ans','Entre 5 et 10 ans','Entre 10 et 15 ans','Plus de 15 ans'] as $e)
                                    <option value="{{ $e }}">{{ $e }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group fg1">
                            <label class="form-label">Domaine de formation <span class="req">*</span></label>
                            <select name="domaine_formation" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['Informatique, Numérique & Cybersécurité','Ingénierie, Industrie & Technologies','Énergie, Pétrole, Gaz & Mines','BTP, Architecture & Urbanisme','Agriculture, Agroalimentaire, Pêche & Environnement','Santé, Médecine & Sciences biomédicales','Économie, Finance, Banque & Assurance','Gestion, Management & Administration','Commerce, Marketing & Communication','Droit, Sciences politiques & Relations internationales','Sciences humaines & sociales','Éducation, Enseignement & Formation','Transport, Logistique & Supply Chain','Tourisme, Hôtellerie, Restauration & Culture','Autre domaine'] as $d)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group fg1">
                            <label class="form-label">Situation professionnelle actuelle <span class="req">*</span></label>
                            <select name="situation_pro" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['Primo-chercheur d\'emploi','Ancien travailleur','En poste','En fin de scolarité'] as $s)
                                    <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Postes recherchés --}}
                <div class="card">
                    <div class="card-title">Postes recherchés <span class="req">*</span></div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1rem">Quel est le poste que vous recherchez en priorité ?</p>
                    <div class="check-grid">
                        @foreach(['Direction générale / Direction exécutive','Management / Responsable d\'équipe','Administration / Assistanat / Secrétariat','Finance / Comptabilité / Audit','Banque / Assurance','Ressources humaines','Commercial / Vente / Business Development','Marketing / Communication / Événementiel','Informatique / Digital / Cybersécurité','Ingénierie / Technique / Maintenance','BTP / Architecture / Urbanisme','Énergie / Pétrole / Gaz / Mines','Logistique / Transport / Achats / Supply Chain','Santé / Social','Juridique / Conformité','Enseignement / Formation / Recherche','Agriculture / Agroalimentaire / Environnement','Hôtellerie / Restauration / Tourisme','Stage','Alternance / Apprentissage','Autre'] as $p)
                            <label class="check-item">
                                <input type="checkbox" name="postes_recherches[]" value="{{ $p }}">
                                <label>{{ $p }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- CV --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>Curriculum Vitae</div>
                    <label class="upload-zone">
                        <input type="file" name="cv" accept=".pdf,.doc,.docx" onchange="showFileName(this,'cvName')">
                        <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <p><strong>Déposer votre CV</strong> ou cliquez pour parcourir<br><span style="font-size:10px">PDF, DOC, DOCX — max 5 Mo</span></p>
                        <div id="cvName" class="upload-name"></div>
                    </label>
                </div>

                <div class="step-nav">
                    <button type="button" onclick="prevPanelP(2)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="button" onclick="nextPanelP(2)" class="btn-next">Étape suivante<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 3 — Si "Entrepreneur" ── --}}
            <div id="panelP3" style="display:none">
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>Informations sur votre entreprise</div>
                    <div class="form-grid">
                        <div class="form-group fg1">
                            <label class="form-label">Raison sociale / Forme juridique <span class="req">*</span></label>
                            <select name="forme_juridique_part" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['Entreprise individuelle (EI)','SARL','SARLU','SA','SAS','SASU','SNC','SCS','GIE','Société coopérative','Association / ONG','Établissement public','Autre'] as $f)
                                    <option value="{{ $f }}">{{ $f }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group fg1">
                            <label class="form-label">Domaine d'activité de l'entreprise <span class="req">*</span></label>
                            <select name="domaine_activite_part" class="form-control">
                                <option value="">Sélectionnez...</option>
                                @foreach(['Agriculture, élevage, pêche & agroalimentaire','Bois, forêt & industrie du bois','Mines & métallurgie','Pétrole, gaz & hydrocarbures','Énergie, eau & services environnementaux','BTP, construction & immobilier','Industrie & production manufacturière','Transport, logistique & services portuaires','Commerce & distribution','Banque, finance, assurance & microfinance','Télécommunications, numérique & technologies','Conseil & services aux entreprises','Tourisme, hôtellerie & restauration','Santé & services sociaux','Éducation & formation','Administration publique & services publics','Culture, médias, communication & événementiel','Association, ONG & économie sociale','Autre'] as $d)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Secteur économique <span class="req">*</span></label>
                            <select name="secteur_eco" class="form-control">
                                <option value="">Sélectionnez...</option>
                                <option value="Primaire">Primaire</option>
                                <option value="Secondaire">Secondaire</option>
                                <option value="Tertiaire">Tertiaire</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pays du siège de l'entreprise <span class="req">*</span></label>
                            <select name="pays_siege_part" class="form-control">
                                <option value="">Sélectionnez...</option>
                                <option value="Gabon">Gabon</option>
                                <option value="France">France</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="step-nav">
                    <button type="button" onclick="prevPanelP(3)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="button" onclick="nextPanelP(3)" class="btn-next">Étape suivante<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 4 — Validation ── --}}
            <div id="panelP4" style="display:none">
                {{-- Récap --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Récapitulatif de votre inscription</div>
                    <div class="recap-block">
                        <div class="rb-title">Informations personnelles</div>
                        <div class="rb-row"><span>Profil</span><span id="rProfil">—</span></div>
                        <div class="rb-row"><span>Identité</span><span id="rIdentite">—</span></div>
                        <div class="rb-row"><span>E-mail</span><span id="rEmail">—</span></div>
                        <div class="rb-row"><span>Téléphone</span><span id="rTel">—</span></div>
                        <div class="rb-row"><span>Pays de résidence</span><span id="rPays">—</span></div>
                        <div class="rb-row"><span>Participation B2B</span><span id="rB2B">—</span></div>
                    </div>
                    <p style="font-size:11px;color:#a0aec0;text-align:center;margin-top:.75rem">
                        🔒 Ces informations seront intégrées dans le QR Code de votre badge d'accès
                    </p>
                </div>

                {{-- Consentements --}}
                <div class="card">
                    <div class="card-title">Consentements <span class="req">*</span></div>
                    <label class="consent-check">
                        <input type="checkbox" name="certif_exactitude" value="1" required>
                        <label>☐ Je certifie que les informations fournies sont exactes. <span class="req">*</span></label>
                    </label>
                    <label class="consent-check">
                        <input type="checkbox" name="accepte_donnees" value="1" required>
                        <label>☐ J'accepte que mes données soient utilisées dans le cadre de l'organisation du <strong>JEFIE 2026</strong>. <span class="req">*</span></label>
                    </label>
                </div>

                <div class="step-nav">
                    <button type="button" onclick="prevPanelP(4)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="submit" class="btn-submit-final" id="btnSubmitP">
                        <svg viewBox="0 0 24 24"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        ENVOYER MON INSCRIPTION
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         FORMULAIRE ENTREPRISE / ACTEUR ÉCONOMIQUE
    ═══════════════════════════════════════════════════════ --}}
    <div id="formEntreprise" style="display:none">

        <div class="progress-bar"><div class="progress-fill" id="progE" style="width:20%"></div></div>
        <div class="stepper" id="stepperE">
            @foreach([['1','Compte'],['2','Collaborateurs'],['3','Participation'],['4','Offres'],['5','Validation']] as $i => [$n,$l])
                <div class="step {{ $i===0?'active':'' }}" id="stepE{{ $n }}">
                    <div class="step-circle">{{ $n }}</div>
                    <div class="step-label">{{ $l }}</div>
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('inscription.store') }}" enctype="multipart/form-data" id="formE">
            @csrf
            <input type="hidden" name="type_inscription" value="entreprise">

            {{-- ── ÉTAPE 1 — MAJ Compte Entreprise ── --}}
            <div id="panelE1">
                {{-- Admin --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Administrateur du compte entreprise</div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Civilité <span class="req">*</span></label>
                            <select name="admin_civilite" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                <option value="M">Monsieur</option>
                                <option value="Mme">Madame</option>
                            </select>
                        </div>
                        <div></div>
                        <div class="form-group">
                            <label class="form-label">Nom <span class="req">*</span></label>
                            <input type="text" name="admin_nom" class="form-control" placeholder="Nom de famille" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prénom <span class="req">*</span></label>
                            <input type="text" name="admin_prenom" class="form-control" placeholder="Prénom" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fonction <span class="req">*</span></label>
                            <input type="text" name="admin_fonction" class="form-control" placeholder="Ex: DRH, Directeur général..." required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Profil <span class="req">*</span></label>
                            <select name="admin_profil" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                @foreach(['Dirigeant / Chef d\'entreprise','Employeur / Recruteur','Responsable RH','Responsable recrutement','Responsable commercial / Business Development','Investisseur','Institution / Organisme public','Personne contact de l\'entreprise'] as $ap)
                                    <option value="{{ $ap }}">{{ $ap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">E-mail professionnel <span class="req">*</span></label>
                            <input type="email" name="admin_email" class="form-control" placeholder="email@entreprise.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">WhatsApp / Téléphone <span class="req">*</span></label>
                            <input type="tel" name="admin_telephone" class="form-control" placeholder="+33 6 00 00 00 00" required>
                        </div>
                    </div>
                </div>

                {{-- Entreprise --}}
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>Informations de l'entreprise</div>
                    <div class="form-grid">
                        <div class="form-group fg1">
                            <label class="form-label">Nom de l'entreprise / Raison sociale <span class="req">*</span></label>
                            <input type="text" name="entreprise_nom" class="form-control" placeholder="Nom officiel de l'entreprise" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Forme juridique <span class="req">*</span></label>
                            <select name="forme_juridique" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                @foreach(['Entreprise individuelle (EI)','SARL','SARLU','SA','SAS','SASU','SNC','SCS','GIE','Société coopérative','Association / ONG','Établissement public / Entreprise publique','Autre'] as $f)
                                    <option value="{{ $f }}">{{ $f }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pays du siège social <span class="req">*</span></label>
                            <select name="pays_siege" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                <option value="Gabon">Gabon</option>
                                <option value="France">France</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Taille de l'entreprise <span class="req">*</span></label>
                            <select name="taille_entreprise" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                @foreach(['1 à 9 salariés','10 à 49 salariés','50 à 249 salariés','250 à 999 salariés','1 000 salariés et plus'] as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group fg1">
                            <label class="form-label">Activité principale <span class="req">*</span></label>
                            <select name="activite_principale" class="form-control" required>
                                <option value="">Sélectionnez...</option>
                                @foreach(['Agriculture, élevage, pêche & agroalimentaire','Bois, forêt & industrie du bois','Mines & métallurgie','Pétrole, gaz & hydrocarbures','Énergie, eau & services environnementaux','BTP, construction & immobilier','Industrie & production manufacturière','Transport, logistique & services portuaires','Commerce & distribution','Banque, finance, assurance & microfinance','Télécommunications, numérique & technologies','Conseil & services aux entreprises','Tourisme, hôtellerie & restauration','Santé & services sociaux','Éducation & formation','Administration publique & services publics','Association, ONG & économie sociale','Autre'] as $a)
                                    <option value="{{ $a }}">{{ $a }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Site internet</label>
                            <input type="url" name="site_internet" class="form-control" placeholder="https://www.entreprise.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Logo de l'entreprise</label>
                            <label class="upload-zone" style="padding:.85rem">
                                <input type="file" name="logo" accept="image/*" onchange="showFileName(this,'logoName')">
                                <svg viewBox="0 0 24 24" style="width:20px;height:20px"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/></svg>
                                <p style="font-size:11px">Déposer votre logo (PNG, JPG)</p>
                                <div id="logoName" class="upload-name"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="step-nav">
                    <button type="button" onclick="backToChoice()" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Retour</button>
                    <button type="button" onclick="nextPanelE(1)" class="btn-next">Étape suivante<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 2 — Collaborateurs ── --}}
            <div id="panelE2" style="display:none">
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/></svg>Inscrire des collaborateurs</div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1.25rem">Souhaitez-vous inscrire d'autres collaborateurs de votre entreprise au Forum JEFIE 2026 ?<br><span style="font-size:11px;color:#a0aec0">Chaque collaborateur recevra son badge d'accès PDF par e-mail.</span></p>
                    <div style="display:flex;gap:1rem;margin-bottom:1.25rem">
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="ajoute_collabs" value="oui" onclick="showCollabs(true)">
                            <label>✅ Oui, ajouter des collaborateurs</label>
                        </label>
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="ajoute_collabs" value="non" onclick="showCollabs(false)" checked>
                            <label>Non, passer à l'étape suivante</label>
                        </label>
                    </div>
                    <div id="collabsZone" style="display:none">
                        <div id="collabsList"></div>
                        <button type="button" onclick="addCollab()" class="btn-add-collab">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            + AJOUTER UN PARTICIPANT
                        </button>
                    </div>
                </div>
                <div class="step-nav">
                    <button type="button" onclick="prevPanelE(2)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="button" onclick="nextPanelE(2)" class="btn-next">Étape suivante<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 3 — Participation au Forum ── --}}
            <div id="panelE3" style="display:none">
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>Objectifs au JEFIE 2026 <span class="req">*</span></div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1rem">Quels sont les principaux objectifs de votre entreprise au JEFIE 2026 ?</p>
                    <div class="check-grid">
                        @foreach(['Recruter des candidats','Identifier des talents de la diaspora','Publier des offres d\'emploi','Rechercher des partenaires commerciaux','Rechercher des investisseurs / financements','Identifier des opportunités d\'investissement au Gabon','Rencontrer des entreprises gabonaises','Rencontrer des institutions publiques','Présenter nos produits ou services','Développer notre réseau professionnel','Participer aux rencontres B2B','Autre'] as $obj)
                            <label class="check-item">
                                <input type="checkbox" name="objectifs[]" value="{{ $obj }}">
                                <label>{{ $obj }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Profils recherchés</div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1rem">Quels profils recherchez-vous principalement ? <span style="color:#a0aec0">(permet le matching automatique candidats ↔ recruteurs)</span></p>
                    <div class="check-grid">
                        @foreach(['Direction générale / Direction exécutive','Management / Responsable d\'équipe','Administration / Assistanat / Secrétariat','Finance / Comptabilité / Audit','Banque / Assurance','Ressources humaines','Commercial / Vente / Business Development','Marketing / Communication / Événementiel','Informatique / Digital / Cybersécurité','Ingénierie / Technique / Maintenance','BTP / Architecture / Urbanisme','Énergie / Pétrole / Gaz / Mines','Logistique / Transport / Achats / Supply Chain','Santé / Social','Juridique / Conformité','Enseignement / Formation / Recherche','Agriculture / Agroalimentaire / Environnement','Hôtellerie / Restauration / Tourisme','Stagiaires','Alternants / Apprentis','Autre'] as $pr)
                            <label class="check-item">
                                <input type="checkbox" name="profils_recherches[]" value="{{ $pr }}">
                                <label>{{ $pr }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Rencontres B2B <span class="req">*</span></div>
                    <div style="display:flex;gap:1rem">
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="entreprise_b2b" value="oui">
                            <label>✅ Oui, participer aux rencontres B2B</label>
                        </label>
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="entreprise_b2b" value="non">
                            <label>Non</label>
                        </label>
                    </div>
                </div>

                <div class="step-nav">
                    <button type="button" onclick="prevPanelE(3)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="button" onclick="nextPanelE(3)" class="btn-next">Étape suivante<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 4 — Offres d'emploi ── --}}
            <div id="panelE4" style="display:none">
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>Publication d'offres d'emploi</div>
                    <p style="font-size:12px;color:#718096;margin-bottom:1.25rem">Souhaitez-vous publier une offre d'emploi ?</p>
                    <div style="display:flex;gap:1rem;margin-bottom:1.25rem">
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="publie_offres" value="oui" onclick="showOffres(true)">
                            <label>✅ Oui, publier des offres</label>
                        </label>
                        <label class="check-item" style="flex:1">
                            <input type="radio" name="publie_offres" value="non" onclick="showOffres(false)" checked>
                            <label>Non, passer à l'étape suivante</label>
                        </label>
                    </div>

                    <div id="offresZone" style="display:none">
                        <div id="offresList"></div>
                        <button type="button" onclick="addOffre()" class="btn-add-offre">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            + AJOUTER UNE OFFRE
                        </button>
                    </div>
                </div>

                <div class="step-nav">
                    <button type="button" onclick="prevPanelE(4)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="button" onclick="nextPanelE(4)" class="btn-next">Valider & Récapitulatif<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></button>
                </div>
            </div>

            {{-- ── ÉTAPE 5 — Validation ── --}}
            <div id="panelE5" style="display:none">
                <div class="card">
                    <div class="card-title"><svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Vérifiez vos informations</div>
                    <div class="recap-block">
                        <div class="rb-title">Entreprise</div>
                        <div class="rb-row"><span>Raison sociale</span><span id="rEntNom">—</span></div>
                        <div class="rb-row"><span>Forme juridique</span><span id="rEntFJ">—</span></div>
                        <div class="rb-row"><span>Activité</span><span id="rEntAct">—</span></div>
                        <div class="rb-row"><span>Pays du siège</span><span id="rEntPays">—</span></div>
                        <div class="rb-row"><span>Taille</span><span id="rEntTaille">—</span></div>
                    </div>
                    <div class="recap-block" style="margin-top:.75rem">
                        <div class="rb-title">Administrateur du compte</div>
                        <div class="rb-row"><span>Nom & Prénom</span><span id="rAdminNom">—</span></div>
                        <div class="rb-row"><span>Fonction</span><span id="rAdminFonction">—</span></div>
                        <div class="rb-row"><span>E-mail</span><span id="rAdminEmail">—</span></div>
                        <div class="rb-row"><span>Téléphone</span><span id="rAdminTel">—</span></div>
                    </div>
                    <div class="recap-block" style="margin-top:.75rem">
                        <div class="rb-title">Participation au Forum</div>
                        <div class="rb-row"><span>Rencontres B2B</span><span id="rEntB2B">—</span></div>
                        <div class="rb-row"><span>Offres d'emploi</span><span id="rEntOffres">—</span></div>
                        <div class="rb-row"><span>Collaborateurs inscrits</span><span id="rEntCollabs">—</span></div>
                    </div>
                </div>

                {{-- Consentements --}}
                <div class="card">
                    <div class="card-title">Déclarations et consentements <span class="req">*</span></div>
                    @foreach([
                        ['cert_habilite','Je certifie être habilité(e) à administrer ce compte au nom de l\'entreprise représentée.'],
                        ['cert_exactitude','Je certifie que les informations fournies sont exactes et à jour.'],
                        ['accepte_traitement','J\'accepte que les données communiquées soient collectées et traitées dans le cadre de l\'organisation et du fonctionnement de la plateforme JEFIE 2026.'],
                        ['engage_usage','Je m\'engage à utiliser les informations et profils des candidats accessibles sur la plateforme exclusivement à des fins de recrutement et de mise en relation professionnelle.'],
                    ] as [$name, $label])
                        <label class="consent-check">
                            <input type="checkbox" name="{{ $name }}" value="1" required>
                            <label>☐ {{ $label }} <span class="req">*</span></label>
                        </label>
                    @endforeach
                </div>

                <div class="step-nav">
                    <button type="button" onclick="prevPanelE(5)" class="btn-prev"><svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>Précédent</button>
                    <button type="submit" class="btn-submit-final" id="btnSubmitE">
                        <svg viewBox="0 0 24 24"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        VALIDER MON COMPTE ENTREPRISE
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
// ══════════════════════════════════════════════════════════
// GESTION DES TYPES
// ══════════════════════════════════════════════════════════
let currentType  = null;
let currentPanelP = 1;
let currentPanelE = 1;
let collabCount  = 0;
let offreCount   = 0;

function selectType(type) {
    currentType = type;
    document.getElementById('choixParticipant').classList.toggle('selected', type === 'participant');
    document.getElementById('choixEntreprise').classList.toggle('selected', type === 'entreprise');
}

function goToForm() {
    if (!currentType) { alert('Veuillez sélectionner un type d\'inscription.'); return; }
    document.getElementById('step0').style.display = 'none';
    if (currentType === 'participant') {
        document.getElementById('formParticipant').style.display = 'block';
        showPanelP(1);
    } else {
        document.getElementById('formEntreprise').style.display = 'block';
        showPanelE(1);
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function backToChoice() {
    document.getElementById('formParticipant').style.display = 'none';
    document.getElementById('formEntreprise').style.display  = 'none';
    document.getElementById('step0').style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ── SOUS-PROFIL PARTICIPANT ──────────────────────────────
function selectSousProfil(v) {
    document.querySelectorAll('.profil-card').forEach(c => c.classList.remove('pc-selected'));
    const el = document.getElementById('pc-' + v);
    if (el) el.classList.add('pc-selected');
    document.getElementById('sousProfil').value = v;
}

// ══════════════════════════════════════════════════════════
// NAVIGATION PARTICIPANT
// ══════════════════════════════════════════════════════════
const PANELS_P = 4;

function showPanelP(n) {
    for (let i = 1; i <= PANELS_P; i++) {
        const el = document.getElementById('panelP' + i);
        if (el) el.style.display = i === n ? 'block' : 'none';
    }
    updateStepperP(n);
    updateProgressP(n);
    currentPanelP = n;
    window.scrollTo({ top: 80, behavior: 'smooth' });
}

function nextPanelP(from) {
    const profil = document.getElementById('sousProfil').value;
    if (from === 1) {
        if (!profil) { alert('Veuillez sélectionner votre profil.'); return; }
        if (profil === 'ecoute')       { showPanelP(2); return; }
        if (profil === 'entrepreneur') { showPanelP(3); return; }
        showPanelP(4); buildRecapP(); return;
    }
    if (from === 2 || from === 3) { showPanelP(4); buildRecapP(); return; }
}

function prevPanelP(from) {
    const profil = document.getElementById('sousProfil').value;
    if (from === 4) {
        if (profil === 'ecoute')       { showPanelP(2); return; }
        if (profil === 'entrepreneur') { showPanelP(3); return; }
        showPanelP(1); return;
    }
    if (from === 2 || from === 3) { showPanelP(1); return; }
}

function updateStepperP(n) {
    for (let i = 1; i <= PANELS_P; i++) {
        const el = document.getElementById('stepP' + i);
        if (!el) continue;
        el.classList.remove('active','done');
        if (i < n) el.classList.add('done');
        else if (i === n) el.classList.add('active');
    }
}

function updateProgressP(n) {
    const pct = Math.round((n / PANELS_P) * 100);
    const bar = document.getElementById('progP');
    if (bar) bar.style.width = pct + '%';
}

function buildRecapP() {
    const g  = n => document.querySelector(`[name="${n}"]`)?.value || '';
    const g2 = n => document.querySelector(`input[name="${n}"]:checked`)?.value || '';
    const profils = {'participant':'Participant','ecoute':'Écoute d\'opportunité','entrepreneur':'Entrepreneur / Porteur de projet'};
    set('rProfil',   profils[g2('profil_visiteur')] || '—');
    set('rIdentite', trim(`${g('prenom')} ${g('nom').toUpperCase()}`));
    set('rEmail',    g('email') || '—');
    set('rTel',      g('whatsapp') || '—');
    set('rPays',     g('pays_residence') || '—');
    set('rB2B',      g2('participe_b2b') === 'oui' ? '✅ Oui' : 'Non');
}

// ══════════════════════════════════════════════════════════
// NAVIGATION ENTREPRISE
// ══════════════════════════════════════════════════════════
const PANELS_E = 5;

function showPanelE(n) {
    for (let i = 1; i <= PANELS_E; i++) {
        const el = document.getElementById('panelE' + i);
        if (el) el.style.display = i === n ? 'block' : 'none';
    }
    updateStepperE(n);
    updateProgressE(n);
    currentPanelE = n;
    window.scrollTo({ top: 80, behavior: 'smooth' });
}

function nextPanelE(from) {
    if (from === PANELS_E - 1) { buildRecapE(); }
    showPanelE(from + 1);
}

function prevPanelE(from) {
    showPanelE(from - 1);
}

function updateStepperE(n) {
    for (let i = 1; i <= PANELS_E; i++) {
        const el = document.getElementById('stepE' + i);
        if (!el) continue;
        el.classList.remove('active','done');
        if (i < n) el.classList.add('done');
        else if (i === n) el.classList.add('active');
    }
}

function updateProgressE(n) {
    const pct = Math.round((n / PANELS_E) * 100);
    const bar = document.getElementById('progE');
    if (bar) bar.style.width = pct + '%';
}

function buildRecapE() {
    const g = n => document.querySelector(`[name="${n}"]`)?.value || '—';
    set('rEntNom',     g('entreprise_nom'));
    set('rEntFJ',      g('forme_juridique'));
    set('rEntAct',     g('activite_principale'));
    set('rEntPays',    g('pays_siege'));
    set('rEntTaille',  g('taille_entreprise'));
    set('rAdminNom',   trim(`${g('admin_prenom')} ${g('admin_nom')}`));
    set('rAdminFonction', g('admin_fonction'));
    set('rAdminEmail', g('admin_email'));
    set('rAdminTel',   g('admin_telephone'));
    const b2b  = document.querySelector('input[name="entreprise_b2b"]:checked')?.value;
    const pub  = document.querySelector('input[name="publie_offres"]:checked')?.value;
    set('rEntB2B',     b2b === 'oui' ? '✅ Oui' : 'Non');
    set('rEntOffres',  pub === 'oui' ? '✅ Oui (' + offreCount + ' offre(s))' : 'Non');
    set('rEntCollabs', collabCount > 0 ? collabCount + ' collaborateur(s)' : 'Aucun');
}

// ══════════════════════════════════════════════════════════
// COLLABORATEURS
// ══════════════════════════════════════════════════════════
function showCollabs(show) {
    document.getElementById('collabsZone').style.display = show ? 'block' : 'none';
}

function addCollab() {
    collabCount++;
    const i = collabCount;
    const html = `
    <div class="collab-block" id="collab${i}">
        <div class="collab-num">Collaborateur N°${i}</div>
        <button type="button" class="btn-del-collab" onclick="removeCollab(${i})"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg></button>
        <div class="form-grid">
            <div class="form-group"><label class="form-label">Nom *</label><input type="text" name="collabs[${i}][nom]" class="form-control" placeholder="Nom de famille" required></div>
            <div class="form-group"><label class="form-label">Prénom *</label><input type="text" name="collabs[${i}][prenom]" class="form-control" placeholder="Prénom" required></div>
            <div class="form-group"><label class="form-label">Fonction *</label><input type="text" name="collabs[${i}][fonction]" class="form-control" placeholder="Poste occupé" required></div>
            <div class="form-group"><label class="form-label">E-mail *</label><input type="email" name="collabs[${i}][email]" class="form-control" placeholder="email@entreprise.com" required></div>
            <div class="form-group"><label class="form-label">Téléphone</label><input type="tel" name="collabs[${i}][telephone]" class="form-control" placeholder="+33 6 00 00 00 00"></div>
        </div>
    </div>`;
    document.getElementById('collabsList').insertAdjacentHTML('beforeend', html);
}

function removeCollab(i) {
    document.getElementById('collab'+i)?.remove();
    collabCount = Math.max(0, collabCount - 1);
}

// ══════════════════════════════════════════════════════════
// OFFRES D'EMPLOI
// ══════════════════════════════════════════════════════════
function showOffres(show) {
    document.getElementById('offresZone').style.display = show ? 'block' : 'none';
    if (show && offreCount === 0) addOffre();
}

function addOffre() {
    offreCount++;
    const i = offreCount;
    const familles = ['Direction générale / Direction exécutive','Management / Responsable d\'équipe','Administration / Assistanat','Finance / Comptabilité / Audit','Ressources humaines','Commercial / Business Development','Marketing / Communication','Informatique / Digital','Ingénierie / Technique','BTP / Architecture','Énergie / Pétrole / Gaz','Logistique / Transport','Santé / Social','Juridique / Conformité','Agriculture / Environnement','Enseignement / Formation','Hôtellerie / Restauration','Stage','Alternance','Autre'];
    const contrats = ['CDI','CDD','Stage','Alternance','Freelance / Consultant','Autre'];
    const lieux    = ['Libreville','France','Autre'];
    const niveaux  = ['BAC+2','BAC+3','BAC+4','BAC+5','Doctorat','Non requis'];
    const exps     = ['Junior (-2 ans)','2 à 5 ans','5 à 10 ans','10 à 15 ans','Plus de 15 ans'];

    const mkOpts = arr => arr.map(v => `<option value="${v}">${v}</option>`).join('');

    const html = `
    <div class="offre-block" id="offre${i}">
        <div class="offre-num">Offre N°${i}</div>
        <button type="button" class="btn-del-offre" onclick="removeOffre(${i})"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg></button>
        <div class="form-grid">
            <div class="form-group fg1"><label class="form-label">Intitulé du poste *</label><input type="text" name="offres[${i}][titre]" class="form-control" placeholder="Ex : Développeur Full-Stack Senior" required></div>
            <div class="form-group"><label class="form-label">Famille de métier *</label><select name="offres[${i}][famille]" class="form-control" required><option value="">Sélectionnez...</option>${mkOpts(familles)}</select></div>
            <div class="form-group"><label class="form-label">Nombre de postes</label><input type="number" name="offres[${i}][nb_postes]" class="form-control" min="1" placeholder="1"></div>
            <div class="form-group"><label class="form-label">Type de contrat *</label><select name="offres[${i}][contrat]" class="form-control" required><option value="">Sélectionnez...</option>${mkOpts(contrats)}</select></div>
            <div class="form-group"><label class="form-label">Lieu du poste *</label><select name="offres[${i}][lieu]" class="form-control" required><option value="">Sélectionnez...</option>${mkOpts(lieux)}</select></div>
            <div class="form-group"><label class="form-label">Niveau d'études</label><select name="offres[${i}][niveau]" class="form-control"><option value="">Sélectionnez...</option>${mkOpts(niveaux)}</select></div>
            <div class="form-group"><label class="form-label">Expérience recherchée</label><select name="offres[${i}][experience]" class="form-control"><option value="">Sélectionnez...</option>${mkOpts(exps)}</select></div>
            <div class="form-group"><label class="form-label">Date limite de candidature</label><input type="date" name="offres[${i}][date_limite]" class="form-control"></div>
            <div class="form-group fg1"><label class="form-label">Description du poste *</label><textarea name="offres[${i}][description]" class="form-control" placeholder="Décrivez les missions, responsabilités et contexte..." required></textarea></div>
            <div class="form-group fg1"><label class="form-label">Compétences principales recherchées *</label><textarea name="offres[${i}][competences]" class="form-control" placeholder="Listez les compétences requises..." required></textarea></div>
            <div class="form-group fg1"><label class="form-label">Fiche de poste</label>
                <label class="upload-zone" style="padding:.75rem">
                    <input type="file" name="offres[${i}][fiche]" accept=".pdf,.doc,.docx" onchange="showFileName(this,'fiche${i}')">
                    <svg viewBox="0 0 24 24" style="width:18px;height:18px"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/></svg>
                    <p style="font-size:11px">Déposer la fiche de poste PDF</p>
                    <div id="fiche${i}" class="upload-name"></div>
                </label>
            </div>
        </div>
    </div>`;
    document.getElementById('offresList').insertAdjacentHTML('beforeend', html);
}

function removeOffre(i) {
    document.getElementById('offre'+i)?.remove();
    offreCount = Math.max(0, offreCount - 1);
}

// ══════════════════════════════════════════════════════════
// UTILITAIRES
// ══════════════════════════════════════════════════════════
function set(id, val) {
    const el = document.getElementById(id);
    if (el) el.textContent = val || '—';
}

function trim(str) {
    return str?.trim().replace(/\s+/g,' ') || '—';
}

function showFileName(input, targetId) {
    const el = document.getElementById(targetId);
    if (!el) return;
    if (input.files && input.files[0]) {
        el.textContent = '✅ ' + input.files[0].name;
        el.style.display = 'block';
    }
}

// check-item toggle style
document.addEventListener('change', e => {
    const item = e.target.closest('.check-item');
    if (!item) return;
    if (e.target.type === 'checkbox') {
        item.classList.toggle('selected', e.target.checked);
    }
});

// Empêcher double-submit
document.querySelectorAll('form').forEach(f => {
    f.addEventListener('submit', () => {
        ['btnSubmitP','btnSubmitE'].forEach(id => {
            const btn = document.getElementById(id);
            if (btn) { btn.disabled = true; btn.style.opacity = '.7'; }
        });
    });
});
</script>
</body>
</html>