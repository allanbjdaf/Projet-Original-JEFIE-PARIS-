<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pourquoi Participer au Forum — JEFIE Paris 2026</title>
    <meta name="description" content="Découvrez pourquoi le Forum JEFIE Paris 2026 est l'événement incontournable de la diaspora gabonaise. Réseau, investissements, emploi, formation — ne manquez pas cette édition.">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #1a2744;
            background: #fff;
            overflow-x: hidden
        }

        /* NAV */
        .nav {
            background: #0d1b3e;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            position: sticky;
            top: 0;
            z-index: 500
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
            font-size: 11px;
            font-weight: 800
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center
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
            gap: 10px;
            align-items: center
        }

        .btn-back {
            color: rgba(255, 255, 255, .7);
            font-size: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid rgba(255, 255, 255, .2);
            padding: 7px 14px;
            border-radius: 5px;
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
            background: #f5a623;
            color: #0d1b3e;
            font-weight: 700;
            font-size: 13px;
            padding: 9px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity .2s
        }

        .btn-inscr:hover {
            opacity: .9
        }

        .btn-inscr svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        /* HERO */
        .hero {
            background: linear-gradient(108deg, #030812, #0d1b3e 50%, #0a2356);
            padding: 5rem 5rem 0;
            position: relative;
            overflow: hidden
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60'%3E%3Ccircle cx='30' cy='30' r='1' fill='rgba(255,255,255,0.05)'/%3E%3C/svg%3E");
            background-size: 60px 60px
        }

        .hero-glow {
            position: absolute;
            right: 5%;
            top: 10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(245, 166, 35, .07), transparent 70%);
            pointer-events: none
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            padding-bottom: 4rem
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(229, 57, 53, .15);
            border: 1px solid rgba(229, 57, 53, .3);
            color: #ef9a9a;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 20px;
            margin-bottom: 1.25rem
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
            font-size: 3.4rem;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.05;
            margin-bottom: .85rem
        }

        .hero h1 em {
            color: #f5a623;
            font-style: normal;
            display: block
        }

        .hero-desc {
            color: rgba(255, 255, 255, .65);
            font-size: 1.05rem;
            line-height: 1.75;
            max-width: 650px;
            margin: 0 auto 2.5rem
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem
        }

        .btn-cta {
            background: #f5a623;
            color: #0d1b3e;
            font-weight: 700;
            font-size: 14px;
            padding: 14px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
            border: none;
            cursor: pointer;
            font-family: inherit
        }

        .btn-cta:hover {
            opacity: .9;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 166, 35, .3)
        }

        .btn-cta svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .btn-cta-outline {
            background: transparent;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            padding: 13px 28px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid rgba(255, 255, 255, .3);
            transition: all .2s
        }

        .btn-cta-outline:hover {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .6)
        }

        .btn-cta-outline svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        /* URGENCE BANNER */
        .urgence {
            background: #e53935;
            padding: .85rem 1.5rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            flex-wrap: wrap
        }

        .urgence-icon {
            width: 26px;
            height: 26px;
            background: rgba(255, 255, 255, .2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .urgence-icon svg {
            width: 13px;
            height: 13px;
            stroke: #fff;
            fill: none;
            stroke-width: 2.5
        }

        .urgence-text {
            color: #fff;
            font-size: 13px;
            font-weight: 700
        }

        .urgence-text strong {
            text-decoration: underline
        }

        .urgence-countdown {
            display: flex;
            align-items: center;
            gap: .5rem;
            background: rgba(0, 0, 0, .2);
            padding: 5px 14px;
            border-radius: 20px
        }

        .uc-unit {
            display: flex;
            flex-direction: column;
            align-items: center
        }

        .uc-num {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 900;
            line-height: 1
        }

        .uc-lbl {
            color: rgba(255, 255, 255, .6);
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: .06em
        }

        .uc-sep {
            color: rgba(255, 255, 255, .5);
            font-size: 1rem;
            margin-bottom: 4px
        }

        .urgence-btn {
            background: #fff;
            color: #e53935;
            font-weight: 800;
            font-size: 12px;
            padding: 7px 18px;
            border-radius: 20px;
            text-decoration: none;
            transition: all .2s;
            white-space: nowrap
        }

        .urgence-btn:hover {
            background: #fce4ec
        }

        /* STATS BAR */
        .stats-bar {
            background: #fff;
            border-bottom: 1px solid #f0f4f8;
            padding: 2rem 5rem
        }

        .stats-inner {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            max-width: 1100px;
            margin: 0 auto;
            gap: 0
        }

        .stat-item {
            text-align: center;
            position: relative;
            padding: 0 1rem
        }

        .stat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: #f0f4f8
        }

        .stat-num {
            font-size: 2.4rem;
            font-weight: 900;
            color: #0d1b3e;
            display: block;
            line-height: 1
        }

        .stat-lbl {
            font-size: 11px;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: 4px
        }

        .stat-evol {
            font-size: 10px;
            color: #2e7d32;
            font-weight: 700;
            margin-top: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px
        }

        .stat-evol svg {
            width: 10px;
            height: 10px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5
        }

        /* SECTION */
        .section {
            padding: 5rem 5rem
        }

        .section-alt {
            background: #f8fafc
        }

        .section-dark {
            background: #0d1b3e
        }

        .section-gold {
            background: #f5a623
        }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #f5a623;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            margin-bottom: .75rem
        }

        .section-eyebrow svg {
            width: 12px;
            height: 12px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 900;
            color: #0d1b3e;
            line-height: 1.1;
            margin-bottom: .85rem;
            text-transform: uppercase
        }

        .section-title-w {
            color: #fff
        }

        .section-title-dark {
            color: #0d1b3e
        }

        .section-desc {
            font-size: 1rem;
            color: #718096;
            line-height: 1.75;
            max-width: 600px
        }

        .section-desc-w {
            color: rgba(255, 255, 255, .65)
        }

        .section-header {
            margin-bottom: 3.5rem
        }

        .section-header.center {
            text-align: center
        }

        .section-header.center .section-desc {
            margin: 0 auto
        }

        /* RAISONS */
        .raison-item {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            margin-bottom: 2px;
            background: #fff;
            border: 1px solid #f0f4f8;
            overflow: hidden;
            border-radius: 16px
        }

        .raison-item:nth-child(even) {
            direction: rtl
        }

        .raison-item:nth-child(even)>* {
            direction: ltr
        }

        .raison-content {
            padding: 3.5rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center
        }

        .raison-num {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: .5rem;
            opacity: .08;
            color: #0d1b3e
        }

        .raison-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 10px;
            margin-bottom: .85rem;
            width: fit-content
        }

        .raison-eyebrow svg {
            width: 11px;
            height: 11px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .raison-title {
            font-size: 1.6rem;
            font-weight: 900;
            color: #0d1b3e;
            line-height: 1.2;
            margin-bottom: .75rem;
            text-transform: uppercase
        }

        .raison-desc {
            font-size: .9rem;
            color: #718096;
            line-height: 1.7;
            margin-bottom: 1.25rem
        }

        .raison-points {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 1.5rem
        }

        .rp-item {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            color: #162552;
            font-weight: 600
        }

        .rp-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .rp-dot svg {
            width: 11px;
            height: 11px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5
        }

        .raison-stat-box {
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
            background: #f8fafc;
            border-radius: 10px;
            padding: .75rem 1.25rem;
            border-left: 3px solid
        }

        .rsb-num {
            font-size: 1.6rem;
            font-weight: 900;
            line-height: 1
        }

        .rsb-lbl {
            font-size: 11px;
            color: #718096;
            margin-top: 2px
        }

        .raison-visual {
            position: relative;
            overflow: hidden;
            min-height: 340px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .rv-bg {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .rv-icon-wrap {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative
        }

        .rv-icon-wrap::before {
            content: '';
            position: absolute;
            inset: -20px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .15);
            animation: ring-pulse 3s ease-in-out infinite
        }

        .rv-icon-wrap::after {
            content: '';
            position: absolute;
            inset: -40px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .08);
            animation: ring-pulse 3s ease-in-out infinite .5s
        }

        @keyframes ring-pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1
            }

            50% {
                transform: scale(1.05);
                opacity: .7
            }
        }

        .rv-icon-main {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .rv-icon-main svg {
            width: 40px;
            height: 40px;
            stroke: #fff;
            fill: none;
            stroke-width: 1.5
        }

        .rv-stat {
            position: absolute;
            background: #fff;
            border-radius: 10px;
            padding: .6rem .85rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .12);
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap
        }

        .rv-stat svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            flex-shrink: 0
        }

        .rv-stat-num {
            font-size: 13px;
            font-weight: 800;
            color: #0d1b3e
        }

        .rv-stat-lbl {
            font-size: 10px;
            color: #718096
        }

        /* PROFILS */
        .profils-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem
        }

        .profil-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            transition: all .3s;
            position: relative;
            overflow: hidden
        }

        .profil-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px
        }

        .profil-card:hover {
            box-shadow: 0 12px 40px rgba(13, 27, 62, .1);
            transform: translateY(-4px)
        }

        .pc-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.1rem
        }

        .pc-icon svg {
            width: 25px;
            height: 25px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.7
        }

        .pc-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0d1b3e;
            margin-bottom: .5rem
        }

        .pc-desc {
            font-size: 12px;
            color: #718096;
            line-height: 1.6;
            margin-bottom: 1rem
        }

        .pc-avantages {
            display: flex;
            flex-direction: column;
            gap: 6px
        }

        .pca-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #4a5568;
            font-weight: 600
        }

        .pca-check {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .pca-check svg {
            width: 9px;
            height: 9px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5
        }

        /* PALMARES */
        .palmares-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem
        }

        .palmares-card {
            border-radius: 16px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform .2s
        }

        .palmares-card:hover {
            transform: translateY(-4px)
        }

        .palmares-card.edition-2026 {
            background: linear-gradient(135deg, #0d1b3e, #162552);
            border: 2px solid #f5a623
        }

        .palmares-card:not(.edition-2026) {
            background: #fff;
            border: 1px solid #e2e8f0
        }

        .pc-annee {
            font-size: .85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .5rem;
            display: flex;
            align-items: center;
            gap: 7px
        }

        .pc-annee-badge {
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 8px;
            font-weight: 700
        }

        .pc-lieu {
            font-size: 12px;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 5px
        }

        .pc-lieu svg {
            width: 11px;
            height: 11px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            flex-shrink: 0
        }

        .pc-chiffres {
            display: flex;
            flex-direction: column;
            gap: .6rem
        }

        .pc-chiffre {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .4rem 0;
            border-bottom: 1px solid
        }

        .pc-chiffre:last-child {
            border-bottom: none
        }

        .pc-ch-label {
            font-size: 11px;
            font-weight: 600
        }

        .pc-ch-val {
            font-size: 13px;
            font-weight: 900
        }

        .edition-2026 .pc-annee {
            color: #f5a623
        }

        .edition-2026 .pc-lieu {
            color: rgba(255, 255, 255, .6)
        }

        .edition-2026 .pc-chiffre {
            border-bottom-color: rgba(255, 255, 255, .08)
        }

        .edition-2026 .pc-ch-label {
            color: rgba(255, 255, 255, .55)
        }

        .edition-2026 .pc-ch-val {
            color: #f5a623
        }

        .edition-en-cours {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #f5a623;
            color: #0d1b3e;
            font-size: 9px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: .06em
        }

        /* TEMOIGNAGES */
        .temoignages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3rem
        }

        .temoignage-card {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 16px;
            padding: 2rem;
            backdrop-filter: blur(5px)
        }

        .tc-stars {
            display: flex;
            gap: 3px;
            margin-bottom: .75rem
        }

        .tc-star {
            color: #f5a623;
            font-size: 14px
        }

        .tc-text {
            font-size: 13px;
            color: rgba(255, 255, 255, .8);
            line-height: 1.75;
            margin-bottom: 1.25rem;
            font-style: italic
        }

        .tc-author {
            display: flex;
            align-items: center;
            gap: .85rem
        }

        .tc-av {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 700;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, .15)
        }

        .tc-name {
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 2px
        }

        .tc-role {
            color: rgba(255, 255, 255, .55);
            font-size: 11px
        }

        .tc-pays {
            color: #f5a623;
            font-size: 10px;
            font-weight: 700;
            margin-top: 2px
        }

        /* FAQ */
        .faq-list {
            display: flex;
            flex-direction: column;
            gap: .75rem;
            max-width: 800px;
            margin: 0 auto
        }

        .faq-item {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            transition: box-shadow .2s
        }

        .faq-item.open {
            box-shadow: 0 4px 16px rgba(13, 27, 62, .08);
            border-color: #f5a623
        }

        .faq-q {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.5rem;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            color: #0d1b3e;
            gap: 1rem;
            user-select: none
        }

        .faq-q svg {
            width: 18px;
            height: 18px;
            stroke: #f5a623;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
            transition: transform .3s
        }

        .faq-item.open .faq-q svg {
            transform: rotate(45deg)
        }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease, padding .35s
        }

        .faq-item.open .faq-a {
            max-height: 200px;
            padding: 0 1.5rem 1.1rem
        }

        .faq-a p {
            font-size: 13px;
            color: #718096;
            line-height: 1.7
        }

        /* CTA FINAL */
        .cta-final {
            background: linear-gradient(108deg, #0d1b3e, #162552);
            padding: 6rem 5rem;
            text-align: center;
            position: relative;
            overflow: hidden
        }

        .cta-final::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60'%3E%3Ccircle cx='30' cy='30' r='1' fill='rgba(255,255,255,0.04)'/%3E%3C/svg%3E");
            background-size: 60px 60px
        }

        .cta-glow {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse, rgba(245, 166, 35, .08), transparent 70%);
            pointer-events: none
        }

        .cta-inner {
            position: relative;
            z-index: 1
        }

        .cta-timer-title {
            color: rgba(255, 255, 255, .6);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-bottom: .75rem
        }

        .cta-countdown {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.75rem
        }

        .cc-unit {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 12px;
            padding: .85rem 1.25rem;
            text-align: center;
            min-width: 80px
        }

        .cc-num {
            color: #f5a623;
            font-size: 2rem;
            font-weight: 900;
            display: block;
            line-height: 1
        }

        .cc-lbl {
            color: rgba(255, 255, 255, .45);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: 3px
        }

        .cc-sep {
            color: rgba(255, 255, 255, .2);
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 1rem
        }

        .cta-h {
            color: #fff;
            font-size: 2.4rem;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: .75rem
        }

        .cta-h span {
            color: #f5a623
        }

        .cta-p {
            color: rgba(255, 255, 255, .65);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 560px;
            margin: 0 auto 2.5rem
        }

        .cta-btns {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap
        }

        .btn-final-gold {
            background: #f5a623;
            color: #0d1b3e;
            font-weight: 700;
            font-size: 15px;
            padding: 16px 34px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s
        }

        .btn-final-gold:hover {
            opacity: .9;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(245, 166, 35, .3)
        }

        .btn-final-gold svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .btn-final-outline {
            background: transparent;
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid rgba(255, 255, 255, .3);
            transition: all .2s
        }

        .btn-final-outline:hover {
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .6)
        }

        .btn-final-outline svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2
        }

        .cta-garantie {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap
        }

        .cta-g-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, .5);
            font-size: 12px
        }

        .cta-g-item svg {
            width: 13px;
            height: 13px;
            stroke: #f5a623;
            fill: none;
            stroke-width: 2
        }

        /* FOOTER */
        .site-footer {
            background: #0a1428;
            color: rgba(255, 255, 255, .65);
            padding: 2.5rem 5rem 0
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .08);
            padding: 1.25rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem
        }

        .footer-copy {
            font-size: 11px;
            color: rgba(255, 255, 255, .3)
        }

        .footer-legal {
            display: flex;
            gap: 1.25rem
        }

        .footer-legal a {
            font-size: 11px;
            color: rgba(255, 255, 255, .4);
            text-decoration: none
        }

        .footer-legal a:hover {
            color: rgba(255, 255, 255, .7)
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2.5rem
        }

        .footer-logo-text {
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.3
        }

        .footer-logo-text span {
            color: #f5a623;
            display: block;
            font-size: 11px;
            font-weight: 800
        }

        .footer-brand p {
            font-size: 12px;
            line-height: 1.7;
            margin: .75rem 0
        }

        .footer-col h4 {
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: .85rem
        }

        .footer-col a {
            display: block;
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            font-size: 12px;
            margin-bottom: 5px;
            transition: color .2s
        }

        .footer-col a:hover {
            color: #fff
        }

        /* TOAST */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #0d1b3e;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 13px 20px;
            border-radius: 8px;
            box-shadow: 0 6px 28px rgba(0, 0, 0, .25);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 9px;
            opacity: 0;
            transform: translateY(10px);
            transition: all .3s;
            pointer-events: none;
            max-width: 320px;
            font-family: inherit
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0)
        }

        .toast svg {
            width: 16px;
            height: 16px;
            stroke: #f5a623;
            fill: none;
            stroke-width: 2.5;
            flex-shrink: 0
        }

        @media(max-width:1200px) {
            .section {
                padding: 3.5rem 2.5rem
            }

            .hero {
                padding: 4rem 2.5rem 0
            }

            .raison-item {
                grid-template-columns: 1fr
            }

            .raison-item:nth-child(even) {
                direction: ltr
            }

            .raison-visual {
                min-height: 220px
            }

            .profils-grid {
                grid-template-columns: 1fr 1fr
            }

            .palmares-grid {
                grid-template-columns: 1fr 1fr
            }

            .temoignages-grid {
                grid-template-columns: 1fr
            }

            .cta-final {
                padding: 4rem 2.5rem
            }

            .site-footer {
                padding: 2.5rem 2.5rem 0
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr
            }
        }

        @media(max-width:768px) {
            .nav-links {
                display: none
            }

            .hero h1 {
                font-size: 2.2rem
            }

            .stats-inner {
                grid-template-columns: 1fr 1fr
            }

            .profils-grid {
                grid-template-columns: 1fr
            }

            .palmares-grid {
                grid-template-columns: 1fr
            }

            .cta-countdown {
                gap: .5rem
            }

            .cc-unit {
                min-width: 60px;
                padding: .65rem .85rem
            }

            .cc-num {
                font-size: 1.5rem
            }

            .footer-grid {
                grid-template-columns: 1fr
            }

            .urgence {
                flex-direction: column;
                gap: .5rem
            }

            .raison-content {
                padding: 2rem
            }
        }




        /* ── FOOTER ── copier*/
        .site-footer {
            background: #0d1b3e;
            color: rgba(255, 255, 255, .7);
            padding: 2.5rem 2.5rem 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .fb p {
            font-size: 12px;
            line-height: 1.6;
            margin: .5rem 0 .75rem;
        }

        .socials {
            display: flex;
            gap: 8px;
        }

        .socials a {
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, .1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            font-size: 11px;
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
            margin-bottom: .75rem;
        }

        .fc a {
            display: block;
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            font-size: 12px;
            margin-bottom: 5px;
            transition: color .2s;
        }

        .fc a:hover {
            color: #fff;
        }

        .fci {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            font-size: 12px;
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .7);
        }

        .fci svg {
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .1);
            padding: 1rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
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

        .footer-legal a:hover {
            color: rgba(255, 255, 255, .7);
        }

        @media (max-width: 1100px) {
            .valeurs-grid {
                grid-template-columns: 1fr 1fr;
            }

            .equipe-grid {
                grid-template-columns: 1fr 1fr;
            }

            .partenaires-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .stats-bar {
                grid-template-columns: repeat(3, 1fr);
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 900px) {
            .mission-section {
                grid-template-columns: 1fr;
            }

            .tl-item {
                grid-template-columns: 1fr 36px 1fr;
                gap: 1rem;
            }

            .valeurs-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .stats-bar {
                grid-template-columns: repeat(2, 1fr);
            }

            .equipe-grid {
                grid-template-columns: 1fr;
            }

            .partenaires-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .hero h1 {
                font-size: 2rem;
            }

            .tl-item {
                grid-template-columns: 36px 1fr;
            }

            .tl-content-left {
                display: none;
            }

            .tl-content-right {
                text-align: left;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .partenaires-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-bar {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    {{-- NAV --}}

    {{-- Insertion de votre barre de navigation globale depuis les composants --}}
    @include('components.navbar')

    {{-- URGENCE BANNER --}}
    <div class="urgence">
        <div class="urgence-icon"><svg viewBox="0 0 24 24">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
            </svg></div>
        <span class="urgence-text">⚡ <strong>Les places sont limitées !</strong> Le Forum JEFIE Paris 2026 se déroule dans :</span>
        <div class="urgence-countdown">
            <div class="uc-unit"><span class="uc-num" id="uJ">32</span><span class="uc-lbl">Jours</span></div>
            <span class="uc-sep">:</span>
            <div class="uc-unit"><span class="uc-num" id="uH">15</span><span class="uc-lbl">H</span></div>
            <span class="uc-sep">:</span>
            <div class="uc-unit"><span class="uc-num" id="uM">32</span><span class="uc-lbl">Min</span></div>
            <span class="uc-sep">:</span>
            <div class="uc-unit"><span class="uc-num" id="uS">00</span><span class="uc-lbl">Sec</span></div>
        </div>
        <a href="{{ route('inscription') }}" class="urgence-btn">Réserver ma place →</a>
    </div>

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-glow"></div>
        <div class="hero-inner">
            <div class="hero-eyebrow">
                <svg viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
                À ne pas manquer — 15-18 Septembre 2026 · Paris
            </div>
            <h1>Pourquoi participer<br><em>au Forum JEFIE 2026 ?</em></h1>
            <p class="hero-desc">Le Forum International de l'Emploi de la Diaspora Gabonaise est <strong style="color:#f5a623">l'événement le plus important de l'année</strong> pour tous les entrepreneurs, talents et décideurs de la diaspora. Voici pourquoi vous ne pouvez pas vous permettre de le manquer.</p>
            <div class="hero-actions">
                <a href="{{ route('inscription') }}" class="btn-cta">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                        <line x1="19" y1="8" x2="19" y2="14" />
                        <line x1="22" y1="11" x2="16" y2="11" />
                    </svg>
                    Je m'inscris maintenant
                </a>
                <a href="{{ route('programme') }}" class="btn-cta-outline">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Voir le programme complet
                </a>
            </div>
        </div>
    </section>

    {{-- STATS BAR --}}
    <div class="stats-bar">
        <div class="stats-inner">
            @foreach([
            [($stats['inscrits'] ?? 2500).' +', 'Participants attendus', '+20% vs 2025'],
            [($stats['pays'] ?? 78), 'Pays représentés', 'Présence mondiale'],
            [($stats['investisseurs'] ?? 200).'+', 'Investisseurs présents', 'Fonds & Business Angels'],
            [($stats['rdv_b2b'] ?? 500).'+', 'RDV B2B organisés', 'Matchmaking premium'],
            ] as [$n,$l,$s])
            <div class="stat-item">
                <span class="stat-num">{{ $n }}</span>
                <div class="stat-lbl">{{ $l }}</div>
                <div class="stat-evol"><svg viewBox="0 0 24 24">
                        <polyline points="18 15 12 9 6 15" />
                    </svg>{{ $s }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- LES 6 RAISONS --}}
    <section class="section">
        <div class="section-header center">
            <div class="section-eyebrow"><svg viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>6 raisons décisives</div>
            <h2 class="section-title">Les vraies raisons de ne pas<br>manquer ce Forum</h2>
            <p class="section-desc">Chaque édition du Forum JEFIE transforme des carrières et accélère des projets. Voici concrètement ce que vous allez vivre.</p>
        </div>

        @foreach($raisons as $raison)
        <div class="raison-item" style="margin-bottom:1.5rem">
            <div class="raison-content">
                <div class="raison-num">{{ $raison['numero'] }}</div>
                <div class="raison-eyebrow" style="background:{{ $raison['bg'] }};color:{{ $raison['couleur'] }}">
                    <svg viewBox="0 0 24 24" stroke="{{ $raison['couleur'] }}" fill="none" stroke-width="2">{!! $raison['icon'] !!}</svg>
                    Raison N°{{ $raison['numero'] }}
                </div>
                <div class="raison-title">{{ $raison['titre'] }}</div>
                <p class="raison-desc">{{ $raison['desc'] }}</p>
                <div class="raison-points">
                    @foreach($raison['points'] as $pt)
                    <div class="rp-item">
                        <div class="rp-dot" style="background:{{ $raison['bg'] }};color:{{ $raison['couleur'] }}">
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        {{ $pt }}
                    </div>
                    @endforeach
                </div>
                <div class="raison-stat-box" style="border-left-color:{{ $raison['couleur'] }}">
                    <span class="rsb-num" style="color:{{ $raison['couleur'] }}">{{ $raison['stat'] }}</span>
                    <div class="rsb-lbl">{{ $raison['stat_label'] }}</div>
                </div>
            </div>
            <div class="raison-visual" style="background:linear-gradient(135deg,{{ $raison['couleur'] }}22,{{ $raison['couleur'] }}44)">
                <div class="rv-bg">
                    <div class="rv-icon-wrap" style="background:{{ $raison['couleur'] }}22">
                        <div class="rv-icon-main" style="background:{{ $raison['couleur'] }}">
                            <svg viewBox="0 0 24 24" stroke="#fff" fill="none" stroke-width="1.5">{!! $raison['icon'] !!}</svg>
                        </div>
                    </div>
                </div>
                @foreach([['top:15%','left:10%'],['top:20%','right:8%'],['bottom:20%','left:8%'],['bottom:15%','right:10%']] as $i => $pos)
                <div class="rv-stat" style="{{ $pos[0] }};{{ $pos[1] }};position:absolute">
                    <svg viewBox="0 0 24 24" style="color:{{ $raison['couleur'] }};width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:1.8">{!! $raison['icon'] !!}</svg>
                    <div>
                        <div class="rv-stat-num">{{ $raison['stat'] }}</div>
                        <div class="rv-stat-lbl">{{ $raison['stat_label'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </section>

    {{-- POUR QUI --}}
    <section class="section section-alt">
        <div class="section-header center">
            <div class="section-eyebrow"><svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87" />
                </svg>Pour qui ?</div>
            <h2 class="section-title">Le Forum s'adresse à vous,<br>quel que soit votre profil</h2>
            <p class="section-desc">Que vous soyez entrepreneur, candidat, recruteur ou investisseur, JEFIE Paris 2026 a été conçu pour répondre à vos besoins.</p>
        </div>
        <div class="profils-grid">
            @foreach($profils as $i => $profil)
            @php
            $colors = ['#f5a623','#1565c0','#2e7d32','#6a1b9a','#e65100','#c2185b'];
            $c = $colors[$i % count($colors)];
            @endphp
            <div class="profil-card" style="border-top:4px solid {{ $c }}">
                <div class="pc-icon" style="background:{{ $profil['bg'] }};color:{{ $profil['couleur'] }}">
                    <svg viewBox="0 0 24 24" stroke="{{ $profil['couleur'] }}" fill="none" stroke-width="1.7">{!! $profil['icon'] !!}</svg>
                </div>
                <div class="pc-title">{{ $profil['titre'] }}</div>
                <p class="pc-desc">{{ $profil['desc'] }}</p>
                <div class="pc-avantages">
                    @foreach($profil['avantages'] as $av)
                    <div class="pca-item">
                        <div class="pca-check" style="background:{{ $profil['bg'] }};color:{{ $profil['couleur'] }}">
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        {{ $av }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- PALMARÈS --}}
    <section class="section">
        <div class="section-header center">
            <div class="section-eyebrow"><svg viewBox="0 0 24 24">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                </svg>Bilan des éditions</div>
            <h2 class="section-title">Une croissance exponentielle<br>d'édition en édition</h2>
            <p class="section-desc">Chaque année, le Forum JEFIE grandit en ambition, en participants et en impact économique. L'édition 2026 sera la plus grande jamais organisée.</p>
        </div>
        <div class="palmares-grid">
            @foreach($palmares as $ed)
            <div class="palmares-card {{ $ed['annee'] === '2026' ? 'edition-2026' : '' }}">
                @if($ed['annee'] === '2026')
                <div class="edition-en-cours">En cours</div>
                @endif
                <div class="pc-annee" style="color:{{ $ed['annee'] === '2026' ? '#f5a623' : '#0d1b3e' }}">
                    {{ $ed['annee'] }}
                    @if($ed['annee'] === '2026')
                    <span class="pc-annee-badge" style="background:rgba(245,166,35,.2);color:#f5a623">Édition actuelle</span>
                    @endif
                </div>
                <div class="pc-lieu" style="color:{{ $ed['annee'] === '2026' ? 'rgba(255,255,255,.6)' : '#718096' }}">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    {{ $ed['lieu'] }}
                </div>
                <div class="pc-chiffres">
                    @foreach([['Inscrits',$ed['inscrits']],['Pays',$ed['pays']],['Partenariats',$ed['partenariats']],['Investissements',$ed['investissements']]] as [$l,$v])
                    <div class="pc-chiffre" style="border-bottom-color:{{ $ed['annee']==='2026' ? 'rgba(255,255,255,.08)' : '#f0f4f8' }}">
                        <span class="pc-ch-label" style="color:{{ $ed['annee']==='2026' ? 'rgba(255,255,255,.55)' : '#718096' }}">{{ $l }}</span>
                        <span class="pc-ch-val" style="color:{{ $ed['annee']==='2026' ? '#f5a623' : '#0d1b3e' }}">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- TEMOIGNAGES --}}
    <section class="section section-dark">
        <div class="section-header center">
            <div class="section-eyebrow"><svg viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                </svg>Ils témoignent</div>
            <h2 class="section-title section-title-w">Ceux qui y étaient<br>vous le disent</h2>
            <p class="section-desc section-desc-w">Des témoignages concrets de participants qui ont transformé leur participation en résultats mesurables.</p>
        </div>
        <div class="temoignages-grid">
            @foreach($temoignages as $t)
            <div class="temoignage-card">
                <div class="tc-stars">@for($i=0;$i<5;$i++)<span class="tc-star">★</span>@endfor</div>
                <p class="tc-text">"{{ $t['texte'] }}"</p>
                <div class="tc-author">
                    <div class="tc-av" style="background:linear-gradient(135deg,{{ $t['couleur'] }},{{ $t['couleur'] }}99)">{{ $t['init'] }}</div>
                    <div>
                        <div class="tc-name">{{ $t['nom'] }}</div>
                        <div class="tc-role">{{ $t['role'] }}</div>
                        <div class="tc-pays">{{ $t['pays'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- FAQ --}}
    <section class="section section-alt">
        <div class="section-header center">
            <div class="section-eyebrow"><svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>Questions fréquentes</div>
            <h2 class="section-title">Tout ce que vous voulez savoir<br>avant de vous inscrire</h2>
            <p class="section-desc">Les réponses aux questions les plus posées par les futurs participants du Forum JEFIE Paris 2026.</p>
        </div>
        <div class="faq-list">
            @foreach($faq as $i => $item)
            <div class="faq-item" id="faq-{{ $i }}">
                <div class="faq-q" onclick="toggleFaq({{ $i }})">
                    {{ $item['q'] }}
                    <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </div>
                <div class="faq-a">
                    <p>{{ $item['r'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="cta-final">
        <div class="cta-glow"></div>
        <div class="cta-inner">
            <div class="cta-timer-title">⏳ Le Forum débute dans</div>
            <div class="cta-countdown">
                <div class="cc-unit"><span class="cc-num" id="ctaJ">32</span>
                    <div class="cc-lbl">Jours</div>
                </div>
                <span class="cc-sep">:</span>
                <div class="cc-unit"><span class="cc-num" id="ctaH">15</span>
                    <div class="cc-lbl">Heures</div>
                </div>
                <span class="cc-sep">:</span>
                <div class="cc-unit"><span class="cc-num" id="ctaM">32</span>
                    <div class="cc-lbl">Min</div>
                </div>
                <span class="cc-sep">:</span>
                <div class="cc-unit"><span class="cc-num" id="ctaS">00</span>
                    <div class="cc-lbl">Sec</div>
                </div>
            </div>
            <h2 class="cta-h">Ne manquez pas <span>JEFIE 2026</span></h2>
            <p class="cta-p">Des milliers d'entrepreneurs, investisseurs et décideurs vous attendent à Paris. Chaque jour sans s'inscrire, c'est une opportunité que quelqu'un d'autre saisit à votre place.</p>
            <div class="cta-btns">
                <a href="{{ route('inscription') }}" class="btn-final-gold">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                        <line x1="19" y1="8" x2="19" y2="14" />
                        <line x1="22" y1="11" x2="16" y2="11" />
                    </svg>
                    S'inscrire maintenant — C'est gratuit
                </a>
                <a href="{{ route('programme') }}" class="btn-final-outline">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Consulter le programme
                </a>
                <a href="{{ route('contact') }}" class="btn-final-outline">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    Nous contacter
                </a>
            </div>
            <div class="cta-garantie">
                @foreach(['Inscription gratuite','Sans engagement','Annulation possible','Données sécurisées RGPD'] as $g)
                <div class="cta-g-item"><svg viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>{{ $g }}</div>
                @endforeach
            </div>
        </div>
    </section>


    <footer class="site-footer">
        <div class="footer-grid">
            <div class="fb">
                <a href="http://127.0.0.1:8000" class="nav-logo" style="margin-bottom:.4rem">
                    <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                        <img src="http://127.0.0.1:8000/images/264.png"
                            alt="Logo JEFIE Paris 2026"
                            style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                    </div>
                    <div class="nav-logo-text" style="color:#fff"><span>Forum International</span>de l'Innovation<br><small>2026</small></div>
                </a>
                <p>Le rendez-vous mondial des décideurs, innovateurs et entrepreneurs engagés pour un avenir durable.</p>
                <nav class="socials">
                    <a href="#" aria-label="Facebook">f</a>
                    <a href="#" aria-label="LinkedIn">in</a>
                    <a href="#" aria-label="Twitter">&#120143;</a>
                    <a href="#" aria-label="YouTube">&#9654;</a>
                    <a href="#" aria-label="Instagram">&#9752;</a>
                </nav>
            </div>
            <div class="fc">
                <h4>Navigation</h4>
                <a href="http://127.0.0.1:8000">Accueil</a>
                <a href="http://127.0.0.1:8000/programme">Programme</a>
                <a href="http://127.0.0.1:8000/institutionnel">Institutionnel</a>
                <a href="http://127.0.0.1:8000/partenaires">Partenaires</a>
                <a href="http://127.0.0.1:8000/actualites">Actualités</a>
                <a href="http://127.0.0.1:8000/a-propos">À propos</a>
            </div>
            <div class="fc">
                <h4>Participer</h4>
                <a href="http://127.0.0.1:8000/inscription">S'inscrire</a>
                <a href="http://127.0.0.1:8000/partenaires/devenir">Devenir partenaire</a>
                <a href="http://127.0.0.1:8000/emploi">Emploi &amp; Recrutement</a>
                <a href="http://127.0.0.1:8000/cartographie">Cartographie Diaspora</a>
                <a href="http://127.0.0.1:8000/faq">FAQ</a>
            </div>
            <div class="fc">
                <h4>Contact</h4>
                <div class="fci">
                    <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="M2 7l10 7 10-7" />
                    </svg>
                    contact@forum-innovation.org
                </div>
                <div class="fci">
                    <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81" />
                    </svg>
                    +221 33 123 45 67
                </div>
                <div class="fci">
                    <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Paris, France &amp; Dakar, Sénégal
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span class="footer-copy">&copy; 2026 Forum International de l'Innovation. Tous droits réservés.</span>
            <div class="footer-legal">
                <a href="http://127.0.0.1:8000/mentions-legales">Mentions légales</a>
                <a href="http://127.0.0.1:8000/confidentialite">Confidentialité</a>
                <a href="http://127.0.0.1:8000/conditions">CGU</a>
            </div>
        </div>
    </footer>




    <script>
        // Countdown universel
        function countdown() {
            const target = new Date('2026-09-15T09:00:00').getTime();
            const now = Date.now();
            const diff = Math.max(0, target - now);
            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            const pad = n => String(n).padStart(2, '0');
            ['uJ', 'ctaJ'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = pad(d);
            });
            ['uH', 'ctaH'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = pad(h);
            });
            ['uM', 'ctaM'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = pad(m);
            });
            ['uS', 'ctaS'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = pad(s);
            });
        }
        countdown();
        setInterval(countdown, 1000);

        // FAQ toggle
        function toggleFaq(i) {
            const item = document.getElementById('faq-' + i);
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        // Toast
        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toastMsg').textContent = msg;
            t.classList.add('show');
            clearTimeout(t._t);
            t._t = setTimeout(() => t.classList.remove('show'), 3000);
        }
    </script>
</body>

</html>