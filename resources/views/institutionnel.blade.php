{{-- resources/views/institutionnel/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Espace Institutionnel — JEFIE PARIS 2026')

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
        gap: 1.6rem;
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
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: opacity .2s;
    }

    .btn-inscr:hover {
        opacity: .9;
    }

    /* ── PAGE LAYOUT ── */
    .page-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        align-items: start;
        /* La sidebar ne s'étire pas jusqu'en bas */
    }

    .main-content {
        flex: 1;
        padding: 0;
        min-width: 0;
        /* Évite le dépassement horizontal */
    }

    /* ══ SIDEBAR ══ */
    .left-sidebar {
        width: 260px;
        background: #0f284e;
        border-right: 1px solid #e2e8f0;
        padding: 1.5rem 0;
        display: flex;
        flex-direction: column;
        /* La sidebar prend exactement la hauteur de son contenu */
        height: fit-content;
        position: sticky;
        /* Elle reste visible au scroll sans s'étirer */
        top: 64px;
        /* Colle sous la navbar sticky */
        align-self: start;
        box-sizing: border-box;
        overflow: hidden;
        /* Évite tout débordement interne */
    }

    .ls-header {
        padding: 1rem 1.5rem 1.5rem;
    }

    .ls-header-title {
        font-size: 13px;
        font-weight: 900;
        color: #f5c518;
        text-transform: uppercase;
        letter-spacing: .07em;
        line-height: 1.35;
    }

    .ls-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 1.5rem;
        font-size: 14px;
        color: #4a5568;
        text-decoration: none;
        transition: background .15s, color .15s;
        border-left: 3px solid transparent;
    }

    .ls-item:hover {
        background: #f4f6fa;
        color: #0f284e;
    }

    .ls-item.active {
        background: #0f284e;
        color: #fff;
        border-left-color: #f5c518;
        font-weight: 700;
    }

    .ls-item svg {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .ls-item.active svg {
        stroke: #f5c518;
    }

    .ls-partner-box {
        margin: 1.25rem;
        background: #0a2156ff;
        border-radius: 8px;
        padding: 1.1rem;
        text-align: center;
    }

    .ls-partner-icon {
        width: 40px;
        height: 40px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto .75rem;
    }

    .ls-partner-icon svg {
        width: 22px;
        height: 22px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.6;
    }

    .ls-partner-title {
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .ls-partner-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 13px;
        line-height: 1.55;
        margin-bottom: 14px;
    }

    .ls-partner-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 11px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        width: 100%;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: opacity .2s;
    }

    .ls-partner-btn:hover {
        opacity: .9;
    }

    /* 2. Le conteneur de droite (Langue + Bouton Inscription) doit être en flex horizontal */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 1rem;
        /* Espace souhaité entre le sélecteur de langue et le bouton */
    }









    /* ══ HERO ══ */
    .hero {
        background: linear-gradient(105deg, #060e20 0%, #262d3e 55%, #1054d0 100%);
        padding: 5rem 3rem 4.5rem;
        min-height: auto;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        background-color: rgba(16, 16, 16, .7);
        background-blend-mode: overlay;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .hero-left {
        flex: 1;
        position: relative;
        z-index: 2;
        max-width: 700px;
        text-align: center;
    }

    .hero-left h1 {
        color: #fff;
        font-size: 2.5rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -.02em;
        line-height: 1.05;
        margin-bottom: .8rem;
    }

    .hero-tagline {
        color: #f5c518;
        font-size: 1.15rem;
        font-weight: 700;
        font-style: italic;
        margin-bottom: 1rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: 1.05rem;
        line-height: 1.7;
    }

    .hero-stats {
        display: flex;
        gap: 1.5rem;
        position: relative;
        z-index: 2;
        flex-wrap: wrap;
        margin-left: auto;
        justify-content: flex-end;
    }

    .hstat {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .hstat-icon {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, .1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hstat-icon svg {
        width: 20px;
        height: 20px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .hstat-num {
        color: #fff;
        font-size: 1.4rem;
        font-weight: 900;
        display: block;
        line-height: 1;
    }

    .hstat-lbl {
        color: rgba(255, 255, 255, .55);
        font-size: 15px;
        margin-top: 2px;
        white-space: pre-line;
    }

    /* ══ MAIN ══ */
    .main-content {
        padding: 0;
    }

    .top-sections {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 1px;
        background: #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .top-section {
        background: #fff;
        padding: 2.5rem 2rem;
    }

    .ts-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
        border-bottom: 2px solid #f5c518;
        padding-bottom: 8px;
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .ts-body {
        font-size: 15px;
        line-height: 1.8;
        color: #4a5568;
        margin-bottom: 1.25rem;
    }

    .ts-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        transition: color .2s;
    }

    .ts-link:hover {
        color: #f5c518;
    }

    .ts-link svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Objectifs */
    .obj-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-bottom: 1.5rem;
    }

    .obj-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .obj-icon {
        width: 34px;
        height: 34px;
        background: #eef2ff;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .obj-icon svg {
        width: 16px;
        height: 16px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 1.8;
    }

    .obj-text {
        font-size: 15px;
        color: #4a5568;
        line-height: 1.6;
        padding-top: 6px;
    }

    /* Organisateurs */
    .org-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 1.5rem;
    }

    .org-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-align: center;
    }

    .org-logo-box {
        width: 80px;
        height: 68px;
        background: #eef2ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .org-logo-box img {
        max-width: 74px;
        max-height: 62px;
        object-fit: contain;
    }

    .org-logo-init {
        font-size: 14px;
        font-weight: 800;
        color: #0f284e;
    }

    .org-name {
        font-size: 13px;
        color: #4a5568;
        line-height: 1.4;
        text-align: center;
    }

    .org-card-full {
        grid-column: 1/-1;
    }

    /* Partenaires inst. */
    .pi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .pi-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 1rem .75rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 7px;
        text-align: center;
    }

    .pi-logo {
        width: 76px;
        height: 56px;
        background: #eef2ff;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pi-logo img {
        max-width: 70px;
        max-height: 50px;
        object-fit: contain;
    }

    .pi-logo-init {
        font-size: 13px;
        font-weight: 800;
        color: #0f284e;
    }

    .pi-name {
        font-size: 13px;
        color: #4a5568;
        line-height: 1.4;
    }

    /* Section Sponsors — pleine largeur centrée */
    .sponsors-section {
        background: #fff;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        padding: 2.5rem 2rem;
        text-align: center;
    }

    .sponsors-section .ts-title {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .sponsors-section .sponsors-row {
        justify-content: center;
    }

    .sponsors-section .ts-link {
        justify-content: center;
    }

    /* Bottom sections — grille 2 colonnes pour Messages + Documents */
    .bottom-sections {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: #e2e8f0;
        border-top: 1px solid #e2e8f0;
    }

    .bottom-section {
        background: #fff;
        padding: 2.5rem 2rem;
    }

    /* Sponsors */
    .sponsors-row {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .sponsor {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .sponsor-niveau {
        font-size: 12px;
        color: #718096;
        text-align: center;
    }

    /* Messages officiels */
    .msg-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .msg-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .msg-avatar {
        width: 96px;
        height: 96px;
        border-radius: 10px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .msg-avatar img {
        width: 96px;
        height: 96px;
        object-fit: cover;
        display: block;
        border-radius: 7px;
    }

    .msg-avatar-init {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    .msg-quote-mark {
        color: #f5c518;
        font-size: 2rem;
        line-height: 0.7;
    }

    .msg-text {
        font-size: 15px;
        color: #4a5568;
        line-height: 1.65;
        font-style: italic;
    }

    .msg-name {
        font-size: 15px;
        font-weight: 700;
        color: #0a1e38;
    }

    .msg-role {
        font-size: 13px;
        color: #718096;
        line-height: 1.4;
    }

    .bottom-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .ts-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f284e;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .msg-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .msg-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
    }

    .msg-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 1rem;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .msg-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .msg-quote-mark {
        font-size: 2.5rem;
        color: #cbd5e0;
        line-height: 1;
    }

    .msg-text {
        font-size: 0.95rem;
        color: #4a5568;
        line-height: 1.5;
        margin-bottom: 1.25rem;
        flex-grow: 1;
    }

    .msg-footer {
        border-top: 1px solid #edf2f7;
        padding-top: 0.75rem;
        margin-top: auto;
    }

    .msg-name {
        font-weight: 700;
        font-size: 0.95rem;
        color: #1a202c;
    }

    .msg-role {
        font-size: 0.8rem;
        color: #718096;
    }

    /* Ajustement mobile strict si nécessaire */
    @media (max-width: 768px) {
        .msg-grid {
            grid-template-columns: 1fr;
            /* Force une seule colonne sur les petits téléphones */
        }
    }

    /* Documents */
    .doc-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .doc-item:last-child {
        border-bottom: none;
    }

    .doc-icon {
        width: 36px;
        height: 36px;
        background: #fce4ec;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .doc-icon svg {
        width: 17px;
        height: 17px;
        stroke: #c2185b;
        fill: none;
        stroke-width: 1.8;
    }

    .doc-name {
        font-size: 14px;
        font-weight: 600;
        color: #0a1e38;
        flex: 1;
    }

    .doc-meta {
        font-size: 12px;
        color: #a0aec0;
    }

    .doc-dl {
        width: 32px;
        height: 32px;
        background: #f0f4f8;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        flex-shrink: 0;
        transition: background .2s;
    }

    .doc-dl:hover {
        background: #e2e8f0;
    }

    .doc-dl svg {
        width: 15px;
        height: 15px;
        stroke: #0a1e38;
        fill: none;
        stroke-width: 1.8;
    }

    .docs-see-all {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: .75rem;
        transition: color .2s;
    }

    .docs-see-all:hover {
        color: #f5c518;
    }

    .docs-see-all svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* CTA Banner */
    .cta-banner {
        background: #0f284e;
        padding: 3rem 3rem;
        display: flex;
        align-items: center;
        gap: 2.5rem;
        flex-wrap: wrap;
    }

    .cta-left {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex: 1;
    }

    .cta-icon {
        width: 56px;
        height: 56px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cta-icon svg {
        width: 28px;
        height: 28px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.6;
    }

    .cta-stars {
        display: flex;
        gap: 4px;
        margin-bottom: 6px;
    }

    .cta-stars svg {
        width: 18px;
        height: 18px;
        stroke: #f5c518;
        fill: #f5c518;
    }

    .cta-title {
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .cta-desc {
        color: rgba(255, 255, 255, .65);
        font-size: 15px;
        line-height: 1.65;
    }

    .cta-actions {
        display: flex;
        gap: 14px;
        align-items: center;
        flex-wrap: wrap;
    }

    .cta-btn-primary {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 15px;
        padding: 14px 28px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .cta-btn-primary:hover {
        opacity: .9;
    }

    .cta-btn-primary svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .cta-btn-outline {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 15px;
        padding: 13px 26px;
        border-radius: 6px;
        border: 1.5px solid rgba(255, 255, 255, .35);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: background .2s;
    }

    .cta-btn-outline:hover {
        background: rgba(255, 255, 255, .08);
    }

    .cta-btn-outline svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Style de l'arrière-plan de la modale */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Fenêtre blanche de la modale */
    .modal-content {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        position: relative;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Bouton Fermer (X) */
    .modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
        color: #aaa;
    }

    .modal-close:hover {
        color: #000;
    }

    /* Grid interne pour les infos contact/stand */
    .modal-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }


    /* Footer */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr;
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
        align-items: center;
        gap: 7px;
        font-size: 12px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
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
        gap: 1.25rem;
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

        .left-sidebar {
            display: none;
        }

        .top-sections,
        .bottom-sections {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .top-sections,
        .bottom-sections {
            grid-template-columns: 1fr;
        }

        .hero {
            flex-direction: column;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:480px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .pi-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


<div class="page-layout">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="left-sidebar">
        <div class="ls-header">
            <div class="ls-header-title">Espace<br>Entreprise</div>
        </div>
        <a href="#contexte" class="ls-item active"><svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>Contexte du projet</a>
        <a href="#objectifs" class="ls-item"><svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>Objectifs</a>
        <a href="#organisateurs" class="ls-item"><svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>Organisateurs</a>
        <a href="#partenaires-inst" class="ls-item"><svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <path d="M3 9h18M9 21V9" />
            </svg>Partenaires inst.</a>
        <a href="#sponsors" class="ls-item"><svg viewBox="0 0 24 24">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>Sponsors</a>
        <a href="#messages" class="ls-item"><svg viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
            </svg>Messages officiels</a>
        <a href="#documents" class="ls-item"><svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>Documents</a>
        <div class="ls-partner-box">
            <div class="ls-partner-icon"><svg viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                </svg></div>
            <div class="ls-partner-title">Devenez partenaire</div>
            <p class="ls-partner-desc">Associez votre image à un événement d'envergure internationale.</p>
            <a href="{{ route('inscription') }}" class="ls-partner-btn">Participer au forum</a>
        </div>
    </aside>

    {{-- ══ MAIN CONTENT ══ --}}
    <main class="main-content">

        {{-- HERO --}}
        <section class="hero" style="background-image:url('{{ asset('images/Institutionnel.jpg') }}')">
            <div class="hero-left">
                <h1>Entreprises <span style="color: #f5c518;">Participantes</span></h1>

                <p class="hero-desc">Découvrez les acteurs engagés,les documents officiels qui structurent les Journées Economiques
                    et Forum International de l'Emploi de la Diaspora Gabonaise édition Paris 2026.</p>
            </div>

        </section>

        {{-- TOP 4 SECTIONS --}}
        <div class="top-sections">

            {{-- Contexte --}}
            <div class="top-section" id="contexte">
                <div class="ts-title">Contexte du Projet</div>
                <p class="ts-body">
                    Les Journées Économiques & Forum International de l'Emploi de la Diaspora Gabonaise (JEFIE Paris 2026) se tiendront les 27 et 28 novembre 2026 au CNIT Forest – La Défense à Paris. Porté conjointement par le PNPE et l'ANPI sous la vision du Président de la République, Chef de l'État, Chef du Gouvernement Brice Clotaire OLIGUI NGUEMA, cet événement vise à mobiliser
                    la diaspora pour la transformation socio-économique du pays. Il constitue
                    une plateforme opérationnelle destinée à rapprocher les compétences de la diaspora des opportunités d'emploi, à encourager l'entrepreneuriat et à stimuler l'investissement au Gabon. Enfin, cette initiative s'inscrit dans un dispositif pérenne doté de mécanismes de suivi pour mesurer
                    concrètement les recrutements, projets et partenariats générés.
                    <a href="{{ route('Apropos') }}" class="ts-link">
                        En savoir plus
                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
            </div>

            {{-- Objectifs --}}
            <div class="top-section" id="objectifs">
                <div class="ts-title">Objectifs Stratégiques</div>
                <div class="obj-list">
                    @foreach ($objectifs as $obj)
                    <div class="obj-item">
                        <div class="obj-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true">{!! $obj['icon'] !!}</svg>
                        </div>
                        <div class="obj-text">{{ $obj['texte'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Organisateurs --}}
            <div class="top-section" id="organisateurs">
                <div class="ts-title">Organisateurs Officiels</div>
                <div class="org-grid">
                    @foreach ($organisateurs as $org)
                    <!-- Ajout des attributs de données pour le clic -->
                    <div class="org-card {{ $loop->last && count($organisateurs) % 2 !== 0 ? 'org-card-full' : '' }} company-logo-click"
                        data-nom="{{ $org['nom'] }}"
                        data-description="{{ $org['description'] ?? 'Aucune description disponible.' }}"
                        data-email="{{ $org['email'] ?? 'Non renseigné' }}"
                        data-stand="{{ $org['stand'] ?? 'Non attribué' }}"
                        style="cursor: pointer;">

                        <div class="org-logo-box">
                            @if ($org['logo'])
                            <img src="{{ asset('images/'.$org['logo']) }}" alt="{{ $org['nom'] }}">
                            @else
                            <span class="org-logo-init">{{ $org['initiale'] }}</span>
                            @endif
                        </div>
                        <div class="org-name">{{ $org['nom'] }}</div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('partenaires.liste') }}" class="ts-link">En savoir plus...</a>
            </div>

            {{-- Partenaires institutionnels --}}
            <div class="top-section" id="partenaires-inst">
                <div class="ts-title">Partenaires & Institutions</div>
                <div class="pi-grid">
                    @foreach ($partenairesInstitution as $pi)
                    <div class="pi-card company-logo-click"
                        data-nom="{{ $pi['nom'] }}"
                        data-description="{{ $pi['description'] ?? 'Aucune description disponible.' }}"
                        data-email="{{ $pi['email'] ?? 'Non renseigné' }}"
                        data-stand="{{ $pi['stand'] ?? 'Non attribué' }}"
                        style="cursor: pointer;">

                        <div class="pi-logo">
                            @if ($pi['logo'])
                            <img src="{{ asset('images/'.$pi['logo']) }}" alt="{{ $pi['nom'] }}">
                            @else
                            <span class="pi-logo-init">{{ $pi['initiale'] }}</span>
                            @endif
                        </div>
                        <div class="pi-name">{{ $pi['nom'] }}</div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('partenaires.liste') }}" class="ts-link">Voir tous les partenaires...</a>
            </div>

        </div>{{-- /.top-sections --}}



        {{-- ── STRUCTURE DE LA FENÊTRE MODALE pour la description ───────────────────────────────── --}}
        <div id="companyModal" class="modal-overlay" style="display:none;">
            <div class="modal-content">
                <span class="modal-close" onclick="closeCompanyModal()">&times;</span>
                <h2 id="modalTitle">Nom de l'entreprise</h2>

                <div class="modal-body">
                    <h3>Description :</h3>
                    <p id="modalDescription">Détails...</p>

                    <div class="modal-info-grid">
                        <div>
                            <strong>📧 Courriel de contact :</strong>
                            <p id="modalEmail">contact@adresse.com</p>
                        </div>
                        <div>
                            <strong>🎪 Stand attribué :</strong>
                            <p id="modalStand">Stand X</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ BOTTOM 2 SECTIONS : Messages + Documents ══ --}}
        <div class="bottom-sections">

            {{-- Messages officiels --}}
            <div class="bottom-section" id="messages" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
                <div class="ts-title" style="font-size: 1.3rem; font-weight: 800; color: #0f284e; margin-bottom: 1.5rem; text-align: center;">Paroles de Leaders</div>

                <div class="msg-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    @forelse ($messagesOfficiels as $msg)
                    <div class="msg-card" style="background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.05); display: flex; flex-direction: column; position: relative; overflow: hidden;">

                        {{-- Avatar du leader --}}
                        <div class="msg-avatar" style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; margin-bottom: 1rem; flex-shrink: 0; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                            @if ($msg['photo'])
                            <img src="{{ asset('images/'.$msg['photo']) }}" alt="{{ $msg['nom'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                            <span class="msg-avatar-init" style="font-size: 1.2rem; font-weight: bold; color: #4a5568;">{{ strtoupper(substr($msg['nom'],0,1)) }}</span>
                            @endif
                        </div>

                        <div class="msg-quote-mark" style="font-size: 2.5rem; color: #cbd5e0; line-height: 1; margin-bottom: 0.25rem;">&ldquo;</div>

                        <p class="msg-text" style="font-size: 0.95rem; color: #4a5568; line-height: 1.5; margin-bottom: 1.25rem; flex-grow: 1;">{{ $msg['message'] }}</p>

                        <div class="msg-footer" style="border-top: 1px solid #edf2f7; padding-top: 0.75rem; margin-top: auto;">
                            <div class="msg-name" style="font-weight: 700; font-size: 0.95rem; color: #1a202c;">{{ $msg['nom'] }}</div>
                            <div class="msg-role" style="font-size: 0.8rem; color: #718096;">{{ $msg['poste'] }}</div>
                        </div>
                    </div>
                    @empty
                    <p style="color:#a0aec0; font-size:15px; text-align: grid-column: 1 / -1;">Aucun message disponible.</p>
                    @endforelse
                </div>
            </div>{{-- /.bottom-section#messages --}}

            {{-- Documents --}}
            <div class="bottom-section" id="documents">
                <div class="ts-title">Documents & Ressources</div>
                @foreach ($documents as $doc)
                <div class="doc-item">
                    <div class="doc-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0">
                        <div class="doc-name">{{ $doc['nom'] }}</div>
                        <div class="doc-meta">{{ $doc['type'] }} &bull; {{ $doc['taille'] }}</div>
                    </div>
                    <a href="{{ $doc['url'] }}" class="doc-dl" download aria-label="Télécharger">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3" />
                        </svg>
                    </a>
                </div>
                @endforeach
                <a href="{{ route('rapports') }}" class="docs-see-all">
                    Voir tous les documents
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>{{-- /.bottom-section#documents --}}

        </div>{{-- /.bottom-sections --}}

        {{-- CTA BANNER --}}
        <div class="cta-banner">
            <div class="cta-left">
                <div class="cta-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                    </svg>
                </div>
                <div>
                    <div class="cta-stars" aria-hidden="true">
                        @for ($i = 0; $i < 3; $i++)
                            <svg viewBox="0 0 24 24">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            @endfor
                    </div>
                    <div class="cta-title">Rejoignez les acteurs du changement en 2026</div>
                    <p class="cta-desc">Partenaire, sponsor ou institution — associez votre image à un événement international d'envergure et développez votre réseau d'influence en Afrique et dans la diaspora.</p>
                </div>
            </div>
            <div class="cta-actions">
                <a href="{{ route('partenaires.devenir') }}" class="cta-btn-primary">
                    Devenir partenaire
                    <svg viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}" class="cta-btn-outline">
                    Nous contacter
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="M2 7l10 7 10-7" />
                    </svg>
                </a>
            </div>
        </div>

    </main>
</div>{{-- /.page-layout --}}


{{-- ══ FOOTER ══ --}}

@include('components.footer')

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Écouter le clic sur tous les logos configurés
        document.querySelectorAll('.company-logo-click').forEach(element => {
            element.addEventListener('click', function() {
                // Récupération des attributs de données
                const nom = this.getAttribute('data-nom');
                const description = this.getAttribute('data-description');
                const email = this.getAttribute('data-email');
                const stand = this.getAttribute('data-stand');

                // Injection dans la modale
                document.getElementById('modalTitle').innerText = nom;
                document.getElementById('modalDescription').innerText = description;
                document.getElementById('modalEmail').innerText = email;
                document.getElementById('modalStand').innerText = stand;

                // Affichage de la modale
                document.getElementById('companyModal').style.display = 'flex';
            });
        });
    });

    // Fonction pour fermer la modale
    function closeCompanyModal() {
        document.getElementById('companyModal').style.display = 'none';
    }

    // Fermer au clic à l'extérieur de la fenêtre blanche
    window.onclick = function(event) {
        const modal = document.getElementById('companyModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

@endsection