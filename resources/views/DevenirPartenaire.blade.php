{{-- resources/views/partenaires/devenir.blade.php --}}
@extends('layouts.app')

@section('title', 'Devenir Partenaire — Forum International de l\'Innovation 2026')

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
        background: #0f284e;
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
        border: 2px solid #f5c518;
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
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5c518;
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
        border-bottom: 2px solid #f5c518;
        padding-bottom: 2px;
        font-weight: 600;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-login {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 18px;
        border-radius: 4px;
        border: 1.5px solid rgba(255, 255, 255, .35);
        cursor: pointer;
        text-decoration: none;
        transition: background .2s;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-inscr {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 22px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .btn-inscr:hover {
        opacity: .9;
    }

    .btn-inscr svg {
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
        background: linear-gradient(105deg, #060e20 0%, #0f284e 55%, #0f2a5e 100%);
        padding: 4rem 2.5rem 3.5rem;
        position: relative;
        overflow: hidden;
        background-image:
            linear-gradient(108deg, #060e20 0%, #0f284e 45%, rgba(15, 40, 78, 0.75) 75%, rgba(15, 42, 94, 0.4) 100%),
            url('/images/dev.png');
    }

    .hero::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 45%;
        height: 100%;
        background: rgba(5, 15, 45, .45);
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        max-width: 620px;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(245, 166, 35, .12);
        border: 1px solid rgba(245, 166, 35, .3);
        color: #f5c518;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 3px;
        margin-bottom: 1.25rem;
    }

    .hero-eyebrow svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .hero h1 {
        color: #fff;
        font-size: 2.8rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -.02em;
        line-height: 1.05;
        margin-bottom: .6rem;
    }

    .hero h1 span {
        color: #f5c518;
    }

    .hero-tagline {
        color: #f5c518;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: .75rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .9rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 500px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 13px 26px;
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

    .btn-gold svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-outline-w {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 24px;
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

    /* ── STATS ── */
    .stats-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: stretch;
    }

    .stat-item {
        flex: 1;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 14px;
        border-right: 1px solid #e2e8f0;
    }

    .stat-item:last-child {
        border-right: none;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        background: rgba(15, 40, 78, .07);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 22px;
        height: 22px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 1.8;
    }

    .stat-num {
        font-size: 1.6rem;
        font-weight: 900;
        color: #0f284e;
        display: block;
        line-height: 1;
    }

    .stat-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 3px;
        white-space: pre-line;
        line-height: 1.3;
    }

    /* ── AVANTAGES ── */
    .avantages-section {
        padding: 4rem 2.5rem;
        background: #f4f6fa;
    }

    .section-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .section-eyebrow {
        font-size: 11px;
        font-weight: 800;
        color: #f5c518;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .section-title {
        font-size: 1.9rem;
        font-weight: 900;
        color: #0f284e;
        margin-bottom: .75rem;
    }

    .section-desc {
        font-size: .9rem;
        color: #718096;
        line-height: 1.65;
        max-width: 560px;
        margin: 0 auto;
    }

    .avantages-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    .avantage-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.5rem;
        transition: box-shadow .2s;
    }

    .avantage-card:hover {
        box-shadow: 0 4px 16px rgba(15, 40, 78, .1);
    }

    .av-icon {
        width: 48px;
        height: 48px;
        background: rgba(15, 40, 78, .07);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .av-icon svg {
        width: 24px;
        height: 24px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 1.8;
    }

    .av-title {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
        margin-bottom: 6px;
    }

    .av-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.6;
    }

    /* ── NIVEAUX DE PARTENARIAT ── */
    .niveaux-section {
        padding: 4rem 2.5rem;
        background: #fff;
    }

    .niveaux-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
    }

    .niveau-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: relative;
        transition: box-shadow .2s, transform .2s;
    }

    .niveau-card:hover {
        box-shadow: 0 6px 20px rgba(15, 40, 78, .1);
        transform: translateY(-2px);
    }

    .niveau-card.populaire {
        border-width: 2px;
    }

    .popular-badge {
        position: absolute;
        top: -13px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        font-size: 9px;
        font-weight: 800;
        padding: 3px 14px;
        border-radius: 10px;
        letter-spacing: .07em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .niveau-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .niveau-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .niveau-nom {
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .07em;
    }

    .niveau-prix {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
    }

    .niveau-avantages {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .niveau-av {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        font-size: 11px;
        color: #4a5568;
        line-height: 1.4;
    }

    .niveau-av svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0;
        margin-top: 1px;
        stroke-width: 2.5;
        fill: none;
    }

    .niveau-btn {
        padding: 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        border: 1.5px solid;
        transition: all .2s;
        text-decoration: none;
        display: block;
    }

    /* ── TEMOIGNAGES ── */
    .temoignages-section {
        padding: 4rem 2.5rem;
        background: #0f284e;
    }

    .section-title-w {
        font-size: 1.9rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: .75rem;
    }

    .section-desc-w {
        font-size: .9rem;
        color: rgba(255, 255, 255, .6);
        line-height: 1.65;
        max-width: 520px;
        margin: 0 auto 2.5rem;
    }

    .temoignages-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .temoignage-card {
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 12px;
        padding: 1.75rem;
    }

    .temo-quote {
        color: #f5c518;
        font-size: 2rem;
        line-height: 1;
        margin-bottom: .75rem;
    }

    .temo-text {
        font-size: 13px;
        color: rgba(255, 255, 255, .8);
        line-height: 1.7;
        font-style: italic;
        margin-bottom: 1.25rem;
    }

    .temo-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .temo-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0a1e38, #0f284e);
        border: 2px solid rgba(245, 166, 35, .4);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .temo-avatar img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
    }

    .temo-avatar-init {
        color: #f5c518;
        font-size: 16px;
        font-weight: 700;
    }

    .temo-name {
        font-size: 13px;
        font-weight: 700;
        color: #fff;
    }

    .temo-poste {
        font-size: 11px;
        color: rgba(255, 255, 255, .55);
    }

    /* ── FORMULAIRE ── */
    .form-section {
        padding: 4rem 2.5rem;
        background: #f4f6fa;
    }

    .form-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 2.5rem;
        align-items: start;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 2rem;
    }

    .form-title {
        font-size: 16px;
        font-weight: 900;
        color: #0f284e;
        margin-bottom: 4px;
    }

    .form-subtitle {
        font-size: 12px;
        color: #718096;
        margin-bottom: 1.5rem;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 14px;
    }

    .form-field {
        margin-bottom: 14px;
    }

    .form-field:last-of-type {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        margin-bottom: 4px;
    }

    .req {
        color: #f5c518;
    }

    .form-control {
        width: 100%;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        padding: 10px 13px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
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
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        cursor: pointer;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
        line-height: 1.6;
    }

    .field-error {
        color: #e53e3e;
        font-size: 11px;
        margin-top: 3px;
        display: block;
    }

    .form-sep {
        height: 1px;
        background: #f0f4f8;
        margin: 1.25rem 0;
    }

    .form-section-label {
        font-size: 11px;
        font-weight: 800;
        color: #0f284e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .niveau-radio-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 14px;
    }

    .niveau-radio-item {
        border: 1.5px solid #e2e8f0;
        border-radius: 7px;
        padding: 10px 12px;
        cursor: pointer;
        transition: all .2s;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .niveau-radio-item:hover {
        border-color: #0f284e;
    }

    .niveau-radio-item input {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        accent-color: #0f284e;
        cursor: pointer;
    }

    .niveau-radio-label {
        font-size: 12px;
        font-weight: 600;
        color: #0a1e38;
    }

    .niveau-radio-prix {
        font-size: 10px;
        color: #718096;
        margin-top: 1px;
    }

    .cb-accept {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 10px;
    }

    .cb-accept input {
        width: 15px;
        height: 15px;
        margin-top: 2px;
        flex-shrink: 0;
        accent-color: #0f284e;
        cursor: pointer;
    }

    .cb-accept label {
        font-size: 12px;
        color: #4a5568;
        cursor: pointer;
        line-height: 1.5;
    }

    .btn-submit {
        background: #0f284e;
        color: #fff;
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        transition: background .2s;
    }

    .btn-submit:hover {
        background: #0a1e38;
    }

    .btn-submit svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 8px;
        padding: 14px 16px;
        font-size: 13px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .alert-errors {
        background: #fce4ec;
        border: 1px solid #f48fb1;
        color: #c2185b;
        border-radius: 8px;
        padding: 14px 16px;
        font-size: 13px;
        margin-bottom: 1.5rem;
    }

    /* Sidebar form */
    .form-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .fsi-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
    }

    .fsi-title {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 1rem;
    }

    .fsi-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .fsi-item:last-child {
        border-bottom: none;
    }

    .fsi-icon {
        width: 32px;
        height: 32px;
        background: rgba(15, 40, 78, .07);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .fsi-icon svg {
        width: 15px;
        height: 15px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 1.8;
    }

    .fsi-text strong {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        display: block;
    }

    .fsi-text span {
        font-size: 11px;
        color: #718096;
    }

    .fsi-contact {
        background: #0f284e;
        border-radius: 12px;
        padding: 1.25rem;
    }

    .fsi-contact-title {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .fsi-contact-line {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: rgba(255, 255, 255, .7);
        margin-bottom: 6px;
    }

    .fsi-contact-line svg {
        width: 14px;
        height: 14px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .fsi-contact-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 10px;
        border-radius: 5px;
        border: none;
        width: 100%;
        margin-top: 12px;
        cursor: pointer;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: opacity .2s;
    }

    .fsi-contact-btn:hover {
        opacity: .9;
    }

    .deadline-box {
        background: rgba(245, 166, 35, .1);
        border: 1px solid rgba(245, 166, 35, .3);
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .deadline-box svg {
        width: 22px;
        height: 22px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .deadline-box strong {
        font-size: 12px;
        font-weight: 700;
        color: #0f284e;
        display: block;
    }

    .deadline-box span {
        font-size: 11px;
        color: #718096;
    }

    /* ── CTA BOTTOM ── */
    .cta-bottom {
        background: #0f284e;
        padding: 3rem 2.5rem;
        text-align: center;
    }

    .cta-bottom h2 {
        color: #fff;
        font-size: 1.8rem;
        font-weight: 900;
        margin-bottom: .75rem;
    }

    .cta-bottom p {
        color: rgba(255, 255, 255, .6);
        font-size: .9rem;
        margin-bottom: 2rem;
    }

    .cta-bottom-btns {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0f284e;
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

    @media (max-width:1100px) {
        .niveaux-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .form-layout {
            grid-template-columns: 1fr;
        }

        .avantages-grid {
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

        .niveaux-grid {
            grid-template-columns: 1fr 1fr;
        }

        .temoignages-grid {
            grid-template-columns: 1fr;
        }

        .stats-bar {
            flex-wrap: wrap;
        }

        .stat-item {
            flex: 1 1 45%;
        }

        .avantages-grid {
            grid-template-columns: 1fr;
        }

        .form-grid-2 {
            grid-template-columns: 1fr;
        }

        .niveau-radio-grid {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width:480px) {
        .niveaux-grid {
            grid-template-columns: 1fr;
        }

        .stat-item {
            flex: 1 1 100%;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>
            Partenariats officiels — Forum 2026
        </div>
        <h1>Devenez <span>Partenaire</span></h1>
        <p class="hero-tagline">Associez votre image à l'événement de référence de l'innovation africaine</p>
        <p class="hero-desc">
            Rejoignez plus de 120 partenaires et exposez votre marque à 5 000+ décideurs,
            entrepreneurs et investisseurs venus de 50+ pays. Un levier de visibilité unique
            pour votre organisation.
        </p>
        <div class="hero-actions">
            <a href="#form-partenariat" class="btn-gold">
                <svg viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
                Soumettre ma demande
            </a>
            <a href="#niveaux" class="btn-outline-w">Voir les offres de partenariat</a>
        </div>
    </div>
</section>

{{-- ══ STATS ══ --}}
<div class="stats-bar">
    @foreach ($stats as $s)
    <div class="stat-item">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true">{!! $s['icon'] !!}</svg>
        </div>
        <div>
            <span class="stat-num">{{ $s['valeur'] }}</span>
            <div class="stat-lbl">{{ $s['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- ══ AVANTAGES ══ --}}
<section class="avantages-section">
    <div class="section-header">
        <div class="section-eyebrow">Pourquoi nous rejoindre</div>
        <h2 class="section-title">Les avantages du partenariat</h2>
        <p class="section-desc">Un partenariat avec le Forum International de l'Innovation, c'est bien plus qu'une visibilité : c'est un accès privilégié à tout un écosystème.</p>
    </div>
    <div class="avantages-grid">
        @foreach ($avantages as $av)
        <div class="avantage-card">
            <div class="av-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $av['icon'] !!}</svg>
            </div>
            <div class="av-title">{{ $av['titre'] }}</div>
            <p class="av-desc">{{ $av['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ NIVEAUX ══ --}}
<section class="niveaux-section" id="niveaux">
    <div class="section-header" style="margin-bottom:2rem">
        <div class="section-eyebrow">Nos offres</div>
        <h2 class="section-title">Choisissez votre niveau de partenariat</h2>
        <p class="section-desc">De Bronze à Sur Mesure, chaque niveau est conçu pour s'adapter à votre budget et à vos objectifs de visibilité.</p>
    </div>
    <div class="niveaux-grid">
        @foreach ($niveaux as $niv)
        <div class="niveau-card {{ $niv['populaire'] ? 'populaire' : '' }}"
            style="{{ $niv['populaire'] ? 'border-color:'.$niv['couleur'].';background:'.$niv['bg'] : 'background:'.$niv['bg'] }}">
            @if ($niv['populaire'])
            <div class="popular-badge" style="background:{{ $niv['couleur'] }}">⭐ Populaire</div>
            @endif
            <div class="niveau-icon" style="background:{{ $niv['couleur'] }}18;color:{{ $niv['couleur'] }}">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>
            </div>
            <div>
                <div class="niveau-nom" style="color:{{ $niv['couleur'] }}">{{ $niv['nom'] }}</div>
                <div class="niveau-prix">{{ $niv['prix'] }}</div>
            </div>
            <div class="niveau-avantages">
                @foreach ($niv['avantages'] as $av)
                <div class="niveau-av">
                    <svg viewBox="0 0 24 24" style="stroke:{{ $niv['couleur'] }}">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    {{ $av }}
                </div>
                @endforeach
            </div>
            <a href="#form-partenariat"
                class="niveau-btn"
                style="border-color:{{ $niv['couleur'] }};color:{{ $niv['populaire'] ? '#fff' : $niv['couleur'] }};background:{{ $niv['populaire'] ? $niv['couleur'] : 'transparent' }}"
                onclick="document.getElementById('niveau_partenariat').value='{{ $niv['slug'] }}'">
                Choisir ce niveau
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ TEMOIGNAGES ══ --}}
<section class="temoignages-section">
    <div class="section-header">
        <div class="section-eyebrow" style="color:#f5c518">Ils nous font confiance</div>
        <h2 class="section-title-w">Ce que disent nos partenaires</h2>
        <p class="section-desc-w">Des organisations leaders qui ont choisi le Forum pour développer leur rayonnement international.</p>
    </div>
    <div class="temoignages-grid">
        @foreach ($temoignages as $t)
        <div class="temoignage-card">
            <div class="temo-quote" aria-hidden="true">&ldquo;</div>
            <p class="temo-text">{{ $t['texte'] }}</p>
            <div class="temo-author">
                <div class="temo-avatar">
                    @if ($t['photo'])
                    {{-- ✅ Chargement direct de vos images depuis public/images/ --}}
                    <img src="{{ asset('images/' . $t['photo']) }}" alt="{{ $t['nom'] }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    @else
                    <span class="temo-avatar-init" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #0f284e; color: #fff; font-size: 14px; font-weight: 700;">
                        {{ strtoupper(substr($t['nom'], 0, 1)) }}
                    </span>
                    @endif
                </div>
                <div>
                    <div class="temo-name">{{ $t['nom'] }}</div>
                    <div class="temo-poste">{{ $t['poste'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ FORMULAIRE ══ --}}
<section class="form-section" id="form-partenariat">
    <div class="section-header" style="margin-bottom:2rem">
        <div class="section-eyebrow">Dépôt de candidature</div>
        <h2 class="section-title">Soumettez votre demande de partenariat</h2>
        <p class="section-desc">Remplissez ce formulaire et notre équipe vous contactera sous 48h pour discuter de votre projet de partenariat.</p>
    </div>

    <div class="form-layout">

        {{-- Formulaire principal --}}
        <div class="form-card">
            <div class="form-title">Formulaire de Demande</div>
            <p class="form-subtitle">Tous les champs marqués <span class="req">*</span> sont obligatoires.</p>

            @if (session('success'))
            <div class="alert-success">
                <svg viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert-errors">Veuillez corriger les erreurs ci-dessous.</div>
            @endif

            <form action="{{ route('partenaires.devenir.store') }}" method="POST" novalidate>
                @csrf

                {{-- Contact --}}
                <div class="form-section-label">Contact principal</div>
                <div class="form-grid-2">
                    <div>
                        <label class="form-label" for="nom_contact">Nom complet <span class="req">*</span></label>
                        <input type="text" id="nom_contact" name="nom_contact" class="form-control"
                            placeholder="Votre nom" value="{{ old('nom_contact') }}" required>
                        @error('nom_contact')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="poste">Poste / Fonction</label>
                        <input type="text" id="poste" name="poste" class="form-control"
                            placeholder="Directeur général" value="{{ old('poste') }}">
                        @error('poste')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-grid-2">
                    <div>
                        <label class="form-label" for="email">Email professionnel <span class="req">*</span></label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="email@organisation.com" value="{{ old('email') }}" required>
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="telephone">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" class="form-control"
                            placeholder="+221 77 000 00 00" value="{{ old('telephone') }}">
                        @error('telephone')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-sep"></div>

                {{-- Organisation --}}
                <div class="form-section-label">Votre organisation</div>
                <div class="form-grid-2">
                    <div>
                        <label class="form-label" for="organisation">Nom de l'organisation <span class="req">*</span></label>
                        <input type="text" id="organisation" name="organisation" class="form-control"
                            placeholder="Nom de votre organisation" value="{{ old('organisation') }}" required>
                        @error('organisation')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="type_organisation">Type d'organisation <span class="req">*</span></label>
                        <select id="type_organisation" name="type_organisation" class="form-control" required>
                            <option value="">Sélectionnez</option>
                            @foreach ($typesOrga as $t)
                            <option value="{{ $t }}" {{ old('type_organisation') === $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                        @error('type_organisation')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-grid-2">
                    <div>
                        <label class="form-label" for="pays">Pays <span class="req">*</span></label>
                        <input type="text" id="pays" name="pays" class="form-control"
                            placeholder="France, Sénégal, Gabon..." value="{{ old('pays') }}" required>
                        @error('pays')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="secteur">Secteur d'activité <span class="req">*</span></label>
                        <select id="secteur" name="secteur" class="form-control" required>
                            <option value="">Sélectionnez</option>
                            @foreach ($secteurs as $s)
                            <option value="{{ $s }}" {{ old('secteur') === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('secteur')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-sep"></div>

                {{-- Niveau partenariat --}}
                <div class="form-section-label">Niveau de partenariat souhaité <span class="req">*</span></div>
                <div class="niveau-radio-grid">
                    @foreach ($niveaux as $niv)
                    <label class="niveau-radio-item" style="{{ old('niveau_partenariat') === $niv['slug'] ? 'border-color:'.$niv['couleur'].';background:'.$niv['bg'] : '' }}">
                        <input type="radio" id="niv_{{ $niv['slug'] }}" name="niveau_partenariat"
                            value="{{ $niv['slug'] }}" {{ old('niveau_partenariat', 'or') === $niv['slug'] ? 'checked' : '' }}
                            onchange="this.closest('.niveau-radio-grid').querySelectorAll('.niveau-radio-item').forEach(el=>el.style='');this.closest('.niveau-radio-item').style='border-color:{{ $niv['couleur'] }};background:{{ $niv['bg'] }}'">
                        <div>
                            <div class="niveau-radio-label" style="color:{{ $niv['couleur'] }}">{{ $niv['nom'] }}</div>
                            <div class="niveau-radio-prix">{{ $niv['prix'] }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('niveau_partenariat')<span class="field-error" style="margin-top:-8px;display:block;margin-bottom:8px">{{ $message }}</span>@enderror

                {{-- Budget --}}
                <div class="form-field">
                    <label class="form-label" for="budget_prevu">Budget prévisionnel <span class="req">*</span></label>
                    <select id="budget_prevu" name="budget_prevu" class="form-control" required>
                        <option value="">Sélectionnez une fourchette</option>
                        @foreach ($budgets as $b)
                        <option value="{{ $b }}" {{ old('budget_prevu') === $b ? 'selected' : '' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                    @error('budget_prevu')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-sep"></div>

                {{-- Objectifs --}}
                <div class="form-section-label">Vos objectifs</div>
                <div class="form-field">
                    <label class="form-label" for="objectifs">Décrivez vos objectifs de partenariat <span class="req">*</span></label>
                    <textarea id="objectifs" name="objectifs" class="form-control" rows="4"
                        placeholder="Ex : renforcer notre visibilité en Afrique de l'Ouest, rencontrer des partenaires qualifiés, présenter nos solutions...">{{ old('objectifs') }}</textarea>
                    @error('objectifs')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                {{-- CGU --}}
                <div class="cb-accept">
                    <input type="checkbox" id="accepte_conditions" name="accepte_conditions" value="1"
                        {{ old('accepte_conditions') ? 'checked' : '' }} required>
                    <label for="accepte_conditions">
                        J'accepte les <a href="{{ route('conditions') }}" target="_blank" style="color:#0f284e;font-weight:700">conditions générales</a>
                        et la <a href="{{ route('confidentialite') }}" target="_blank" style="color:#0f284e;font-weight:700">politique de confidentialité</a>
                        <span class="req">*</span>
                    </label>
                </div>
                @error('accepte_conditions')<span class="field-error" style="margin-bottom:8px;display:block">{{ $message }}</span>@enderror

                <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24">
                        <line x1="22" y1="2" x2="11" y2="13" />
                        <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
                    </svg>
                    Envoyer ma demande de partenariat
                </button>

                <p style="font-size:11px;color:#a0aec0;text-align:center;margin-top:10px">
                    Votre demande sera traitée sous 48h ouvrées par notre équipe.
                </p>
            </form>
        </div>

        {{-- Sidebar informative --}}
        <div class="form-sidebar">

            <div class="deadline-box">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                </svg>
                <div>
                    <strong>Réponse sous 48h</strong>
                    <span>Notre équipe traite chaque demande personnellement</span>
                </div>
            </div>

            <div class="fsi-card">
                <div class="fsi-title">Ce qui vous attend</div>
                @foreach ([
                ['Réception de votre demande', 'Confirmation immédiate par email', '
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="M2 7l10 7 10-7" />'],
                ['Appel de découverte', 'Notre équipe vous contacte sous 48h', '
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07" />'],
                ['Proposition sur mesure', 'Offre adaptée à vos objectifs', '
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />'],
                ['Signature & onboarding', 'Accompagnement dédié jusqu\'au Forum', '
                <polyline points="20 6 9 17 4 12" />'],
                ] as $i => [$titre, $desc, $ic])
                <div class="fsi-item">
                    <div class="fsi-icon" style="background:{{ ['rgba(245,166,35,.12)','rgba(15, 40, 78,.07)','rgba(15, 40, 78,.07)','rgba(46,125,50,.1)'][$i] }}">
                        <svg viewBox="0 0 24 24" style="stroke:{{ ['#f5c518','#0f284e','#0f284e','#2e7d32'][$i] }}" aria-hidden="true">{!! $ic !!}</svg>
                    </div>
                    <div class="fsi-text">
                        <strong>{{ ($i+1) }}. {{ $titre }}</strong>
                        <span>{{ $desc }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="fsi-contact">
                <div class="fsi-contact-title">Une question avant de vous lancer ?</div>
                <div class="fsi-contact-line">
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="M2 7l10 7 10-7" />
                    </svg>
                    partenariats@forum-innovation.org
                </div>
                <div class="fsi-contact-line">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81" />
                    </svg>
                    +221 33 123 45 67
                </div>
                <a href="{{ route('contact') }}" class="fsi-contact-btn">Nous contacter directement</a>
            </div>

            <div class="fsi-card">
                <div class="fsi-title">Ils nous font déjà confiance</div>
                @foreach (['Orange', 'Ecobank', 'Sonatel', 'Société Générale', 'BAD', 'Union Africaine'] as $brand)
                <div style="display:inline-block;background:#f4f6fa;border:1px solid #e2e8f0;border-radius:5px;padding:5px 12px;font-size:11px;font-weight:700;color:#0a1e38;margin:3px">
                    {{ $brand }}
                </div>
                @endforeach
                <p style="font-size:11px;color:#a0aec0;margin-top:10px">+ 114 autres partenaires confirmés</p>
            </div>

        </div>
    </div>
</section>

{{-- ══ CTA BOTTOM ══ --}}
<div class="cta-bottom">
    <h2>Prêt à rejoindre l'aventure ?</h2>
    <p>Ne manquez pas cette opportunité unique de vous connecter à l'écosystème de l'innovation africaine.</p>
    <div class="cta-bottom-btns">
        <a href="#form-partenariat" class="btn-gold">
            <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
            </svg>
            Déposer ma candidature
        </a>
        <a href="{{ route('contact') }}" class="btn-outline-w">Parler à un conseiller</a>
    </div>
</div>

{{-- ══ FOOTER ══ --}}

@include('components.footer')

@endsection