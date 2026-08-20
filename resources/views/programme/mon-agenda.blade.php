{{-- resources/views/programme/mon-agenda.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon Agenda — JEFIE Paris 2026</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f2f7;
            color: #1a2744
        }

        /* NAV */
        .nav {
            background: #0d1b3e;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.75rem;
            position: sticky;
            top: 0;
            z-index: 400
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none
        }

        .nav-logo-icon {
            width: 42px;
            height: 42px;
            border: 2px solid #f5a623;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .nav-logo-icon svg {
            width: 20px;
            height: 20px;
            stroke: #f5a623;
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
            color: #f5a623;
            display: block;
            font-size: 11px
        }

        .nav-links {
            display: flex;
            gap: 1.5rem
        }

        .nav-links a {
            color: rgba(255, 255, 255, .8);
            font-size: 13px;
            text-decoration: none;
            transition: color .2s;
            white-space: nowrap
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #f5a623
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .btn-nav-back {
            color: rgba(255, 255, 255, .7);
            font-size: 12px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .2);
            padding: 7px 16px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s
        }

        .btn-nav-back:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff
        }

        .btn-nav-back svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .btn-inscr {
            background: #f5a623;
            color: #0d1b3e;
            font-weight: 700;
            font-size: 13px;
            padding: 9px 20px;
            border-radius: 5px;
            text-decoration: none
        }

        /* HERO */
        .hero {
            background: linear-gradient(108deg, #060e20, #0d1b3e 60%, #0f2a5e);
            padding: 2rem 2.5rem;
            position: relative;
            overflow: hidden
        }

        .hero::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            width: 30%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Ccircle cx='300' cy='80' r='120' fill='rgba(245,166,35,0.04)'/%3E%3C/svg%3E") no-repeat center;
            pointer-events: none
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem
        }

        .hero-left {}

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(245, 166, 35, .12);
            border: 1px solid rgba(245, 166, 35, .3);
            color: #f5a623;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 3px;
            margin-bottom: .75rem
        }

        .hero-eyebrow svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .hero h1 {
            color: #fff;
            font-size: 1.8rem;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: .4rem
        }

        .hero h1 span {
            color: #f5a623
        }

        .hero-sub {
            color: rgba(255, 255, 255, .6);
            font-size: 12px;
            line-height: 1.6
        }

        .hero-stats {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1.25rem
        }

        .hs {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .hs-num {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 900;
            display: block;
            line-height: 1
        }

        .hs-lbl {
            color: rgba(255, 255, 255, .5);
            font-size: 10px
        }

        .hero-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 200px
        }

        .btn-hero {
            padding: 11px 22px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all .2s;
            border: none;
            font-family: inherit;
            text-decoration: none;
            white-space: nowrap;
            justify-content: center
        }

        .btn-hero svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .bh-gold {
            background: #f5a623;
            color: #0d1b3e
        }

        .bh-gold:hover {
            opacity: .9
        }

        .bh-outline {
            background: rgba(255, 255, 255, .08);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .2)
        }

        .bh-outline:hover {
            background: rgba(255, 255, 255, .15)
        }

        .bh-red {
            background: rgba(229, 57, 53, .15);
            color: #ef9a9a;
            border: 1px solid rgba(229, 57, 53, .3)
        }

        .bh-red:hover {
            background: rgba(229, 57, 53, .25)
        }

        /* LAYOUT */
        .page-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 2.5rem
        }

        /* AGENDA VIDE */
        .agenda-vide {
            background: #fff;
            border: 2px dashed #e2e8f0;
            border-radius: 16px;
            padding: 4rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem
        }

        .av-icon {
            width: 80px;
            height: 80px;
            background: #f4f6fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .av-icon svg {
            width: 40px;
            height: 40px;
            stroke: #d1d9e6;
            fill: none;
            stroke-width: 1.2
        }

        .av-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #718096
        }

        .av-desc {
            font-size: 13px;
            color: #a0aec0;
            line-height: 1.7;
            max-width: 420px
        }

        .btn-go-prog {
            background: #0d1b3e;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            padding: 13px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s;
            margin-top: .5rem
        }

        .btn-go-prog:hover {
            background: #162552
        }

        .btn-go-prog svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        /* BARRE OUTILS */
        .toolbar {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: .85rem 1.25rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem
        }

        .tb-info {
            font-size: 12px;
            color: #718096;
            flex: 1
        }

        .tb-info strong {
            color: #0d1b3e
        }

        .tb-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        .btn-tb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            border: 1.5px solid;
            transition: all .2s;
            font-family: inherit;
            text-decoration: none;
            white-space: nowrap
        }

        .btn-tb svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .bt-primary {
            background: #0d1b3e;
            color: #fff;
            border-color: #0d1b3e
        }

        .bt-primary:hover {
            background: #162552
        }

        .bt-gold {
            background: #f5a623;
            color: #0d1b3e;
            border-color: #f5a623
        }

        .bt-gold:hover {
            opacity: .9
        }

        .bt-outline {
            background: #fff;
            color: #162552;
            border-color: #d1d9e6
        }

        .bt-outline:hover {
            border-color: #0d1b3e
        }

        .bt-red {
            background: #fff;
            color: #e53935;
            border-color: #fecaca
        }

        .bt-red:hover {
            background: #fce4ec
        }

        /* VUE SÉLECTEUR */
        .vue-btns {
            display: flex;
            gap: 4px;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            overflow: hidden
        }

        .vb {
            padding: 7px 12px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            background: #fff;
            color: #718096;
            border: none;
            font-family: inherit;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 5px
        }

        .vb svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8
        }

        .vb.active,
        .vb:hover {
            background: #0d1b3e;
            color: #fff
        }

        /* FILTRES JOURS */
        .jours-filter {
            display: flex;
            gap: 8px;
            margin-bottom: 1.5rem;
            flex-wrap: wrap
        }

        .jf {
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            border: 1.5px solid #e2e8f0;
            color: #718096;
            background: #fff;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap
        }

        .jf:hover {
            border-color: #0d1b3e;
            color: #0d1b3e
        }

        .jf.active {
            background: #0d1b3e;
            color: #fff;
            border-color: #0d1b3e
        }

        /* SECTION JOUR */
        .jour-section {
            margin-bottom: 2rem
        }

        .jour-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
            padding: 1rem 1.25rem;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            border-left: 4px solid #f5a623
        }

        .jh-date-box {
            width: 52px;
            height: 52px;
            background: #0d1b3e;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .jh-day {
            color: #f5a623;
            font-size: 1.2rem;
            font-weight: 900;
            line-height: 1
        }

        .jh-month {
            color: rgba(255, 255, 255, .5);
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .05em
        }

        .jh-info {}

        .jh-title {
            font-size: 15px;
            font-weight: 800;
            color: #0d1b3e
        }

        .jh-sub {
            font-size: 11px;
            color: #718096;
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .jh-count {
            background: #fff8e6;
            color: #f5a623;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 8px;
            margin-left: auto
        }

        .jh-progress {
            flex: 1;
            height: 6px;
            background: #f0f4f8;
            border-radius: 3px;
            overflow: hidden;
            max-width: 120px;
            margin-left: 1rem
        }

        .jh-prog-fill {
            height: 100%;
            background: linear-gradient(90deg, #f5a623, #e09010);
            border-radius: 3px
        }

        /* SESSION CARTE */
        .session-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            overflow: hidden;
            margin-bottom: .85rem;
            transition: box-shadow .2s;
            position: relative
        }

        .session-card:hover {
            box-shadow: 0 4px 16px rgba(13, 27, 62, .08)
        }

        .session-card.vedette {
            border-color: #f5a623
        }

        .sc-heure {
            width: 72px;
            background: #fafbfc;
            border-right: 1px solid #f0f4f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            padding: .75rem .5rem;
            text-align: center;
            gap: 4px
        }

        .sc-h-debut {
            font-size: 1rem;
            font-weight: 900;
            color: #0d1b3e;
            line-height: 1
        }

        .sc-h-sep {
            font-size: 10px;
            color: #d1d9e6;
            font-weight: 300
        }

        .sc-h-fin {
            font-size: .85rem;
            font-weight: 600;
            color: #a0aec0
        }

        .sc-stripe {
            width: 5px;
            flex-shrink: 0
        }

        .sc-content {
            padding: 1.1rem;
            flex: 1;
            min-width: 0
        }

        .sc-top {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            margin-bottom: .6rem
        }

        .sc-type-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .sc-type-icon svg {
            width: 17px;
            height: 17px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.7
        }

        .sc-meta {}

        .sc-type-lbl {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 3px
        }

        .sc-titre {
            font-size: .95rem;
            font-weight: 800;
            color: #0d1b3e;
            line-height: 1.3
        }

        .sc-info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 5px
        }

        .sc-info-item {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            color: #718096
        }

        .sc-info-item svg {
            width: 11px;
            height: 11px;
            stroke: #a0aec0;
            fill: none;
            stroke-width: 1.8
        }

        .sc-desc {
            font-size: 12px;
            color: #718096;
            line-height: 1.55;
            margin: .65rem 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .sc-intervenants {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: .65rem;
            flex-wrap: wrap
        }

        .sc-iv {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d1b3e, #162552);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f5a623;
            font-size: 10px;
            font-weight: 700;
            border: 2px solid #fff;
            flex-shrink: 0
        }

        .sc-iv-name {
            font-size: 11px;
            color: #4a5568;
            font-weight: 600
        }

        .sc-footer {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .sc-salle-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f0f4f8;
            color: #718096;
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 6px
        }

        .sc-salle-badge svg {
            width: 10px;
            height: 10px;
            stroke: #a0aec0;
            fill: none;
            stroke-width: 1.8
        }

        .vedette-star {
            color: #f5a623;
            font-size: 10px;
            font-weight: 700;
            background: #fff8e6;
            border: 1px solid #ffe082;
            padding: 2px 9px;
            border-radius: 8px
        }

        .btn-retirer {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            background: #fff;
            color: #e53935;
            border: 1.5px solid #fecaca;
            cursor: pointer;
            transition: all .2s;
            font-family: inherit
        }

        .btn-retirer:hover {
            background: #fce4ec
        }

        .btn-retirer svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .btn-voir-detail {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            background: #f4f6fa;
            color: #162552;
            border: 1.5px solid #e2e8f0;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none
        }

        .btn-voir-detail:hover {
            border-color: #0d1b3e;
            background: #fff
        }

        .btn-voir-detail svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        /* VUE CALENDRIER */
        .cal-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.5rem
        }

        .cal-col {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden
        }

        .cal-col-head {
            background: #0d1b3e;
            padding: .75rem 1rem;
            text-align: center
        }

        .cal-col-jour {
            color: #f5a623;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em
        }

        .cal-col-date {
            color: rgba(255, 255, 255, .7);
            font-size: 11px;
            margin-top: 2px
        }

        .cal-col-body {
            padding: .75rem
        }

        .cal-session {
            border-left: 3px solid;
            border-radius: 5px;
            padding: .5rem .6rem;
            margin-bottom: .5rem;
            font-size: 11px;
            background: #fafbfc;
            cursor: pointer;
            transition: opacity .2s
        }

        .cal-session:hover {
            opacity: .85
        }

        .cal-session:last-child {
            margin-bottom: 0
        }

        .cal-s-heure {
            font-size: 10px;
            font-weight: 700;
            color: #718096;
            margin-bottom: 2px
        }

        .cal-s-titre {
            font-weight: 700;
            color: #162552;
            line-height: 1.3
        }

        .cal-empty {
            padding: 1.5rem;
            text-align: center;
            color: #d1d9e6;
            font-size: 12px
        }

        /* RÉSUMÉ STATISTIQUES */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem
        }

        .sg-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1rem;
            text-align: center
        }

        .sg-num {
            font-size: 1.4rem;
            font-weight: 900;
            color: #0d1b3e;
            display: block;
            line-height: 1
        }

        .sg-lbl {
            font-size: 11px;
            color: #718096;
            margin-top: 3px
        }

        .sg-bar {
            height: 4px;
            border-radius: 2px;
            margin-top: .5rem;
            width: 100%
        }

        /* Types résumé */
        .type-summary {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 1.5rem
        }

        .ts-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: .75rem 1rem;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px
        }

        .ts-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0
        }

        .ts-label {
            font-size: 12px;
            font-weight: 700;
            color: #162552;
            flex: 1
        }

        .ts-count {
            font-size: 12px;
            font-weight: 800;
            color: #0d1b3e
        }

        .ts-bar-wrap {
            flex: 1;
            height: 5px;
            background: #f0f4f8;
            border-radius: 3px;
            overflow: hidden;
            max-width: 80px
        }

        .ts-bar-fill {
            height: 100%;
            border-radius: 3px
        }

        /* CONFLIT */
        .conflit-warning {
            background: #fce4ec;
            border: 1px solid #f48fb1;
            border-radius: 8px;
            padding: .85rem 1rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 1.25rem
        }

        .cw-icon {
            width: 28px;
            height: 28px;
            background: #e53935;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .cw-icon svg {
            width: 14px;
            height: 14px;
            stroke: #fff;
            fill: none;
            stroke-width: 2.5
        }

        .cw-title {
            font-size: 12px;
            font-weight: 700;
            color: #c2185b;
            margin-bottom: 3px
        }

        .cw-desc {
            font-size: 11px;
            color: #e57373;
            line-height: 1.5
        }

        /* PRINT */
        @media print {

            .nav,
            .hero-actions,
            .toolbar,
            .jours-filter,
            .btn-retirer,
            .btn-voir-detail,
            .site-footer {
                display: none !important
            }

            body {
                background: #fff
            }

            .page-wrap {
                padding: 1rem
            }

            .session-card {
                break-inside: avoid;
                margin-bottom: .5rem
            }

            .hero {
                background: #0d1b3e !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact
            }
        }

        /* FOOTER */
        .site-footer {
            background: #0d1b3e;
            color: rgba(255, 255, 255, .7);
            padding: 2rem 2.5rem 0;
            margin-top: 2rem
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .1);
            padding: 1rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .footer-copy {
            font-size: 11px;
            color: rgba(255, 255, 255, .35)
        }

        .footer-legal {
            display: flex;
            gap: 1rem
        }

        .footer-legal a {
            font-size: 11px;
            color: rgba(255, 255, 255, .4);
            text-decoration: none
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #0d1b3e;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .25);
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            transform: translateY(10px);
            transition: all .3s;
            pointer-events: none;
            max-width: 320px
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0)
        }

        .toast svg {
            width: 15px;
            height: 15px;
            stroke: #f5a623;
            fill: none;
            stroke-width: 2.5;
            flex-shrink: 0
        }

        @media(max-width:1024px) {
            .cal-grid {
                grid-template-columns: 1fr 1fr
            }

            .summary-grid {
                grid-template-columns: 1fr 1fr
            }
        }

        @media(max-width:768px) {
            .nav-links {
                display: none
            }

            .page-wrap {
                padding: 1rem
            }

            .cal-grid {
                grid-template-columns: 1fr
            }

            .summary-grid {
                grid-template-columns: 1fr
            }

            .hero {
                padding: 1.5rem 1rem
            }

            .hero h1 {
                font-size: 1.4rem
            }

            .hero-inner {
                flex-direction: column
            }

            .hero-actions {
                flex-direction: row;
                flex-wrap: wrap
            }
        }
    </style>
</head>

<body>

    @include('components.navbar')




    {{-- HERO --}}
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-left">
                <div class="hero-eyebrow">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    JEFIE Paris 2026 — 15-18 Septembre
                </div>
                <h1>Mon <span>Agenda</span></h1>
                <p class="hero-sub">Retrouvez toutes les sessions que vous avez sélectionnées.<br>Téléchargez, partagez et imprimez votre programme personnalisé.</p>
                <div class="hero-stats" id="heroStats">
                    <div class="hs">
                        <div style="width:36px;height:36px;background:rgba(245,166,35,.15);border-radius:8px;display:flex;align-items:center;justify-content:center">
                            <svg viewBox="0 0 24 24" width="18" height="18" stroke="#f5a623" fill="none" stroke-width="1.7">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                        </div>
                        <div><span class="hs-num" id="heroTotal">0</span>
                            <div class="hs-lbl">Sessions</div>
                        </div>
                    </div>
                    <div class="hs">
                        <div style="width:36px;height:36px;background:rgba(67,160,71,.15);border-radius:8px;display:flex;align-items:center;justify-content:center">
                            <svg viewBox="0 0 24 24" width="18" height="18" stroke="#43a047" fill="none" stroke-width="1.7">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div><span class="hs-num" id="heroDuree">0h</span>
                            <div class="hs-lbl">Durée totale</div>
                        </div>
                    </div>
                    <div class="hs">
                        <div style="width:36px;height:36px;background:rgba(21,101,192,.15);border-radius:8px;display:flex;align-items:center;justify-content:center">
                            <svg viewBox="0 0 24 24" width="18" height="18" stroke="#1565c0" fill="none" stroke-width="1.7">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                        </div>
                        <div><span class="hs-num" id="heroJours">0</span>
                            <div class="hs-lbl">Jours couverts</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-actions">
                <button class="btn-hero bh-gold" onclick="exportAgenda()">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                    </svg>
                    Télécharger mon agenda
                </button>
                <button class="btn-hero bh-outline" onclick="printAgenda()">
                    <svg viewBox="0 0 24 24">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                        <rect x="6" y="14" width="12" height="8" />
                    </svg>
                    Imprimer
                </button>
                <button class="btn-hero bh-outline" onclick="partagerAgenda()">
                    <svg viewBox="0 0 24 24">
                        <circle cx="18" cy="5" r="3" />
                        <circle cx="6" cy="12" r="3" />
                        <circle cx="18" cy="19" r="3" />
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                    </svg>
                    Partager
                </button>
                <button class="btn-hero bh-red" onclick="viderAgenda()">
                    <svg viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                        <path d="M10 11v6M14 11v6" />
                    </svg>
                    Vider mon agenda
                </button>
            </div>
        </div>
    </section>

    {{-- CONTENU --}}
    <div class="page-wrap">

        {{-- AGENDA VIDE --}}
        <div class="agenda-vide" id="agendaVide" style="display:none">
            <div class="av-icon"><svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg></div>
            <h2 class="av-title">Votre agenda est vide</h2>
            <p class="av-desc">Vous n'avez encore ajouté aucune session à votre agenda. Parcourez le programme et cliquez sur « Ajouter à mon agenda » pour constituer votre programme personnalisé.</p>
            <a href="{{ route('programme') }}" class="btn-go-prog">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Parcourir le programme
            </a>
        </div>

        {{-- CONTENU AGENDA --}}
        <div id="agendaContent" style="display:none">

            {{-- Alertes conflits --}}
            <div id="conflitsWrap"></div>

            {{-- Barre outils --}}
            <div class="toolbar">
                <div class="tb-info"><strong id="tbTotal">0 session(s)</strong> dans votre agenda · <span id="tbDuree">0h</span> de programme</div>
                <div class="tb-actions">
                    <div class="vue-btns">
                        <button class="vb active" id="vbListe" onclick="setVue('liste')">
                            <svg viewBox="0 0 24 24">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3.01" y2="6" />
                                <line x1="3" y1="12" x2="3.01" y2="12" />
                                <line x1="3" y1="18" x2="3.01" y2="18" />
                            </svg>
                            Liste
                        </button>
                        <button class="vb" id="vbCal" onclick="setVue('calendrier')">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                            Calendrier
                        </button>
                    </div>
                    <button class="btn-tb bt-gold" onclick="exportAgenda()">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                        </svg>
                        Télécharger
                    </button>
                    <button class="btn-tb bt-outline" onclick="printAgenda()">
                        <svg viewBox="0 0 24 24">
                            <polyline points="6 9 6 2 18 2 18 9" />
                            <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                            <rect x="6" y="14" width="12" height="8" />
                        </svg>
                        Imprimer
                    </button>
                    <a href="{{ route('programme') }}" class="btn-tb bt-outline">
                        <svg viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Ajouter des sessions
                    </a>
                    <button class="btn-tb bt-red" onclick="viderAgenda()">
                        <svg viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                        </svg>
                        Tout vider
                    </button>
                </div>
            </div>

            {{-- Filtres jours --}}
            <div class="jours-filter" id="joursFilter">
                <button class="jf active" onclick="filterJour('')" data-jour="">Tous les jours</button>
                <button class="jf" onclick="filterJour('1')" data-jour="1">Jour 1 — 15 Sept.</button>
                <button class="jf" onclick="filterJour('2')" data-jour="2">Jour 2 — 16 Sept.</button>
                <button class="jf" onclick="filterJour('3')" data-jour="3">Jour 3 — 17 Sept.</button>
                <button class="jf" onclick="filterJour('4')" data-jour="4">Jour 4 — 18 Sept.</button>
            </div>

            {{-- Résumé --}}
            <div class="summary-grid" id="summaryGrid"></div>

            {{-- Vue liste --}}
            <div id="vueListeWrap">
                <div id="sessionsParJour"></div>
            </div>

            {{-- Vue calendrier --}}
            <div id="vueCalWrap" style="display:none">
                <div class="cal-grid" id="calGrid"></div>
            </div>

            {{-- Résumé types --}}
            <div class="type-summary" id="typeSummary"></div>
        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="footer-bottom">
            <span class="footer-copy">&copy; {{ date('Y') }} JEFIE Paris 2026 — Agenda personnel</span>
            <div class="footer-legal">
                <a href="{{ route('programme') }}">Retour au programme</a>
                <a href="{{ route('inscription') }}">S'inscrire</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </footer>

    <div class="toast" id="toast"><svg viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12" />
        </svg><span id="toastMsg">Action effectuée</span></div>

    <script>
        // ══════════════════════════════════════════════════════════════
        // MON AGENDA — Lecture et affichage depuis localStorage
        // ══════════════════════════════════════════════════════════════
        const STORAGE_KEY = 'jefie_agenda_2026';

        const TYPE_COLORS = {
            conference: '#1565c0',
            panel: '#6a1b9a',
            atelier: '#2e7d32',
            networking: '#e65100',
            b2b: '#b07d10',
            pitch: '#c2185b'
        };
        const TYPE_BG = {
            conference: '#e3f2fd',
            panel: '#ede7f6',
            atelier: '#e8f5e9',
            networking: '#fff3e0',
            b2b: '#fff8e6',
            pitch: '#fce4ec'
        };
        const TYPE_LABELS = {
            conference: 'Conférence',
            panel: 'Panel',
            atelier: 'Atelier',
            networking: 'Networking',
            b2b: 'Rendez-vous B2B',
            pitch: 'Pitch entrepreneurial'
        };
        const TYPE_ICONS = {
            conference: '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/>',
            panel: '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>',
            atelier: '<path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77"/>',
            networking: '<circle cx="12" cy="12" r="10"/>',
            b2b: '<rect x="3" y="4" width="18" height="18" rx="2"/>',
            pitch: '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>',
        };
        const JOURS_INFO = {
            1: {
                label: 'Jour 1',
                date: '15 Septembre 2026',
                day: '15',
                month: 'Sept'
            },
            2: {
                label: 'Jour 2',
                date: '16 Septembre 2026',
                day: '16',
                month: 'Sept'
            },
            3: {
                label: 'Jour 3',
                date: '17 Septembre 2026',
                day: '17',
                month: 'Sept'
            },
            4: {
                label: 'Jour 4',
                date: '18 Septembre 2026',
                day: '18',
                month: 'Sept'
            },
        };

        let agenda = [];
        let vueActuelle = 'liste';
        let jourFiltre = '';

        // ── Init ───────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            agenda = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            renderPage();
        });

        // ── Render principale ──────────────────────────────────────────
        function renderPage() {
            const vide = document.getElementById('agendaVide');
            const content = document.getElementById('agendaContent');

            if (agenda.length === 0) {
                vide.style.display = 'flex';
                content.style.display = 'none';
                updateHeroStats();
                return;
            }

            vide.style.display = 'none';
            content.style.display = 'block';

            updateHeroStats();
            updateToolbarInfo();
            detectConflits();
            renderSummaryGrid();
            renderTypeSummary();
            renderSessions();
            renderCalendrier();
        }

        // ── Stats hero ─────────────────────────────────────────────────
        function updateHeroStats() {
            document.getElementById('heroTotal').textContent = agenda.length;
            document.getElementById('heroDuree').textContent = calcDuree() + 'h';
            const jours = new Set(agenda.map(s => s.jour));
            document.getElementById('heroJours').textContent = jours.size;
        }

        function updateToolbarInfo() {
            document.getElementById('tbTotal').textContent = agenda.length + ' session' + (agenda.length > 1 ? 's' : '');
            document.getElementById('tbDuree').textContent = calcDuree() + 'h de programme';
        }

        function calcDuree() {
            return agenda.reduce((acc, s) => {
                const [dh, dm] = s.heureDebut.split(':').map(Number);
                const [fh, fm] = s.heureFin.split(':').map(Number);
                return acc + (fh + fm / 60) - (dh + dm / 60);
            }, 0).toFixed(1);
        }

        // ── Détection conflits ─────────────────────────────────────────
        function detectConflits() {
            const conflits = [];
            const sorted = [...agenda].sort((a, b) => a.jour - b.jour || a.heureDebut.localeCompare(b.heureDebut));
            for (let i = 0; i < sorted.length - 1; i++) {
                const a = sorted[i],
                    b = sorted[i + 1];
                if (a.jour === b.jour && a.heureFin > b.heureDebut) {
                    conflits.push(`"${a.titre.substring(0,40)}..." chevauche "${b.titre.substring(0,40)}..."`);
                }
            }
            const wrap = document.getElementById('conflitsWrap');
            if (conflits.length > 0) {
                wrap.innerHTML = conflits.map(c => `
            <div class="conflit-warning">
                <div class="cw-icon"><svg viewBox="0 0 24 24"><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg></div>
                <div><div class="cw-title">⚠️ Conflit d'horaire détecté</div><div class="cw-desc">${c}</div></div>
            </div>`).join('');
            } else {
                wrap.innerHTML = '';
            }
        }

        // ── Résumé stats --──────────────────────────────────────────────
        function renderSummaryGrid() {
            const byType = {};
            agenda.forEach(s => {
                byType[s.type] = (byType[s.type] || 0) + 1;
            });
            const topTypes = Object.entries(byType).sort((a, b) => b[1] - a[1]).slice(0, 3);
            const jours = new Set(agenda.map(s => s.jour));

            document.getElementById('summaryGrid').innerHTML = `
        <div class="sg-card">
            <span class="sg-num">${agenda.length}</span>
            <div class="sg-lbl">Sessions sélectionnées</div>
            <div class="sg-bar" style="background:linear-gradient(90deg,#f5a623 ${Math.min(agenda.length/16*100,100)}%,#f0f4f8 0)"></div>
        </div>
        <div class="sg-card">
            <span class="sg-num">${jours.size} / 4</span>
            <div class="sg-lbl">Jours avec sessions</div>
            <div class="sg-bar" style="background:linear-gradient(90deg,#1565c0 ${jours.size/4*100}%,#f0f4f8 0)"></div>
        </div>
        <div class="sg-card">
            <span class="sg-num">${calcDuree()}h</span>
            <div class="sg-lbl">Durée totale de formation</div>
            <div class="sg-bar" style="background:linear-gradient(90deg,#2e7d32 ${Math.min(calcDuree()/48*100,100)}%,#f0f4f8 0)"></div>
        </div>`;
        }

        // ── Résumé par type ────────────────────────────────────────────
        function renderTypeSummary() {
            const byType = {};
            agenda.forEach(s => {
                byType[s.type] = (byType[s.type] || 0) + 1;
            });
            const total = agenda.length;
            const html = Object.entries(byType).sort((a, b) => b[1] - a[1]).map(([t, n]) => `
        <div class="ts-item">
            <div class="ts-dot" style="background:${TYPE_COLORS[t]||'#718096'}"></div>
            <div class="ts-label">${TYPE_LABELS[t]||t}</div>
            <div class="ts-bar-wrap"><div class="ts-bar-fill" style="width:${n/total*100}%;background:${TYPE_COLORS[t]||'#718096'}"></div></div>
            <div class="ts-count">${n} session${n>1?'s':''}</div>
        </div>`).join('');
            document.getElementById('typeSummary').innerHTML = `<div style="font-size:11px;font-weight:800;color:#0d1b3e;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.75rem;border-left:3px solid #f5a623;padding-left:8px">Répartition par type</div>${html}`;
        }

        // ── Vue Liste ──────────────────────────────────────────────────
        function renderSessions() {
            const filtered = jourFiltre ? agenda.filter(s => String(s.jour) === jourFiltre) : agenda;
            const sorted = [...filtered].sort((a, b) => a.jour - b.jour || a.heureDebut.localeCompare(b.heureDebut));

            let html = '';
            let lastJour = null;
            sorted.forEach(s => {
                const ji = JOURS_INFO[s.jour] || {
                    label: 'Jour ' + s.jour,
                    date: 'Sept. 2026',
                    day: s.jour,
                    month: 'Sept'
                };
                if (s.jour !== lastJour) {
                    if (lastJour !== null) html += '</div>';
                    const cnt = sorted.filter(x => x.jour === s.jour).length;
                    html += `
            <div class="jour-section" data-jour="${s.jour}">
                <div class="jour-header">
                    <div class="jh-date-box"><span class="jh-day">${ji.day}</span><span class="jh-month">${ji.month}</span></div>
                    <div class="jh-info"><div class="jh-title">${ji.label}</div><div class="jh-sub"><span>${ji.date}</span></div></div>
                    <span class="jh-count">${cnt} session${cnt>1?'s':''}</span>
                    <div class="jh-progress"><div class="jh-prog-fill" style="width:${cnt/4*100}%"></div></div>
                </div>
                <div>`;
                    lastJour = s.jour;
                }
                html += renderSessionCard(s);
            });
            if (lastJour !== null) html += '</div></div>';
            document.getElementById('sessionsParJour').innerHTML = html || '<div style="text-align:center;padding:3rem;color:#a0aec0;background:#fff;border-radius:12px;border:1px solid #e2e8f0">Aucune session pour ce jour.</div>';
        }

        function renderSessionCard(s) {
            const c = TYPE_COLORS[s.type] || '#718096';
            const bg = TYPE_BG[s.type] || '#f4f6fa';
            const l = TYPE_LABELS[s.type] || s.type;
            const ic = TYPE_ICONS[s.type] || '<circle cx="12" cy="12" r="10"/>';
            return `
    <div class="session-card">
        <div class="sc-heure">
            <div class="sc-h-debut">${s.heureDebut}</div>
            <div class="sc-h-sep">↓</div>
            <div class="sc-h-fin">${s.heureFin}</div>
        </div>
        <div class="sc-stripe" style="background:${c}"></div>
        <div class="sc-content">
            <div class="sc-top">
                <div class="sc-type-icon" style="background:${bg};color:${c}">
                    <svg viewBox="0 0 24 24" stroke="${c}" fill="none" stroke-width="1.7">${ic}</svg>
                </div>
                <div class="sc-meta">
                    <div class="sc-type-lbl" style="color:${c}">${l}</div>
                    <div class="sc-titre">${s.titre}</div>
                    <div class="sc-info-row">
                        <div class="sc-info-item"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>${s.heureDebut} – ${s.heureFin}</div>
                        <div class="sc-info-item"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>${s.salle}</div>
                        <div class="sc-info-item" style="background:${bg};color:${c};padding:2px 8px;border-radius:6px;font-weight:700">Jour ${s.jour}</div>
                    </div>
                </div>
            </div>
            <div class="sc-footer">
                <a href="{{ route('programme') }}" class="btn-voir-detail">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Voir les détails
                </a>
                <button class="btn-retirer" onclick="retirerSession(${s.id}, '${s.titre.replace(/'/g,"\\\'")}', '${s.type}', '${s.heureDebut}', '${s.heureFin}', '${s.salle.replace(/'/g,"\\\\'")}', ${s.jour})">
                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
                    Retirer de l'agenda
                </button>
            </div>
        </div>
    </div>`;
        }

        // ── Vue Calendrier ─────────────────────────────────────────────
        function renderCalendrier() {
            const jours = [1, 2, 3, 4];
            const html = jours.map(j => {
                const ji = JOURS_INFO[j];
                const sessions = [...agenda].filter(s => s.jour === j).sort((a, b) => a.heureDebut.localeCompare(b.heureDebut));
                const sessionsHtml = sessions.length ? sessions.map(s => {
                    const c = TYPE_COLORS[s.type] || '#718096';
                    return `<div class="cal-session" style="border-left-color:${c};background:${TYPE_BG[s.type]||'#f4f6fa'}" onclick="scrollToSession(${s.id})">
                <div class="cal-s-heure">${s.heureDebut} – ${s.heureFin}</div>
                <div class="cal-s-titre">${s.titre}</div>
            </div>`;
                }).join('') : `<div class="cal-empty">Aucune session</div>`;

                return `<div class="cal-col">
            <div class="cal-col-head">
                <div class="cal-col-jour">${ji.label}</div>
                <div class="cal-col-date">${ji.date}</div>
            </div>
            <div class="cal-col-body">${sessionsHtml}</div>
        </div>`;
            }).join('');
            document.getElementById('calGrid').innerHTML = html;
        }

        // ── Actions ────────────────────────────────────────────────────
        function retirerSession(id, titre, type, debut, fin, salle, jour) {
            agenda = agenda.filter(s => s.id !== id);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(agenda));
            showToast('Session retirée de votre agenda');
            renderPage();
        }

        function viderAgenda() {
            if (!confirm('Voulez-vous vraiment vider tout votre agenda ? Cette action est irréversible.')) return;
            agenda = [];
            localStorage.setItem(STORAGE_KEY, JSON.stringify(agenda));
            showToast('Agenda vidé');
            renderPage();
        }

        function filterJour(jour) {
            jourFiltre = jour;
            document.querySelectorAll('.jf').forEach(btn => btn.classList.toggle('active', btn.dataset.jour === jour));
            renderSessions();
        }

        function setVue(vue) {
            vueActuelle = vue;
            document.getElementById('vbListe').classList.toggle('active', vue === 'liste');
            document.getElementById('vbCal').classList.toggle('active', vue === 'calendrier');
            document.getElementById('vueListeWrap').style.display = vue === 'liste' ? '' : 'none';
            document.getElementById('vueCalWrap').style.display = vue === 'calendrier' ? '' : 'none';
        }

        // ── Export ─────────────────────────────────────────────────────
        function exportAgenda() {
            if (agenda.length === 0) {
                showToast('Votre agenda est vide');
                return;
            }
            const sorted = [...agenda].sort((a, b) => a.jour - b.jour || a.heureDebut.localeCompare(b.heureDebut));
            let txt = '╔══════════════════════════════════════════════╗\n';
            txt += '║        MON AGENDA — JEFIE PARIS 2026         ║\n';
            txt += '║     15-18 Septembre 2026 · Paris, France     ║\n';
            txt += '╚══════════════════════════════════════════════╝\n\n';
            txt += `📊 ${agenda.length} session(s) · ${calcDuree()}h de programme\n\n`;
            let lastJour = null;
            sorted.forEach(s => {
                const ji = JOURS_INFO[s.jour] || {
                    label: 'Jour ' + s.jour,
                    date: 'Sept. 2026'
                };
                if (s.jour !== lastJour) {
                    txt += `\n┌─ ${ji.label} · ${ji.date} ${'─'.repeat(20)}\n`;
                    lastJour = s.jour;
                }
                txt += `│\n│  ⏰ ${s.heureDebut} – ${s.heureFin}\n│  📌 ${s.titre}\n│  📍 ${s.salle}\n│  🏷️  ${TYPE_LABELS[s.type]||s.type}\n`;
            });
            txt += '\n└' + '─'.repeat(45) + '\n\n© JEFIE Paris 2026 · Agenda généré le ' + new Date().toLocaleDateString('fr-FR');
            const blob = new Blob([txt], {
                type: 'text/plain;charset=utf-8'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'mon-agenda-jefie-2026.txt';
            a.click();
            URL.revokeObjectURL(url);
            showToast('✅ Agenda téléchargé !');
        }

        function printAgenda() {
            window.print();
        }

        function partagerAgenda() {
            const url = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: 'Mon Agenda JEFIE 2026',
                    text: `J'ai sélectionné ${agenda.length} sessions au Forum JEFIE Paris 2026 !`,
                    url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => showToast('Lien copié dans le presse-papiers !'));
            }
        }

        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toastMsg').textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2800);
        }
    </script>
</body>

</html>