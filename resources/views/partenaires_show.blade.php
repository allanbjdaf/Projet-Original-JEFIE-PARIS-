{{-- resources/views/partenaires/show.blade.php --}}
{{-- Page entreprise individuelle : /partenaires/{slug} --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nos Partenaires — JEFIE Paris 2026</title>
    <meta name="description" content="Découvrez la liste des partenaires officiels du Forum JEFIE Paris 2026.">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #1a2744;
            background: #f0f2f7
        }

        /* NAV */
        .nav {
            background: #0d1b3e;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 300
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none
        }

        .nav-logo-icon {
            width: 40px;
            height: 40px;
            border: 2px solid #f3cc21ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .nav-logo-icon svg {
            width: 18px;
            height: 18px;
            stroke: #f3cc21ff;
            fill: none;
            stroke-width: 1.8
        }

        .nav-logo-text {
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.3
        }

        .nav-logo-text span {
            color: #f3cc21ff;
            display: block;
            font-size: 11px;
            font-weight: 800
        }

        .nav-links {
            display: flex;
            gap: 1.5rem
        }

        .nav-links a {
            color: rgba(255, 255, 255, .75);
            font-size: 13px;
            text-decoration: none;
            transition: color .2s
        }

        .nav-links a:hover {
            color: #f3cc21ff
        }

        .nav-right {
            display: flex;
            gap: 8px;
            align-items: center
        }

        .btn-back {
            color: rgba(255, 255, 255, .7);
            font-size: 12px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .2);
            padding: 7px 14px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all .2s
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff
        }

        .btn-back svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .btn-inscr {
            background: #f3cc21ff;
            color: #0d1b3e;
            font-weight: 700;
            font-size: 13px;
            padding: 9px 18px;
            border-radius: 5px;
            text-decoration: none
        }

        /* HERO ENTREPRISE */
        .hero-ent {
            background: linear-gradient(108deg, #060e20, #0d1b3e 55%, #0a2356);
            padding: 2.5rem 2.5rem 0;
            position: relative;
            overflow: hidden
        }

        .hero-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: flex-end;
            gap: 2rem;
            flex-wrap: wrap;
            padding-bottom: 2.5rem
        }

        .he-logo {
            width: 90px;
            height: 90px;
            background: #fff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, .1);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .2)
        }

        .he-logo img {
            width: 90px;
            height: 90px;
            object-fit: contain
        }

        .he-logo-placeholder {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #0d1b3e, #162552);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f3cc21ff;
            font-size: 2rem;
            font-weight: 900;
            flex-shrink: 0
        }

        .he-info {
            flex: 1;
            min-width: 0
        }

        .he-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: .65rem
        }

        .he-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: .05em
        }

        .he-name {
            color: #fff;
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: .35rem;
            line-height: 1.15
        }

        .he-secteur {
            color: rgba(255, 255, 255, .6);
            font-size: 13px;
            margin-bottom: .65rem;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .he-sep {
            width: 1px;
            height: 14px;
            background: rgba(255, 255, 255, .2)
        }

        .he-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: .75rem
        }

        .btn-he {
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all .2s;
            cursor: pointer;
            border: none;
            font-family: inherit
        }

        .btn-he svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .bh-gold {
            background: #f3cc21ff;
            color: #0d1b3e
        }

        .bh-gold:hover {
            opacity: .9
        }

        .bh-ghost {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .2)
        }

        .bh-ghost:hover {
            background: rgba(255, 255, 255, .18)
        }

        .he-stats {
            display: flex;
            gap: 1.25rem;
            margin-left: auto;
            flex-shrink: 0
        }

        .he-stat {
            text-align: center;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 10px;
            padding: .65rem 1rem
        }

        .he-stat-num {
            color: #f3cc21ff;
            font-size: 1.1rem;
            font-weight: 900;
            display: block;
            line-height: 1
        }

        .he-stat-lbl {
            color: rgba(255, 255, 255, .5);
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: 3px
        }

        /* TABS NAVIGATION */
        .ent-tabs {
            background: #fff;
            border-bottom: 2px solid #f0f4f8;
            overflow-x: auto
        }

        .ent-tabs-inner {
            display: flex;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 2.5rem
        }

        .etab {
            padding: .85rem 1.25rem;
            font-size: 13px;
            font-weight: 600;
            color: #718096;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            white-space: nowrap;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .etab svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8
        }

        .etab:hover {
            color: #0d1b3e;
            background: #fafbfc
        }

        .etab.active {
            color: #0d1b3e;
            border-bottom-color: #f3cc21ff;
            font-weight: 700
        }

        /* LAYOUT */
        .page-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 2.5rem;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 2rem;
            align-items: start
        }

        /* MAIN */
        /* Alert succès QR */
        .alert-qr-ok {
            background: #e8f5e9;
            border: 1px solid #a5d6a7;
            color: #2e7d32;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem
        }

        .alert-qr-ok svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            flex-shrink: 0
        }

        /* VERROU OFFRES */
        .lock-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 1.5rem
        }

        .lock-icon {
            width: 80px;
            height: 80px;
            background: #f0f2f7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem
        }

        .lock-icon svg {
            width: 36px;
            height: 36px;
            stroke: #a0aec0;
            fill: none;
            stroke-width: 1.4
        }

        .lock-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0d1b3e;
            margin-bottom: .5rem
        }

        .lock-desc {
            font-size: 13px;
            color: #718096;
            line-height: 1.65;
            max-width: 380px;
            margin: 0 auto 1.75rem
        }

        .qr-display {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.75rem
        }

        .qr-img {
            width: 160px;
            height: 160px;
            border: 3px solid #0d1b3e;
            border-radius: 12px;
            padding: 8px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .qr-img img {
            width: 100%;
            height: 100%;
            border-radius: 6px
        }

        .qr-hint {
            font-size: 11px;
            color: #a0aec0;
            text-align: center;
            line-height: 1.5;
            max-width: 220px
        }

        .lock-steps {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1.25rem
        }

        .ls-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            width: 90px
        }

        .ls-num {
            width: 30px;
            height: 30px;
            background: #0d1b3e;
            color: #f3cc21ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800
        }

        .ls-text {
            font-size: 10px;
            color: #718096;
            text-align: center;
            line-height: 1.4
        }

        .ls-arrow {
            color: #d1d9e6;
            font-size: 1.5rem;
            align-self: center;
            margin-top: -14px
        }

        .lock-link {
            font-size: 12px;
            color: #718096
        }

        .lock-link a {
            color: #0d1b3e;
            font-weight: 700;
            text-decoration: none
        }

        .lock-link a:hover {
            color: #f3cc21ff
        }

        /* OFFRES */
        .offres-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem
        }

        .oh-title {
            font-size: 12px;
            font-weight: 800;
            color: #0d1b3e;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-left: 3px solid #f3cc21ff;
            padding-left: 8px;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .oh-unlock {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 8px
        }

        .oh-unlock svg {
            width: 11px;
            height: 11px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5
        }

        .offres-list {
            display: flex;
            flex-direction: column;
            gap: .85rem;
            margin-bottom: 1.5rem
        }

        .offre-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            transition: all .2s;
            text-decoration: none
        }

        .offre-card:hover {
            border-color: #0d1b3e;
            box-shadow: 0 4px 16px rgba(13, 27, 62, .08);
            transform: translateY(-1px)
        }

        .offre-logo {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: #f4f6fa;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden
        }

        .offre-logo img {
            width: 46px;
            height: 46px;
            object-fit: contain
        }

        .offre-logo-pl {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d1b3e, #162552);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f3cc21ff;
            font-size: 16px;
            font-weight: 700;
            flex-shrink: 0
        }

        .offre-body {
            flex: 1;
            min-width: 0
        }

        .offre-titre {
            font-size: 14px;
            font-weight: 700;
            color: #0d1b3e;
            margin-bottom: 4px;
            line-height: 1.3
        }

        .offre-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            font-size: 11px;
            color: #718096;
            margin-bottom: 8px
        }

        .offre-meta-sep {
            width: 3px;
            height: 3px;
            background: #d1d9e6;
            border-radius: 50%
        }

        .offre-desc {
            font-size: 12px;
            color: #718096;
            line-height: 1.55;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .offre-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 8px
        }

        .offre-tag {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 8px;
            text-transform: uppercase
        }

        .offre-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
            flex-shrink: 0
        }

        .offre-statut {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 8px
        }

        .s-active {
            background: #e8f5e9;
            color: #2e7d32
        }

        .s-expire {
            background: #fce4ec;
            color: #c2185b
        }

        .offre-action {
            background: #0d1b3e;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 7px 14px;
            border-radius: 6px;
            white-space: nowrap
        }

        .empty-offres {
            background: #fff;
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 2.5rem;
            text-align: center
        }

        .empty-offres svg {
            width: 40px;
            height: 40px;
            stroke: #d1d9e6;
            fill: none;
            stroke-width: 1.2;
            display: block;
            margin: 0 auto .75rem
        }

        .empty-offres p {
            font-size: 13px;
            color: #a0aec0
        }

        /* PRÉSENTATION */
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.25rem
        }

        .card-title {
            font-size: 11px;
            font-weight: 800;
            color: #0d1b3e;
            text-transform: uppercase;
            letter-spacing: .08em;
            border-left: 3px solid #f3cc21ff;
            padding-left: 8px;
            margin-bottom: 1rem
        }

        .desc-text {
            font-size: 13px;
            color: #4a5568;
            line-height: 1.75
        }

        .infos-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 8px
        }

        .info-icon {
            width: 30px;
            height: 30px;
            background: #f4f6fa;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .info-icon svg {
            width: 14px;
            height: 14px;
            stroke: #718096;
            fill: none;
            stroke-width: 1.8
        }

        .info-label {
            font-size: 10px;
            color: #a0aec0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 2px
        }

        .info-val {
            font-size: 12px;
            color: #162552;
            font-weight: 600
        }

        .info-val a {
            color: #0d1b3e;
            text-decoration: none
        }

        .info-val a:hover {
            color: #f3cc21ff
        }

        /* SIDEBAR */
        /* QR miniature sidebar */
        .qr-sidebar-card {
            background: #0d1b3e;
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            margin-bottom: 1.25rem
        }

        .qsc-title {
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: .5rem
        }

        .qsc-desc {
            color: rgba(255, 255, 255, .6);
            font-size: 11px;
            line-height: 1.5;
            margin-bottom: 1rem
        }

        .qsc-qr {
            width: 110px;
            height: 110px;
            background: #fff;
            border-radius: 10px;
            margin: 0 auto .75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px
        }

        .qsc-qr img {
            width: 100%;
            height: 100%;
            border-radius: 5px
        }

        .qsc-hint {
            color: rgba(255, 255, 255, .45);
            font-size: 10px;
            line-height: 1.5
        }

        .qsc-unlock-btn {
            display: block;
            background: #f3cc21ff;
            color: #0d1b3e;
            font-weight: 700;
            font-size: 12px;
            padding: 10px;
            border-radius: 7px;
            text-decoration: none;
            margin-top: .85rem;
            transition: opacity .2s
        }

        .qsc-unlock-btn:hover {
            opacity: .9
        }

        /* Contact card */
        .contact-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.25rem
        }

        /* Autres partenaires */
        .autres-list {
            display: flex;
            flex-direction: column;
            gap: .6rem
        }

        .autre-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: .6rem .75rem;
            background: #f8fafc;
            border-radius: 8px;
            text-decoration: none;
            transition: background .15s
        }

        .autre-item:hover {
            background: #fff;
            border: 1px solid #e2e8f0
        }

        .autre-logo {
            width: 32px;
            height: 32px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden
        }

        .autre-logo img {
            width: 32px;
            height: 32px;
            object-fit: contain
        }

        .autre-name {
            font-size: 12px;
            font-weight: 700;
            color: #162552;
            flex: 1
        }

        .autre-secteur {
            font-size: 10px;
            color: #a0aec0
        }

        @media(max-width:1000px) {
            .page-content {
                grid-template-columns: 1fr
            }

            .he-stats {
                display: none
            }
        }

        @media(max-width:768px) {
            .nav-links {
                display: none
            }

            .hero-inner {
                flex-direction: column;
                align-items: flex-start
            }

            .page-content {
                padding: 1rem
            }

            .infos-grid {
                grid-template-columns: 1fr
            }
        }
    </style>
</head>

<body>

    {{-- NAV --}}
    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon"><svg viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg></div>
            <div class="nav-logo-text"><span>JEFIE</span>Paris 2026</div>
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('emploi') }}">Emploi</a>
            <a href="{{ route('programme') }}">Programme</a>
        </div>
        <div class="nav-right">
            <a href="{{ route('partenaires') }}" class="btn-back"><svg viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>Partenaires</a>
            <a href="{{ route('inscription') }}" class="btn-inscr">S'inscrire</a>
        </div>
    </nav>

    {{-- HERO ENTREPRISE --}}
    <div class="hero-ent">
        <div class="hero-inner">
            @if($partenaire->logo)
            <div class="he-logo"><img src="{{ asset('storage/'.$partenaire->logo) }}" alt="{{ $partenaire->nom }}"></div>
            @else
            <div class="he-logo-placeholder">{{ strtoupper(substr($partenaire->nom,0,1)) }}</div>
            @endif

            <div class="he-info">
                <div class="he-badges">
                    @php $badge = $partenaire->badge_type; @endphp
                    <span class="he-badge" style="background:{{ $badge[2] }};color:{{ $badge[1] }}">★ {{ $badge[0] }}</span>
                    @if($partenaire->stand)
                    <span class="he-badge" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.7)">Stand {{ $partenaire->stand }}</span>
                    @endif
                    @if($qrValide)
                    <span class="he-badge" style="background:#e8f5e9;color:#2e7d32">🔓 Accès QR actif</span>
                    @endif
                </div>
                <div class="he-name">{{ $partenaire->nom }}</div>
                <div class="he-secteur">
                    @if($partenaire->secteur)<span>{{ $partenaire->secteur }}</span>@endif
                    @if($partenaire->secteur && $partenaire->ville)<div class="he-sep"></div>@endif
                    @if($partenaire->ville)<span>📍 {{ $partenaire->ville }}@if($partenaire->pays), {{ $partenaire->pays }}@endif</span>@endif
                    @if($partenaire->nombre_employes)<div class="he-sep"></div><span>👥 {{ $partenaire->nombre_employes }} employés</span>@endif
                </div>
                @if($partenaire->description_courte)
                <p style="color:rgba(255,255,255,.6);font-size:13px;line-height:1.6;max-width:520px">{{ $partenaire->description_courte }}</p>
                @endif
                <div class="he-actions">
                    @if($partenaire->site_web)
                    <a href="{{ $partenaire->site_web }}" target="_blank" class="btn-he bh-ghost">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M2 12h20M12 2a15.3 15.3 0 010 20" />
                        </svg>
                        Site web
                    </a>
                    @endif
                    @if($partenaire->email_contact)
                    <a href="mailto:{{ $partenaire->email_contact }}" class="btn-he bh-ghost">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        Contacter
                    </a>
                    @endif
                    <a href="{{ route('inscription') }}" class="btn-he bh-gold">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        RDV B2B
                    </a>
                </div>
            </div>

            <div class="he-stats">
                <div class="he-stat"><span class="he-stat-num">{{ $partenaire->offres_actives_count ?? $partenaire->offresActives()->count() }}</span>
                    <div class="he-stat-lbl">Offres actives</div>
                </div>
                <div class="he-stat"><span class="he-stat-num">{{ $partenaire->stand ?? '—' }}</span>
                    <div class="he-stat-lbl">Stand Forum</div>
                </div>
            </div>
        </div>

        {{-- TABS --}}
        <div class="ent-tabs">
            <div class="ent-tabs-inner">
                <a href="#presentation" class="etab active"><svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>Présentation</a>
                <a href="#offres" class="etab"><svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    </svg>
                    Offres
                    <span style="background:{{ $qrValide ? '#e8f5e9' : '#f0f4f8' }};color:{{ $qrValide ? '#2e7d32' : '#718096' }};font-size:10px;padding:1px 7px;border-radius:8px;font-weight:700">
                        {{ $qrValide ? $offres->count().' 🔓' : '🔒' }}
                    </span>
                </a>
                <a href="#contact" class="etab"><svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    </svg>Contact</a>
            </div>
        </div>
    </div>

    {{-- CONTENU --}}
    <div class="page-content">

        {{-- MAIN --}}
        <div>
            {{-- Alert QR succès --}}
            @if(session('qr_success'))
            <div class="alert-qr-ok">
                <svg viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                <div><strong>Accès déverrouillé !</strong><br>{{ session('qr_success') }}</div>
            </div>
            @endif

            {{-- PRÉSENTATION --}}
            <div id="presentation">
                @if($partenaire->description)
                <div class="card">
                    <div class="card-title">À propos de {{ $partenaire->nom }}</div>
                    <div class="desc-text">{{ $partenaire->description }}</div>
                </div>
                @endif
                <div class="card">
                    <div class="card-title">Informations</div>
                    <div class="infos-grid">
                        @if($partenaire->secteur)
                        <div class="info-item">
                            <div class="info-icon"><svg viewBox="0 0 24 24">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg></div>
                            <div>
                                <div class="info-label">Secteur</div>
                                <div class="info-val">{{ $partenaire->secteur }}</div>
                            </div>
                        </div>
                        @endif
                        @if($partenaire->site_web)
                        <div class="info-item">
                            <div class="info-icon"><svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M2 12h20" />
                                </svg></div>
                            <div>
                                <div class="info-label">Site web</div>
                                <div class="info-val"><a href="{{ $partenaire->site_web }}" target="_blank">{{ $partenaire->site_web }}</a></div>
                            </div>
                        </div>
                        @endif
                        @if($partenaire->ville)
                        <div class="info-item">
                            <div class="info-icon"><svg viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg></div>
                            <div>
                                <div class="info-label">Localisation</div>
                                <div class="info-val">{{ $partenaire->ville }}{{ $partenaire->pays ? ', '.$partenaire->pays : '' }}</div>
                            </div>
                        </div>
                        @endif
                        @if($partenaire->nombre_employes)
                        <div class="info-item">
                            <div class="info-icon"><svg viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                </svg></div>
                            <div>
                                <div class="info-label">Effectif</div>
                                <div class="info-val">{{ $partenaire->nombre_employes }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- OFFRES --}}
            <div id="offres">
                @if($qrValide)
                {{-- ✅ QR VALIDÉ — Offres visibles --}}
                <div class="offres-header">
                    <div class="oh-title">
                        Offres publiées par {{ $partenaire->nom }}
                        <div class="oh-unlock"><svg viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4" />
                                <path d="M17 4h3a1 1 0 011 1v3M3 20V9a1 1 0 011-1h13a1 1 0 011 1v10a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>Accès QR actif</div>
                    </div>
                    <span style="font-size:12px;color:#a0aec0">{{ $offres->count() }} offre(s)</span>
                </div>

                @if($offres->count() > 0)
                <div class="offres-list">
                    @foreach($offres as $offre)
                    <a href="{{ route('emploi.show', $offre->slug ?? $offre->id) }}" class="offre-card">
                        @if($partenaire->logo)
                        <div class="offre-logo"><img src="{{ asset('storage/'.$partenaire->logo) }}" alt=""></div>
                        @else
                        <div class="offre-logo-pl">{{ strtoupper(substr($partenaire->nom,0,1)) }}</div>
                        @endif
                        <div class="offre-body">
                            <div class="offre-titre">{{ $offre->titre }}</div>
                            <div class="offre-meta">
                                <span>{{ $partenaire->nom }}</span>
                                @if($offre->localisation)<span class="offre-meta-sep"></span><span>📍 {{ $offre->localisation }}</span>@endif
                                @if($offre->type_contrat)<span class="offre-meta-sep"></span><span>{{ $offre->type_contrat }}</span>@endif
                                @if($offre->date_limite)<span class="offre-meta-sep"></span><span>🕐 {{ \Carbon\Carbon::parse($offre->date_limite)->diffForHumans() }}</span>@endif
                            </div>
                            @if($offre->description)
                            <div class="offre-desc">{{ strip_tags($offre->description) }}</div>
                            @endif
                            <div class="offre-tags">
                                @if($offre->type_contrat)<span class="offre-tag" style="background:#e3f2fd;color:#1565c0">{{ $offre->type_contrat }}</span>@endif
                                @if($offre->secteur)<span class="offre-tag" style="background:#e8f5e9;color:#2e7d32">{{ $offre->secteur }}</span>@endif
                                @if($offre->experience)<span class="offre-tag" style="background:#f0f4f8;color:#718096">{{ $offre->experience }}</span>@endif
                            </div>
                        </div>
                        <div class="offre-right">
                            <span class="offre-statut s-active">Active</span>
                            <span class="offre-action">Postuler →</span>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="empty-offres">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    </svg>
                    <p>Aucune offre disponible pour le moment.<br><span style="color:#c6c9d0;font-size:11px">Revenez prochainement ou activez les alertes emploi.</span></p>
                    <a href="{{ route('emploi') }}" style="display:inline-flex;align-items:center;gap:6px;background:#0d1b3e;color:#fff;font-weight:700;font-size:12px;padding:10px 20px;border-radius:7px;text-decoration:none;margin-top:1rem">Voir toutes les offres</a>
                </div>
                @endif

                @else
                {{-- 🔒 QR NON VALIDÉ — Offres masquées --}}
                <div class="lock-section">
                    <div class="lock-icon"><svg viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0110 0v4" />
                        </svg></div>
                    <div class="lock-title">Offres d'emploi — Accès réservé</div>
                    <p class="lock-desc">Les offres publiées par <strong>{{ $partenaire->nom }}</strong> sont accessibles exclusivement via le QR Code présent sur le stand de l'entreprise au Forum JEFIE Paris 2026.</p>

                    {{-- QR Code à afficher sur le stand --}}
                    <div class="qr-display">
                        <div class="qr-img">
                            <img src="{{ $partenaire->qr_image_url }}" alt="QR Code {{ $partenaire->nom }}" loading="lazy">
                        </div>
                        <div class="qr-hint">📱 Scannez ce QR Code avec votre téléphone depuis le stand {{ $partenaire->stand ? 'N°'.$partenaire->stand : '' }} au Forum</div>
                    </div>

                    <div class="lock-steps">
                        <div class="ls-step">
                            <div class="ls-num">1</div>
                            <div class="ls-text">Visitez le stand au Forum</div>
                        </div>
                        <div class="ls-arrow">→</div>
                        <div class="ls-step">
                            <div class="ls-num">2</div>
                            <div class="ls-text">Scannez le QR Code</div>
                        </div>
                        <div class="ls-arrow">→</div>
                        <div class="ls-step">
                            <div class="ls-num">3</div>
                            <div class="ls-text">Accédez aux offres</div>
                        </div>
                    </div>

                    <p class="lock-link">Vous avez déjà scanné le QR Code ? <a href="{{ $partenaire->qr_url }}">Cliquez ici pour déverrouiller</a></p>
                </div>
                @endif
            </div>

            {{-- CONTACT --}}
            <div id="contact" class="card">
                <div class="card-title">Contacter {{ $partenaire->nom }}</div>
                <div class="infos-grid">
                    @if($partenaire->email_contact)
                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg></div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-val"><a href="mailto:{{ $partenaire->email_contact }}">{{ $partenaire->email_contact }}</a></div>
                        </div>
                    </div>
                    @endif
                    @if($partenaire->telephone)
                    <div class="info-item">
                        <div class="info-icon"><svg viewBox="0 0 24 24">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006.79 6.79l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                            </svg></div>
                        <div>
                            <div class="info-label">Téléphone</div>
                            <div class="info-val">{{ $partenaire->telephone }}</div>
                        </div>
                    </div>
                    @endif
                    @if($partenaire->adresse)
                    <div class="info-item" style="grid-column:1/-1">
                        <div class="info-icon"><svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg></div>
                        <div>
                            <div class="info-label">Adresse</div>
                            <div class="info-val">{{ $partenaire->adresse }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <aside>
            {{-- QR Card sidebar --}}
            @if(!$qrValide)
            <div class="qr-sidebar-card">
                <div class="qsc-title">🔒 Offres verrouillées</div>
                <div class="qsc-desc">Scannez le QR Code sur le stand de l'entreprise au Forum pour accéder aux offres.</div>
                <div class="qsc-qr">
                    <img src="{{ $partenaire->qr_image_url }}" alt="QR Code" style="width:100%;height:100%;border-radius:5px">
                </div>
                <div class="qsc-hint">📍 Stand {{ $partenaire->stand ?? 'Forum JEFIE 2026' }}<br>15-18 Septembre · Paris</div>
                <a href="{{ $partenaire->qr_url }}" class="qsc-unlock-btn">Déjà scanné ? Déverrouiller →</a>
            </div>
            @else
            <div style="background:#e8f5e9;border:1px solid #a5d6a7;border-radius:12px;padding:1rem;margin-bottom:1.25rem;text-align:center">
                <div style="font-size:1.5rem;margin-bottom:.4rem">🔓</div>
                <div style="font-size:12px;font-weight:700;color:#2e7d32;margin-bottom:3px">Accès QR actif</div>
                <div style="font-size:11px;color:#388e3c">Toutes les offres sont visibles</div>
            </div>
            @endif

            {{-- Infos rapides --}}
            <div class="contact-card">
                <div class="card-title">Infos rapides</div>
                <div style="display:flex;flex-direction:column;gap:.6rem;margin-top:.75rem">
                    @if($partenaire->site_web)
                    <a href="{{ $partenaire->site_web }}" target="_blank" style="display:flex;align-items:center;gap:8px;font-size:12px;color:#162552;text-decoration:none;font-weight:600;padding:.5rem .6rem;background:#f8fafc;border-radius:7px;transition:background .15s" onmouseover="this.style.background='#f0f4f8'" onmouseout="this.style.background='#f8fafc'">
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="#718096" fill="none" stroke-width="1.8">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M2 12h20" />
                        </svg>
                        {{ parse_url($partenaire->site_web)['host'] ?? $partenaire->site_web }}
                    </a>
                    @endif
                    @if($partenaire->email_contact)
                    <a href="mailto:{{ $partenaire->email_contact }}" style="display:flex;align-items:center;gap:8px;font-size:12px;color:#162552;text-decoration:none;font-weight:600;padding:.5rem .6rem;background:#f8fafc;border-radius:7px">
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="#718096" fill="none" stroke-width="1.8">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        {{ $partenaire->email_contact }}
                    </a>
                    @endif
                    @if($partenaire->stand)
                    <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:#162552;font-weight:600;padding:.5rem .6rem;background:#fff8e6;border-radius:7px;border:1px solid #ffe082">
                        <svg viewBox="0 0 24 24" width="14" height="14" stroke="#f5a623" fill="none" stroke-width="1.8">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        Stand N° {{ $partenaire->stand }} — Forum JEFIE 2026
                    </div>
                    @endif
                </div>
            </div>

            {{-- Autres partenaires --}}
            @if(isset($autresPartenaires) && $autresPartenaires->count() > 0)
            <div class="card">
                <div class="card-title">Autres partenaires</div>
                <div class="autres-list" style="margin-top:.75rem">
                    @foreach($autresPartenaires->take(5) as $autre)
                    <a href="{{ route('partenaires.show', $autre->slug) }}" class="autre-item">
                        @if($autre->logo)
                        <div class="autre-logo"><img src="{{ asset('storage/'.$autre->logo) }}" alt=""></div>
                        @else
                        <div class="autre-logo" style="background:#0d1b3e;color:#f5a623;font-size:12px;font-weight:700">{{ strtoupper(substr($autre->nom,0,1)) }}</div>
                        @endif
                        <div>
                            <div class="autre-name">{{ $autre->nom }}</div>
                            <div class="autre-secteur">{{ $autre->secteur }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </aside>
    </div>

    {{-- FOOTER --}}
    <footer style="background:#0a1428;color:rgba(255,255,255,.6);padding:1.5rem 2.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-top:2rem">
        <span style="font-size:11px;color:rgba(255,255,255,.3)">&copy; {{ date('Y') }} JEFIE Paris 2026</span>
        <div style="display:flex;gap:1rem">
            <a href="{{ route('partenaires.index') }}" style="font-size:11px;color:rgba(255,255,255,.4);text-decoration:none">← Tous les partenaires</a>
            <a href="{{ route('inscription') }}" style="font-size:11px;color:#f5a623;text-decoration:none;font-weight:700">S'inscrire au Forum</a>
        </div>
    </footer>

    <script>
        // Smooth scroll tabs
        document.querySelectorAll('.etab').forEach(tab => {
            tab.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(tab.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    document.querySelectorAll('.etab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                }
            });
        });
        // Activer le bon onglet au scroll
        window.addEventListener('scroll', () => {
            const sections = ['presentation', 'offres', 'contact'];
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                const rect = el.getBoundingClientRect();
                if (rect.top <= 150 && rect.bottom > 150) {
                    document.querySelectorAll('.etab').forEach(t => t.classList.remove('active'));
                    const active = document.querySelector(`.etab[href="#${id}"]`);
                    if (active) active.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>