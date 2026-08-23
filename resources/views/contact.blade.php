{{-- resources/views/contact/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Contact & Presse — Forum International de l\'Innovation 2026')

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
        background: #fff;
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
        width: 44px;
        height: 44px;
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
        letter-spacing: .04em;
    }

    .nav-logo-text span {
        color: #f5a623;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5a623;
        font-size: 10px;
        font-weight: 700;
    }

    .nav-links {
        display: flex;
        gap: 1.6rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .75);
        font-size: 13px;
        text-decoration: none;
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

    .nav-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
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
        background: linear-gradient(100deg, #0a1628 0%, #0d1b3e 55%, #162552 100%);
        padding: 2.5rem 2.5rem 2.5rem;
        position: relative;
        overflow: hidden;
        min-height: 200px;
        display: flex;
        align-items: flex-end;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 520px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 1px solid #f5a623;
        color: #f5a623;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 3px;
        margin-bottom: 1.1rem;
        background: rgba(255, 255, 255, .06);
    }

    .hero h1 {
        color: #fff;
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: .8rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .9rem;
        line-height: 1.65;
    }

    /* ✅ APRÈS — avec image microphone */
    .hero-media {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        width: 50%;
        overflow: hidden;
        z-index: 1;
    }

    .hero-media::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, #0d1b3e 0%, transparent 50%);
        z-index: 2;
    }

    .hero-media-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        opacity: 1;
        /* ← 0.45 → 1 */
    }

    /* ── CONTACT BAR ── */
    .contact-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: stretch;
        box-shadow: 0 2px 12px rgba(13, 27, 62, .06);
    }

    .ci {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 1.4rem 1.6rem;
        border-right: 1px solid #e2e8f0;
    }

    .ci-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #1a2e6e;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ci-icon svg {
        width: 20px;
        height: 20px;
        stroke: #fff;
        fill: none;
        stroke-width: 1.8;
    }

    .ci-label {
        color: #1a2e6e;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .ci-val {
        color: #4a5568;
        font-size: 13px;
        line-height: 1.45;
    }

    .accred-block {
        background: #0d1b3e;
        padding: 1.25rem 1.6rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 270px;
    }

    .accred-block p {
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .accred-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .accred-btn:hover {
        opacity: .9;
    }

    /* ── MAIN GRID ── */
    .main-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 3rem;
        padding: 3rem 2.5rem;
        background: #fff;
        align-items: start;
    }

    /* ── COL 1 : FORMULAIRE ── */
    .sec-title {
        font-size: 14px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        position: relative;
        padding-bottom: 8px;
        margin-bottom: 8px;
    }

    .sec-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 38px;
        height: 3px;
        background: #f5a623;
        border-radius: 2px;
    }

    .sec-sub {
        color: #4a5568;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .fg2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 14px;
    }

    .ff {
        margin-bottom: 14px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #162552;
        margin-bottom: 5px;
    }

    .req-star {
        color: #f5a623;
    }

    .form-control {
        width: 100%;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        padding: 10px 13px;
        font-size: 13px;
        color: #1a2744;
        background: #fff;
        outline: none;
        transition: border-color .2s;
    }

    .form-control:focus {
        border-color: #162552;
        box-shadow: 0 0 0 3px rgba(22, 37, 82, .08);
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 11px center;
        background-size: 15px;
        cursor: pointer;
    }

    .submit-btn {
        background: #0d1b3e;
        color: #fff;
        width: 100%;
        padding: 13px;
        border: none;
        border-radius: 5px;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        letter-spacing: .03em;
        cursor: pointer;
        transition: background .2s;
    }

    .submit-btn:hover {
        background: #162552;
    }

    .form-note {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #718096;
        font-size: 11px;
        margin-top: 10px;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 6px;
        padding: 12px 16px;
        margin-bottom: 1rem;
        font-size: 13px;
    }

    .alert-error-box {
        background: #fce4ec;
        border: 1px solid #f48fb1;
        color: #c2185b;
        border-radius: 6px;
        padding: 12px 16px;
        margin-bottom: 1rem;
        font-size: 13px;
    }

    .field-error {
        color: #e53e3e;
        font-size: 11px;
        margin-top: 4px;
        display: block;
    }

    /* ── COL 2 : DOSSIERS PRESSE ── */
    .dossier-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .dossier-item:last-of-type {
        border-bottom: none;
    }

    .dossier-icon {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dossier-icon.pdf {
        background: #fce4ec;
    }

    .dossier-icon.pptx {
        background: #fff3e0;
    }

    .dossier-icon.zip {
        background: #e8f5e9;
    }

    .dossier-icon svg {
        width: 18px;
        height: 18px;
    }

    .dossier-info {
        flex: 1;
        min-width: 0;
    }

    .dossier-name {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 2px;
    }

    .dossier-meta {
        font-size: 11px;
        color: #718096;
    }

    .dossier-dl {
        width: 32px;
        height: 32px;
        background: #f0f4f8;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        cursor: pointer;
        transition: background .2s;
        text-decoration: none;
    }

    .dossier-dl:hover {
        background: #e2e8f0;
    }

    .dossier-dl svg {
        width: 16px;
        height: 16px;
        stroke: #162552;
        fill: none;
        stroke-width: 1.8;
    }

    .nl-press {
        background: #eef2ff;
        border-radius: 8px;
        padding: 1.25rem;
        margin-top: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .nl-press-icon {
        width: 44px;
        height: 44px;
        background: #1a2e6e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nl-press-icon svg {
        width: 20px;
        height: 20px;
        stroke: #fff;
        fill: none;
        stroke-width: 1.8;
    }

    .nl-press-content {
        flex: 1;
    }

    .nl-press-content p {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 3px;
    }

    .nl-press-content span {
        font-size: 12px;
        color: #718096;
        display: block;
        margin-bottom: 10px;
    }

    .nl-form {
        display: flex;
        gap: 8px;
    }

    .nl-form input {
        flex: 1;
        padding: 9px 12px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        outline: none;
    }

    .nl-form button {
        background: #0d1b3e;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 9px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s;
    }

    .nl-form button:hover {
        background: #162552;
    }

    /* ── COL 3 : COMMUNIQUÉS ── */
    .communique-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f0f4f8;
        cursor: pointer;
    }

    .communique-item:last-of-type {
        border-bottom: none;
    }

    .ci-left {
        flex: 1;
        min-width: 0;
    }

    .ci-date {
        font-size: 11px;
        color: #718096;
        margin-bottom: 5px;
    }

    .ci-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
        display: inline-block;
        margin-bottom: 6px;
        letter-spacing: .05em;
    }

    .b-ann {
        background: #e3f2fd;
        color: #1565c0;
    }

    .b-par {
        background: #fff3e0;
        color: #e65100;
    }

    .b-prog {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .b-ins {
        background: #fff8e1;
        color: #f9a825;
    }

    .ci-title {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        line-height: 1.4;
    }

    .ci-chev {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 2px;
    }

    .ci-chev svg {
        width: 10px;
        height: 10px;
        stroke: #718096;
        fill: none;
        stroke-width: 2;
    }

    .see-all-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #162552;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 1rem;
        transition: color .2s;
    }

    .see-all-link:hover {
        color: #f5a623;
    }

    .see-all-link svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── DOSSIERS PRESSE ── */
    .dossier-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid #f0f4f8;
        transition: background .15s;
    }

    .dossier-item:last-of-type {
        border-bottom: none;
    }

    .dossier-item:hover {
        background: #fafbfc;
        margin: 0 -8px;
        padding: 13px 8px;
        border-radius: 6px;
    }

    .dossier-icon {
        width: 38px;
        height: 38px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dossier-icon.pdf {
        background: #fce4ec;
    }

    .dossier-icon.pptx {
        background: #fff3e0;
    }

    .dossier-icon.zip {
        background: #e8f5e9;
    }

    .dossier-icon svg {
        width: 18px;
        height: 18px;
        fill: none;
        stroke-width: 1.8;
    }

    .dossier-info {
        flex: 1;
        min-width: 0;
    }

    .dossier-name {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 2px;
    }

    .dossier-meta {
        font-size: 11px;
        color: #a0aec0;
    }

    .dossier-dl {
        width: 34px;
        height: 34px;
        background: #f0f4f8;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-decoration: none;
        transition: background .2s, transform .2s;
    }

    .dossier-dl:hover {
        background: #0d1b3e;
        transform: translateY(-1px);
    }

    .dossier-dl svg {
        width: 16px;
        height: 16px;
        stroke: #162552;
        fill: none;
        stroke-width: 1.8;
        transition: stroke .2s;
    }

    .dossier-dl:hover svg {
        stroke: #f5a623;
    }

    /* Newsletter presse */
    .nl-press {
        background: #0d1b3e;
        border-radius: 10px;
        padding: 1.1rem;
        margin-top: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .nl-press-icon {
        width: 44px;
        height: 44px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nl-press-icon svg {
        width: 20px;
        height: 20px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
    }

    .nl-press-content {
        flex: 1;
    }

    .nl-press-content p {
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 2px;
    }

    .nl-press-content span {
        font-size: 11px;
        color: rgba(255, 255, 255, .6);
        display: block;
        margin-bottom: 10px;
    }

    .nl-form {
        display: flex;
        gap: 7px;
    }

    .nl-form input {
        flex: 1;
        padding: 9px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .1);
        color: #fff;
        font-size: 12px;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
    }

    .nl-form input::placeholder {
        color: rgba(255, 255, 255, .4);
    }

    .nl-form input:focus {
        border-color: rgba(255, 255, 255, .4);
    }

    .nl-form button {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        white-space: nowrap;
        transition: opacity .2s;
        font-family: inherit;
    }

    .nl-form button:hover {
        opacity: .9;
    }

    /* ── COMMUNIQUÉS DE PRESSE ── */
    .communique-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f0f4f8;
        cursor: pointer;
        text-decoration: none;
        transition: background .15s;
    }

    .communique-item:last-of-type {
        border-bottom: none;
    }

    .communique-item:hover {
        background: #fafbfc;
        margin: 0 -8px;
        padding: 14px 8px;
        border-radius: 6px;
    }

    .ci-left {
        flex: 1;
        min-width: 0;
    }

    .ci-date {
        font-size: 11px;
        color: #a0aec0;
        margin-bottom: 5px;
    }

    .ci-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
        display: inline-block;
        margin-bottom: 6px;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .b-ann {
        background: #e3f2fd;
        color: #1565c0;
    }

    .b-par {
        background: #fff3e0;
        color: #e65100;
    }

    .b-prog {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .b-ins {
        background: #fff8e1;
        color: #f9a825;
    }

    .ci-title {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        line-height: 1.4;
        transition: color .2s;
    }

    .communique-item:hover .ci-title {
        color: #0d1b3e;
    }

    .ci-chev {
        flex-shrink: 0;
        width: 22px;
        height: 22px;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 2px;
        transition: background .2s, border-color .2s;
    }

    .communique-item:hover .ci-chev {
        background: #0d1b3e;
        border-color: #0d1b3e;
    }

    .ci-chev svg {
        width: 11px;
        height: 11px;
        stroke: #718096;
        fill: none;
        stroke-width: 2;
        transition: stroke .2s;
    }

    .communique-item:hover .ci-chev svg {
        stroke: #fff;
    }

    .see-all-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #162552;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 1rem;
        transition: color .2s;
    }

    .see-all-link:hover {
        color: #f5a623;
    }

    .see-all-link svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0d1b3e;
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
@endsection

@section('content')

@include('components.navbar')


{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">
            <svg width="13" height="13" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            Espace Presse
        </div>
        <h1>Contact &amp; <span style="color: #f5a623;">Presse</span></h1>
        <p class="hero-desc">
            Contactez l'équipe du Forum International de l'Innovation<br>
            et accédez aux ressources presse officielles.
        </p>
    </div>

    {{-- Image décorative côté droit --}}
    {{-- ✅ APRÈS — avec votre image --}}
    <div class="hero-media" aria-hidden="true">
        <img src="{{ asset('images/pc.jpg') }}"
            alt="Contact & Presse"
            class="hero-media-img">
    </div>
</section>

{{-- ══════════════════════════════════════════
     BARRE DE CONTACT
══════════════════════════════════════════ --}}
<div class="contact-bar" role="complementary" aria-label="Coordonnées de contact">

    <div class="ci">
        <div class="ci-icon">
            <svg viewBox="0 0 24 24">
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="M2 7l10 7 10-7" />
            </svg>
        </div>
        <div>
            <div class="ci-label">Email</div>
            <div class="ci-val">
                contact@forum-innovation.org<br>
                presse@forum-innovation.org
            </div>
        </div>
    </div>

    <div class="ci">
        <div class="ci-icon">
            <svg viewBox="0 0 24 24">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
            </svg>
        </div>
        <div>
            <div class="ci-label">Téléphone</div>
            <div class="ci-val">
                +221 33 123 45 67<br>
                Lun – Ven : 8h00 – 18h00 (GMT)
            </div>
        </div>
    </div>

    <div class="ci">
        <div class="ci-icon">
            <svg viewBox="0 0 24 24">
                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                <circle cx="12" cy="10" r="3" />
            </svg>
        </div>
        <div>
            <div class="ci-label">Adresse</div>
            <div class="ci-val">
                Cité de l'innovation,<br>
                Dakar, Sénégal
            </div>
        </div>
    </div>

    <div class="ci" style="border-right:none">
        <div class="ci-icon">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 6v6l4 2" />
            </svg>
        </div>
        <div>
            <div class="ci-label">Délai de réponse</div>
            <div class="ci-val">Sous 24h ouvrées</div>
        </div>
    </div>

    <div class="accred-block">

        <a href="{{ route('inscription') }}" class="accred-btn">
            <svg width="13" height="13" viewBox="0 0 24 24" stroke="#0d1b3e" fill="none" stroke-width="2.5" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            Participer au forum ?
        </a>
    </div>
</div>

{{-- ══════════════════════════════════════════
     GRILLE PRINCIPALE
══════════════════════════════════════════ --}}
<main class="main-grid">

    {{-- ── COL 1 : FORMULAIRE DE CONTACT ── --}}
    <section aria-labelledby="titre-contact">
        <h2 id="titre-contact" class="sec-title">Formulaire de Contact</h2>
        <p class="sec-sub">
            Une question, une demande d'information ou un partenariat ?<br>
            Écrivez-nous, notre équipe vous répondra dans les plus brefs délais.
        </p>

        @if (session('success'))
        <div class="alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert-error-box" role="alert">Veuillez corriger les erreurs ci-dessous.</div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" novalidate>
            @csrf

            <div class="fg2">
                <div>
                    <label class="form-label" for="nom_complet">
                        Nom complet <span class="req-star">*</span>
                    </label>
                    <input
                        type="text" id="nom_complet" name="nom_complet"
                        class="form-control" placeholder="Votre nom complet"
                        value="{{ old('nom_complet') }}" required autocomplete="name">
                    @error('nom_complet')<span class="field-error" role="alert">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="form-label" for="email">
                        Email <span class="req-star">*</span>
                    </label>
                    <input
                        type="email" id="email" name="email"
                        class="form-control" placeholder="Votre adresse email"
                        value="{{ old('email') }}" required autocomplete="email">
                    @error('email')<span class="field-error" role="alert">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="fg2">
                <div>
                    <label class="form-label" for="sujet">
                        Sujet <span class="req-star">*</span>
                    </label>
                    <select id="sujet" name="sujet" class="form-control" required>
                        <option value="">Sélectionnez un sujet</option>
                        @foreach (($sujets ?? []) as $s)
                        <option value="{{ $s }}" {{ old('sujet') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                    @error('sujet')<span class="field-error" role="alert">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="form-label" for="telephone">Téléphone</label>
                    <input
                        type="tel" id="telephone" name="telephone"
                        class="form-control" placeholder="Votre numéro de téléphone"
                        value="{{ old('telephone') }}" autocomplete="tel">
                    @error('telephone')<span class="field-error" role="alert">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="ff">
                <label class="form-label" for="message">
                    Message <span class="req-star">*</span>
                </label>
                <textarea
                    id="message" name="message"
                    class="form-control" placeholder="Votre message…"
                    required>{{ old('message') }}</textarea>
                @error('message')<span class="field-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="submit-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" aria-hidden="true">
                    <line x1="22" y1="2" x2="11" y2="13" />
                    <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
                </svg>
                Envoyer le message
            </button>

            <div class="form-note">
                <svg width="13" height="13" viewBox="0 0 24 24" stroke="#718096" fill="none" stroke-width="1.8" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0110 0v4" />
                </svg>
                Vos données sont sécurisées et ne seront jamais partagées.
            </div>
        </form>
    </section>


    {{-- ══ SECTION DOSSIERS PRESSE ══ --}}
    <section aria-labelledby="titre-dossiers">
        <h2 id="titre-dossiers" class="sec-title">Dossiers Presse</h2>
        <p class="sec-sub">Téléchargez nos dossiers et kits média officiels.</p>

        {{-- ✅ Liste des dossiers téléchargeables --}}
        @foreach ([
        ['pdf', '#c2185b', '
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
        <polyline points="14 2 14 8 20 8" />', 'Dossier de presse 2026', 'PDF', '4.2 Mo', '#'],
        ['pptx', '#e65100', '
        <rect x="2" y="3" width="20" height="14" rx="2" />
        <path d="M8 21h8M12 17v4" />', 'Présentation officielle', 'PPTX', '8.7 Mo', '#'],
        ['zip', '#2e7d32', '
        <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z" />', 'Kit média (Logos & Photos)', 'ZIP', '15.3 Mo', '#'],
        ['pdf', '#1565c0', '
        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
        <polyline points="14 2 14 8 20 8" />', "Rapport d'impact 2025", 'PDF', '6.1 Mo', '#'],
        ] as [$type, $color, $ic, $nom, $fmt, $taille, $url])
        <div class="dossier-item">
            <div class="dossier-icon {{ $type }}">
                <svg viewBox="0 0 24 24" stroke="{{ $color }}">{!! $ic !!}</svg>
            </div>
            <div class="dossier-info">
                <div class="dossier-name">{{ $nom }}</div>
                <div class="dossier-meta">{{ $fmt }} &bull; {{ $taille }}</div>
            </div>
            <a href="{{ $url }}" class="dossier-dl" download aria-label="Télécharger {{ $nom }}">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
            </a>
        </div>
        @endforeach

        {{-- Newsletter presse --}}
        <div class="nl-press">
            <div class="nl-press-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>
            </div>
            <div class="nl-press-content">
                <p>Recevez nos communiqués en avant-première</p>
                <span>Abonnez-vous à notre newsletter presse.</span>
                <form action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="nl-form">
                        <input type="email" name="email_newsletter"
                            placeholder="Votre adresse email" required>
                        <button type="submit">S'abonner</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- ══ SECTION COMMUNIQUÉS DE PRESSE ══ --}}
    <section aria-labelledby="titre-communiques">
        <h2 id="titre-communiques" class="sec-title">Communiqués de Presse</h2>
        <p class="sec-sub">Consultez nos derniers communiqués officiels.</p>

        {{-- ✅ Liste des communiqués avec badges --}}
        @foreach ([
        ['15 MAI 2026', 'b-ann', 'ANNONCE', 'Lancement officiel du Forum International de l\'Innovation 2026', route('actualites')],
        ['02 MAI 2026', 'b-par', 'PARTENARIAT', 'Annonce des premiers partenaires institutionnels', route('actualites')],
        ['20 AVR. 2026', 'b-prog', 'PROGRAMME', 'Programme préliminaire dévoilé', route('actualites')],
        ['10 AVR. 2026', 'b-ins', 'INSCRIPTIONS', 'Ouverture des inscriptions et de la billetterie', route('actualites')],
        ] as [$date, $badgeClass, $badgeLabel, $titre, $lien])
        <a href="{{ $lien }}" class="communique-item">
            <div class="ci-left">
                <div class="ci-date">{{ $date }}</div>
                <span class="ci-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                <div class="ci-title">{{ $titre }}</div>
            </div>
            <div class="ci-chev">
                <svg viewBox="0 0 24 24">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </div>
        </a>
        @endforeach

        <a href="{{ route('actualites') }}" class="see-all-link">
            Voir tous les communiqués
            <svg viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </section>

</main>

{{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}
<footer class="site-footer">
    <div class="footer-grid">

        <div class="fb">
            <a href="{{ route('index') }}" class="nav-logo" style="margin-bottom:.5rem">
                <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
                    <img src="http://127.0.0.1:8000/images/264.png"
                        alt="Logo JEFIE Paris 2026"
                        style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
                </div>
                <div class="nav-logo-text">
                    <span>Forum International</span>de l'Innovation<br><small>2026</small>
                </div>
            </a>
            <p>Ensemble, construisons l'avenir par l'innovation.</p>
            <nav class="socials" aria-label="Réseaux sociaux">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="Twitter / X">&#120143;</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
            </nav>
        </div>

        <div class="fc">
            <h4>Liens Utiles</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('institutionnel') }}">Institutionnel</a>
            <a href="{{ route('emploi') }}">Emploi &amp; Recrutement</a>
            <a href="{{ route('cartographie') }}">Cartographie Diaspora</a>
        </div>

        <div class="fc">
            <h4>Ressources</h4>
            <a href="{{ route('dossiers') }}">Dossiers presse</a>
            <a href="{{ route('actualites') }}">Communiqués</a>
            <a href="{{ route('galerie') }}">Galerie média</a>
            <a href="{{ route('branding') }}">Branding &amp; Logos</a>
            <a href="{{ route('rapports') }}">Rapports &amp; Études</a>
        </div>

        <div class="fc">
            <h4>Informations</h4>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="{{ route('Faq') }}">FAQ</a>
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Politique de confidentialité</a>
        </div>

        <div class="fc">
            <h4>Contact Rapide</h4>
            <div class="fci">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>
                contact@forum-innovation.org
            </div>
            <div class="fci">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
                </svg>
                +221 33 123 45 67
            </div>
            <div class="fci">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                Cité de l'innovation, Dakar, Sénégal
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} Forum International de l'Innovation &ndash; Tous droits réservés.
    </div>
</footer>

@endsection