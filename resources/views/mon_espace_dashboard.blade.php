    {{-- resources/views/mon-espace/dashboard.blade.php --}}
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Mon Espace — JEFIE Paris 2026</title>
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Segoe UI', Arial, sans-serif;
                color: #1a2744;
                background: #f0f2f7;
            }


            /* Progress profil */
            .profil-progress {}

            .pp-row {
                display: flex;
                justify-content: space-between;
                font-size: 11px;
                margin-bottom: 4px;
            }

            .pp-row span {
                color: #718096;
            }

            .pp-row strong {
                color: #0f284e;
            }

            .pp-bar {
                height: 6px;
                background: #f0f4f8;
                border-radius: 3px;
                overflow: hidden;
            }

            .pp-fill {
                height: 100%;
                background: linear-gradient(90deg, #f5c518, #e09010);
                border-radius: 3px;
                transition: width .6s;
            }

            .pp-tip {
                font-size: 10px;
                color: #f5c518;
                margin-top: 4px;
            }

            /* Onglets principaux */
            .main-tabs {
                display: flex;
                border-bottom: 2px solid #f0f4f8;
                margin: 0;
            }

            .main-tab {
                flex: 1;
                padding: .6rem;
                text-align: center;
                font-size: 11px;
                font-weight: 700;
                color: #a0aec0;
                cursor: pointer;
                border-bottom: 2px solid transparent;
                margin-bottom: -2px;
                transition: all .2s;
                background: none;
                border-top: none;
                border-left: none;
                border-right: none;
                font-family: inherit;
            }

            .main-tab.active {
                color: #0f284e;
                border-bottom-color: #f5c518;
                background: #fff8e6;
            }

            .main-tab:hover {
                color: #0f284e;
                background: #fafbfc;
            }

            /* Sous-menus */
            .subnav-section {
                padding: .5rem 0;
            }

            .subnav-title {
                padding: .35rem 1.25rem;
                font-size: 9px;
                font-weight: 800;
                color: #a0aec0;
                text-transform: uppercase;
                letter-spacing: .12em;
            }

            .subnav-item {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 9px 1.25rem;
                font-size: 13px;
                color: #4a5568;
                text-decoration: none;
                border-left: 3px solid transparent;
                transition: all .15s;
                cursor: pointer;
            }

            .subnav-item:hover {
                background: #f4f6fa;
                color: #0f284e;
            }

            .subnav-item.active {
                background: #fff8e6;
                color: #0f284e;
                border-left-color: #f5c518;
                font-weight: 700;
            }

            .subnav-item svg {
                width: 15px;
                height: 15px;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.8;
                flex-shrink: 0;
            }

            .subnav-badge {
                margin-left: auto;
                font-size: 10px;
                font-weight: 700;
                padding: 1px 7px;
                border-radius: 10px;
            }

            .subnav-badge.red {
                background: #fce4ec;
                color: #c2185b;
            }

            .subnav-badge.green {
                background: #e8f5e9;
                color: #2e7d32;
            }

            .subnav-badge.blue {
                background: #e3f2fd;
                color: #0f284e;
            }

            /* Lien rapide vers espace dédié */
            .go-espace {
                margin: 1rem 1.25rem;
                background: linear-gradient(108deg, #0f284e, #0a1e38);
                border-radius: 10px;
                padding: 1rem;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 10px;
                transition: opacity .2s;
            }

            .go-espace:hover {
                opacity: .9;
            }

            .go-espace-icon {
                width: 36px;
                height: 36px;
                background: rgba(245, 166, 35, .15);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .go-espace-icon svg {
                width: 18px;
                height: 18px;
                stroke: #f5c518;
                fill: none;
                stroke-width: 1.7;
            }

            .go-espace-title {
                color: #fff;
                font-size: 12px;
                font-weight: 700;
            }

            .go-espace-sub {
                color: rgba(255, 255, 255, .5);
                font-size: 10px;
                margin-top: 2px;
            }

            /* Logout */
            .sidebar-bottom {
                margin-top: auto;
                padding: .75rem 0;
                border-top: 1px solid #f0f4f8;
            }

            .logout-btn {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 9px 1.25rem;
                font-size: 12px;
                color: #718096;
                background: none;
                border: none;
                cursor: pointer;
                font-family: inherit;
                width: 100%;
                transition: color .2s;
            }

            .logout-btn:hover {
                color: #e53935;
            }

            .logout-btn svg {
                width: 15px;
                height: 15px;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.8;
            }

            /* ══ MAIN ══ */
            .main-content {
                padding: 1.75rem 2rem;
            }

            /* Notifications */
            .notif-list {
                display: flex;
                flex-direction: column;
                gap: 8px;
                margin-bottom: 1.25rem;
            }

            .notif {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-radius: 8px;
                font-size: 13px;
            }

            .notif.info {
                background: #e3f2fd;
                color: #0f284e;
                border: 1px solid #bbdefb;
            }

            .notif.warning {
                background: #fff8e6;
                color: #b07d10;
                border: 1px solid #ffe082;
            }

            .notif.success {
                background: #e8f5e9;
                color: #2e7d32;
                border: 1px solid #a5d6a7;
            }

            .notif svg {
                width: 15px;
                height: 15px;
                stroke: currentColor;
                fill: none;
                stroke-width: 2;
                flex-shrink: 0;
            }

            .notif a {
                color: inherit;
                font-weight: 700;
                text-decoration: none;
                margin-left: auto;
                border: 1px solid currentColor;
                padding: 3px 10px;
                border-radius: 5px;
                font-size: 11px;
                transition: all .2s;
            }

            .alert-ok {
                background: #e8f5e9;
                border: 1px solid #a5d6a7;
                color: #2e7d32;
                border-radius: 8px;
                padding: 10px 14px;
                font-size: 13px;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 7px;
            }

            /* Suite de votre CSS inchangé */
            .welcome-header {
                background: linear-gradient(108deg, #0f284e, #0a1e38);
                border-radius: 14px;
                padding: 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
                /* 👈 Réparé : le mot incomplet "wra" a été corrigé en "wrap" */
            }


            /* ── AJOUT CORRECTIF : Empêche le contenu de remonter sous la navbar ── */
            .page-layout {
                display: grid;
                grid-template-columns: 260px 1fr;
                min-height: calc(100vh - 64px);
                background: #f0f2f7;
                position: relative;
            }

            /* Assure que la zone centrale respire et se positionne correctement */
            .main-content {
                padding: 2rem;
                background: #f0f2f7;
            }



            .wh-left h1 {
                color: #fff;
                font-size: 1.2rem;
                font-weight: 900;
                margin-bottom: 3px;
            }

            .wh-left p {
                color: rgba(255, 255, 255, .6);
                font-size: 12px;
                line-height: 1.5;
            }

            .wh-right {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .btn-wh {
                padding: 9px 18px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                transition: all .2s;
                border: none;
                cursor: pointer;
                font-family: inherit;
            }

            .btn-wh svg {
                width: 13px;
                height: 13px;
                stroke: currentColor;
                fill: none;
                stroke-width: 2;
            }

            .btn-wh-primary {
                background: #f5c518;
                color: #0f284e;
            }

            .btn-wh-primary:hover {
                opacity: .9;
            }

            .btn-wh-outline {
                background: rgba(255, 255, 255, .1);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, .25);
            }

            .btn-wh-outline:hover {
                background: rgba(255, 255, 255, .18);
            }

            /* Stats */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .stat-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                padding: 1.1rem;
                display: flex;
                align-items: center;
                gap: 12px;
                transition: box-shadow .2s;
            }

            .stat-card:hover {
                box-shadow: 0 4px 14px rgba(15, 40, 78, .08);
            }

            .stat-icon {
                width: 44px;
                height: 44px;
                border-radius: 11px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .stat-icon svg {
                width: 21px;
                height: 21px;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.7;
            }

            .stat-num {
                font-size: 1.4rem;
                font-weight: 900;
                color: #0f284e;
                display: block;
                line-height: 1;
            }

            .stat-lbl {
                font-size: 11px;
                color: #718096;
                margin-top: 2px;
            }

            /* Grid 2 cols */
            .grid2 {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.25rem;
                margin-bottom: 1.25rem;
            }

            .grid3 {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 1.25rem;
                margin-bottom: 1.25rem;
            }

            /* Cards */
            .card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
            }

            .card-head {
                padding: 1rem 1.25rem;
                border-bottom: 1px solid #f0f4f8;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .card-title {
                font-size: 12px;
                font-weight: 900;
                color: #0f284e;
                text-transform: uppercase;
                letter-spacing: .08em;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .card-title::before {
                content: '';
                width: 3px;
                height: 16px;
                background: #f5c518;
                border-radius: 2px;
            }

            .card-link {
                font-size: 12px;
                font-weight: 700;
                color: #0a1e38;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }

            .card-link svg {
                width: 12px;
                height: 12px;
                stroke: currentColor;
                fill: none;
                stroke-width: 2;
            }

            /* Table */
            .table-wrap {
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th {
                font-size: 10px;
                font-weight: 800;
                color: #a0aec0;
                text-transform: uppercase;
                letter-spacing: .07em;
                padding: 9px 14px;
                border-bottom: 1px solid #f0f4f8;
                text-align: left;
                background: #fafbfc;
            }

            td {
                font-size: 12px;
                color: #0a1e38;
                padding: 12px 14px;
                border-bottom: 1px solid #f0f4f8;
                vertical-align: middle;
            }

            tr:last-child td {
                border-bottom: none;
            }

            tr:hover td {
                background: #fafbfc;
            }

            .td-name {
                font-weight: 700;
            }

            .td-sub {
                font-size: 11px;
                color: #718096;
                margin-top: 1px;
            }

            /* Badges */
            .badge {
                font-size: 10px;
                font-weight: 700;
                padding: 3px 10px;
                border-radius: 10px;
                display: inline-block;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .b-confirme {
                background: #e8f5e9;
                color: #2e7d32;
            }

            .b-en_attente {
                background: #fff8e6;
                color: #b07d10;
            }

            .b-en_cours {
                background: #e3f2fd;
                color: #0f284e;
            }

            .b-accepte {
                background: #e8f5e9;
                color: #2e7d32;
            }

            .b-refuse {
                background: #fce4ec;
                color: #c2185b;
            }

            .b-standard {
                background: #e3f2fd;
                color: #0f284e;
                border: 1px solid #bbdefb;
            }

            .b-premium {
                background: #fff8e6;
                color: #b07d10;
                border: 1px solid #ffe082;
            }

            .b-gratuit {
                background: #f0faf0;
                color: #2e7d32;
                border: 1px solid #c8e6c9;
            }

            .b-active {
                background: #e8f5e9;
                color: #2e7d32;
            }

            /* Billet */
            .billet-card {
                background: linear-gradient(135deg, #0f284e 0%, #0a1e38 60%, #1a3a72 100%);
                border-radius: 14px;
                padding: 1.5rem;
                color: #fff;
                display: flex;
                gap: 1.5rem;
                align-items: center;
                flex-wrap: wrap;
            }

            .billet-icon {
                width: 64px;
                height: 64px;
                background: rgba(245, 166, 35, .15);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .billet-icon svg {
                width: 32px;
                height: 32px;
                stroke: #f5c518;
                fill: none;
                stroke-width: 1.6;
            }

            .billet-info {
                flex: 1;
            }

            .billet-num {
                color: #f5c518;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .1em;
                margin-bottom: 3px;
            }

            .billet-titre {
                font-size: 1rem;
                font-weight: 800;
                margin-bottom: 4px;
            }

            .billet-meta {
                color: rgba(255, 255, 255, .65);
                font-size: 12px;
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .billet-qr {
                width: 70px;
                height: 70px;
                background: #fff;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .billet-qr svg {
                width: 50px;
                height: 50px;
            }

            .billet-statut {
                font-size: 10px;
                font-weight: 800;
                padding: 3px 12px;
                border-radius: 10px;
                display: inline-block;
                margin-top: 6px;
            }

            .bs-confirme {
                background: #43a047;
                color: #fff;
            }

            .bs-attente {
                background: #f5c518;
                color: #0f284e;
            }

            /* Items RDV / Alertes */
            .rdv-item {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                padding: 10px 1.25rem;
                border-bottom: 1px solid #f0f4f8;
            }

            .rdv-item:last-child {
                border-bottom: none;
            }

            .rdv-date-box {
                width: 44px;
                height: 44px;
                background: #0f284e;
                border-radius: 8px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .rdv-day {
                color: #f5c518;
                font-size: 1rem;
                font-weight: 900;
                line-height: 1;
            }

            .rdv-month {
                color: rgba(255, 255, 255, .6);
                font-size: 9px;
                text-transform: uppercase;
            }

            .rdv-info {
                flex: 1;
            }

            .rdv-titre {
                font-size: 12px;
                font-weight: 700;
                color: #0a1e38;
            }

            .rdv-sub {
                font-size: 11px;
                color: #718096;
            }

            /* Offres suggérées */
            .offre-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 10px 1.25rem;
                border-bottom: 1px solid #f0f4f8;
                text-decoration: none;
                transition: background .15s;
            }

            .offre-item:last-child {
                border-bottom: none;
            }

            .offre-item:hover {
                background: #fafbfc;
            }

            .offre-logo {
                width: 36px;
                height: 36px;
                border-radius: 7px;
                background: #f4f6fa;
                border: 1px solid #e2e8f0;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                overflow: hidden;
            }

            .offre-logo img {
                width: 36px;
                height: 36px;
                object-fit: contain;
            }

            .offre-info {
                flex: 1;
                min-width: 0;
            }

            .offre-titre {
                font-size: 12px;
                font-weight: 700;
                color: #0a1e38;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .offre-meta {
                font-size: 11px;
                color: #718096;
            }

            /* Actions rapides */
            .quick-actions {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: .75rem;
            }

            .qa-btn {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 7px;
                padding: 1rem .75rem;
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                text-decoration: none;
                transition: all .2s;
                cursor: pointer;
                text-align: center;
            }

            .qa-btn:hover {
                border-color: #0f284e;
                background: #fff;
                box-shadow: 0 2px 8px rgba(15, 40, 78, .08);
            }

            .qa-icon {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .qa-icon svg {
                width: 18px;
                height: 18px;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.7;
            }

            .qa-label {
                font-size: 11px;
                font-weight: 700;
                color: #0a1e38;
                line-height: 1.3;
            }

            /* Empty */
            .empty-mini {
                text-align: center;
                padding: 1.5rem;
                color: #a0aec0;
                font-size: 12px;
            }

            @media (max-width:1100px) {
                .page-layout {
                    grid-template-columns: 1fr;
                }

                .sidebar {
                    display: none;
                }

                .stats-grid {
                    grid-template-columns: 1fr 1fr;
                }

                .grid2,
                .grid3 {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width:600px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .quick-actions {
                    grid-template-columns: 1fr 1fr;
                }

                .main-content {
                    padding: 1rem;
                }
            }


            /* ── FOOTER ── */
            .site-footer {
                background: #0f284e;
                color: rgba(255, 255, 255, .7);
                padding: 3rem 2.5rem 0;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: 1.5fr 1fr 1fr 1fr 1.3fr;
                gap: 2rem;
                margin-bottom: 2.5rem;
            }

            .fb p {
                font-size: 13px;
                line-height: 1.65;
                margin: .75rem 0 1rem;
            }

            .socials {
                display: flex;
                gap: 10px;
            }

            .socials a {
                width: 32px;
                height: 32px;
                background: rgba(255, 255, 255, .1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                text-decoration: none;
                font-size: 12px;
                font-weight: 700;
                transition: background .2s;
            }

            .socials a:hover {
                background: rgba(255, 255, 255, .2);
            }

            .fc h4 {
                color: #fff;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: .1em;
                text-transform: uppercase;
                margin-bottom: 1rem;
            }

            .fc a {
                display: block;
                color: rgba(255, 255, 255, .6);
                text-decoration: none;
                font-size: 13px;
                margin-bottom: 6px;
                transition: color .2s;
            }

            .fc a:hover {
                color: #fff;
            }

            .fci {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                margin-bottom: 8px;
                color: rgba(255, 255, 255, .7);
            }

            .fci svg {
                flex-shrink: 0;
            }

            .footer-bottom {
                border-top: 1px solid rgba(255, 255, 255, .1);
                padding: 1.25rem 0;
                text-align: center;
                font-size: 12px;
                color: rgba(255, 255, 255, .35);
            }

            @media (max-width: 1100px) {
                .main-grid {
                    grid-template-columns: 1fr 1fr;
                }

                .footer-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width: 768px) {
                .nav-links {
                    display: none;
                }

                .main-grid {
                    grid-template-columns: 1fr;
                }

                .contact-bar {
                    flex-direction: column;
                }

                .ci {
                    border-right: none;
                    border-bottom: 1px solid #e2e8f0;
                }

                .fg2 {
                    grid-template-columns: 1fr;
                }

                .footer-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
        {{-- CSS global responsive pour les footers --}}
        <link rel="stylesheet" href="{{ asset('css/footer-responsive.css') }}">
    </head>

    <body>

        {{-- ── NAV ── --}}

        {{-- 🚀 REMPLACEMENT : Appel de votre composant Navbar réutilisable unique --}}
        @include('components.navbar')

        <div class="page-layout">

            {{-- ══ SIDEBAR ══ --}}
            <aside class="sidebar">

                {{-- User card --}}
                <div class="user-card">
                    <div class="uc-top">
                        <div class="uc-avatar">
                            @if (auth()->user()->photo ?? false)
                            <img src="{{ asset('storage/'.auth()->user()->photo) }}" alt="">
                            @else
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            @endif
                            <span class="uc-dot"></span>
                        </div>
                        <div>
                            <div class="uc-name">{{ auth()->user()->name }}</div>
                            <div class="uc-email">{{ auth()->user()->email }}</div>
                            @php
                            $roleConfig = [
                            'admin' => ['Admin','#c2185b','#fce4ec'],
                            'super_admin' => ['Super Admin','#c2185b','#fce4ec'],
                            'recruteur' => ['Recruteur','#0f284e','#e3f2fd'],
                            'partenaire' => ['Partenaire','#b07d10','#fff8e6'],
                            'entrepreneur' => ['Entrepreneur','#2e7d32','#e8f5e9'],
                            'institution' => ['Institution','#00838f','#e0f7fa'],
                            'candidat' => ['Candidat','#6a1b9a','#ede7f6'],
                            'participant_forum' => ['Participant','#0f284e','#e3f2fd'],
                            'moderateur' => ['Modérateur','#f5c518','#fff3e0'],
                            'intervenant' => ['Intervenant','#2e7d32','#e8f5e9'],
                            'visiteur' => ['Visiteur','#718096','#f0f4f8'],
                            'benevole' => ['Bénévole','#00838f','#e0f7fa'],
                            'editeur' => ['Éditeur','#6a1b9a','#ede7f6'],
                            'support' => ['Support','#f5c518','#fff3e0'],
                            ];
                            $rl = $roleConfig[$role] ?? ['Utilisateur','#718096','#f0f4f8'];
                            @endphp
                            <span class="uc-role-badge" style="background:{{ $rl[2] }};color:{{ $rl[1] }}">{{ $rl[0] }}</span>
                        </div>
                    </div>
                    {{-- Completion profil --}}
                    @php $completion = auth()->user()->completion ?? 65; @endphp
                    <div class="profil-progress">
                        <div class="pp-row"><span>Profil complété</span><strong>{{ $completion }}%</strong></div>
                        <div class="pp-bar">
                            <div class="pp-fill" style="width:{{ $completion }}%"></div>
                        </div>
                        @if ($completion < 100)
                            <div class="pp-tip">→ Complétez votre profil pour plus de visibilité
                    </div>
                    @endif
                </div>
        </div>

        {{-- ── ONGLETS PRINCIPAUX ── --}}
        <div class="main-tabs">
            <button class="main-tab {{ in_array($role,['entrepreneur','recruteur','partenaire','institution','editeur']) ? 'active' : '' }}"
                onclick="switchTab('acteurs')" id="tab-acteurs">
                💼 Acteurs éco.
            </button>
            <button class="main-tab {{ in_array($role,['candidat','participant_forum','moderateur','intervenant','visiteur','benevole','support','admin','super_admin']) ? 'active' : '' }}"
                onclick="switchTab('participants')" id="tab-participants">
                👥 Participants
            </button>
        </div>

        {{-- ══ SOUS-MENUS ACTEURS ÉCONOMIQUES ══ --}}
        <div id="nav-acteurs" class="subnav-section" style="{{ in_array($role,['entrepreneur','recruteur','partenaire','institution','editeur']) ? '' : 'display:none' }}">

            @if (in_array($role,['entrepreneur','institution']))
            <div class="subnav-title">Espace Entrepreneur</div>
            <a href="{{ route('mon-espace.dashboard') }}" class="subnav-item active">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Tableau de bord
            </a>
            <a href="{{ route('mon-espace.profil') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Mon profil entreprise
            </a>
            <a href="{{ route('mon-espace.billet') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9M9 9l3 3 3-3" />
                </svg>
                Mon billet
                @if ($inscription && $inscription->statut === 'confirme')<span class="subnav-badge green">✓</span>@endif
            </a>
            <a href="{{ route('entrepreneurs.annuaire') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
                Annuaire entrepreneurs
            </a>
            <a href="{{ route('entrepreneurs.rendez-vous') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Mes rendez-vous B2B
                @if (($rdvs_prochains ?? collect())->count() > 0)<span class="subnav-badge blue">{{ ($rdvs_prochains ?? collect())->count() }}</span>@endif
            </a>
            <a href="{{ route('mon-espace.preferences') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83" />
                </svg>
                Préférences
            </a>
            @endif

            @if (in_array($role,['recruteur','partenaire']))
            <div class="subnav-title">Espace Recruteur</div>
            <a href="{{ route('mon-espace.dashboard') }}" class="subnav-item active">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Tableau de bord
            </a>
            <a href="{{ route('mon-espace.profil') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                Profil entreprise
            </a>
            <a href="{{ route('mon-espace.billet') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9" />
                </svg>
                Mon billet
            </a>
            <a href="{{ route('recruteur.offres') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Mes offres publiées
                @if (($stats[0]['valeur'] ?? 0) > 0)<span class="subnav-badge blue">{{ $stats[0]['valeur'] ?? 0 }}</span>@endif
            </a>
            <a href="{{ route('recruteur.candidatures') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                </svg>
                Candidatures reçues
                @if (($stats[2]['valeur'] ?? 0) > 0)<span class="subnav-badge red">{{ $stats[2]['valeur'] ?? 0 }}</span>@endif
            </a>
            <a href="{{ route('mon-espace.preferences') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3" />
                </svg>
                Préférences
            </a>
            @endif

            @if ($role === 'editeur')
            <div class="subnav-title">Espace Éditeur</div>
            <a href="{{ route('mon-espace.dashboard') }}" class="subnav-item active">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Tableau de bord
            </a>
            <a href="{{ route('mon-espace.profil') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Mon profil
            </a>
            <a href="{{ route('mon-espace.preferences') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3" />
                </svg>
                Préférences
            </a>
            @endif

            {{-- Lien vers espace dédié --}}
            @if (in_array($role,['entrepreneur','institution']))
            <a href="{{ route('entrepreneurs.dashboard') }}" class="go-espace">
                <div class="go-espace-icon"><svg viewBox="0 0 24 24">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                    </svg></div>
                <div>
                    <div class="go-espace-title">Espace Entrepreneur</div>
                    <div class="go-espace-sub">Accéder à mon espace complet →</div>
                </div>
            </a>
            @elseif (in_array($role,['recruteur','partenaire']))
            <a href="{{ route('recruteur.dashboard') }}" class="go-espace">
                <div class="go-espace-icon"><svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg></div>
                <div>
                    <div class="go-espace-title">Espace Recruteur</div>
                    <div class="go-espace-sub">Accéder à mon espace complet →</div>
                </div>
            </a>
            @endif
        </div>

        {{-- ══ SOUS-MENUS PARTICIPANTS ══ --}}
        <div id="nav-participants" class="subnav-section" style="{{ in_array($role,['candidat','participant_forum','moderateur','intervenant','visiteur','benevole','support','admin','super_admin']) ? '' : 'display:none' }}">

            <div class="subnav-title">Mon compte</div>
            <a href="{{ route('mon-espace.dashboard') }}" class="subnav-item active">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Tableau de bord
            </a>
            <a href="{{ route('mon-espace.profil') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Mon profil
            </a>
            <a href="{{ route('mon-espace.billet') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9M9 9l3 3 3-3" />
                </svg>
                Mon billet d'accès
                @if ($inscription && $inscription->statut === 'confirme')
                <span class="subnav-badge green">✓</span>
                @elseif ($inscription && $inscription->statut === 'en_attente_paiement')
                <span class="subnav-badge red">!</span>
                @endif
            </a>

            @if (in_array($role,['candidat','participant_forum','benevole','moderateur','intervenant']))
            <div class="subnav-title">Emploi & Carrière</div>
            <a href="{{ route('mon-espace.candidatures') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Mes candidatures
                @php $nbCand = ($stats[0]['valeur'] ?? 0); @endphp
                @if ($nbCand > 0)<span class="subnav-badge blue">{{ $nbCand }}</span>@endif
            </a>
            <a href="{{ route('emploi.alertes') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                </svg>
                Mes alertes emploi
            </a>
            <a href="{{ route('emploi.documents') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                </svg>
                Mes documents (CV)
            </a>
            <a href="{{ route('emploi.rdvb2b') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Rendez-vous B2B
            </a>
            @endif

            <div class="subnav-title">Paramètres</div>
            <a href="{{ route('mon-espace.preferences') }}" class="subnav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83" />
                </svg>
                Préférences & notifications
            </a>

            @if (in_array($role,['admin','super_admin']))
            <a href="{{ route('admin.dashboard') }}" class="go-espace" style="margin-top:.75rem">
                <div class="go-espace-icon"><svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg></div>
                <div>
                    <div class="go-espace-title">Administration</div>
                    <div class="go-espace-sub">Accéder au back-office →</div>
                </div>
            </a>
            @elseif (in_array($role,['candidat','participant_forum']))
            <a href="{{ route('emploi') }}" class="go-espace" style="margin-top:.75rem">
                <div class="go-espace-icon"><svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    </svg></div>
                <div>
                    <div class="go-espace-title">Espace Emploi</div>
                    <div class="go-espace-sub">Voir toutes les offres →</div>
                </div>
            </a>
            @endif
        </div>

        {{-- Logout --}}
        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                    </svg>
                    Se déconnecter
                </button>
            </form>
        </div>
        </aside>

        {{-- ══ CONTENU PRINCIPAL ══ --}}
        <main class="main-content">

            @if (session('success'))
            <div class="alert-ok"><svg viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" />
                </svg>{{ session('success') }}</div>
            @endif

            {{-- Notifications --}}
            @if (!empty($notifications))
            <div class="notif-list">
                @foreach ($notifications as $notif)
                <div class="notif {{ $notif['type'] }}">
                    <svg viewBox="0 0 24 24">
                        @if ($notif['type']==='warning')
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                        @elseif ($notif['type']==='success')
                        <polyline points="20 6 9 17 4 12" />
                        @else
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />@endif
                    </svg>
                    {{ $notif['msg'] }}
                    @if (isset($notif['url']))<a href="{{ $notif['url'] }}">Voir →</a>@endif
                </div>
                @endforeach
            </div>
            @endif

            {{-- Welcome --}}
            <div class="welcome-header">
                <div class="wh-left">
                    <h1>Bonjour, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
                    <p>Bienvenue dans votre espace {{ $rl[0] }} — JEFIE Paris 2026<br>
                        <span style="font-size:11px;opacity:.8">{{ now()->translatedFormat('l d F Y') }}</span>
                    </p>
                </div>
                <div class="wh-right">
                    <a href="{{ route('mon-espace.profil') }}" class="btn-wh btn-wh-outline">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Mon profil
                    </a>
                    <a href="{{ route('mon-espace.billet') }}" class="btn-wh btn-wh-primary">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9M9 9l3 3 3-3" />
                        </svg>
                        Mon billet
                    </a>
                </div>
            </div>

            {{-- Billet rapide --}}
            @if ($inscription)
            <div class="billet-card" style="margin-bottom:1.5rem">
                <div class="billet-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9M9 9l3 3 3-3" />
                    </svg>
                </div>
                <div class="billet-info">
                    <div class="billet-num">N° {{ $inscription->numero_badge ?? '—' }}</div>
                    <div class="billet-titre">Forum JEFIE Paris 2026</div>
                    <div class="billet-meta">
                        <span>📅 15 - 18 Septembre 2026</span>
                        <span>📍 Paris, France</span>
                        <span>🎫 Pass {{ ucfirst($inscription->type_pass ?? '—') }}</span>
                    </div>
                    <span class="billet-statut {{ $inscription->statut === 'confirme' ? 'bs-confirme' : 'bs-attente' }}">
                        {{ $inscription->statut === 'confirme' ? '✓ Confirmé' : '⏳ En attente' }}
                    </span>
                </div>
                <div class="billet-qr">
                    <svg viewBox="0 0 50 50" fill="none">
                        <rect x="2" y="2" width="18" height="18" rx="2" stroke="#0f284e" stroke-width="2.5" />
                        <rect x="7" y="7" width="8" height="8" fill="#0f284e" />
                        <rect x="30" y="2" width="18" height="18" rx="2" stroke="#0f284e" stroke-width="2.5" />
                        <rect x="35" y="7" width="8" height="8" fill="#0f284e" />
                        <rect x="2" y="30" width="18" height="18" rx="2" stroke="#0f284e" stroke-width="2.5" />
                        <rect x="7" y="35" width="8" height="8" fill="#0f284e" />
                        <rect x="30" y="30" width="4" height="4" fill="#0f284e" />
                        <rect x="36" y="30" width="4" height="4" fill="#0f284e" />
                        <rect x="42" y="30" width="4" height="4" fill="#0f284e" />
                        <rect x="30" y="36" width="4" height="4" fill="#0f284e" />
                        <rect x="42" y="36" width="4" height="4" fill="#0f284e" />
                        <rect x="30" y="42" width="4" height="4" fill="#0f284e" />
                        <rect x="42" y="42" width="4" height="4" fill="#0f284e" />
                    </svg>
                </div>
            </div>
            @else
            <div class="card" style="margin-bottom:1.25rem;border:2px dashed #e2e8f0">
                <div style="padding:1.25rem;display:flex;align-items:center;gap:14px">
                    <div style="width:48px;height:48px;background:#fff8e6;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <svg viewBox="0 0 24 24" width="22" height="22" stroke="#f5c518" fill="none" stroke-width="1.7">
                            <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9M9 9l3 3 3-3" />
                        </svg>
                    </div>
                    <div style="flex:1">
                        <div style="font-size:13px;font-weight:700;color:#0f284e;margin-bottom:3px">Vous n'avez pas encore de billet</div>
                        <div style="font-size:12px;color:#718096">Inscrivez-vous au Forum JEFIE Paris 2026 pour obtenir votre badge et QR Code d'accès.</div>
                    </div>
                    <a href="{{ route('inscription') }}" style="background:#f5c518;color:#0f284e;font-weight:700;font-size:12px;padding:10px 18px;border-radius:6px;text-decoration:none;white-space:nowrap;transition:opacity .2s">S'inscrire →</a>
                </div>
            </div>
            @endif

            {{-- Stats --}}
            @if (!empty($stats))
            <div class="stats-grid" style="margin-bottom:1.5rem">
                @foreach ($stats as $s)
                @php
                $icones = [
                'candidature'=>'
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />',
                'check'=>'
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />',
                'alerte'=>'
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />',
                'rdv'=>'
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />',
                'offre'=>'
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />',
                'nouveau'=>'
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />',
                'vue'=>'
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />',
                'employe'=>'
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />',
                'opportunite'=>'
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />',
                'profil'=>'
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />',
                'user'=>'
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />',
                'billet'=>'
                <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9" />',
                ];
                $ic = $icones[$s['icon']] ?? '
                <circle cx="12" cy="12" r="10" />';
                $bgMap = ['#0f284e'=>'#e3f2fd','#2e7d32'=>'#e8f5e9','#f5c518'=>'#fff8e6','#6a1b9a'=>'#ede7f6','#c2185b'=>'#fce4ec','#f5c518'=>'#fff3e0'];
                $bg = $bgMap[$s['couleur']] ?? '#f4f6fa';
                @endphp
                <div class="stat-card">
                    <div class="stat-icon" style="background:{{ $bg }};color:{{ $s['couleur'] }}">
                        <svg viewBox="0 0 24 24" stroke="{{ $s['couleur'] }}" fill="none" stroke-width="1.7">{!! $ic !!}</svg>
                    </div>
                    <div>
                        <span class="stat-num">{{ $s['valeur'] }}{{ $s['label']==='% Profil complété' ? '%' : '' }}</span>
                        <div class="stat-lbl">{{ $s['label'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Actions rapides --}}
            <div class="card" style="margin-bottom:1.25rem">
                <div class="card-head">
                    <div class="card-title">Actions rapides</div>
                </div>
                <div style="padding:1.1rem">
                    <div class="quick-actions">
                        <a href="{{ route('mon-espace.profil') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#e3f2fd;color:#0f284e"><svg viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg></div>
                            <span class="qa-label">Modifier mon profil</span>
                        </a>
                        <a href="{{ route('mon-espace.billet') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#e8f5e9;color:#2e7d32"><svg viewBox="0 0 24 24">
                                    <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 3v9M9 9l3 3 3-3" />
                                </svg></div>
                            <span class="qa-label">Mon billet & QR Code</span>
                        </a>
                        @if (in_array($role,['candidat','participant_forum','benevole','moderateur','intervenant']))
                        <a href="{{ route('mon-espace.candidatures') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#ede7f6;color:#6a1b9a"><svg viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                </svg></div>
                            <span class="qa-label">Mes candidatures</span>
                        </a>
                        <a href="{{ route('emploi') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#fff3e0;color:#f5c518"><svg viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="M21 21l-4.35-4.35" />
                                </svg></div>
                            <span class="qa-label">Chercher un emploi</span>
                        </a>
                        <a href="{{ route('emploi.rdvb2b') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#fff8e6;color:#b07d10"><svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg></div>
                            <span class="qa-label">Rendez-vous B2B</span>
                        </a>
                        @endif
                        @if (in_array($role,['recruteur','partenaire']))
                        <a href="{{ route('recruteur.offre.creer') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#e8f5e9;color:#2e7d32"><svg viewBox="0 0 24 24">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg></div>
                            <span class="qa-label">Publier une offre</span>
                        </a>
                        <a href="{{ route('recruteur.candidatures') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#ede7f6;color:#6a1b9a"><svg viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                </svg></div>
                            <span class="qa-label">Candidatures reçues</span>
                        </a>
                        @endif
                        @if (in_array($role,['entrepreneur','institution']))
                        <a href="{{ route('entrepreneurs.annuaire') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#e8f5e9;color:#2e7d32"><svg viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                                </svg></div>
                            <span class="qa-label">Annuaire entrepreneurs</span>
                        </a>
                        <a href="{{ route('entrepreneurs.rendez-vous') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#fff8e6;color:#b07d10"><svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg></div>
                            <span class="qa-label">Mes rendez-vous</span>
                        </a>
                        @endif
                        @if (in_array($role,['admin','super_admin']))
                        <a href="{{ route('admin.dashboard') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#fce4ec;color:#c2185b"><svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7" rx="1" />
                                    <rect x="14" y="3" width="7" height="7" rx="1" />
                                    <rect x="3" y="14" width="7" height="7" rx="1" />
                                    <rect x="14" y="14" width="7" height="7" rx="1" />
                                </svg></div>
                            <span class="qa-label">Administration</span>
                        </a>
                        <a href="{{ route('admin.export') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#e3f2fd;color:#0f284e"><svg viewBox="0 0 24 24">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                </svg></div>
                            <span class="qa-label">Exporter les données</span>
                        </a>
                        @endif
                        <a href="{{ route('mon-espace.preferences') }}" class="qa-btn">
                            <div class="qa-icon" style="background:#f0f4f8;color:#718096"><svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4" />
                                </svg></div>
                            <span class="qa-label">Préférences</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Grid : Candidatures + RDV --}}
            <div class="grid2">

                {{-- Dernières candidatures --}}
                @if (in_array($role,['candidat','participant_forum','benevole','moderateur','intervenant']))
                <div class="card">
                    <div class="card-head">
                        <div class="card-title">Mes candidatures</div>
                        <a href="{{ route('mon-espace.candidatures') }}" class="card-link">Voir tout <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg></a>
                    </div>
                    @if (isset($candidatures_recentes) && $candidatures_recentes->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Poste</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidatures_recentes as $c)
                                <tr>
                                    <td>
                                        <div class="td-name">{{ $c->poste_cible }}</div>
                                        <div class="td-sub">{{ $c->offreEmploi?->entreprise ?? '—' }}</div>
                                    </td>
                                    <td><span class="badge b-{{ $c->statut }}">{{ ucfirst(str_replace('_',' ',$c->statut)) }}</span></td>
                                    <td style="font-size:11px;color:#a0aec0">{{ $c->created_at?->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-mini">
                        Aucune candidature — <a href="{{ route('emploi') }}" style="color:#f5c518;font-weight:700">Voir les offres</a>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Offres recruteur --}}
                @if (in_array($role,['recruteur','partenaire']) && isset($offres_recentes))
                <div class="card">
                    <div class="card-head">
                        <div class="card-title">Mes offres publiées</div>
                        <a href="{{ route('recruteur.offres') }}" class="card-link">Voir tout <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg></a>
                    </div>
                    @forelse ($offres_recentes as $o)
                    <div class="offre-item" style="text-decoration:none">
                        <div class="offre-logo">
                            @if ($o->logo_entreprise)
                            <img src="{{ asset('storage/'.$o->logo_entreprise) }}" alt="">
                            @else
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="#718096" fill="none" stroke-width="1.5">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            @endif
                        </div>
                        <div class="offre-info">
                            <div class="offre-titre">{{ $o->titre }}</div>
                            <div class="offre-meta">{{ $o->type_contrat }} · {{ $o->lieu }} · {{ $o->candidatures_count ?? 0 }} candid.</div>
                        </div>
                        <span class="badge b-{{ $o->statut }}">{{ ucfirst($o->statut) }}</span>
                    </div>
                    @empty
                    <div class="empty-mini"><a href="{{ route('recruteur.offre.creer') }}" style="color:#f5c518;font-weight:700">+ Publier une offre</a></div>
                    @endforelse
                </div>
                @endif

                {{-- Prochains RDV --}}
                @if (isset($rdvs_prochains) && $rdvs_prochains->count() > 0)
                <div class="card">
                    <div class="card-head">
                        <div class="card-title">Prochains RDV B2B</div>
                        <a href="{{ route('emploi.rdvb2b') }}" class="card-link">Voir tout <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg></a>
                    </div>
                    @foreach ($rdvs_prochains as $rdv)
                    <div class="rdv-item">
                        <div class="rdv-date-box">
                            <span class="rdv-day">{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d') }}</span>
                            <span class="rdv-month">{{ \Carbon\Carbon::parse($rdv->date_heure)->translatedFormat('M') }}</span>
                        </div>
                        <div class="rdv-info">
                            <div class="rdv-titre">{{ $rdv->objet }}</div>
                            <div class="rdv-sub">{{ $rdv->recruteur_id }} · {{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Offres suggérées --}}
                @if (isset($offres_suggeres) && $offres_suggeres->count() > 0)
                <div class="card">
                    <div class="card-head">
                        <div class="card-title">Offres suggérées</div>
                        <a href="{{ route('emploi') }}" class="card-link">Voir tout <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg></a>
                    </div>
                    @foreach ($offres_suggeres as $o)
                    <a href="{{ route('emploi.show', $o->slug ?? $o->id) }}" class="offre-item">
                        <div class="offre-logo">
                            @if ($o->logo_entreprise)
                            <img src="{{ asset('storage/'.$o->logo_entreprise) }}" alt="">
                            @else
                            <span style="font-size:12px;font-weight:700;color:#0f284e">{{ strtoupper(substr($o->entreprise ?? 'E',0,2)) }}</span>
                            @endif
                        </div>
                        <div class="offre-info">
                            <div class="offre-titre">{{ $o->titre }}</div>
                            <div class="offre-meta">{{ $o->entreprise }} · {{ $o->type_contrat }} · {{ $o->lieu }}</div>
                        </div>
                        <span class="badge b-active">Nouveau</span>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

        </main>
        </div>

        <script>
            function switchTab(tab) {
                document.getElementById('nav-acteurs').style.display = tab === 'acteurs' ? '' : 'none';
                document.getElementById('nav-participants').style.display = tab === 'participants' ? '' : 'none';
                document.getElementById('tab-acteurs').classList.toggle('active', tab === 'acteurs');
                document.getElementById('tab-participants').classList.toggle('active', tab === 'participants');
            }
        </script>



        {{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}

@include('components.footer')

    </body>

    </html>