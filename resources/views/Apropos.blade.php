{{-- resources/views/apropos/index.blade.php --}}
@extends('layouts.app')

@section('title', 'À propos — Forum International de l\'Innovation 2026')

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

    .hero {
        /* Superposition : Le dégradé officiel passe au premier plan avec une opacité réduite à droite, suivi de votre image */
        background-image:
            linear-gradient(108deg, #060e20 0%, #0d1b3e 45%, rgba(13, 27, 62, 0.75) 75%, rgba(15, 42, 94, 0.4) 100%),
            url('/images/dav.jpg');
        /* <-- Déposez votre image sous ce nom dans public/images/ */

        background-color: #060e20;
        /* Couleur de secours pendant le chargement */
        background-repeat: no-repeat;
        background-position: right center;
        /* Oriente l'illustration vers la droite */
        background-size: cover;
        /* Permet à l'image de couvrir tout l'espace proprement */
        padding: 5rem 2.5rem 4.5rem;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .hero::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245, 166, 35, .06) 0%, transparent 70%);
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
        margin-bottom: 1.5rem;
    }

    .hero h1 {
        color: #fff;
        font-size: 3rem;
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

    .hero-tagline {
        color: #f5a623;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .9rem;
        line-height: 1.75;
        max-width: 640px;
        margin: 0 auto 2.5rem;
    }

    .hero-actions {
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
        padding: 13px 28px;
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
        display: grid;
        grid-template-columns: repeat(6, 1fr);
    }

    .stat-item {
        padding: 1.5rem 1.25rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-right: 1px solid #e2e8f0;
        text-align: center;
    }

    .stat-item:last-child {
        border-right: none;
    }

    .stat-icon-wrap {
        width: 40px;
        height: 40px;
        background: rgba(13, 27, 62, .06);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon-wrap svg {
        width: 20px;
        height: 20px;
        stroke: #0d1b3e;
        fill: none;
        stroke-width: 1.8;
    }

    .stat-num {
        font-size: 1.5rem;
        font-weight: 900;
        color: #0d1b3e;
        display: block;
        line-height: 1;
    }

    .stat-lbl {
        font-size: 10px;
        color: #718096;
        font-weight: 600;
        line-height: 1.3;
    }

    /* ── MISSION ── */
    .mission-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        min-height: 420px;
    }

    .mission-left {
        background: #0d1b3e;
        padding: 4rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .mission-eyebrow {
        font-size: 10px;
        font-weight: 800;
        color: #f5a623;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .mission-title {
        font-size: 1.9rem;
        font-weight: 900;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 1.25rem;
    }

    .mission-title span {
        color: #f5a623;
    }

    .mission-text {
        color: rgba(255, 255, 255, .7);
        font-size: .9rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }

    .mission-quote {
        border-left: 3px solid #f5a623;
        padding-left: 1.25rem;
        color: rgba(255, 255, 255, .85);
        font-size: .95rem;
        font-style: italic;
        line-height: 1.65;
        margin: 1.5rem 0;
    }

    .mission-right {
        background: linear-gradient(135deg, #eef2ff 0%, #f4f6fa 100%);
        padding: 4rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 1.5rem;
    }

    .vision-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .vision-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .vision-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .vision-title {
        font-size: 13px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 4px;
    }

    .vision-text {
        font-size: 12px;
        color: #718096;
        line-height: 1.55;
    }

    /* ── VALEURS ── */
    .valeurs-section {
        padding: 5rem 2.5rem;
        background: #fff;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-eyebrow {
        font-size: 10px;
        font-weight: 800;
        color: #f5a623;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 900;
        color: #0d1b3e;
        margin-bottom: .75rem;
    }

    .section-desc {
        font-size: .9rem;
        color: #718096;
        line-height: 1.65;
        max-width: 540px;
        margin: 0 auto;
    }

    .valeurs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .valeur-card {
        border-radius: 12px;
        padding: 1.75rem;
        border: 1px solid #e2e8f0;
        transition: transform .2s, box-shadow .2s;
    }

    .valeur-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(13, 27, 62, .1);
    }

    .valeur-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.1rem;
    }

    .valeur-icon svg {
        width: 26px;
        height: 26px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .valeur-title {
        font-size: 15px;
        font-weight: 800;
        color: #162552;
        margin-bottom: 8px;
    }

    .valeur-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.7;
    }

    /* ── TIMELINE ── */
    .timeline-section {
        padding: 5rem 2.5rem;
        background: #f4f6fa;
    }

    .timeline-wrap {
        position: relative;
        max-width: 860px;
        margin: 0 auto;
    }

    .timeline-line {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
        transform: translateX(-50%);
    }

    .tl-item {
        display: grid;
        grid-template-columns: 1fr 40px 1fr;
        gap: 1.5rem;
        align-items: center;
        margin-bottom: 2.5rem;
    }

    .tl-item:last-child {
        margin-bottom: 0;
    }

    .tl-content-left {
        text-align: right;
    }

    .tl-content-right {
        text-align: left;
    }

    .tl-annee {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .tl-titre {
        font-size: 15px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 5px;
    }

    .tl-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.6;
    }

    .tl-dot {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        z-index: 1;
        position: relative;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
    }

    .tl-dot svg {
        width: 18px;
        height: 18px;
        stroke: #fff;
        fill: none;
        stroke-width: 2;
    }

    /* ── EQUIPE ── */
    .equipe-section {
        padding: 5rem 2.5rem;
        background: #fff;
    }

    .equipe-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .equipe-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.75rem;
        text-align: center;
        transition: box-shadow .2s;
    }

    .equipe-card:hover {
        box-shadow: 0 4px 16px rgba(13, 27, 62, .08);
    }

    .eq-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #0d1b3e, #162552);
        border: 3px solid #f5a623;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .eq-avatar img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
    }

    .eq-init {
        color: #f5a623;
        font-size: 22px;
        font-weight: 700;
    }

    .eq-name {
        font-size: 14px;
        font-weight: 700;
        color: #162552;
        margin-bottom: 4px;
    }

    .eq-poste {
        font-size: 12px;
        color: #718096;
        line-height: 1.4;
        margin-bottom: 12px;
    }

    .eq-linkedin {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        color: #1565c0;
        text-decoration: none;
        background: #e3f2fd;
        padding: 5px 12px;
        border-radius: 4px;
        transition: background .2s;
    }

    .eq-linkedin:hover {
        background: #bbdefb;
    }

    .eq-linkedin svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── PARTENAIRES ── */
    .partenaires-section {
        padding: 4rem 2.5rem;
        background: #f4f6fa;
    }

    .partenaires-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 12px;
    }

    .partenaire-item {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: .85rem .5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        transition: box-shadow .2s;
    }

    .partenaire-item:hover {
        box-shadow: 0 2px 10px rgba(13, 27, 62, .07);
    }

    .partenaire-logo {
        width: 40px;
        height: 32px;
        background: #eef2ff;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .partenaire-logo img {
        max-width: 36px;
        max-height: 28px;
        object-fit: contain;
    }

    .partenaire-init {
        font-size: 11px;
        font-weight: 800;
        color: #0d1b3e;
    }

    .partenaire-nom {
        font-size: 9px;
        color: #718096;
        text-align: center;
        line-height: 1.25;
    }

    /* ── FAQ ── */
    .faq-section {
        padding: 5rem 2.5rem;
        background: #0d1b3e;
    }

    .faq-section .section-title {
        color: #fff;
    }

    .faq-section .section-desc {
        color: rgba(255, 255, 255, .6);
    }

    .faq-list {
        max-width: 760px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 1px;
    }

    .faq-item {
        background: rgba(255, 255, 255, .05);
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .faq-question {
        padding: 1.1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        cursor: pointer;
    }

    .faq-q-text {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        line-height: 1.4;
    }

    .faq-toggle {
        width: 28px;
        height: 28px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: none;
        cursor: pointer;
        transition: background .2s;
    }

    .faq-toggle svg {
        width: 14px;
        height: 14px;
        stroke: #f5a623;
        fill: none;
        stroke-width: 2.5;
        transition: transform .2s;
    }

    .faq-answer {
        padding: 0 1.25rem 1.1rem;
        font-size: 13px;
        color: rgba(255, 255, 255, .65);
        line-height: 1.7;
        display: none;
    }

    .faq-item.open .faq-answer {
        display: block;
    }

    .faq-item.open .faq-toggle {
        background: #f5a623;
    }

    .faq-item.open .faq-toggle svg {
        stroke: #0d1b3e;
        transform: rotate(45deg);
    }

    /* ── CTA ── */
    .cta-section {
        padding: 5rem 2.5rem;
        background: linear-gradient(108deg, #0d1b3e, #162552);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245, 166, 35, .08) 0%, transparent 70%);
        pointer-events: none;
    }

    .cta-eyebrow {
        font-size: 10px;
        font-weight: 800;
        color: #f5a623;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: .75rem;
        position: relative;
        z-index: 1;
    }

    .cta-title {
        font-size: 2rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: .75rem;
        position: relative;
        z-index: 1;
    }

    .cta-desc {
        color: rgba(255, 255, 255, .6);
        font-size: .9rem;
        line-height: 1.65;
        max-width: 520px;
        margin: 0 auto 2rem;
        position: relative;
        z-index: 1;
    }

    .cta-btns {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
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
@endsection

@section('content')

@include('components.navbar')


{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-eyebrow">Forum International de l'Innovation 2026</div>
    <h1>À <span>Propos</span> du Forum</h1>
    <p class="hero-tagline">Innover, Collaborer, Transformer l'Avenir</p>
    <p class="hero-desc">
        Le Forum International de l'Innovation est la plateforme de référence réunissant
        décideurs, entrepreneurs, investisseurs, chercheurs et membres de la diaspora africaine
        autour des grands défis du développement durable et de l'innovation.
    </p>
    <div class="hero-actions">
        <a href="#mission" class="btn-gold">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            Notre mission
        </a>
        <a href="{{ route('inscription') }}" class="btn-outline-w">Rejoindre le Forum</a>
    </div>
</section>

{{-- ══ STATS ══ --}}
<div class="stats-bar">
    @foreach ($stats as $s)
    <div class="stat-item">
        <div class="stat-icon-wrap">
            <svg viewBox="0 0 24 24" aria-hidden="true">{!! $s['icon'] !!}</svg>
        </div>
        <span class="stat-num">{{ $s['valeur'] }}</span>
        <div class="stat-lbl">{{ $s['label'] }}</div>
    </div>
    @endforeach
</div>

{{-- ══ MISSION & VISION ══ --}}
<section class="mission-section" id="mission">
    <div class="mission-left">
        <div class="mission-eyebrow">Notre raison d'être</div>
        <h2 class="mission-title">
            Un Forum au service de<br>
            <span>l'Afrique qui innove</span>
        </h2>
        <p class="mission-text">
            Le Forum International de l'Innovation 2026 est né d'une conviction forte :
            l'Afrique possède les talents, les ressources et l'énergie pour devenir un
            acteur majeur de l'économie mondiale. Ce Forum est le catalyseur de cette transformation.
        </p>
        <div class="mission-quote">
            « Ensemble, nous pouvons construire des ponts entre les talents de la diaspora
            et les opportunités sur le continent africain. L'innovation est notre passeport
            pour l'avenir. »
        </div>
        <p class="mission-text">
            Chaque édition réunit des esprits brillants, des institutions engagées et des
            entrepreneurs déterminés pour créer des synergies concrètes et durables.
        </p>
    </div>
    <div class="mission-right">
        <div class="vision-card">
            <div class="vision-icon" style="background:#fff8e6;color:#f5a623">
                <svg viewBox="0 0 24 24">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
            </div>
            <div>
                <div class="vision-title">Notre Vision</div>
                <p class="vision-text">Faire de l'Afrique un hub mondial d'innovation et de création de valeur, porté par sa diaspora et ses entrepreneurs.</p>
            </div>
        </div>
        <div class="vision-card">
            <div class="vision-icon" style="background:#e3f2fd;color:#1565c0">
                <svg viewBox="0 0 24 24">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                    <polyline points="17 6 23 6 23 12" />
                </svg>
            </div>
            <div>
                <div class="vision-title">Notre Mission</div>
                <p class="vision-text">Créer des espaces de dialogue, de collaboration et de co-création entre les acteurs du développement africain, en Afrique et dans la diaspora.</p>
            </div>
        </div>
        <div class="vision-card">
            <div class="vision-icon" style="background:#e8f5e9;color:#2e7d32">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 8v4l3 3" />
                </svg>
            </div>
            <div>
                <div class="vision-title">Notre Engagement</div>
                <p class="vision-text">Générer des résultats concrets : partenariats signés, projets financés, emplois créés et solutions innovantes déployées sur le continent.</p>
            </div>
        </div>
    </div>
</section>

{{-- ══ VALEURS ══ --}}
<section class="valeurs-section">
    <div class="section-header">
        <div class="section-eyebrow">Ce qui nous guide</div>
        <h2 class="section-title">Nos valeurs fondamentales</h2>
        <p class="section-desc">Six valeurs qui définissent l'identité du Forum et orientent chacune de nos décisions.</p>
    </div>
    <div class="valeurs-grid">
        @foreach ($valeurs as $v)
        <div class="valeur-card" style="background:{{ $v['bg'] }};border-color:{{ $v['couleur'] }}22">
            <div class="valeur-icon" style="background:{{ $v['couleur'] }}18;color:{{ $v['couleur'] }}">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $v['icon'] !!}</svg>
            </div>
            <div class="valeur-title" style="color:{{ $v['couleur'] }}">{{ $v['titre'] }}</div>
            <p class="valeur-desc">{{ $v['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ TIMELINE ══ --}}
<section class="timeline-section">
    <div class="section-header">
        <div class="section-eyebrow">Notre parcours</div>
        <h2 class="section-title">L'histoire du Forum</h2>
        <p class="section-desc">De l'idée initiale à l'événement international de référence en quatre étapes clés.</p>
    </div>
    <div class="timeline-wrap">
        <div class="timeline-line"></div>
        @foreach ($timeline as $i => $tl)
        @php $isLeft = $i % 2 === 0; @endphp
        <div class="tl-item">
            {{-- Contenu gauche --}}
            <div class="tl-content-left">
                @if ($isLeft)
                <div class="tl-annee" style="color:{{ $tl['couleur'] }}">{{ $tl['annee'] }}</div>
                <div class="tl-titre">{{ $tl['titre'] }}</div>
                <p class="tl-desc">{{ $tl['desc'] }}</p>
                @endif
            </div>
            {{-- Dot --}}
            <div class="tl-dot" style="background:{{ $tl['couleur'] }}">
                <svg viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </div>
            {{-- Contenu droite --}}
            <div class="tl-content-right">
                @if (!$isLeft)
                <div class="tl-annee" style="color:{{ $tl['couleur'] }}">{{ $tl['annee'] }}</div>
                <div class="tl-titre">{{ $tl['titre'] }}</div>
                <p class="tl-desc">{{ $tl['desc'] }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ ÉQUIPE ══ --}}
<section class="equipe-section">
    <div class="section-header">
        <div class="section-eyebrow">Les visages du Forum</div>
        <h2 class="section-title">Notre équipe organisatrice</h2>
        <p class="section-desc">Une équipe passionnée et engagée, dédiée à faire du Forum un événement d'exception.</p>
    </div>
    <div class="equipe-grid">
        @foreach ($equipe as $membre)
        <div class="equipe-card">
            <div class="eq-avatar">
                @if ($membre['photo'])
                <img src="{{ asset('images/'.$membre['photo']) }}" alt="{{ $membre['nom'] }}">
                @else
                <span class="eq-init">{{ strtoupper(substr($membre['nom'],0,1)) }}</span>
                @endif
            </div>
            <div class="eq-name">{{ $membre['nom'] }}</div>
            <div class="eq-poste">{{ $membre['poste'] }}</div>
            <a href="{{ $membre['linkedin'] }}" class="eq-linkedin" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24">
                    <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z" />
                    <rect x="2" y="9" width="4" height="12" />
                    <circle cx="4" cy="4" r="2" />
                </svg>
                LinkedIn
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ GRILLE DES LOGOS PARTENAIRES (SÉCURISÉE) ══ --}}
<section class="partenaires-logos-section" style="max-width: 1280px; margin: 3rem auto; padding: 0 2rem;">
    <div style="text-align: center; margin-bottom: 2rem;">
        <h2 style="font-size: 13px; font-weight: 900; color: #0d1b3e; letter-spacing: .1em; text-transform: uppercase;">
            Ils soutiennent le Forum
        </h2>
    </div>

    {{-- Grille fluide s'adaptant à tous les écrans --}}
    <div class="partenaires-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1.5rem; align-items: center;">
        @foreach ($partenaires as $p)
        <div class="partenaire-logo-box" title="{{ $p['nom'] }}" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; height: 75px; display: flex; align-items: center; justify-content: center; padding: 12px; box-shadow: 0 2px 8px rgba(13,27,62,0.01); transition: all 0.2s; flex-shrink: 0;">

            @if ($p['logo'])
            {{-- ✅ Le secret anti-écrasement : object-fit: contain --}}
            <img src="{{ asset('images/' . $p['logo']) }}" alt="Logo {{ $p['nom'] }}" loading="lazy"
                style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; display: block; filter: grayscale(20%);">
            @else
            <span style="font-size: 14px; font-weight: 800; color: #a0aec0; letter-spacing: 0.05em;">
                {{ $p['initiale'] }}
            </span>
            @endif

        </div>
        @endforeach
    </div>
</section>


{{-- ══ FAQ ══ --}}
{{-- ══ FAQ ══ --}}
<section class="faq-section" style="background: #ffffff; padding: 4rem 2.5rem; width: 100%;">
    <div class="section-header" style="text-align: center; margin-bottom: 3rem;">
        <div class="section-eyebrow" style="color: #f5a623; text-transform: uppercase; font-size: 11px; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 6px;">Questions fréquentes</div>
        <h2 class="section-title" style="font-size: 1.8rem; font-weight: 800; color: #0d1b3e; text-transform: uppercase; margin-top: 5px;">Tout ce que vous devez savoir</h2>
        <p class="section-desc" style="color: #718096; font-size: 0.95rem; max-width: 600px; margin: 8px auto 0 auto;">Les réponses aux questions les plus posées sur le Forum International de l'Innovation.</p>
    </div>

    <div class="faq-list" role="list" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 12px;">
        @foreach ($faq as $i => $item)
        <div class="faq-item" role="listitem" id="faq-{{ $i }}" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; transition: all 0.2s ease;">
            <div class="faq-question" onclick="toggleFaq({{ $i }})" style="display: flex; justify-content: space-between; align-items: center; padding: 1.1rem 1.25rem; cursor: pointer; user-select: none; gap: 15px;">
                <span class="faq-q-text" style="font-size: 13px; font-weight: 700; color: #0d1b3e; line-height: 1.4;">{{ $item['q'] }}</span>
                <button class="faq-toggle" type="button" aria-expanded="false" aria-controls="faq-ans-{{ $i }}" style="background: transparent; border: none; color: #0d1b3e; cursor: pointer; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: transform 0.2s ease;">
                    <svg viewBox="0 0 24 24" style="width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2.5; stroke-linecap: round;">
                        <line x1="12" y1="5" x2="12" y2="19" class="plus-v-line" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>
            </div>
            <div class="faq-answer" id="faq-ans-{{ $i }}" role="region" style="max-height: 0; overflow: hidden; transition: max-height 0.25s ease-out; font-size: 12.5px; color: #4a5568; line-height: 1.6; padding: 0 1.25rem;">
                <div style="padding-bottom: 1.1rem;">{{ $item['r'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="text-align:center;margin-top:2.5rem">
        <a href="{{ route('Faq') }}" style="font-size:13px;font-weight:700;color:#f5a623;text-decoration:none;display:inline-flex;align-items:center;gap:5px; transition: color 0.2s;">
            Voir toutes les questions
            <svg width="13" height="13" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
            </svg>
        </a>
    </div>
</section>


{{-- ══ CTA ══ --}}
<section class="cta-section">
    <div class="cta-eyebrow">Rejoignez l'aventure</div>
    <h2 class="cta-title">Prêt à faire partie du Forum 2026 ?</h2>
    <p class="cta-desc">
        Que vous soyez entrepreneur, investisseur, partenaire ou simplement passionné d'innovation,
        votre place est au Forum International de l'Innovation.
    </p>
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
</section>

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
                <a href="#" aria-label="Instagram">&#9752;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Navigation</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('institutionnel') }}">Institutionnel</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
            <a href="{{ route('Apropos') }}">À propos</a>
        </div>
        <div class="fc">
            <h4>Participer</h4>
            <a href="{{ route('inscription') }}">S'inscrire</a>
            <a href="{{ route('partenaires.devenir') }}">Devenir partenaire</a>
            <a href="{{ route('emploi') }}">Emploi &amp; Recrutement</a>
            <a href="{{ route('cartographie') }}">Cartographie Diaspora</a>
            <a href="{{ route('Faq') }}">FAQ</a>
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
    function toggleFaq(index) {
        const item = document.getElementById('faq-' + index);
        const btn = item.querySelector('.faq-toggle');
        const isOpen = item.classList.contains('open');
        // Fermer tous
        document.querySelectorAll('.faq-item').forEach(el => {
            el.classList.remove('open');
            el.querySelector('.faq-toggle').setAttribute('aria-expanded', 'false');
        });
        // Ouvrir si fermé
        if (!isOpen) {
            item.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
        }
    }
</script>
@endpush

@endsection