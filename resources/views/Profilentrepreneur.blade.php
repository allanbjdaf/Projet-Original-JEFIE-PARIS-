{{-- resources/views/entrepreneurs/profil.blade.php --}}
@extends('layouts.app')

@section('title', ($profil->nom_complet ?? 'Profil') . ' — Espace Entrepreneurs Diaspora')

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
        padding: 0 1.75rem;
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
        gap: 1.3rem;
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

    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
    }

    .nav-icon-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .nav-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 16px;
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

    /* ── BREADCRUMB ── */
    .breadcrumb {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        padding: .75rem 2rem;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
    }

    .breadcrumb a {
        color: #718096;
        text-decoration: none;
        transition: color .2s;
    }

    .breadcrumb a:hover {
        color: #0f284e;
    }

    .breadcrumb-sep {
        color: #d1d9e6;
    }

    .breadcrumb-current {
        color: #0a1e38;
        font-weight: 600;
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


    /* ── PAGE LAYOUT ── */
    .page-layout {
        display: grid;
        grid-template-columns: 280px 1fr 280px;
        gap: 1.5rem;
        padding: 1.75rem 2rem;
        max-width: 1440px;
        margin: 0 auto;
        align-items: start;
    }

    /* ══ SIDEBAR GAUCHE — CARTE PROFIL ══ */
    .profil-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 80px;
    }

    /* Card identité */
    .id-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .id-card-cover {
        height: 80px;
        background: linear-gradient(108deg, #0f284e, #0a1e38, #1e3472);
        position: relative;
    }

    .id-card-cover::after {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 40'%3E%3Cellipse cx='80' cy='20' rx='60' ry='35' fill='rgba(245,166,35,0.06)'/%3E%3C/svg%3E") no-repeat right/cover;
    }

    .id-card-body {
        padding: 0 1.25rem 1.25rem;
    }

    .id-avatar-wrap {
        margin-top: -36px;
        margin-bottom: .75rem;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }

    .id-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        border: 3px solid #fff;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .id-avatar img {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 50%;
        display: block;
    }

    .id-avatar-init {
        color: #f5c518;
        font-size: 24px;
        font-weight: 700;
    }

    .id-edit-btn {
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all .2s;
    }

    .id-edit-btn:hover {
        background: #0f284e;
        color: #fff;
        border-color: #0f284e;
    }

    .id-edit-btn svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .id-name {
        font-size: 16px;
        font-weight: 800;
        color: #0a1e38;
        margin-bottom: 2px;
    }

    .id-poste {
        font-size: 12px;
        color: #718096;
        margin-bottom: 6px;
    }

    .id-company {
        font-size: 13px;
        font-weight: 600;
        color: #0f284e;
        margin-bottom: 8px;
    }

    .id-verified {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        color: #2e7d32;
        background: #e8f5e9;
        padding: 3px 10px;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .id-verified svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
    }

    .id-sector {
        display: inline-block;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 4px;
        margin-bottom: 12px;
    }

    .sector-tech {
        background: #e3f2fd;
        color: #0f284e;
    }

    .sector-agri {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .sector-conseil {
        background: #ede7f6;
        color: #6a1b9a;
    }

    .sector-commerce {
        background: #fff3e0;
        color: #f5c518;
    }

    .sector-sante {
        background: #fce4ec;
        color: #c2185b;
    }

    .sector-finance {
        background: #e0f7fa;
        color: #00838f;
    }

    /* Progression profil */
    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: #718096;
        margin-bottom: 5px;
    }

    .progress-label strong {
        color: #0f284e;
        font-weight: 700;
    }

    .progress-bar {
        height: 7px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #f5c518, #e09010);
        border-radius: 4px;
        transition: width .5s ease;
    }

    /* Localisation */
    .id-loc {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #718096;
        margin-bottom: 4px;
    }

    .id-loc svg {
        width: 13px;
        height: 13px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    /* Actions rapides */
    .id-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .id-action-btn {
        flex: 1;
        padding: 9px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all .2s;
        text-decoration: none;
        border: none;
    }

    .id-action-btn svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .id-action-primary {
        background: #0f284e;
        color: #fff;
    }

    .id-action-primary:hover {
        background: #0a1e38;
    }

    .id-action-outline {
        background: #fff;
        color: #0a1e38;
        border: 1px solid #e2e8f0;
    }

    .id-action-outline:hover {
        border-color: #0f284e;
    }

    /* Sidebar widget commun */
    .sw-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .sw-title {
        font-size: 11px;
        font-weight: 800;
        color: #0f284e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: .9rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sw-title a {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        text-transform: none;
        letter-spacing: 0;
    }

    .sw-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 0;
        border-bottom: 1px solid #f0f4f8;
        font-size: 12px;
        color: #4a5568;
    }

    .sw-row:last-child {
        border-bottom: none;
    }

    .sw-row svg {
        width: 14px;
        height: 14px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .sw-row strong {
        color: #0a1e38;
        font-weight: 600;
    }

    /* Stats mini */
    .sw-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .sw-stat {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: .75rem;
        text-align: center;
    }

    .sw-stat-num {
        font-size: 1.2rem;
        font-weight: 800;
        color: #0f284e;
        display: block;
    }

    .sw-stat-lbl {
        font-size: 10px;
        color: #718096;
        margin-top: 2px;
    }

    /* ══ CONTENU PRINCIPAL ══ */
    .main-content {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    /* Onglets */
    .tabs-nav {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: .25rem;
        display: flex;
        gap: 2px;
    }

    .tab-btn {
        flex: 1;
        padding: 9px 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        color: #718096;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all .2s;
        white-space: nowrap;
    }

    .tab-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .tab-btn.active {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
    }

    .tab-btn:hover:not(.active) {
        background: #f4f6fa;
        color: #0a1e38;
    }

    /* Section card générique */
    .content-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.5rem;
    }

    .cc-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.1rem;
    }

    .cc-title {
        font-size: 13px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .cc-edit {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        padding: 4px 10px;
        transition: all .2s;
    }

    .cc-edit:hover {
        background: #0f284e;
        color: #fff;
        border-color: #0f284e;
    }

    .cc-edit svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Grille infos 2 colonnes */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .info-label {
        font-size: 10px;
        font-weight: 700;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: .07em;
    }

    .info-value {
        font-size: 13px;
        font-weight: 600;
        color: #0a1e38;
    }

    .info-value.empty {
        color: #a0aec0;
        font-style: italic;
        font-weight: 400;
    }

    /* Tags domaines */
    .tags-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-top: 4px;
    }

    .tag {
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 600;
        color: #0a1e38;
    }

    /* Projets */
    .projet-item {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: .75rem;
        transition: box-shadow .2s;
    }

    .projet-item:last-child {
        margin-bottom: 0;
    }

    .projet-item:hover {
        box-shadow: 0 2px 10px rgba(15, 40, 78, .07);
    }

    .projet-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .75rem;
        margin-bottom: 5px;
    }

    .projet-titre {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
    }

    .projet-status {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
        flex-shrink: 0;
    }

    .projet-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.55;
    }

    .projet-meta {
        display: flex;
        gap: 1rem;
        margin-top: 8px;
    }

    .projet-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #a0aec0;
    }

    .projet-meta-item svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    /* KPI Financiers */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .kpi-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.1rem;
        text-align: center;
    }

    .kpi-num {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0f284e;
        display: block;
    }

    .kpi-lbl {
        font-size: 10px;
        color: #718096;
        margin-top: 4px;
        font-weight: 600;
    }

    .kpi-trend {
        font-size: 10px;
        font-weight: 700;
        color: #2e7d32;
        margin-top: 3px;
    }

    /* Participation forum */
    .forum-status-card {
        background: linear-gradient(108deg, #0f284e, #0a1e38);
        border-radius: 10px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .fsc-icon {
        width: 52px;
        height: 52px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .fsc-icon svg {
        width: 26px;
        height: 26px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.6;
    }

    .fsc-info {
        flex: 1;
    }

    .fsc-title {
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .fsc-sub {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
    }

    .fsc-badge {
        background: rgba(245, 166, 35, .2);
        color: #f5c518;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 4px;
        letter-spacing: .06em;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    /* Alertes complétion */
    .completion-tips {
        background: #fff8e6;
        border: 1px solid rgba(245, 166, 35, .3);
        border-radius: 8px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .completion-tips svg {
        width: 18px;
        height: 18px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .completion-tips p {
        font-size: 12px;
        color: #7a5c10;
        line-height: 1.55;
    }

    .completion-tips a {
        color: #0f284e;
        font-weight: 700;
        text-decoration: none;
    }

    /* ══ SIDEBAR DROITE ══ */
    .right-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 80px;
    }

    /* Compétences */
    .competence-bar {
        margin-bottom: 10px;
    }

    .competence-bar:last-child {
        margin-bottom: 0;
    }

    .competence-header {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        margin-bottom: 4px;
    }

    .competence-name {
        font-weight: 600;
        color: #0a1e38;
    }

    .competence-pct {
        color: #718096;
    }

    .comp-bar-bg {
        height: 6px;
        background: #f0f4f8;
        border-radius: 3px;
        overflow: hidden;
    }

    .comp-bar-fill {
        height: 100%;
        border-radius: 3px;
    }

    /* Réseaux sociaux */
    .social-links {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .social-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        text-decoration: none;
        transition: all .2s;
        font-size: 12px;
        font-weight: 600;
        color: #0a1e38;
    }

    .social-link:hover {
        border-color: #0f284e;
        background: #f8fafc;
    }

    .social-icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .social-icon svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .social-link span {
        flex: 1;
    }

    .social-add {
        font-size: 11px;
        color: #a0aec0;
        margin-left: auto;
    }

    /* RDV widget */
    .rdv-widget {
        background: #f5c518;
        border-radius: 10px;
        padding: 1.25rem;
    }

    .rdv-widget-title {
        font-size: 13px;
        font-weight: 800;
        color: #0f284e;
        margin-bottom: 4px;
    }

    .rdv-widget-desc {
        font-size: 11px;
        color: rgba(15, 40, 78, .7);
        margin-bottom: 12px;
        line-height: 1.45;
    }

    .rdv-widget-btn {
        background: #0f284e;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 10px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        transition: background .2s;
        text-decoration: none;
    }

    .rdv-widget-btn:hover {
        background: #0a1e38;
    }

    .rdv-widget-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Suggérés */
    .suggested-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .suggested-item:last-child {
        border-bottom: none;
    }

    .sug-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .sug-name {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
    }

    .sug-co {
        font-size: 11px;
        color: #718096;
    }

    .sug-follow {
        margin-left: auto;
        font-size: 10px;
        font-weight: 700;
        color: #0f284e;
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 4px 8px;
        cursor: pointer;
        transition: all .2s;
        flex-shrink: 0;
        text-decoration: none;
    }

    .sug-follow:hover {
        background: #0f284e;
        color: #fff;
        border-color: #0f284e;
    }

    /* ── FOOTER ── */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2rem 2rem 0;
        margin-top: 2rem;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: .85rem 0;
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

    .footer-links {
        display: flex;
        gap: 1rem;
    }

    .footer-links a {
        font-size: 11px;
        color: rgba(255, 255, 255, .4);
        text-decoration: none;
    }

    .footer-links a:hover {
        color: rgba(255, 255, 255, .7);
    }

    @media (max-width:1200px) {
        .page-layout {
            grid-template-columns: 260px 1fr;
        }

        .right-sidebar {
            display: none;
        }

        .kpi-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:900px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .profil-sidebar {
            position: static;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .tabs-nav {
            overflow-x: auto;
        }
    }

    @media (max-width:600px) {
        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .hero h1 {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


{{-- ══ BREADCRUMB ══ --}}
<div class="breadcrumb">
    <a href="{{ route('home') }}">Accueil</a>
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('entrepreneurs.dashboard') }}">Espace Entrepreneurs</a>
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('entrepreneurs.annuaire') }}">Annuaire</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">{{ $profil->nom_complet ?? 'Profil' }}</span>
</div>

<div class="page-layout">

    {{-- ══ SIDEBAR GAUCHE ══ --}}
    <aside>
        <div class="profil-sidebar">

            {{-- Carte identité --}}
            <div class="id-card">
                <div class="id-card-cover"></div>
                <div class="id-card-body">
                    <div class="id-avatar-wrap">
                        <div class="id-avatar">
                            @if ($profil->photo)
                            <img src="{{ asset('storage/'.$profil->photo) }}" alt="{{ $profil->nom_complet }}">
                            @else
                            <span class="id-avatar-init">{{ strtoupper(substr($profil->nom_complet ?? 'E', 0, 1)) }}</span>
                            @endif
                        </div>
                        @auth
                        @if (auth()->id() === $profil->user_id)
                        <a href="{{ route('entrepreneurs.profil.edit') }}" class="id-edit-btn">
                            <svg viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Modifier
                        </a>
                        @endif
                        @endauth
                    </div>

                    <div class="id-name">{{ $profil->nom_complet }}</div>
                    <div class="id-poste">{{ $profil->poste }}</div>
                    <div class="id-company">{{ $profil->entreprise }}</div>

                    @if ($profil->profil_verifie)
                    <div class="id-verified">
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        Profil vérifié
                    </div><br>
                    @endif

                    <span class="id-sector sector-{{ $profil->secteur_css ?? 'tech' }}">
                        {{ $profil->secteur_activite }}
                    </span>

                    <div class="id-loc">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ $profil->ville }}@if($profil->pays_residence), {{ $profil->pays_residence }}@endif
                    </div>
                    <div class="id-loc">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        {{ $profil->taille_employes ?? '—' }} employés
                    </div>
                    <div class="id-loc">
                        <svg viewBox="0 0 24 24">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                        </svg>
                        CA : {{ $profil->chiffre_affaires ?? 'Non renseigné' }}
                    </div>

                    {{-- Complétion profil --}}
                    @php $completion = $profil->completion ?? 0; @endphp
                    <div class="progress-label" style="margin-top:12px">
                        <span>Complétion du profil</span>
                        <strong>{{ $completion }}%</strong>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?php echo $completion; ?>%"></div>
                    </div>

                    {{-- Actions --}}
                    <div class="id-actions">
                        @auth
                        @if (auth()->id() !== $profil->user_id)
                        <a href="#" class="id-action-btn id-action-primary">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <path d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                            RDV B2B
                        </a>
                        <a href="{{ route('entrepreneurs.messages') }}" class="id-action-btn id-action-outline">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                            </svg>
                            Message
                        </a>
                        @else
                        <a href="{{ route('entrepreneurs.profil.edit') }}" class="id-action-btn id-action-primary">
                            <svg viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Modifier le profil
                        </a>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="id-action-btn id-action-primary">
                            <svg viewBox="0 0 24 24">
                                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                            </svg>
                            Se connecter
                        </a>
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Stats rapides --}}
            <div class="sw-card">
                <div class="sw-title">En chiffres</div>
                <div class="sw-stats">
                    <div class="sw-stat">
                        <span class="sw-stat-num">{{ $profil->taille_employes ?? '—' }}</span>
                        <div class="sw-stat-lbl">Employés</div>
                    </div>
                    <div class="sw-stat">
                        <span class="sw-stat-num">{{ $profil->chiffre_affaires ?? '—' }}</span>
                        <div class="sw-stat-lbl">CA annuel</div>
                    </div>
                    <div class="sw-stat">
                        <span class="sw-stat-num">{{ $profil->capacite_investissement ?? '—' }}</span>
                        <div class="sw-stat-lbl">Investissement</div>
                    </div>
                    <div class="sw-stat">
                        <span class="sw-stat-num">{{ $profil->taille_entreprise ?? '—' }}</span>
                        <div class="sw-stat-lbl">Type</div>
                    </div>
                </div>
            </div>

            {{-- Infos complémentaires --}}
            <div class="sw-card">
                <div class="sw-title">Informations</div>
                <div class="sw-row">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <span><strong>Secteur : </strong>{{ $profil->secteur_activite ?? '—' }}</span>
                </div>
                <div class="sw-row">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M2 12h20" />
                    </svg>
                    <span><strong>Pays : </strong>{{ $profil->pays_residence ?? '—' }}</span>
                </div>
                <div class="sw-row">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    <span><strong>Membre depuis : </strong>{{ $profil->created_at?->translatedFormat('M Y') ?? '—' }}</span>
                </div>
            </div>

        </div>
    </aside>

    {{-- ══ CONTENU PRINCIPAL ══ --}}
    <main class="main-content">

        {{-- Alerte si profil incomplet (visible seulement par le propriétaire) --}}
        @auth
        @if (auth()->id() === $profil->user_id && ($profil->completion ?? 0) < 80)
            <div class="completion-tips">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <p>
                Votre profil est complété à <strong>{{ $profil->completion ?? 0 }}%</strong>.
                Un profil complet obtient <strong>5× plus de visibilité</strong> dans l'annuaire.
                <a href="{{ route('entrepreneurs.profil.edit') }}">Compléter maintenant →</a>
            </p>
</div>
@endif
@endauth

{{-- Onglets de navigation --}}
<div class="tabs-nav" role="tablist">
    <button class="tab-btn active" onclick="showTab('apercu', this)" role="tab" aria-selected="true">
        <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
            <circle cx="12" cy="7" r="4" />
        </svg>
        Aperçu
    </button>
    <button class="tab-btn" onclick="showTab('projets', this)" role="tab" aria-selected="false">
        <svg viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
            <polyline points="14 2 14 8 20 8" />
        </svg>
        Projets
    </button>
    <button class="tab-btn" onclick="showTab('financier', this)" role="tab" aria-selected="false">
        <svg viewBox="0 0 24 24">
            <line x1="12" y1="1" x2="12" y2="23" />
            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
        </svg>
        Financier
    </button>
    <button class="tab-btn" onclick="showTab('forum', this)" role="tab" aria-selected="false">
        <svg viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
        </svg>
        Forum 2026
    </button>
</div>

{{-- ── TAB : APERÇU ── --}}
<div id="tab-apercu" class="tab-content">

    {{-- À propos --}}
    <div class="content-card">
        <div class="cc-header">
            <div class="cc-title">À propos</div>
            @auth @if(auth()->id() === $profil->user_id)
            <a href="{{ route('entrepreneurs.profil.edit') }}" class="cc-edit">
                <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Modifier
            </a>
            @endif @endauth
        </div>
        @if ($profil->domaines_expertise)
        <p style="font-size:13px;color:#4a5568;line-height:1.75">{{ $profil->domaines_expertise }}</p>
        @else
        <p style="font-size:13px;color:#a0aec0;font-style:italic">Aucune description renseignée pour le moment.</p>
        @endif
    </div>

    {{-- Informations professionnelles --}}
    <div class="content-card">
        <div class="cc-header">
            <div class="cc-title">Informations professionnelles</div>
            @auth @if(auth()->id() === $profil->user_id)
            <a href="{{ route('entrepreneurs.profil.edit') }}" class="cc-edit">
                <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Modifier
            </a>
            @endif @endauth
        </div>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Entreprise</span>
                <span class="info-value {{ !$profil->entreprise ? 'empty' : '' }}">
                    {{ $profil->entreprise ?? 'Non renseigné' }}
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Poste</span>
                <span class="info-value {{ !$profil->poste ? 'empty' : '' }}">
                    {{ $profil->poste ?? 'Non renseigné' }}
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Secteur d'activité</span>
                <span class="info-value {{ !$profil->secteur_activite ? 'empty' : '' }}">
                    {{ $profil->secteur_activite ?? 'Non renseigné' }}
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Taille de l'entreprise</span>
                <span class="info-value {{ !$profil->taille_entreprise ? 'empty' : '' }}">
                    {{ $profil->taille_entreprise ?? 'Non renseigné' }}
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Nombre d'employés</span>
                <span class="info-value {{ !$profil->taille_employes ? 'empty' : '' }}">
                    {{ $profil->taille_employes ?? 'Non renseigné' }}
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Ville</span>
                <span class="info-value {{ !$profil->ville ? 'empty' : '' }}">
                    {{ $profil->ville ?? 'Non renseigné' }}{{ $profil->pays_residence ? ', '.$profil->pays_residence : '' }}
                </span>
            </div>
        </div>

        @if ($profil->domaines_expertise)
        <div style="margin-top:1.1rem">
            <span class="info-label" style="display:block;margin-bottom:6px">Domaines d'expertise</span>
            <div class="tags-wrap">
                @foreach (explode(',', $profil->domaines_expertise) as $domaine)
                <span class="tag">{{ trim($domaine) }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

</div>{{-- /#tab-apercu --}}

{{-- ── TAB : PROJETS ── --}}
<div id="tab-projets" class="tab-content" style="display:none">
    <div class="content-card">
        <div class="cc-header">
            <div class="cc-title">Projets & Initiatives</div>
            @auth @if(auth()->id() === $profil->user_id)
            <a href="{{ route('entrepreneurs.profil.edit') }}" class="cc-edit">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Ajouter
            </a>
            @endif @endauth
        </div>

        @if ($profil->projets_economiques)
        @php
        $projets = collect(explode('||', $profil->projets_economiques))
        ->filter()->map(fn($p) => trim($p));
        @endphp
        @forelse ($projets as $projet)
        <div class="projet-item">
            <div class="projet-header">
                <div class="projet-titre">{{ $projet }}</div>
                <span class="projet-status" style="background:#e8f5e9;color:#2e7d32">En cours</span>
            </div>
        </div>
        @empty
        <p style="color:#a0aec0;font-size:13px;font-style:italic">Aucun projet renseigné.</p>
        @endforelse
        @else
        <div style="text-align:center;padding:2rem 1rem">
            <svg width="48" height="48" viewBox="0 0 24 24" stroke="#d1d9e6" fill="none" stroke-width="1.2" style="margin:0 auto .75rem">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            <p style="color:#a0aec0;font-size:13px">Aucun projet renseigné pour le moment.</p>
            @auth @if(auth()->id() === $profil->user_id)
            <a href="{{ route('entrepreneurs.profil.edit') }}" style="font-size:12px;font-weight:700;color:#0f284e;text-decoration:none;margin-top:8px;display:inline-block">
                + Ajouter mes projets
            </a>
            @endif @endauth
        </div>
        @endif
    </div>
</div>

{{-- ── TAB : FINANCIER ── --}}
<div id="tab-financier" class="tab-content" style="display:none">
    <div class="content-card">
        <div class="cc-header">
            <div class="cc-title">Données Financières</div>
            @auth @if(auth()->id() === $profil->user_id)
            <a href="{{ route('entrepreneurs.profil.edit') }}" class="cc-edit">
                <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Modifier
            </a>
            @endif @endauth
        </div>
        <div class="kpi-grid">
            <div class="kpi-card">
                <span class="kpi-num">{{ $profil->chiffre_affaires ?? '—' }}</span>
                <div class="kpi-lbl">Chiffre d'affaires</div>
            </div>
            <div class="kpi-card">
                <span class="kpi-num">{{ $profil->taille_employes ?? '—' }}</span>
                <div class="kpi-lbl">Employés</div>
            </div>
            <div class="kpi-card">
                <span class="kpi-num">{{ $profil->capacite_investissement ?? '—' }}</span>
                <div class="kpi-lbl">Capacité d'investissement</div>
            </div>
        </div>

        @if (!$profil->chiffre_affaires && !$profil->capacite_investissement)
        <p style="text-align:center;color:#a0aec0;font-size:12px;margin-top:1rem;font-style:italic">
            Ces informations sont confidentielles et visibles uniquement par les membres connectés.
        </p>
        @endif
    </div>
</div>

{{-- ── TAB : FORUM ── --}}
<div id="tab-forum" class="tab-content" style="display:none">
    <div class="content-card">
        <div class="cc-header">
            <div class="cc-title">Participation Forum 2026</div>
        </div>

        @if ($participation ?? false)
        <div class="forum-status-card" style="margin-bottom:1.25rem">
            <div class="fsc-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>
            <div class="fsc-info">
                <div class="fsc-title">Participation confirmée</div>
                <div class="fsc-sub">15 – 18 Juin 2026 · Paris, France</div>
            </div>
            <div class="fsc-badge">{{ $participation->statut ?? 'Participant' }}</div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Statut</span>
                <span class="info-value">{{ $participation->statut ?? '—' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Stand</span>
                <span class="info-value {{ !($participation->stand ?? null) ? 'empty' : '' }}">
                    {{ $participation->stand ?? 'Non attribué' }}
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Documents soumis</span>
                <span class="info-value">{{ $participation->docs_soumis ?? '—' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Rendez-vous B2B</span>
                <span class="info-value">{{ $participation->nb_rdv ?? 0 }} planifié(s)</span>
            </div>
        </div>
        @else
        <div style="text-align:center;padding:2rem 1rem">
            <svg width="48" height="48" viewBox="0 0 24 24" stroke="#d1d9e6" fill="none" stroke-width="1.2" style="margin:0 auto .75rem">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
            <p style="color:#a0aec0;font-size:13px;margin-bottom:.75rem">
                @if(auth()->id() === ($profil->user_id ?? null))
                Vous n'êtes pas encore inscrit au Forum 2026.
                @else
                Cet entrepreneur n'a pas encore confirmé sa participation.
                @endif
            </p>
            @auth @if(auth()->id() === $profil->user_id)
            <a href="{{ route('inscription') }}" class="id-action-btn id-action-primary" style="display:inline-flex;max-width:200px;margin:0 auto">
                <svg viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
                S'inscrire au Forum
            </a>
            @endif @endauth
        </div>
        @endif
    </div>
</div>

</main>

{{-- ══ SIDEBAR DROITE ══ --}}
<aside>
    <div class="right-sidebar">

        {{-- Prendre rendez-vous --}}
        @auth
        @if (auth()->id() !== $profil->user_id)
        <div class="rdv-widget">
            <div class="rdv-widget-title">Prendre rendez-vous B2B</div>
            <p class="rdv-widget-desc">Planifiez une rencontre professionnelle avec {{ $profil->nom_complet }}.</p>
            <a href="{{ route('entrepreneurs.rendez-vous') }}" class="rdv-widget-btn">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Planifier un RDV
            </a>
        </div>
        @endif
        @endauth

        {{-- Compétences clés --}}
        @if ($profil->domaines_expertise)
        <div class="sw-card">
            <div class="sw-title">Expertises</div>
            @foreach (array_slice(explode(',', $profil->domaines_expertise), 0, 5) as $i => $exp)
            @php $pcts = [95, 88, 82, 75, 68]; $pct = $pcts[$i] ?? 70; @endphp
            <div class="competence-bar">
                <div class="competence-header">
                    <span class="competence-name">{{ trim($exp) }}</span>
                    <span class="competence-pct">{{ $pct }}%</span>
                </div>
                <div class="comp-bar-bg">
                    <div class="comp-bar-fill" style="width:<?php echo $pct; ?>%;background:#0f284e"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Réseaux sociaux --}}
        <div class="sw-card">
            <div class="sw-title">Réseaux & Contacts</div>
            <div class="social-links">
                <a href="#" class="social-link">
                    <div class="social-icon" style="background:#e3f2fd;color:#0f284e">
                        <svg viewBox="0 0 24 24">
                            <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z" />
                            <rect x="2" y="9" width="4" height="12" />
                            <circle cx="4" cy="4" r="2" />
                        </svg>
                    </div>
                    <span>LinkedIn</span>
                    <span class="social-add">Voir →</span>
                </a>
                <a href="#" class="social-link">
                    <div class="social-icon" style="background:#e3f2fd;color:#0f284e">
                        <svg viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                        </svg>
                    </div>
                    <span>Twitter / X</span>
                    <span class="social-add">Voir →</span>
                </a>
                <a href="{{ route('contact') }}" class="social-link">
                    <div class="social-icon" style="background:#e8f5e9;color:#2e7d32">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                    </div>
                    <span>Email</span>
                    <span class="social-add">Contacter →</span>
                </a>
            </div>
        </div>

        {{-- Profils suggérés --}}
        @if (!empty($suggeres))
        <div class="sw-card">
            <div class="sw-title">
                Entrepreneurs similaires
                <a href="{{ route('entrepreneurs.annuaire') }}">Voir tout</a>
            </div>
            @foreach ($suggeres as $s)
            <div class="suggested-item">
                <div class="sug-avatar">{{ strtoupper(substr($s->nom_complet, 0, 1)) }}</div>
                <div>
                    <div class="sug-name">{{ $s->nom_complet }}</div>
                    <div class="sug-co">{{ $s->entreprise }}</div>
                </div>
                <a href="{{ route('entrepreneurs.show', $s->slug) }}" class="sug-follow">Voir</a>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</aside>

</div>{{-- /.page-layout --}}

{{-- ── FOOTER MINIMAL ── --}}

@include('components.footer')

@push('scripts')
<script>
    function showTab(id, btn) {
        // Masquer tous les onglets
        document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
        // Désactiver tous les boutons
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('active');
            el.setAttribute('aria-selected', 'false');
        });
        // Afficher l'onglet cible
        const target = document.getElementById('tab-' + id);
        if (target) target.style.display = 'flex';
        if (target) target.style.flexDirection = 'column';
        if (target) target.style.gap = '1.25rem';
        if (target) target.style.display = 'contents';
        // Activer le bouton
        btn.classList.add('active');
        btn.setAttribute('aria-selected', 'true');
    }

    // Initialisation : forcer le display du premier onglet
    document.addEventListener('DOMContentLoaded', function() {
        const first = document.getElementById('tab-apercu');
        if (first) {
            first.style.display = 'contents';
        }
    });
</script>
@endpush

@endsection