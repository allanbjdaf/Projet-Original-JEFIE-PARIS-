{{-- resources/views/programme/index.blade.php --}}
@extends('layouts.app')

@section('title', 'JEFIE PARIS 2026')

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

    /* ── NAV ── */
    .nav {
        background: #0d1b3e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .nav-logo-icon {
        width: 42px;
        height: 42px;
        border: 2px solid #f5a623;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        color: #f5a623;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5a623;
        font-size: 9px;
        font-weight: 700;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .75);
        font-size: 13px;
        text-decoration: none;
        white-space: nowrap;
        transition: color .2s;
    }

    .nav-links a:hover {
        color: #fff;
    }

    .nav-links a.active {
        color: #fff;
        border-bottom: 2px solid #f5a623;
        padding-bottom: 2px;
        font-weight: 600;
    }

    .nav-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 22px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .nav-btn:hover {
        opacity: .9;
    }

    .nav-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── LANGUAGE SWITCHER ── */
    * Styles optionnels pour que le sélecteur de langue et le bouton s'alignent parfaitement en hauteur */
 .lang-switcher {
        position: relative;
        display: inline-block;
    }

    .lang-btn,
    .nav-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 5px;
        padding: 7px 12px;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        font-family: inherit;
    }

    .lang-btn:hover {
        background: rgba(255, 255, 255, .14);
    }

    .lang-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .lang-flag {
        font-size: 14px;
        line-height: 1;
    }

    .lang-dropdown {
        display: none;
        /* Caché par défaut */
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        background: #ffffff;
        /* Ou couleur sombre selon votre thème */
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        min-width: 150px;
        z-index: 1000;
    }

    .lang-switcher:hover .lang-dropdown,
    .lang-dropdown.open {
        display: block;
    }

    .lang-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 1rem;
        color: #333;
        text-decoration: none;
        transition: background 0.2s;
    }

    .lang-item:last-child {
        border-bottom: none;
    }

    .lang-item:hover {
        background: #f4f4f4;
    }

    .lang-item.active {
        font-weight: bold;
    }

    .lang-item.active .lang-item-flag {
        filter: brightness(1);
    }

    .lang-item-flag {
        font-size: 16px;
        flex-shrink: 0;
    }

    .lang-item-name {
        font-weight: 400;
    }

    .lang-item-code {
        color: #888888;
        /* Remplacez par le code gris de votre choix, ex: #6b7280 */
        font-size: 0.75rem;
        font-weight: 500;
    }

    .lang-item.active .lang-item-code {
        color: #888888;
        ;
    }

    .lang-check {
        margin-left: auto;
    }

    .lang-check svg {
        width: 14px;
        height: 14px;
        fill: none;
        stroke-width: 2.5;
    }


    /* ── HERO ── */
    .hero {
        background: linear-gradient(105deg, #060e20 0%, #0d1b3e 50%, #0f2a5e 100%);
        padding: 2.5rem 2rem !important;
        position: relative;
        overflow: hidden;
        min-height: 280px;
        display: flex;
        align-items: center;
        gap: 2rem;
        min-height: auto !important;
    }

    .hero::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 45%;
        height: 100%;
        background: url('/images/institutionnel.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        pointer-events: none;
    }

    .hero-left {
        position: relative;
        z-index: 2;
        max-width: 520px;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(245, 166, 35, .12);
        border: 1px solid rgba(245, 166, 35, .3);
        color: #f5a623;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 3px;
        margin-bottom: 1rem;
    }

    .hero-left h1 {
        color: #fff;
        font-size: 2.2rem !important;
        font-weight: 900;
        letter-spacing: -.02em;
        text-transform: uppercase;
        line-height: 1.05;
        margin-bottom: .5rem;

    }

    .hero-tagline {
        color: #f5a623;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: .75rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .88rem;
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 22px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .btn-gold:hover {
        opacity: .9;
    }

    .btn-outline-w {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 20px;
        border-radius: 5px;
        border: 1.5px solid rgba(255, 255, 255, .35);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: background .2s;
    }

    .btn-outline-w:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-gold svg,
    .btn-outline-w svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        flex-shrink: 0;
    }

    /* Dots slider */
    .hero-dots {
        display: flex;
        gap: 8px;
        margin-top: 1.5rem;
    }

    .hero-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .35);
        cursor: pointer;
        border: none;
        padding: 0;
        transition: background .2s;
    }

    .hero-dot.active {
        background: #f5a623;
    }

    /* ── COUNTDOWN + ACCÈS RAPIDES ── */
    .info-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .countdown-block {
        padding: 1.5rem 2.5rem;
        border-right: 1px solid #e2e8f0;
    }

    .countdown-label {
        font-size: 11px;
        font-weight: 800;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .countdown-units {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .cu {
        text-align: center;
    }

    .cu-num {
        font-size: 2.4rem;
        font-weight: 900;
        color: #0d1b3e;
        display: block;
        line-height: 1;
    }

    .cu-lbl {
        font-size: 10px;
        color: #718096;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-top: 4px;
    }

    .cu-sep {
        font-size: 2rem;
        font-weight: 900;
        color: #d1d9e6;
        align-self: flex-start;
        margin-top: 2px;
    }

    .accès-rapides-block {
        padding: 1.5rem 2.5rem;
    }

    .ar-label {
        font-size: 11px;
        font-weight: 800;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .ar-list {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .ar-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        text-decoration: none;
        transition: transform .2s;
    }

    .ar-item:hover {
        transform: translateY(-2px);
    }

    .ar-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ar-icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .ar-lbl {
        font-size: 11px;
        color: #4a5568;
        font-weight: 600;
        text-align: center;
    }

    /* ── FILTRES ── */
    .filters-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        padding: 1.25rem 2.5rem;
    }

    .filters-title {
        font-size: 12px;
        font-weight: 800;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: .9rem;
    }

    .filters-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr auto;
        gap: 12px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .filter-group label {
        font-size: 11px;
        font-weight: 600;
        color: #718096;
    }

    .filter-select {
        padding: 9px 30px 9px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        color: #1a2744;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 9px center;
        background-size: 14px;
        cursor: pointer;
        width: 100%;
    }

    .filter-search-btn {
        background: #0d1b3e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
        white-space: nowrap;
    }

    .filter-search-btn:hover {
        background: #162552;
    }

    .filter-search-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── PROGRAMME LAYOUT ── */
    .programme-layout {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 0;
        padding: 2rem 2.5rem;
        background: #f4f6fa;
        align-items: start;
    }

    /* Onglets jours */
    .jours-tabs {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .jours-list {
        display: flex;
        gap: 4px;
    }

    .jour-tab {
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
        border: none;
        background: #fff;
        color: #4a5568;
        border: 1px solid #e2e8f0;
    }

    .jour-tab:hover {
        background: #f4f6fa;
    }

    .jour-tab.active {
        background: #0d1b3e;
        color: #fff;
        border-color: #0d1b3e;
    }

    .jour-tab .jour-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
    }

    .jour-tab .jour-date {
        display: block;
        font-size: 10px;
        opacity: .7;
        margin-top: 1px;
    }

    .vue-btns {
        display: flex;
        gap: 8px;
    }

    .vue-btn {
        padding: 9px 16px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all .2s;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #162552;
    }

    .vue-btn.active {
        background: #0d1b3e;
        color: #fff;
        border-color: #0d1b3e;
    }

    .vue-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Timeline activités */
    .timeline {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .timeline-item {
        display: flex;
        gap: 1.25rem;
        position: relative;
    }

    .timeline-time {
        width: 70px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        padding-top: 1.25rem;
    }

    .timeline-time .t-start {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
    }

    .timeline-time .t-end {
        font-size: 11px;
        color: #a0aec0;
        margin-top: 2px;
    }

    .timeline-connector {
        width: 24px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 1.4rem;
    }

    .tc-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px currentColor;
    }

    .tc-line {
        width: 2px;
        flex: 1;
        background: #e2e8f0;
        margin-top: 4px;
    }

    .timeline-item:last-child .tc-line {
        display: none;
    }

    .activity-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        transition: box-shadow .2s;
    }

    .activity-card:hover {
        box-shadow: 0 2px 12px rgba(13, 27, 62, .08);
    }

    .activity-icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-icon-wrap svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .activity-body {
        flex: 1;
        min-width: 0;
    }

    .activity-type {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .07em;
        text-transform: uppercase;
        margin-bottom: 3px;
    }

    .activity-title {
        font-size: 14px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .activity-loc {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #718096;
    }

    .activity-loc svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .activity-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 8px;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .intervenant-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .interv-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d1b3e, #162552);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #e2e8f0;
    }

    .interv-avatar img {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
    }

    .interv-plus {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #eef2ff;
        border: 2px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: #162552;
    }

    .interv-info-name {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
    }

    .interv-info-role {
        font-size: 11px;
        color: #718096;
    }

    .places-badge {
        font-size: 11px;
        font-weight: 700;
        color: #e65100;
        background: #fff3e0;
        padding: 3px 10px;
        border-radius: 4px;
    }

    .activity-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: stretch;
        min-width: 160px;
        flex-shrink: 0;
    }

    .act-btn {
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        transition: all .2s;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #162552;
        white-space: nowrap;
    }

    .act-btn:hover {
        border-color: #0d1b3e;
    }

    .act-btn svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .act-btn.agenda {
        border-color: #f5a623;
        color: #0d1b3e;
    }

    .act-btn.rdv {
        border-color: #e91e63;
        color: #e91e63;
    }

    .act-btn.pitch {
        border-color: #c62828;
        color: #c62828;
    }

    /* Charger plus */
    .load-more {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 1rem;
    }

    .load-more-btn {
        background: #fff;
        border: 1px solid #d1d9e6;
        color: #162552;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 24px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
    }

    .load-more-btn:hover {
        background: #f4f6fa;
    }

    .load-more-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── SIDEBAR DROITE À NE PAS MANQUER ── */
    .right-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 80px;
    }

    .rs-title {
        font-size: 12px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .ane-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        gap: 10px;
        padding: .85rem;
        transition: box-shadow .2s;
    }

    .ane-card:hover {
        box-shadow: 0 2px 10px rgba(13, 27, 62, .07);
    }

    .ane-photo {
        width: 60px;
        height: 52px;
        border-radius: 6px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0d1b3e, #162552);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ane-photo img {
        width: 60px;
        height: 52px;
        object-fit: cover;
        display: block;
    }

    .ane-photo-placeholder svg {
        width: 24px;
        height: 24px;
        stroke: rgba(255, 255, 255, .2);
        fill: none;
        stroke-width: 1.2;
    }

    .ane-info {
        flex: 1;
        min-width: 0;
    }

    .ane-date {
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .ane-title {
        font-size: 12px;
        font-weight: 700;
        color: #162552;
        line-height: 1.35;
        margin-bottom: 5px;
    }

    .ane-salle {
        font-size: 11px;
        color: #718096;
        margin-bottom: 5px;
    }

    .ane-detail-btn {
        font-size: 11px;
        font-weight: 700;
        color: #162552;
        background: #f4f6fa;
        border: none;
        border-radius: 4px;
        padding: 4px 10px;
        cursor: pointer;
        transition: background .2s;
    }

    .ane-detail-btn:hover {
        background: #e2e8f0;
    }

    /* ── CTA PARTICIPER ── */
    .cta-participer {
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.5rem 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin: 0 2.5rem;
    }

    .cta-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cta-icon {
        width: 48px;
        height: 48px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cta-icon svg {
        width: 24px;
        height: 24px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.6;
    }

    .cta-title {
        font-size: 14px;
        font-weight: 800;
        color: #0d1b3e;
        margin-bottom: 3px;
    }

    .cta-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.45;
    }

    .cta-btns {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .cta-btn-primary {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 22px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .cta-btn-primary:hover {
        opacity: .9;
    }

    .cta-btn-primary svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .cta-btn-outline {
        background: transparent;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 20px;
        border-radius: 5px;
        border: 1.5px solid #d1d9e6;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: border-color .2s;
    }

    .cta-btn-outline:hover {
        border-color: #0d1b3e;
    }

    .cta-btn-outline svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── NEWSLETTER ── */
    .newsletter-bar {
        background: #fff;
        border-top: 1px solid #e2e8f0;
        padding: 1.5rem 2.5rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .nl-icon {
        width: 48px;
        height: 48px;
        background: #eef2ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nl-icon svg {
        width: 22px;
        height: 22px;
        stroke: #162552;
        fill: none;
        stroke-width: 1.8;
    }

    .nl-text p {
        font-size: 14px;
        font-weight: 700;
        color: #0d1b3e;
        margin-bottom: 2px;
    }

    .nl-text span {
        font-size: 12px;
        color: #718096;
    }

    .nl-form {
        display: flex;
        gap: 8px;
        margin-left: auto;
    }

    .nl-form input {
        padding: 10px 16px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 13px;
        outline: none;
        min-width: 240px;
        color: #1a2744;
    }

    .nl-form input::placeholder {
        color: #a0aec0;
    }

    .nl-form button {
        background: #0d1b3e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: background .2s;
        white-space: nowrap;
    }

    .nl-form button:hover {
        background: #162552;
    }

    .nl-form button svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }



    .hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 4rem 2.5rem 3.5rem;
        min-height: auto;
        gap: 40px;
        color: #ffffff;

        /* EFFET MAQUETTE : Assombrissement et calage de l'image de fond */
        background-color: rgba(4, 13, 29, 0.88);
        /* Teinte bleu nuit de la maquette */
        background-blend-mode: overlay;
        /* Fusionne le bleu avec la photo de la conférence */
        background-size: cover;
        /* Étire l'image sur toute la largeur sans déformation */
        background-position: center center;
        /* Centre parfaitement la scène lumineuse */
        background-repeat: no-repeat;
    }




    /* Alignement en ligne de tous les éléments de l'intervenant */
    .intervenant-row {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    /* Style de base pour chaque avatar circulaire */
    .interv-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        /* Bordure blanche pour séparer les visages */
        margin-right: -10px;
        /* Crée l'effet de chevauchement de la maquette */
        position: relative;
        z-index: 1;
    }

    /* L'avatar principal reste au-dessus au niveau des calques */
    .main-avatar {
        z-index: 2;
    }

    /* Bulle indiquant le nombre d'intervenants restants (+2) */
    .interv-plus {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: #edf2f7;
        color: #4a5568;
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
        margin-right: 15px;
        /* Décale le groupe de texte qui suit */
        z-index: 0;
    }

    /* Groupe de texte (Nom + Rôle) */
    .interv-text-group {
        margin-left: 10px;
        /* S'applique si aucune bulle "+X" n'est présente pour aérer */
    }

    .interv-info-name {
        font-weight: 700;
        font-size: 0.9rem;
        color: #1a202c;
    }

    .interv-info-role {
        font-size: 0.75rem;
        color: #718096;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0d1b3e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr 1.2fr;
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

    .footer-nl-form {
        display: flex;
        gap: 6px;
        margin-top: 8px;
    }

    .footer-nl-form input {
        flex: 1;
        padding: 9px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .07);
        color: #fff;
        font-size: 12px;
        outline: none;
    }

    .footer-nl-form input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .footer-nl-form button {
        background: #f5a623;
        border: none;
        border-radius: 5px;
        width: 38px;
        height: 38px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: opacity .2s;
    }

    .footer-nl-form button:hover {
        opacity: .9;
    }

    .footer-nl-form button svg {
        width: 15px;
        height: 15px;
        stroke: #0d1b3e;
        fill: none;
        stroke-width: 2;
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
        transition: color .2s;
    }

    .footer-legal a:hover {
        color: rgba(255, 255, 255, .7);
    }

    @media (max-width:1100px) {
        .programme-layout {
            grid-template-columns: 1fr;
        }

        .right-sidebar {
            display: none;
        }

        .filters-row {
            grid-template-columns: 1fr 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .info-bar {
            grid-template-columns: 1fr;
        }

        .jours-tabs {
            flex-direction: column;
            gap: .75rem;
            align-items: flex-start;
        }

        .jours-list {
            flex-wrap: wrap;
        }

        .filters-row {
            grid-template-columns: 1fr;
        }

        .hero-left h1 {
            font-size: 2rem;
        }

        .cta-participer,
        .newsletter-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .nl-form {
            width: 100%;
        }

        .nl-form input {
            flex: 1;
            min-width: 0;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


{{-- ══ HERO ══ --}}
<section class="hero hero-compact" style="background-image: url('{{ asset('images/institutionnel.jpg') }}'); min-height: auto; padding: 4rem 2.5rem 3.5rem;">
    <div class="hero-left" style="max-width: 600px;">
        <div class="hero-eyebrow" style="margin-bottom: 0.5rem; font-size: 0.85rem;">
            <svg width="12" height="12" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            15 – 18 septembre 2026 · Dakar
        </div>
        <h1 style="font-size: 2.6rem; font-weight: 900; text-transform: uppercase; letter-spacing: -.02em; line-height: 1.05; margin-bottom: 0.6rem; color: #fff;">Programme<br>Officiel</h1>
        <p class="hero-tagline" style="font-size: 1rem; margin-bottom: 0.5rem;">Découvrez toutes les activités du Forum</p>
        <p class="hero-desc" style="font-size: 0.9rem; margin-bottom: 1.25rem;">
            Conférences, panels, ateliers, networking, B2B et pitchs entrepreneuriaux :
            construisons ensemble l'avenir.
        </p>
        <div class="hero-actions">
            <a href="#programme-section" class="btn-gold">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Consulter l'agenda
            </a>
            <a href="{{ route('rapports') }}" class="btn-outline-w">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3" />
                </svg>
                Télécharger le programme PDF
            </a>
        </div>
        <div class="hero-dots" aria-label="Diaporama" style="margin-top: 1rem;">
            <button class="hero-dot active" aria-label="Slide 1" aria-current="true"></button>
            <button class="hero-dot" aria-label="Slide 2"></button>
            <button class="hero-dot" aria-label="Slide 3"></button>
        </div>
    </div>
</section>

{{-- ══ COUNTDOWN + ACCÈS RAPIDES ══ --}}
<div class="info-bar">
    <div class="countdown-block">
        <div class="countdown-label">Le Forum Débute Dans</div>
        <div class="countdown-units" id="countdown" aria-live="polite" aria-label="Compte à rebours">
            <div class="cu"><span class="cu-num" id="cd-days">120</span>
                <div class="cu-lbl">Jours</div>
            </div>
            <span class="cu-sep" aria-hidden="true">:</span>
            <div class="cu"><span class="cu-num" id="cd-hours">08</span>
                <div class="cu-lbl">Heures</div>
            </div>
            <span class="cu-sep" aria-hidden="true">:</span>
            <div class="cu"><span class="cu-num" id="cd-mins">35</span>
                <div class="cu-lbl">Minutes</div>
            </div>
            <span class="cu-sep" aria-hidden="true">:</span>
            <div class="cu"><span class="cu-num" id="cd-secs">15</span>
                <div class="cu-lbl">Secondes</div>
            </div>
        </div>
    </div>
    @php
    // Sécurité : Si le cache bloque ou si la variable est absente, on va chercher directement la méthode du contrôleur
    if (!isset($accesRapides)) {
    $accesRapides = (new \App\Http\Controllers\ProgrammeController())->index(request())->getData()['accesRapides']
    ?? (new \App\Http\Controllers\ProgrammeController())->index(request())->getData()['acceesRapides']
    ?? [];
    }
    @endphp
    <div class="accès-rapides-block">
        <div class="ar-label">Accès Rapides</div>
        <div class="ar-list">
            @foreach ($accesRapides as $ar)
            @php $arIconBg = $ar['color'] . '18'; $arColor = $ar['color']; @endphp
            <a href="#" class="ar-item" aria-label="{{ $ar['label'] }}">
                <div class="ar-icon" style="background:<?php echo $arIconBg; ?>">
                    <svg viewBox="0 0 24 24" style="stroke:<?php echo $arColor; ?>" aria-hidden="true">{!! $ar['icon'] !!}</svg>
                </div>
                <span class="ar-lbl">{{ $ar['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ══ FILTRES ══ --}}
<div class="filters-bar">
    <div class="filters-title">Filtrer le Programme</div>
    <form action="{{ route('programme') }}" method="GET">
        <div class="filters-row">
            <div class="filter-group">
                <label for="f-date">Date</label>
                <select id="f-date" name="date" class="filter-select">
                    <option value="">Tous les jours</option>
                    @foreach ($jours as $j)
                    <option value="{{ $j['num'] }}" {{ request('date') == $j['num'] ? 'selected' : '' }}>
                        {{ $j['label'] }} – {{ $j['date'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="f-thematique">Thématique</label>
                <select id="f-thematique" name="thematique" class="filter-select">
                    <option value="">Toutes les thématiques</option>
                    @foreach ($thematiques as $t)
                    <option value="{{ $t }}" {{ request('thematique') === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="f-intervenant">Intervenant</label>
                <select id="f-intervenant" name="intervenant" class="filter-select">
                    <option value="">Tous les intervenants</option>
                    @foreach ($intervenants as $i)
                    <option value="{{ $i }}" {{ request('intervenant') === $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="f-format">Format</label>
                <select id="f-format" name="format" class="filter-select">
                    <option value="">Tous les formats</option>
                    @foreach ($formats as $f)
                    <option value="{{ $f }}" {{ request('format') === $f ? 'selected' : '' }}>{{ $f }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="filter-search-btn">
                Rechercher
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
            </button>
        </div>
    </form>
</div>

{{-- ══ PROGRAMME + SIDEBAR ══ --}}
<div class="programme-layout" id="programme-section">

    {{-- Programme principal --}}
    <div>
        {{-- Onglets jours + vues --}}
        <div class="jours-tabs">
            <div class="jours-list" role="tablist">
                @foreach ($jours as $j)
                <a href="{{ route('programme', ['jour' => $j['num']]) }}"
                    class="jour-tab {{ $jourActif === $j['num'] ? 'active' : '' }}"
                    role="tab"
                    aria-selected="{{ $jourActif === $j['num'] ? 'true' : 'false' }}">
                    <span class="jour-label">{{ $j['label'] }}</span>
                    <span class="jour-date">{{ $j['date'] }}</span>
                </a>
                @endforeach
            </div>
            <div class="vue-btns">
                <button class="vue-btn active" type="button" aria-pressed="true">
                    <svg viewBox="0 0 24 24">
                        <line x1="8" y1="6" x2="21" y2="6" />
                        <line x1="8" y1="12" x2="21" y2="12" />
                        <line x1="8" y1="18" x2="21" y2="18" />
                        <line x1="3" y1="6" x2="3.01" y2="6" />
                        <line x1="3" y1="12" x2="3.01" y2="12" />
                        <line x1="3" y1="18" x2="3.01" y2="18" />
                    </svg>
                    Vue agenda
                </button>
                <button class="vue-btn" type="button">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Vue calendrier
                </button>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="timeline" role="list" aria-label="Activités du programme">
            @forelse ($activites as $act)
            @php
            $actDotColor = $act['couleur'];
            $actIconBg = $act['bg'];
            $actTypeColor = $act['couleur'];
            @endphp
            <div class="timeline-item" role="listitem">
                <div class="timeline-time">
                    <span class="t-start">{{ $act['heure_debut'] }}</span>
                    <span class="t-end">{{ $act['heure_fin'] }}</span>
                </div>
                <div class="timeline-connector">
                    <div class="tc-dot" style="color:<?php echo $actDotColor; ?>"></div>
                    <div class="tc-line"></div>
                </div>
                <div class="activity-card">
                    <div class="activity-icon-wrap" style="background:<?php echo $actIconBg; ?>;color:<?php echo $actTypeColor; ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $act['icon'] !!}</svg>
                    </div>
                    <div class="activity-body">
                        <div class="activity-type" style="color:<?php echo $actTypeColor; ?>">{{ $act['type_label'] }}</div>
                        <div class="activity-title">{{ $act['titre'] }}</div>
                        <div class="activity-loc">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $act['salle'] }}
                        </div>
                        <div class="activity-meta">
                            <div class="intervenant-row">

                                {{-- CAS 1 : Si un intervenant principal est défini (ex: Pr. Amadou KONÉ) --}}
                                @if (!empty($act['intervenant_nom']))
                                @if(!empty($act['photo']))
                                <img class="interv-avatar main-avatar" src="{{ asset('images/' . $act['photo']) }}" alt="{{ $act['intervenant_nom'] }}">
                                @endif

                                @if(!empty($act['intervenants']))
                                @foreach(array_slice($act['intervenants'], 0, 2) as $interv)
                                <img class="interv-avatar" src="{{ asset('images/' . $interv['photo']) }}" alt="{{ $interv['nom'] }}">
                                @endforeach
                                @endif

                                {{-- CAS 2 : Si c'est un Panel (Pas de leader, on liste les photos du tableau directement) --}}
                                @elseif(!empty($act['intervenants']))
                                @foreach(array_slice($act['intervenants'], 0, 3) as $interv)
                                <img class="interv-avatar" src="{{ asset('images/' . $interv['photo']) }}" alt="{{ $interv['nom'] }}" title="{{ $interv['nom'] }}">
                                @endforeach
                                @endif

                                {{-- COMPTEUR DE BULLES (+X) --}}
                                {{-- Calcule le reste par rapport au nombre total déclaré ou au tableau --}}
                                @if(isset($act['nb_intervenants']) && $act['nb_intervenants'] > 3)
                                <div class="interv-plus">+{{ $act['nb_intervenants'] - 3 }}</div>
                                @elseif(!empty($act['intervenants']) && count($act['intervenants']) > 3)
                                <div class="interv-plus">+{{ count($act['intervenants']) - 3 }}</div>
                                @endif

                                {{-- LIBELLÉ GLOBAL DU PANEL (Affiche le texte à droite des bulles) --}}
                                <div class="interv-text-group">
                                    @if (!empty($act['intervenant_nom']))
                                    <div class="interv-info-name">{{ $act['intervenant_nom'] }}</div>
                                    <div class="interv-info-role">{{ $act['intervenant_role'] }}</div>
                                    @elseif(!empty($act['intervenants']))
                                    <div class="interv-info-name">{{ count($act['intervenants']) }} intervenants</div>
                                    @endif
                                </div>

                            </div>

                            {{-- Badge des places limitées --}}
                            @if ($act['places_restantes'] !== null)
                            <div class="places-badge">
                                Places limitées · {{ $act['places_restantes'] }}/{{ $act['places_total'] }} places
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="activity-actions">
                        <button class="act-btn agenda" type="button">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                            Ajouter à mon agenda
                        </button>
                        @if ($act['type'] === 'b2b' || $act['type'] === 'networking')
                        <button class="act-btn rdv" type="button">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                            </svg>
                            Planifier un RDV
                        </button>
                        @endif
                        @if ($act['type'] === 'pitch')
                        <button class="act-btn pitch" type="button">
                            <svg viewBox="0 0 24 24">
                                <polygon points="23 7 16 12 23 17 23 7" />
                                <rect x="1" y="5" width="15" height="14" rx="2" />
                            </svg>
                            Soumettre mon pitch
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p style="color:#718096;font-size:13px;padding:1rem 0">Aucune activité disponible pour ce jour.</p>
            @endforelse
        </div>

        <div class="load-more">
            <button class="load-more-btn" type="button">
                Charger plus d'activités
                <svg viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Sidebar droite : À ne pas manquer --}}
    <aside class="right-sidebar" aria-label="À ne pas manquer">
        <div class="rs-title">À Ne Pas Manquer</div>
        @foreach ($aNesPasManquer as $item)
        @php $aneColor = $item['color']; @endphp
        <div class="ane-card">
            <div class="ane-photo">
                @if ($item['photo'])
                <img src="{{ asset('images/'.$item['photo']) }}" alt="{{ $item['titre'] }}">
                @else
                <div class="ane-photo-placeholder">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </div>
                @endif
            </div>
            <div class="ane-info">
                <div class="ane-date" style="color:<?php echo $aneColor; ?>">{{ $item['date'] }}</div>
                <div class="ane-title">{{ $item['titre'] }}</div>
                <div class="ane-salle">{{ $item['salle'] }}</div>
                <button class="ane-detail-btn" type="button">Détails</button>
            </div>
        </div>
        @endforeach
    </aside>

</div>{{-- /.programme-layout --}}

{{-- ══ CTA PARTICIPER ══ --}}
<div class="cta-participer">
    <div class="cta-left">
        <div class="cta-icon">
            <svg viewBox="0 0 24 24">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                <path d="M6 12v5c3 3 9 3 12 0v-5" />
            </svg>
        </div>
        <div>
            <div class="cta-title">Participez Activement au Forum</div>
            <p class="cta-desc">Inscrivez-vous dès maintenant et réservez votre place pour toutes les activités qui vous intéressent.</p>
        </div>
    </div>
    <div class="cta-btns">
        <a href="{{ route('inscription') }}" class="cta-btn-primary">
            S'inscrire maintenant
            <svg viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
            </svg>
        </a>
        <a href="{{ route('partenaires.devenir') }}" class="cta-btn-outline">
            Devenir partenaire
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
            </svg>
        </a>
    </div>
</div>

{{-- ══ NEWSLETTER ══ --}}
<div class="newsletter-bar">
    <div class="nl-icon">
        <svg viewBox="0 0 24 24">
            <rect x="2" y="4" width="20" height="16" rx="2" />
            <path d="M2 7l10 7 10-7" />
        </svg>
    </div>
    <div class="nl-text">
        <p>Recevez le Programme et les Actualités</p>
        <span>Soyez informé en avant-première de toutes les nouveautés du Forum.</span>
    </div>
    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="nl-form">
        @csrf
        <input type="email" name="email_newsletter" placeholder="Votre adresse email" required>
        <button type="submit">
            S'abonner
            <svg viewBox="0 0 24 24">
                <line x1="22" y1="2" x2="11" y2="13" />
                <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
            </svg>
        </button>
    </form>
</div>

{{-- ══ FOOTER ══ --}}
<footer class="site-footer">
    <div class="footer-grid">
        <div class="fb">
            <a href="{{ route('index') }}" class="nav-logo" style="margin-bottom:.4rem">
                <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                    <img src="http://127.0.0.1:8000/images/264.png"
                        alt="Logo JEFIE Paris 2026"
                        style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                </div>
                <div class="nav-logo-text" style="color:#fff"><span>Journées économiques et Forum international </span>de l'emploi de la diaspora Gabonaise<br><small>2026</small></div>
            </a>
            <p>Le rendez-vous mondial des décideurs, innovateurs et entrepreneurs engagés pour un avenir durable.</p>
            <nav class="socials" aria-label="Réseaux sociaux">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="Twitter">&#120143;</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
                <a href="#" aria-label="Instagram">&#9752;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Liens Rapides</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="#">Intervenants</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
        </div>
        <div class="fc">
            <h4>Participer</h4>
            <a href="{{ route('inscription') }}">S'inscrire</a>
            <a href="{{ route('partenaires.devenir') }}">Devenir partenaire</a>
            <a href="#">Soumettre un pitch</a>
            <a href="#">Planifier un RDV B2B</a>
            <a href="#">Informations pratiques</a>
            <a href="{{ route('Faq') }}">FAQ</a>
        </div>
        <div class="fc">
            <h4>Informations</h4>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>15 – 18 Juin 2026</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>Palais des Congrès<br>Abidjan, Côte d'Ivoire</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>contact@forum-innovation.org</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
                </svg>+225 01 23 45 67 89</div>
        </div>
        <div class="fc">
            <h4>Recevez nos Actualités</h4>
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <div class="footer-nl-form">
                    <input type="email" name="email_newsletter" placeholder="Votre email" required>
                    <button type="submit" aria-label="S'abonner">
                        <svg viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" fill="#0d1b3e" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} CDC site. Tous droits réservés.</span>
        <div class="footer-legal">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Confidentialité</a>
            <a href="#">CGU</a>
        </div>
    </div>
</footer>

@push('scripts')
<script>
    // Compte à rebours vers le 15 juin 2026
    (function() {
        const target = new Date('2026-06-15T09:00:00').getTime();

        function update() {
            const now = Date.now();
            const diff = Math.max(0, target - now);
            const days = Math.floor(diff / 86400000);
            const hours = Math.floor((diff % 86400000) / 3600000);
            const mins = Math.floor((diff % 3600000) / 60000);
            const secs = Math.floor((diff % 60000) / 1000);
            const pad = n => String(n).padStart(2, '0');
            const el = id => document.getElementById(id);
            if (el('cd-days')) el('cd-days').textContent = pad(days);
            if (el('cd-hours')) el('cd-hours').textContent = pad(hours);
            if (el('cd-mins')) el('cd-mins').textContent = pad(mins);
            if (el('cd-secs')) el('cd-secs').textContent = pad(secs);
        }
        update();
        setInterval(update, 1000);
    })();
</script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Définition de la date cible : 15 Septembre 2026 à 09:00:00
        const targetDate = new Date('2026-09-15T09:00:00').getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const timeDifference = targetDate - now;

            // Sélection des éléments HTML par leur ID
            const daysEl = document.getElementById('cd-days');
            const hoursEl = document.getElementById('cd-hours');
            const minsEl = document.getElementById('cd-mins');
            const secsEl = document.getElementById('cd-secs');
            const labelEl = document.querySelector('.countdown-label');

            // Si la date cible est atteinte ou passée
            if (timeDifference <= 0) {
                if (daysEl) daysEl.textContent = '00';
                if (hoursEl) hoursEl.textContent = '00';
                if (minsEl) minsEl.textContent = '00';
                if (secsEl) secsEl.textContent = '00';
                if (labelEl) labelEl.textContent = "Le Forum a débuté !";
                return;
            }

            // Calcul du temps restant
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Injection des valeurs avec un zéro initial pour le format (ex: "08" au lieu de "8")
            if (daysEl) daysEl.textContent = days < 10 ? '0' + days : days;
            if (hoursEl) hoursEl.textContent = hours < 10 ? '0' + hours : hours;
            if (minsEl) minsEl.textContent = minutes < 10 ? '0' + minutes : minutes;
            if (secsEl) secsEl.textContent = seconds < 10 ? '0' + seconds : seconds;
        }

        // Lancement immédiat au chargement de la page
        updateCountdown();

        // Actualisation toutes les secondes
        setInterval(updateCountdown, 1000);
    });
</script>


@endsection