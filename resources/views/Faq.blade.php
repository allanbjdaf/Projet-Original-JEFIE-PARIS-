{{-- resources/views/faq/index.blade.php --}}
@extends('layouts.app')

@section('title', 'FAQ — Questions fréquentes — Forum International de l\'Innovation 2026')

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
        text-decoration: none;
        transition: background .2s;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-inscr {
        background: #f5a623;
        color: #0d1b3e;
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
        /* Superposition : Le dégradé officiel à 108° passe en premier (avec transparence à la fin), suivi de l'image */
        background-image:
            linear-gradient(108deg, #060e20 0%, #0d1b3e 55%, rgba(15, 42, 94, 0.4) 100%),
            url('/images/pca.png');
        /* <-- Déposez votre image sous ce nom dans public/images/ */

        background-color: #060e20;
        /* Couleur de secours pendant le chargement */
        background-repeat: no-repeat;
        background-position: right center;
        /* Calorie l'illustration vers la droite */
        background-size: cover;
        /* Permet à l'image de couvrir tout l'espace proprement */
        padding: 4rem 2.5rem 3.5rem;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .hero::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245, 166, 35, .07) 0%, transparent 70%);
        pointer-events: none;
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
        padding: 5px 14px;
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
        font-size: 2.6rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -.02em;
        line-height: 1.05;
        margin-bottom: .6rem;
        position: relative;
        z-index: 1;
    }

    .hero h1 span {
        color: #f5a623;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .9rem;
        line-height: 1.65;
        max-width: 540px;
        margin: 0 auto 2rem;
        position: relative;
        z-index: 1;
    }

    /* Barre recherche hero */
    .hero-search {
        max-width: 560px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .hero-search-wrap {
        display: flex;
        gap: 8px;
    }

    .hero-search-input {
        flex: 1;
        padding: 13px 18px;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 7px;
        background: rgba(255, 255, 255, .09);
        color: #fff;
        font-size: 14px;
        outline: none;
        transition: border-color .2s;
    }

    .hero-search-input::placeholder {
        color: rgba(255, 255, 255, .4);
    }

    .hero-search-input:focus {
        border-color: #f5a623;
        background: rgba(255, 255, 255, .12);
    }

    .hero-search-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 13px;
        padding: 13px 24px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: opacity .2s;
        white-space: nowrap;
    }

    .hero-search-btn:hover {
        opacity: .9;
    }

    .hero-search-btn svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .hero-search-hint {
        font-size: 11px;
        color: rgba(255, 255, 255, .4);
        margin-top: 8px;
    }

    /* ── STATS ── */
    .stats-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4rem;
        padding: 1.25rem 2.5rem;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
    }

    .stat-num {
        font-size: 1.4rem;
        font-weight: 900;
        color: #0d1b3e;
        display: block;
    }

    .stat-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 2px;
    }

    .stat-sep {
        width: 1px;
        height: 32px;
        background: #e2e8f0;
    }

    /* ── PAGE LAYOUT ── */
    .page-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 2rem;
        padding: 2rem 2.5rem;
        max-width: 1440px;
        margin: 0 auto;
        align-items: start;
    }

    /* ══ SIDEBAR CATEGORIES ══ */
    .cat-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 80px;
    }

    .cat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .cat-card-title {
        font-size: 11px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .08em;
        text-transform: uppercase;
        padding: 1rem 1.25rem .75rem;
        border-bottom: 1px solid #f0f4f8;
    }

    .cat-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 1.25rem;
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all .15s;
    }

    .cat-item:hover {
        background: #f4f6fa;
    }

    .cat-item.active {
        border-left-color: #f5a623;
        background: rgba(245, 166, 35, .06);
    }

    .cat-icon {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cat-icon svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .cat-label {
        font-size: 12px;
        font-weight: 600;
        color: #4a5568;
        flex: 1;
    }

    .cat-item.active .cat-label {
        color: #0d1b3e;
        font-weight: 700;
    }

    .cat-count {
        font-size: 10px;
        font-weight: 700;
        color: #718096;
        background: #f4f6fa;
        border-radius: 10px;
        padding: 2px 7px;
    }

    /* Besoin d'aide card */
    .aide-card {
        background: #0d1b3e;
        border-radius: 12px;
        padding: 1.25rem;
    }

    .aide-icon {
        width: 40px;
        height: 40px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .75rem;
    }

    .aide-icon svg {
        width: 20px;
        height: 20px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 1.8;
    }

    .aide-title {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .aide-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 11px;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .aide-btn {
        background: #f5a623;
        color: #0d1b3e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: opacity .2s;
    }

    .aide-btn:hover {
        opacity: .9;
    }

    /* ══ CONTENU PRINCIPAL ══ */
    .main-content {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }

    /* Barre résultat recherche */
    .search-result-bar {
        background: #fff8e6;
        border: 1px solid rgba(245, 166, 35, .3);
        border-radius: 8px;
        padding: .85rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .srb-text {
        font-size: 13px;
        color: #7a5c10;
    }

    .srb-text strong {
        font-weight: 700;
    }

    .srb-clear {
        font-size: 12px;
        font-weight: 700;
        color: #0d1b3e;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .srb-clear svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* En-tête section FAQ */
    .faq-section-title {
        font-size: 12px;
        font-weight: 900;
        color: #0d1b3e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-left: 3px solid #f5a623;
        padding-left: 10px;
    }

    /* Questions populaires chips */
    .populaires-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pop-chip {
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 600;
        color: #162552;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pop-chip:hover {
        background: #0d1b3e;
        color: #fff;
        border-color: #0d1b3e;
    }

    .pop-chip svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── ACCORDION FAQ ── */
    .faq-group {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .faq-group-header {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .faq-group-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .faq-group-icon svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .faq-group-name {
        font-size: 13px;
        font-weight: 800;
        color: #0d1b3e;
    }

    .faq-group-count {
        font-size: 10px;
        font-weight: 700;
        color: #718096;
        background: #e2e8f0;
        border-radius: 10px;
        padding: 2px 8px;
        margin-left: auto;
    }

    .faq-item {
        border-bottom: 1px solid #f0f4f8;
    }

    .faq-item:last-child {
        border-bottom: none;
    }

    .faq-question {
        padding: 1.1rem 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        cursor: pointer;
        transition: background .15s;
    }

    .faq-question:hover {
        background: #fafbfd;
    }

    .faq-q-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #f4f6fa;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
        transition: background .2s;
    }

    .faq-q-icon svg {
        width: 12px;
        height: 12px;
        stroke: #718096;
        fill: none;
        stroke-width: 2.5;
        transition: transform .25s;
    }

    .faq-item.open .faq-q-icon {
        background: #f5a623;
    }

    .faq-item.open .faq-q-icon svg {
        stroke: #0d1b3e;
        transform: rotate(45deg);
    }

    .faq-q-text {
        font-size: 14px;
        font-weight: 600;
        color: #162552;
        line-height: 1.45;
        flex: 1;
        padding-top: 3px;
    }

    .faq-item.open .faq-q-text {
        color: #0d1b3e;
        font-weight: 700;
    }

    .faq-popular-tag {
        background: #fff8e6;
        color: #b07d10;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 3px;
        text-transform: uppercase;
        letter-spacing: .05em;
        flex-shrink: 0;
        margin-top: 4px;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height .35s ease, padding .3s ease;
    }

    .faq-item.open .faq-answer {
        max-height: 500px;
    }

    .faq-answer-inner {
        padding: .25rem 1.5rem 1.25rem 4rem;
        font-size: 13px;
        color: #4a5568;
        line-height: 1.75;
    }

    .faq-answer-inner a {
        color: #0d1b3e;
        font-weight: 700;
        text-decoration: none;
        border-bottom: 1px solid rgba(13, 27, 62, .2);
        transition: border-color .2s;
    }

    .faq-answer-inner a:hover {
        border-color: #f5a623;
        color: #f5a623;
    }

    .faq-answer-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: .85rem;
        padding-top: .75rem;
        border-top: 1px solid #f0f4f8;
    }

    .faq-helpful-label {
        font-size: 11px;
        color: #a0aec0;
    }

    .faq-helpful-btn {
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 600;
        color: #162552;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all .2s;
    }

    .faq-helpful-btn:hover {
        background: #0d1b3e;
        color: #fff;
        border-color: #0d1b3e;
    }

    .faq-helpful-btn svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Vide */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .empty-state svg {
        width: 56px;
        height: 56px;
        stroke: #d1d9e6;
        fill: none;
        stroke-width: 1;
        margin: 0 auto 1rem;
    }

    .empty-state p {
        color: #a0aec0;
        font-size: 14px;
    }

    .empty-state a {
        display: inline-block;
        margin-top: 10px;
        font-size: 13px;
        font-weight: 700;
        color: #0d1b3e;
        text-decoration: none;
    }

    /* ── CONTACTS ── */
    .contact-section {
        padding: 3.5rem 2.5rem;
        background: #fff;
    }

    .contact-section .section-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .contact-section .section-title {
        font-size: 1.6rem;
        font-weight: 900;
        color: #0d1b3e;
        margin-bottom: .5rem;
    }

    .contact-section .section-desc {
        font-size: .9rem;
        color: #718096;
        line-height: 1.6;
        max-width: 480px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    .contact-card {
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        transition: box-shadow .2s;
    }

    .contact-card:hover {
        box-shadow: 0 4px 16px rgba(13, 27, 62, .08);
    }

    .cc-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .cc-icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .cc-title {
        font-size: 14px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 5px;
    }

    .cc-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.55;
        margin-bottom: 12px;
    }

    .cc-info {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #162552;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .cc-info svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0;
        fill: none;
        stroke-width: 1.8;
    }

    .cc-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 10px;
        transition: opacity .2s;
        color: #fff;
    }

    .cc-btn:hover {
        opacity: .9;
    }

    .cc-btn svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── CTA BOTTOM ── */
    .cta-section {
        background: linear-gradient(108deg, #0d1b3e, #162552);
        padding: 3.5rem 2.5rem;
        text-align: center;
    }

    .cta-eyebrow {
        font-size: 10px;
        font-weight: 800;
        color: #f5a623;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: .75rem;
    }

    .cta-title {
        font-size: 1.7rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: .75rem;
    }

    .cta-desc {
        color: rgba(255, 255, 255, .6);
        font-size: .9rem;
        line-height: 1.65;
        max-width: 500px;
        margin: 0 auto 2rem;
    }

    .cta-btns {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f5a623;
        color: #0d1b3e;
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background .2s;
    }

    .btn-outline-w:hover {
        background: rgba(255, 255, 255, .08);
    }

    /* ── FOOTER ── */
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

    @media (max-width:1100px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .cat-sidebar {
            position: static;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .cat-card {
            flex: 1;
            min-width: 200px;
        }

        .contact-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .hero h1 {
            font-size: 1.9rem;
        }

        .contact-grid {
            grid-template-columns: 1fr;
        }

        .stats-bar {
            gap: 1.5rem;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:480px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .hero-search-wrap {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-eyebrow">
        <svg viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01" />
        </svg>
        Centre d'aide — Foire Aux Questions
    </div>
    <h1>Foire Aux <span>Questions</span></h1>
    <p class="hero-desc">
        Trouvez rapidement les réponses à vos questions sur le Forum International
        de l'Innovation 2026 : inscription, programme, partenariats et bien plus.
    </p>
    <form action="{{ route('Faq') }}" method="GET" class="hero-search">
        <div class="hero-search-wrap">
            <input type="text" name="q" class="hero-search-input"
                placeholder="Rechercher une question... ex: Comment s'inscrire ?"
                value="{{ $recherche }}" autocomplete="off">
            <button type="submit" class="hero-search-btn">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
                Rechercher
            </button>
        </div>
        <input type="hidden" name="cat" value="{{ $categorieActive }}">
        <p class="hero-search-hint">Essayez : "inscription", "paiement", "visa", "rendez-vous B2B"</p>
    </form>
</section>

{{-- ══ STATS ══ --}}
<div class="stats-bar">
    @foreach ($stats as $i => $s)
    @if ($i > 0)<div class="stat-sep"></div>@endif
    <div class="stat-item">
        <span class="stat-num">{{ $s['valeur'] }}</span>
        <span class="stat-lbl">{{ $s['label'] }}</span>
    </div>
    @endforeach
</div>

{{-- ══ PAGE LAYOUT ══ --}}
<div class="page-layout">

    {{-- ── SIDEBAR CATÉGORIES ── --}}
    <aside>
        <div class="cat-sidebar">

            {{-- Catégories --}}
            <div class="cat-card">
                <div class="cat-card-title">Catégories</div>
                @foreach ($categories as $cat)
                @php
                $count = collect($faqs ?? [])->filter(fn($f) => $cat['slug'] === 'tous' || $f['categorie'] === $cat['slug'])->count();
                @endphp
                @php $catColor = $cat['color']; @endphp
                <a href="{{ route('Faq', ['cat' => $cat['slug'], 'q' => $recherche]) }}"
                    class="cat-item {{ $categorieActive === $cat['slug'] ? 'active' : '' }}">
                    <div class="cat-icon" style="background:<?php echo $catColor . '15'; ?>;color:<?php echo $catColor; ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true">{!! $cat['icon'] !!}</svg>
                    </div>
                    <span class="cat-label">{{ $cat['label'] }}</span>
                    <span class="cat-count">{{ $count }}</span>
                </a>
                @endforeach
            </div>

            {{-- Aide card --}}
            <div class="aide-card">
                <div class="aide-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                </div>
                <div class="aide-title">Besoin d'aide personnalisée ?</div>
                <p class="aide-desc">Notre équipe répond à toutes vos questions sous 24h, 7j/7.</p>
                <a href="{{ route('contact') }}" class="aide-btn">Nous contacter →</a>
            </div>

        </div>
    </aside>

    {{-- ── CONTENU PRINCIPAL ── --}}
    <main class="main-content">

        {{-- Résultat recherche --}}
        @if ($recherche)
        <div class="search-result-bar">
            <p class="srb-text">
                <strong>{{ count($faqs) }}</strong> résultat{{ count($faqs) > 1 ? 's' : '' }}
                pour « <strong>{{ $recherche }}</strong> »
            </p>
            <a href="{{ route('Faq', ['cat' => $categorieActive]) }}" class="srb-clear">
                <svg viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
                Effacer
            </a>
        </div>
        @endif

        {{-- Questions populaires --}}
        @if (!$recherche && $categorieActive === 'tous')
        <div>
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.85rem">
                <div class="faq-section-title">Questions populaires</div>
            </div>
            <div class="populaires-wrap">
                @foreach (collect($faqs)->where('populaire', true) as $pop)
                <a href="#faq-{{ $pop['id'] }}"
                    class="pop-chip"
                    onclick="openFaq(<?php echo $pop['id']; ?>)">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01" />
                    </svg>
                    {{ Str::limit($pop['question'], 50) }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Contenu FAQ groupé par catégorie ou liste plate --}}
        @if (count($faqs) > 0)
        @if ($categorieActive === 'tous' && !$recherche)
        {{-- Affichage groupé par catégorie --}}
        @foreach ($categories as $cat)
        @if ($cat['slug'] === 'tous') @continue @endif
        @php
        $items = collect($faqs)->where('categorie', $cat['slug'])->values();
        @endphp
        @if ($items->count() > 0)
        <div class="faq-group" id="cat-{{ $cat['slug'] }}">
            <div class="faq-group-header">
                @php $catGrpColor = $cat['color']; @endphp
                <div class="faq-group-icon" style="background:<?php echo $catGrpColor . '15'; ?>;color:<?php echo $catGrpColor; ?>">
                    <svg viewBox="0 0 24 24" aria-hidden="true">{!! $cat['icon'] !!}</svg>
                </div>
                <span class="faq-group-name">{{ $cat['label'] }}</span>
                <span class="faq-group-count">{{ $items->count() }} question{{ $items->count() > 1 ? 's' : '' }}</span>
            </div>
            @foreach ($items as $faq)
            <div class="faq-item" id="faq-{{ $faq['id'] }}">
                <div class="faq-question" onclick="toggleFaq(<?php echo $faq['id']; ?>)" role="button" tabindex="0"
                    onkeydown="if(event.key==='Enter')toggleFaq(<?php echo $faq['id']; ?>)">
                    <div class="faq-q-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </div>
                    <span class="faq-q-text">{{ $faq['question'] }}</span>
                    @if ($faq['populaire'] ?? false)
                    <span class="faq-popular-tag">⭐ Populaire</span>
                    @endif
                </div>
                <div class="faq-answer" id="ans-{{ $faq['id'] }}" aria-hidden="true">
                    <div class="faq-answer-inner">
                        {{ $faq['reponse'] }}
                        <div class="faq-answer-actions">
                            <span class="faq-helpful-label">Cette réponse vous a été utile ?</span>
                            <button class="faq-helpful-btn" type="button" onclick="markHelpful(<?php echo $faq['id']; ?>, true)">
                                <svg viewBox="0 0 24 24">
                                    <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3H14z" />
                                    <path d="M7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
                                </svg>
                                Oui
                            </button>
                            <button class="faq-helpful-btn" type="button" onclick="markHelpful(<?php echo $faq['id']; ?>, false)">
                                <svg viewBox="0 0 24 24">
                                    <path d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3H10z" />
                                    <path d="M17 2h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17" />
                                </svg>
                                Non
                            </button>
                            <a href="{{ route('contact') }}" style="margin-left:auto;font-size:11px;color:#718096;text-decoration:none">
                                Encore une question ? → Contactez-nous
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @endforeach

        @else
        {{-- Affichage liste plate (catégorie filtrée ou recherche) --}}
        @php
        $catInfo = collect($categories)->firstWhere('slug', $categorieActive);
        @endphp
        <div class="faq-group">
            @if ($catInfo && $categorieActive !== 'tous')
            <div class="faq-group-header">
                @php $catInfoColor = $catInfo['color']; @endphp
                <div class="faq-group-icon" style="background:<?php echo $catInfoColor . '15'; ?>;color:<?php echo $catInfoColor; ?>">
                    <svg viewBox="0 0 24 24" aria-hidden="true">{!! $catInfo['icon'] !!}</svg>
                </div>
                <span class="faq-group-name">{{ $catInfo['label'] }}</span>
                <span class="faq-group-count">{{ count($faqs) }} question{{ count($faqs) > 1 ? 's' : '' }}</span>
            </div>
            @endif
            @foreach ($faqs as $faq)
            <div class="faq-item" id="faq-{{ $faq['id'] }}">
                <div class="faq-question" onclick="toggleFaq(<?php echo $faq['id']; ?>)" role="button" tabindex="0"
                    onkeydown="if(event.key==='Enter')toggleFaq(<?php echo $faq['id']; ?>)">
                    <div class="faq-q-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </div>
                    <span class="faq-q-text">{{ $faq['question'] }}</span>
                    @if ($faq['populaire'] ?? false)
                    <span class="faq-popular-tag">⭐ Populaire</span>
                    @endif
                </div>
                <div class="faq-answer" id="ans-{{ $faq['id'] }}" aria-hidden="true">
                    <div class="faq-answer-inner">
                        {{ $faq['reponse'] }}
                        <div class="faq-answer-actions">
                            <span class="faq-helpful-label">Cette réponse vous a été utile ?</span>
                            <button class="faq-helpful-btn" type="button" onclick="markHelpful(<?php echo $faq['id']; ?>, true)">
                                <svg viewBox="0 0 24 24">
                                    <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3H14z" />
                                    <path d="M7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
                                </svg>
                                Oui
                            </button>
                            <button class="faq-helpful-btn" type="button">
                                <svg viewBox="0 0 24 24">
                                    <path d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3H10z" />
                                    <path d="M17 2h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17" />
                                </svg>
                                Non
                            </button>
                            <a href="{{ route('contact') }}" style="margin-left:auto;font-size:11px;color:#718096;text-decoration:none">
                                Encore une question ? → Contactez-nous
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @else
        {{-- État vide --}}
        <div class="empty-state">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01" />
            </svg>
            <p>Aucune question trouvée pour « {{ $recherche }} ».</p>
            <a href="{{ route('faq') }}">← Voir toutes les questions</a>
        </div>
        @endif

    </main>
</div>{{-- /.page-layout --}}

{{-- ══ CONTACTS SECTION ══ --}}
<section class="contact-section">
    <div class="section-header">
        <h2 class="section-title">Vous n'avez pas trouvé votre réponse ?</h2>
        <p class="section-desc">Notre équipe est disponible pour répondre à toutes vos questions spécifiques.</p>
    </div>
    <div class="contact-grid">
        @foreach ($contactCards as $cc)
        @php $ccColor = $cc['color']; @endphp
        <div class="contact-card" style="background:<?php echo $cc['bg']; ?>;border-color:<?php echo $ccColor . '22'; ?>">
            <div class="cc-icon" style="background:<?php echo $ccColor . '15'; ?>;color:<?php echo $ccColor; ?>">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $cc['icon'] !!}</svg>
            </div>
            <div class="cc-title">{{ $cc['titre'] }}</div>
            <p class="cc-desc">{{ $cc['desc'] }}</p>
            <div class="cc-info" style="color:<?php echo $ccColor; ?>">
                <svg viewBox="0 0 24 24" style="stroke:<?php echo $ccColor; ?>">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>
                {{ $cc['email'] }}
            </div>
            <div class="cc-info" style="color:<?php echo $ccColor; ?>">
                <svg viewBox="0 0 24 24" style="stroke:<?php echo $ccColor; ?>">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81" />
                </svg>
                {{ $cc['tel'] }}
            </div>
            <a href="{{ route('contact') }}" class="cc-btn" style="background:<?php echo $ccColor; ?>">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                </svg>
                Contacter cette équipe
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ CTA BOTTOM ══ --}}
<div class="cta-section">
    <div class="cta-eyebrow">Passez à l'action</div>
    <h2 class="cta-title">Prêt à rejoindre le Forum 2026 ?</h2>
    <p class="cta-desc">Inscrivez-vous maintenant et rejoignez 5 000+ décideurs, entrepreneurs et innovateurs du monde entier.</p>
    <div class="cta-btns">
        <a href="{{ route('inscription') }}" class="btn-gold">
            <svg viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
            </svg>
            S'inscrire maintenant
        </a>
        <a href="{{ route('partenaires.devenir') }}" class="btn-outline-w">Devenir partenaire</a>
        <a href="{{ route('contact') }}" class="btn-outline-w">Nous contacter</a>
    </div>
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
                <div class="nav-logo-text" style="color:#fff"><span>Forum International</span>de l'Innovation<br><small>2026</small></div>
            </a>
            <p>Le rendez-vous mondial des décideurs, innovateurs et entrepreneurs engagés pour un avenir durable.</p>
            <nav class="socials">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="Twitter">&#120143;</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Navigation</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('institutionnel') }}">Institutionnel</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
        </div>
        <div class="fc">
            <h4>Aide</h4>
            <a href="{{ route('Faq') }}">FAQ complète</a>
            <a href="{{ route('Faq', ['cat' => 'inscription']) }}">Inscription</a>
            <a href="{{ route('Faq', ['cat' => 'paiement']) }}">Paiement & Tarifs</a>
            <a href="{{ route('Faq', ['cat' => 'partenariat']) }}">Partenariats</a>
            <a href="{{ route('contact') }}">Contact direct</a>
        </div>
        <div class="fc">
            <h4>Contact</h4>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>contact@forum-innovation.org</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81" />
                </svg>+221 33 123 45 67</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                </svg>Lun–Ven 8h–18h (GMT)</div>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} Forum International de l'Innovation. Tous droits réservés.</span>
        <div class="footer-legal">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Confidentialité</a>
            <a href="{{ route('conditions') }}">CGU</a>
        </div>
    </div>
</footer>

@push('scripts')
<script>
    // ── Toggle FAQ accordion ───────────────────────────────────────────
    function toggleFaq(id) {
        const item = document.getElementById('faq-' + id);
        if (!item) return;
        const isOpen = item.classList.contains('open');
        // Fermer tous les items ouverts
        document.querySelectorAll('.faq-item.open').forEach(el => {
            el.classList.remove('open');
            const ans = el.querySelector('.faq-answer');
            if (ans) {
                ans.style.maxHeight = '0';
                ans.setAttribute('aria-hidden', 'true');
            }
        });
        // Ouvrir si était fermé
        if (!isOpen) {
            item.classList.add('open');
            const ans = item.querySelector('.faq-answer');
            if (ans) {
                ans.style.maxHeight = ans.scrollHeight + 'px';
                ans.setAttribute('aria-hidden', 'false');
            }
            // Scroll vers la question
            setTimeout(() => item.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            }), 100);
        }
    }

    // ── Ouvrir depuis un chip populaire ───────────────────────────────
    function openFaq(id) {
        const item = document.getElementById('faq-' + id);
        if (!item) return;
        // Fermer les autres
        document.querySelectorAll('.faq-item.open').forEach(el => {
            el.classList.remove('open');
            const a = el.querySelector('.faq-answer');
            if (a) a.style.maxHeight = '0';
        });
        item.classList.add('open');
        const ans = item.querySelector('.faq-answer');
        if (ans) ans.style.maxHeight = ans.scrollHeight + 'px';
        setTimeout(() => item.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        }), 100);
    }

    // ── Feedback utile ─────────────────────────────────────────────────
    function markHelpful(id, helpful) {
        const actions = document.querySelector('#faq-' + id + ' .faq-answer-actions');
        if (actions) {
            actions.innerHTML = helpful ?
                '<span style="font-size:12px;color:#2e7d32;font-weight:700">✓ Merci pour votre retour !</span>' :
                '<span style="font-size:12px;color:#718096">Merci. <a href="{{ route("contact") }}" style="color:#0d1b3e;font-weight:700">Contactez-nous</a> pour plus d\'aide.</span>';
        }
    }

    // ── Ouvrir le FAQ ciblé via ancre URL (#faq-N) ────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash;
        if (hash && hash.startsWith('#faq-')) {
            const id = parseInt(hash.replace('#faq-', ''));
            if (!isNaN(id)) setTimeout(() => openFaq(id), 200);
        }
    });
</script>
@endpush

@endsection