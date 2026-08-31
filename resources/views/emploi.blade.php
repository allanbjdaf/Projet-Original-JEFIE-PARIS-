{{-- resources/views/emploi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'JEFIE PARIS 2026')

@section('styles')

<style>
    /*pour la parteie emploi recrutement candidat */

    .emploi-layout {
        display: grid;
        grid-template-columns: 220px 1fr;
        min-height: calc(100vh - 64px);
        background: #f4f6fa;
    }

    .emploi-sidebar {
        background: #fff;
        border-right: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        padding: 1rem 0;
    }

    .es-header {
        padding: .75rem 1.25rem 1rem;
        border-bottom: 1px solid #f0f4f8;
        margin-bottom: .5rem;
    }

    .es-title {
        font-size: 10px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .es-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 1.25rem;
        font-size: 13px;
        color: #4a5568;
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all .15s;
    }

    .es-item:hover {
        background: #f4f6fa;
        color: #0f284e;
    }

    .es-item.active {
        background: #fff8e6;
        color: #0f284e;
        border-left-color: #f5c518;
        font-weight: 700;
    }

    .es-item svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .es-item .badge {
        margin-left: auto;
        background: #e53935;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 1px 6px;
        border-radius: 10px;
    }

    .emploi-main {
        padding: 1.5rem;
        overflow-y: auto;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .page-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f284e;
    }

    .page-subtitle {
        font-size: 12px;
        color: #718096;
        margin-top: 2px;
    }

    .btn-primary {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: background .2s;
        font-family: inherit;
    }

    .btn-primary:hover {
        background: #0a1e38;
    }

    .btn-primary svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-or {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
        font-family: inherit;
    }

    .btn-or:hover {
        opacity: .9;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 7px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-success svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    .stats-mini {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-mini {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
    }

    .stat-mini-num {
        font-size: 1.4rem;
        font-weight: 900;
        color: #0f284e;
        display: block;
    }

    .stat-mini-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 2px;
    }

    .card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.25rem;
    }

    .card-title {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 8px;
        margin-bottom: 1rem;
    }

    .table-wrap {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        font-size: 11px;
        font-weight: 700;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: .07em;
        padding: 8px 12px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
        white-space: nowrap;
    }

    td {
        font-size: 13px;
        color: #0a1e38;
        padding: 12px;
        border-bottom: 1px solid #f0f4f8;
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: #fafbfc;
    }

    .statut-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 10px;
        display: inline-block;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .s-attente {
        background: #fff8e6;
        color: #b07d10;
    }

    .s-cours {
        background: #e3f2fd;
        color: #0f284e;
    }

    .s-accept {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .s-refuse {
        background: #fce4ec;
        color: #c2185b;
    }

    .action-btns {
        display: flex;
        gap: 6px;
    }

    .btn-sm {
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        border: 1px solid;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all .2s;
        font-family: inherit;
    }

    .btn-sm svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .btn-sm-view {
        border-color: #d1d9e6;
        color: #0a1e38;
        background: #fff;
    }

    .btn-sm-view:hover {
        background: #f4f6fa;
    }

    .btn-sm-del {
        border-color: #fecaca;
        color: #e53935;
        background: #fff;
    }

    .btn-sm-del:hover {
        background: #fce4ec;
    }

    .btn-sm-on {
        border-color: #a5d6a7;
        color: #2e7d32;
        background: #fff;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #a0aec0;
    }

    .empty-state svg {
        width: 48px;
        height: 48px;
        stroke: #d1d9e6;
        fill: none;
        stroke-width: 1.2;
        display: block;
        margin: 0 auto .75rem;
    }

    .empty-state p {
        font-size: 13px;
        margin-bottom: .75rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .fg1 {
        grid-column: 1/-1;
    }

    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        display: block;
        margin-bottom: 4px;
    }

    .req {
        color: #e53935;
    }

    .form-control {
        width: 100%;
        padding: 10px 13px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
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
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        padding-right: 30px;
        cursor: pointer;
    }

    .file-zone {
        border: 2px dashed #d1d9e6;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s;
    }

    .file-zone:hover {
        border-color: #0f284e;
        background: #f8fafc;
    }

    .file-zone input[type=file] {
        display: none;
    }

    .file-zone svg {
        width: 28px;
        height: 28px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.5;
        display: block;
        margin: 0 auto .5rem;
    }

    .file-zone p {
        font-size: 12px;
        color: #718096;
    }

    .file-zone p strong {
        color: #0f284e;
    }

    .rdv-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: .85rem;
    }

    .rdv-date {
        width: 50px;
        height: 50px;
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
        font-size: 1.1rem;
        font-weight: 900;
        line-height: 1;
    }

    .rdv-month {
        color: rgba(255, 255, 255, .7);
        font-size: 9px;
        text-transform: uppercase;
    }

    .rdv-info {
        flex: 1;
    }

    .rdv-title {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
        margin-bottom: 3px;
    }

    .rdv-sub {
        font-size: 11px;
        color: #718096;
    }

    .rdv-statut {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 10px;
        margin-left: auto;
    }

    .profil-avatar-wrap {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .profil-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #f5c518;
    }

    .profil-avatar img {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .profil-avatar-init {
        color: #f5c518;
        font-size: 28px;
        font-weight: 700;
    }

    .doc-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .doc-item:last-child {
        border-bottom: none;
    }

    .doc-icon {
        width: 36px;
        height: 36px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .doc-icon svg {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    .doc-name {
        font-size: 13px;
        font-weight: 600;
        color: #0a1e38;
        flex: 1;
    }

    .doc-meta {
        font-size: 11px;
        color: #a0aec0;
    }

    .toggle-switch {
        position: relative;
        width: 40px;
        height: 22px;
    }

    .toggle-switch input {
        display: none;
    }

    .toggle-slider {
        position: absolute;
        inset: 0;
        background: #d1d9e6;
        border-radius: 11px;
        cursor: pointer;
        transition: background .3s;
    }

    .toggle-slider::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        background: #fff;
        border-radius: 50%;
        top: 3px;
        left: 3px;
        transition: transform .3s;
    }

    .toggle-switch input:checked+.toggle-slider {
        background: #2e7d32;
    }

    .toggle-switch input:checked+.toggle-slider::after {
        transform: translateX(18px);
    }





    /*pour tout le site complet*/


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
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background .2s;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, .08);
    }

    .btn-login svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
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
        gap: 6px;
        transition: opacity .2s;
    }

    .btn-inscr:hover {
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
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 4rem 2.5rem 3.5rem;
        min-height: auto;

        background:
            linear-gradient(rgba(15, 40, 78, .75), rgba(15, 40, 78, .75)),
            url('/images/pcc.png');

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* 2. On désactive l'ancien calque sombre */
    .hero::after {
        display: none;
    }

    .hero-left {
        position: relative;
        z-index: 2;
        max-width: 440px;
    }

    .hero-title {
        color: #fff;
        font-size: 2.6rem;
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.05;
        letter-spacing: -.02em;
        margin-bottom: .6rem;
    }

    .hero-title span {
        color: #f5c518;
        display: block;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.8rem;
            white-space: nowrap;
        }
    }

    .hero-tagline {
        color: #f5c518;
        font-size: .95rem;
        font-weight: 700;
        margin-bottom: .5rem;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .65);
        font-size: .88rem;
        line-height: 1.65;
    }


    .hero-stats {
        width: 50%;

        display: flex;
        justify-content: flex-end;

        gap: 45px;

        align-items: center;
    }



    /* Injection de l'image de fond floutée derrière les statistiques */
    .hero-stats::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        /* Intégration de votre image rec */
        background: url('/images/cp.png') no-repeat center center;
        background-size: cover;

        /* Application du flou et de la transparence */
        filter: blur(20px);
        opacity: 0.45;
        /* Ajustez cette valeur (0 à 1) pour rendre l'image plus ou moins visible */

        z-index: -1;
        /* Place l'image DERRIÈRE les textes */
        border-radius: 12px;
        /* Optionnel : adoucit les angles du fond de droite */
    }

    /* Chaque bloc de statistique transformé en badge moderne et lisible */
    .hstat {
        display: flex;
        align-items: center;
        gap: 15px;

        padding-left: 30px;

        border-left: 1px solid rgba(255, 255, 255, .25);
    }

    /* L'icône dans sa boîte */
    .hstat-icon {
        width: 45px;
        height: 45px;
        background: rgba(15, 40, 78, 0.06);
        /* Teinte discrète pour faire ressortir l'icône */
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hstat-icon svg {

        width: 30px;
        height: 30px;


        stroke: #f5c518;
        /* Garde la couleur or d'origine */
        fill: none;
        stroke-width: 2;
    }

    /* Le chiffre (Mis en valeur) */
    .hstat-num {
        color: #fff;
        font-size: 20px;
        font-weight: 700;
        line-height: 1;
    }

    /* Le texte descriptif */
    .hstat-lbl {
        color: #fff;
        font-size: 13px;
        line-height: 1.4;

        opacity: .9;
    }




    /* ── BARRE DE RECHERCHE ── */
    .search-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        padding: 1.25rem 2.5rem 1rem;
    }

    .search-label {
        font-size: 12px;
        font-weight: 800;
        color: #0f284e;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: .9rem;
    }

    .search-row {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr auto;
        gap: 10px;
        align-items: stretch;
        margin-bottom: .75rem;
    }

    .search-field {
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        padding: 10px 14px;
        background: #fff;
        transition: border-color .2s;
    }

    .search-field:focus-within {
        border-color: #0f284e;
    }

    .search-field svg {
        width: 16px;
        height: 16px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .search-field input,
    .search-field select {
        flex: 1;
        border: none;
        outline: none;
        font-size: 13px;
        color: #1a2744;
        background: transparent;
    }

    .search-field input::placeholder {
        color: #a0aec0;
    }

    .search-field select {
        appearance: none;
        cursor: pointer;
        color: #4a5568;
    }

    .search-field select option[value=""] {
        color: #a0aec0;
    }

    .search-btn {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s;
    }

    .search-btn:hover {
        background: #0a1e38;
    }

    .search-populaire {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #718096;
        flex-wrap: wrap;
    }

    .search-populaire span {
        font-weight: 600;
    }

    .pop-tag {
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 3px 10px;
        font-size: 12px;
        color: #0a1e38;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s;
    }

    .pop-tag:hover {
        background: #0f284e;
        color: #fff;
        border-color: #0f284e;
    }

    .search-avancee {
        margin-left: auto;
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .search-avancee svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }


    /* ── PAGE LAYOUT ── */
    .page-layout {
        display: grid;
        grid-template-columns: 200px 1fr 280px;
        background: #f4f6fa;
        align-items: start;
    }

    /* ══ SIDEBAR GAUCHE ══ */
    .left-sidebar {
        background: #fff;
        border-right: 1px solid #e2e8f0;
        padding: 1.25rem 0;
        min-height: calc(100vh - 200px);
        display: flex;
        flex-direction: column;
    }

    .ls-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 1.25rem;
        font-size: 13px;
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
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .ls-item.active svg {
        stroke: #f5c518;
    }

    .ls-sep {
        height: 1px;
        background: #f0f4f8;
        margin: .75rem 0;
    }

    .ls-recruteur {
        margin: auto 1.25rem 1.25rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
    }

    .ls-recruteur p {
        font-size: 12px;
        font-weight: 700;
        color: #0f284e;
        margin-bottom: 4px;
    }

    .ls-recruteur span {
        font-size: 11px;
        color: #718096;
        line-height: 1.45;
        display: block;
        margin-bottom: 10px;
    }

    .ls-recruteur-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 11px;
        padding: 8px 12px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: opacity .2s;
    }

    .ls-recruteur-btn:hover {
        opacity: .9;
    }



    /* ══ MAIN CONTENT ══ */
    .main-content {
        padding: 1.75rem 2rem;
    }

    .onglets {
        display: flex;
        align-items: center;
        gap: 0;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 1.25rem;
    }

    .onglet {
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 600;
        color: #718096;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all .2s;
        white-space: nowrap;
    }

    .onglet:hover {
        color: #0f284e;
    }

    .onglet.active {
        color: #0f284e;
        border-bottom-color: #f5c518;
        font-weight: 700;
    }

    /* Conteneur du logo de l'entreprise */
    .comp-logo {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        margin-right: 18px;
        /* Crée l'espace nécessaire avant le titre */
        flex-shrink: 0;
        /* Empêche le logo de se déformer si le titre est long */
        overflow: hidden;
    }

    /* L'image proprement dite */
    .offer-logo-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        /* Ajuste le logo sans l'écraser ni le pixeliser */
        padding: 6px;
        /* Évite que le logo ne colle aux bordures de son carré */
    }

    /* Rond de secours si l'image n'existe pas */
    .logo-fallback-avatar {
        width: 100%;
        height: 100%;
        background: #0f284e;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }


    /* Offres liste */
    .offres-list {
        display: flex;
        flex-direction: column;
        gap: 1px;
        background: #e2e8f0;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .offre-item {
        background: #fff;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: background .15s;
    }

    .offre-item:hover {
        background: #f8fafc;
    }

    .offre-logo {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
        overflow: hidden;
        flex-shrink: 0;
    }

    .offer-logo-img {
        width: 90%;
        height: 90%;
        object-fit: contain;
    }

    .offre-logo-init {
        font-weight: 700;
        color: #1d4ed8;
    }

    .offre-body {
        flex: 1;
        min-width: 0;
    }

    .offre-titre {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
        margin-bottom: 3px;
    }

    .offre-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 12px;
        color: #718096;
        flex-wrap: wrap;
    }

    .offre-meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .offre-meta-item svg {
        width: 12px;
        height: 12px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .offre-contrat {
        background: #f0f4f8;
        color: #0a1e38;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
    }

    .offre-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
        flex-shrink: 0;
    }

    .badge-nouveau {
        background: #e8f5e9;
        color: #2e7d32;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 4px;
    }

    .badge-vedette {
        background: #fff3e0;
        color: #f5c518;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 4px;
    }

    .offre-temps {
        font-size: 11px;
        color: #a0aec0;
    }

    .offre-save {
        width: 28px;
        height: 28px;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #fff;
        transition: all .2s;
        flex-shrink: 0;
    }

    .offre-save:hover {
        border-color: #f5c518;
    }

    .offre-save svg {
        width: 13px;
        height: 13px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 2;
    }

    /* Voir toutes */
    .voir-toutes-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 11px;
        background: #fff;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s;
    }

    .voir-toutes-btn:hover {
        background: #f4f6fa;
    }

    .fonc-item {
        cursor: pointer;
        transition: box-shadow .2s, transform .2s;
    }

    .fonc-item:hover {
        box-shadow: 0 4px 16px rgba(15, 40, 78, .12);
        transform: translateY(-3px);
    }

    .fonc-item:hover .fonc-icon {
        background: #0f284e;
    }

    .fonc-item:hover .fonc-icon svg {
        stroke: #f5c518;
    }

    .fonc-item:hover .fonc-titre {
        color: #f5c518;
    }

    /* Fonctionnalités */
    .fonctionnalites {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.75rem;
    }

    .fonc-item {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .fonc-icon {
        width: 44px;
        height: 44px;
        background: #0f284e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fonc-icon svg {
        width: 22px;
        height: 22px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .fonc-titre {
        font-size: 13px;
        font-weight: 700;
        color: #0f284e;
    }

    .fonc-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.5;
    }

    /* ══ SIDEBAR DROITE ══ */
    .right-sidebar {
        padding: 1.75rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .rs-candidat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .rs-candidat-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: .75rem;
    }

    .rs-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        overflow: hidden;
        /* Empêche l'image de dépasser du cercle */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .rs-avatar img {
        width: 100%;
        /* Force l'image à prendre toute la largeur */
        height: 100%;
        /* Force l'image à prendre toute la hauteur */
        object-fit: cover;
        /* Centre et recadre proprement l'image sans la déformer */
        display: block;
    }

    .rs-avatar-init {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
    }

    .rs-candidat-label {
        font-size: 10px;
        font-weight: 800;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: .07em;
        margin-bottom: 2px;
    }

    .rs-candidat-name {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
    }

    .rs-candidat-email {
        font-size: 11px;
        color: #718096;
    }

    .rs-candidat-link {
        font-size: 12px;
        font-weight: 700;
        color: #0f284e;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .rs-candidat-link svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .rs-cand-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: .75rem;
    }

    .rs-cand-title {
        font-size: 11px;
        font-weight: 800;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .rs-cand-link {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
    }

    .cand-stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .cand-stat-item:last-child {
        border-bottom: none;
    }

    .cand-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .cand-stat-label {
        font-size: 12px;
        color: #4a5568;
        flex: 1;
    }

    .cand-stat-count {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
    }

    .rs-rdv-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
    }

    .rs-rdv-header {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: .75rem;
    }

    .rs-rdv-icon {
        width: 40px;
        height: 40px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .rs-rdv-icon svg {
        width: 20px;
        height: 20px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .rs-rdv-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f284e;
        margin-bottom: 3px;
    }

    .rs-rdv-desc {
        font-size: 11px;
        color: #718096;
        line-height: 1.45;
    }

    .rs-rdv-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 14px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: opacity .2s;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .rs-rdv-btn:hover {
        opacity: .9;
    }


    /* ── FONCTIONNALITÉS CLIQUABLES ── */
    .fonctionnalites {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin: 2rem 0;
    }

    .fonc-item {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem 1.25rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
        cursor: pointer;
        transition: all .2s;
        position: relative;
        overflow: hidden;
        user-select: none;
    }

    .fonc-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15, 40, 78, .03);
        opacity: 0;
        transition: opacity .2s;
    }

    .fonc-item:hover {
        border-color: #0f284e;
        box-shadow: 0 6px 20px rgba(15, 40, 78, .12);
        transform: translateY(-3px);
    }

    .fonc-item:hover::after {
        opacity: 1;
    }

    .fonc-item:hover .fonc-icon {
        background: #0f284e;
    }

    .fonc-item:hover .fonc-icon svg {
        stroke: #f5c518;
    }

    .fonc-item:hover .fonc-titre {
        color: #0f284e;
    }

    .fonc-item:active {
        transform: translateY(-1px);
    }

    .fonc-icon {
        width: 56px;
        height: 56px;
        background: #eef2ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s;
        flex-shrink: 0;
    }

    .fonc-icon svg {
        width: 24px;
        height: 24px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 1.7;
        transition: stroke .2s;
    }

    .fonc-titre {
        font-size: 14px;
        font-weight: 700;
        color: #0a1e38;
        line-height: 1.3;
    }

    .fonc-desc {
        font-size: 12px;
        color: #718096;
        line-height: 1.5;
    }

    .fonc-item .fonc-arrow {
        font-size: 11px;
        font-weight: 700;
        color: #f5c518;
        margin-top: 4px;
        opacity: 0;
        transition: opacity .2s;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .fonc-item:hover .fonc-arrow {
        opacity: 1;
    }

    /* ── PANNEAU LATÉRAL SLIDE-IN ── */
    .side-panel-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .45);
        z-index: 500;
        opacity: 0;
        visibility: hidden;
        transition: opacity .3s, visibility .3s;
    }

    .side-panel-overlay.open {
        opacity: 1;
        visibility: visible;
    }

    .side-panel {
        position: fixed;
        top: 0;
        right: -480px;
        width: 420px;
        max-width: 95vw;
        height: 100vh;
        background: #fff;
        z-index: 501;
        box-shadow: -4px 0 30px rgba(0, 0, 0, .15);
        display: flex;
        flex-direction: column;
        transition: right .35s cubic-bezier(.4, 0, .2, 1);
        overflow: hidden;
    }

    .side-panel.open {
        right: 0;
    }

    .side-panel-header {
        background: #0f284e;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .side-panel-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .side-panel-title svg {
        width: 20px;
        height: 20px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 2;
    }

    .side-panel-close {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, .12);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #fff;
        transition: background .2s;
        flex-shrink: 0;
    }

    .side-panel-close:hover {
        background: rgba(255, 255, 255, .22);
    }

    .side-panel-close svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
    }

    .side-panel-body {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Formulaire dans panneau */
    .sp-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .sp-label {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
    }

    .sp-label span {
        color: #e53935;
    }

    .sp-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
    }

    .sp-input:focus {
        border-color: #0f284e;
        box-shadow: 0 0 0 3px rgba(15, 40, 78, .07);
    }

    .sp-input::placeholder {
        color: #a0aec0;
    }

    .sp-select {
        width: 100%;
        padding: 10px 28px 10px 14px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        cursor: pointer;
        font-family: inherit;
        transition: border-color .2s;
    }

    .sp-select:focus {
        border-color: #0f284e;
    }

    .sp-textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
        transition: border-color .2s;
    }

    .sp-textarea:focus {
        border-color: #0f284e;
    }

    .sp-file-wrap {
        border: 2px dashed #d1d9e6;
        border-radius: 8px;
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
    }

    .sp-file-wrap:hover {
        border-color: #0f284e;
        background: #f4f6fa;
    }

    .sp-file-wrap input[type="file"] {
        display: none;
    }

    .sp-file-icon {
        margin-bottom: 8px;
    }

    .sp-file-icon svg {
        width: 28px;
        height: 28px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.5;
    }

    .sp-file-label {
        font-size: 13px;
        color: #718096;
    }

    .sp-file-label strong {
        color: #0f284e;
    }

    .sp-file-name {
        font-size: 11px;
        color: #2e7d32;
        font-weight: 600;
        margin-top: 5px;
    }

    .sp-sep {
        font-size: 11px;
        color: #a0aec0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-top: 1px solid #f0f4f8;
        padding-top: 8px;
    }

    .sp-btn-submit {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        padding: 13px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .2s;
        font-family: inherit;
        margin-top: 4px;
    }

    .sp-btn-submit:hover {
        background: #0a1e38;
    }

    .sp-btn-submit svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .sp-btn-submit.gold {
        background: #f5c518;
        color: #0f284e;
    }

    .sp-btn-submit.gold:hover {
        background: #e09010;
    }

    .sp-note {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        color: #718096;
        background: #f8fafc;
        border-radius: 5px;
        padding: 8px 12px;
    }

    .sp-note svg {
        width: 13px;
        height: 13px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .sp-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 8px;
        padding: 1rem;
        font-size: 13px;
        text-align: center;
        display: none;
    }

    .sp-success.show {
        display: block;
    }

    .sp-success svg {
        width: 22px;
        height: 22px;
        stroke: #2e7d32;
        fill: none;
        stroke-width: 2;
        display: block;
        margin: 0 auto .5rem;
    }

    @media (max-width:600px) {
        .fonctionnalites {
            grid-template-columns: 1fr 1fr;
        }

        .side-panel {
            width: 100%;
        }
    }

    @media (max-width:400px) {
        .fonctionnalites {
            grid-template-columns: 1fr;
        }
    }

    /* ── CTA RECRUTEUR ── */
    .cta-recruteur {
        background: #0f284e;
        padding: 1.75rem 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .cta-rec-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cta-rec-icon {
        width: 52px;
        height: 52px;
        background: rgba(245, 166, 35, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cta-rec-icon svg {
        width: 26px;
        height: 26px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.6;
    }

    .cta-rec-title {
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .cta-rec-desc {
        color: rgba(255, 255, 255, .6);
        font-size: 12px;
    }

    .cta-rec-btns {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .cta-btn-gold {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 24px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: opacity .2s;
    }

    .cta-btn-gold:hover {
        opacity: .9;
    }

    .cta-btn-gold svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .cta-btn-outline-w {
        background: transparent;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 11px 22px;
        border-radius: 5px;
        border: 1.5px solid rgba(255, 255, 255, .35);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: background .2s;
    }

    .cta-btn-outline-w:hover {
        background: rgba(255, 255, 255, .08);
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
        transition: color .2s;
    }

    .footer-legal a:hover {
        color: rgba(255, 255, 255, .7);
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .page-layout {
            grid-template-columns: 200px 1fr;
        }

        .right-sidebar {
            display: none;
        }

        .fonctionnalites {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 900px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .left-sidebar {
            display: none;
        }

        .search-row {
            grid-template-columns: 1fr 1fr;
        }

        .hero {
            flex-direction: column;
        }

        .fonctionnalites {
            grid-template-columns: 1fr 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .search-row {
            grid-template-columns: 1fr;
        }

        .fonctionnalites {
            grid-template-columns: 1fr;
        }

        .hero-stats {
            flex-wrap: wrap;
            gap: 1rem;
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
<section class="hero">
    <div class="hero-left">
        <h1 class="hero-title">
            Espace Emploi<br>
            <span>&amp; Recrutement</span>
        </h1>
        <p class="hero-tagline">Connectons les talents aux opportunités</p>
        <p class="hero-desc">Trouvez le poste idéal ou le talent qu'il vous faut parmi les entreprises et candidats du Forum.</p>
    </div>
    <div class="hero-stats">
        @foreach ($stats as $s)
        <div class="hstat">
            <div class="hstat-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $s['icon'] !!}</svg>
            </div>
            <div>
                <span class="hstat-num">{{ $s['valeur'] }}</span>
                <div class="hstat-lbl">{{ $s['label'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ BARRE DE RECHERCHE ══ --}}
<div class="search-bar">
    <div class="search-label">Trouvez l'opportunité qui vous correspond</div>
    <form action="{{ route('emploi') }}" method="GET">
        <div class="search-row">
            <div class="search-field">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Métier, mot-clé, compétence" autocomplete="off">
            </div>
            <div class="search-field">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                <select name="secteur">
                    <option value="">Secteur d'activité</option>
                    @foreach ($secteurs as $s)
                    <option value="{{ $s }}" {{ request('secteur') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-field">
                <svg viewBox="0 0 24 24">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                <input type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Lieu de travail">
            </div>
            <div class="search-field">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                <select name="contrat">
                    <option value="">Type de contrat</option>
                    @foreach ($typesContrat as $t)
                    <option value="{{ $t }}" {{ request('contrat') === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="search-btn">Rechercher</button>
        </div>
        <div class="search-populaire">
            <span>Recherches populaires :</span>
            @foreach ($recherchesPop as $tag)
            <a href="{{ route('emploi', ['q' => $tag]) }}" class="pop-tag">{{ $tag }}</a>
            @endforeach
            <a href="{{ route('emploi') }}" class="search-avancee" style="margin-left:auto">
                Recherche avancée
                <svg viewBox="0 0 24 24">
                    <line x1="4" y1="6" x2="20" y2="6" />
                    <line x1="4" y1="12" x2="14" y2="12" />
                    <line x1="4" y1="18" x2="8" y2="18" />
                </svg>
            </a>
        </div>
    </form>
</div>

{{-- ══ PAGE LAYOUT ══ --}}
<div class="page-layout">

    {{-- ── SIDEBAR GAUCHE ── --}}
    <aside class="left-sidebar" aria-label="Navigation espace emploi">
        <a href="{{ route('emploi') }}" class="ls-item active">
            <svg viewBox="0 0 24 24">
                <rect x="2" y="7" width="20" height="14" rx="2" />
                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
            </svg>
            Espace Emploi
        </a>
        <a href="{{ route('emploi') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            Offres d'emploi
        </a>
        <a href="{{ route('emploi.candidatures') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Mes candidatures
        </a>
        <a href="{{ route('emploi.rdvb2b') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            Rendez-vous B2B
        </a>
        <a href="{{ route('emploi.alertes') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
            </svg>
            Mes alertes
        </a>
        <a href="{{ route('emploi.documents') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            Mes documents
        </a>
        <a href="{{ route('emploi.profil') }}" class="ls-item">
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Mon profil
        </a>
        <div class="ls-sep"></div>
        <div class="ls-recruteur">
            <p>Vous êtes recruteur ?</p>
            <span>Publiez vos offres et trouvez les meilleurs talents.</span>
            <a href="{{ route('recruteur.dashboard') }}" class="ls-recruteur-btn">Accéder à mon espace recruteur</a>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ── --}}
    <main class="main-content">

        {{-- Onglets --}}
        <div class="onglets" role="tablist">
            <a href="{{ route('emploi', ['onglet' => 'recentes']) }}"
                class="onglet {{ $ongletActif === 'recentes' ? 'active' : '' }}"
                role="tab" aria-selected="{{ $ongletActif === 'recentes' ? 'true' : 'false' }}">
                Offres récentes
            </a>
            <a href="{{ route('emploi', ['onglet' => 'vedette']) }}"
                class="onglet {{ $ongletActif === 'vedette' ? 'active' : '' }}"
                role="tab" aria-selected="{{ $ongletActif === 'vedette' ? 'true' : 'false' }}">
                Offres en vedette
            </a>
            <a href="{{ route('emploi', ['onglet' => 'secteurs']) }}"
                class="onglet {{ $ongletActif === 'secteurs' ? 'active' : '' }}"
                role="tab" aria-selected="{{ $ongletActif === 'secteurs' ? 'true' : 'false' }}">
                Par secteurs
            </a>
        </div>

        {{-- Liste des offres --}}
        <div class="offres-list" role="list" aria-label="Offres d'emploi">
            @forelse ($offres as $offre)
            <div class="offre-item" role="listitem">

                {{-- CORRECTION ICI : Utilisation des classes CSS existantes (.offre-logo et .offer-logo-img) --}}
                <div class="offre-logo">
                    @if(!empty($offre->logo_entreprise))
                    <img src="{{ asset('images/' . $offre->logo_entreprise) }}" alt="Logo {{ $offre->entreprise }}" class="offer-logo-img">
                    @else
                    {{-- Initiale ou icône par défaut si pas de logo --}}
                    <span class="offre-logo-init">{{ strtoupper(substr($offre->entreprise, 0, 2)) }}</span>
                    @endif
                </div>

                <div class="offre-body">
                    <div class="offre-titre">{{ $offre->titre }}</div>
                    <div class="offre-meta">
                        <span class="offre-meta-item">{{ $offre->entreprise }}</span>
                        <span class="offre-meta-item">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $offre->lieu }}
                        </span>
                        <span class="offre-contrat">{{ $offre->type_contrat }}</span>
                    </div>
                </div>
                <div class="offre-right">
                    @if ($offre->en_vedette)
                    <span class="badge-vedette">En vedette</span>
                    @else
                    <span class="badge-nouveau">Nouveau</span>
                    @endif
                    <span class="offre-temps">{{ $offre->temps_publication }}</span>
                </div>
                <button class="offre-save" type="button" aria-label="Sauvegarder cette offre">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z" />
                    </svg>
                </button>
            </div>
            @empty
            {{-- Offres de démonstration si la BDD est vide --}}
            @php
            $demosOffres = [
            [
            'titre' => 'Ingénieur DevOps',
            'entreprise' => 'Orange Digital Center',
            'lieu' => 'Abidjan, Côte d\'Ivoire',
            'contrat' => 'CDI',
            'vedette' => false,
            'temps' => 'Il y a 2h',
            'image' => 'ora.png'
            ],
            [
            'titre' => 'Analyste Risques Financiers',
            'entreprise' => 'Ecobank Côte d\'Ivoire',
            'lieu' => 'Abidjan, Côte d\'Ivoire',
            'contrat' => 'CDI',
            'vedette' => true,
            'temps' => 'Il y a 5h',
            'image' => 'eco.jpg'
            ],
            [
            'titre' => 'Chef de Projet Digital',
            'entreprise' => 'SONATEL',
            'lieu' => 'Dakar, Sénégal',
            'contrat' => 'CDI',
            'vedette' => false,
            'temps' => 'Il y a 1j',
            'image' => 'son.jpg'
            ],
            [
            'titre' => 'Responsable Conformité',
            'entreprise' => 'Société Générale',
            'lieu' => 'Abidjan, Côte d\'Ivoire',
            'contrat' => 'CDD',
            'vedette' => true,
            'temps' => 'Il y a 1j',
            'image' => 'socie.png'
            ],
            [
            'titre' => 'Data Scientist',
            'entreprise' => 'BICICI',
            'lieu' => 'Abidjan, Côte d\'Ivoire',
            'contrat' => 'CDI',
            'vedette' => false,
            'temps' => 'Il y a 2j',
            'image' => 'eco.jpg'
            ],
            ];
            @endphp
            @foreach ($demosOffres as $demo)
            <div class="offre-item" role="listitem">
                {{-- CORRECTION ICI AUSSI : Affichage de l'image de démo si elle est présente --}}
                <div class="offre-logo">
                    @if(!empty($demo['image']))
                    <img src="{{ asset('images/' . $demo['image']) }}" alt="Logo {{ $demo['entreprise'] }}" class="offer-logo-img">
                    @else
                    <span class="offre-logo-init">{{ strtoupper(substr($demo['entreprise'],0,2)) }}</span>
                    @endif
                </div>
                <div class="offre-body">
                    <div class="offre-titre">{{ $demo['titre'] }}</div>
                    <div class="offre-meta">
                        <span class="offre-meta-item">{{ $demo['entreprise'] }}</span>
                        <span class="offre-meta-item">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $demo['lieu'] }}
                        </span>
                        <span class="offre-contrat">{{ $demo['contrat'] }}</span>
                    </div>
                </div>
                <div class="offre-right">
                    @if ($demo['vedette'])
                    <span class="badge-vedette">En vedette</span>
                    @else
                    <span class="badge-nouveau">Nouveau</span>
                    @endif
                    <span class="offre-temps">{{ $demo['temps'] }}</span>
                </div>
                <button class="offre-save" type="button" aria-label="Sauvegarder cette offre">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z" />
                    </svg>
                </button>
            </div>
            @endforeach
            @endforelse
        </div>


        {{-- Pagination --}}
        @if ($offres->hasPages())
        <div style="margin-bottom:1rem">{{ $offres->withQueryString()->links() }}</div>
        @endif

        <a href="{{ route('emploi') }}" class="voir-toutes-btn">Voir toutes les offres</a>

        {{-- Fonctionnalités --}}
        <div class="fonctionnalites">

            {{-- 1. Candidature --}}
            <div class="fonc-item" onclick="openPanel('panel-candidature')" role="button" tabindex="0" aria-haspopup="true">
                <div class="fonc-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                    </svg>
                </div>
                <div class="fonc-titre">Déposez votre candidature</div>
                <p class="fonc-desc">Postulez en quelques clics et suivez l'évolution de vos candidatures.</p>
                <div class="fonc-arrow">
                    Commencer
                    <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </div>
            </div>

            {{-- 2. CV & Documents --}}
            <div class="fonc-item" onclick="openPanel('panel-documents')" role="button" tabindex="0" aria-haspopup="true">
                <div class="fonc-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                </div>
                <div class="fonc-titre">CV et documents</div>
                <p class="fonc-desc">Téléchargez votre CV et vos lettres de motivation en toute sécurité.</p>
                <div class="fonc-arrow">
                    Télécharger
                    <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </div>
            </div>

            {{-- 3. Alertes emploi --}}
            <div class="fonc-item" onclick="openPanel('panel-alerte')" role="button" tabindex="0" aria-haspopup="true">
                <div class="fonc-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                    </svg>
                </div>
                <div class="fonc-titre">Alertes emploi</div>
                <p class="fonc-desc">Recevez des notifications pour les nouvelles offres correspondant à votre profil.</p>
                <div class="fonc-arrow">
                    Créer une alerte
                    <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </div>
            </div>

            {{-- 4. RDV B2B --}}
            <div class="fonc-item" onclick="openPanel('panel-rdvb2b')" role="button" tabindex="0" aria-haspopup="true">
                <div class="fonc-icon">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                </div>
                <div class="fonc-titre">Rendez-vous B2B</div>
                <p class="fonc-desc">Échangez directement avec les recruteurs lors de rendez-vous qualifiés.</p>
                <div class="fonc-arrow">
                    Prendre RDV
                    <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </div>
            </div>

        </div>

        {{-- ══ OVERLAY ══ --}}
        <div class="side-panel-overlay" id="panelOverlay" onclick="closeAllPanels()"></div>

        {{-- ══════════════════════════════════════════
     PANNEAU 1 — CANDIDATURE
══════════════════════════════════════════ --}}
        <aside class="side-panel" id="panel-candidature" aria-modal="true" role="dialog" aria-label="Déposer une candidature">
            <div class="side-panel-header">
                <div class="side-panel-title">
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                    </svg>
                    Déposer une candidature
                </div>
                <button class="side-panel-close" onclick="closePanel('panel-candidature')">
                    <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="side-panel-body">
                <div class="sp-success" id="success-candidature">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <strong>Candidature envoyée avec succès !</strong><br>
                    <span style="font-size:11px;color:#4a7c59">Vous recevrez une réponse sous 48h ouvrées.</span>
                </div>
                @csrf
                <input type="hidden" name="offre_id" id="offre_id_cand" value="">

                <div class="sp-field">
                    <label class="sp-label">Nom complet <span>*</span></label>
                    <input type="text" name="nom_complet" class="sp-input" placeholder="Votre nom et prénom"
                        value="{{ auth()->user()->name ?? '' }}" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Email <span>*</span></label>
                    <input type="email" name="email" class="sp-input" placeholder="votre@email.com"
                        value="{{ auth()->user()->email ?? '' }}" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Téléphone</label>
                    <input type="tel" name="telephone" class="sp-input" placeholder="+33 6 00 00 00 00">
                </div>

                <div class="sp-field">
                    <label class="sp-label">Poste ciblé <span>*</span></label>
                    <input type="text" name="poste_cible" class="sp-input"
                        placeholder="Ex: Développeur PHP / Laravel" id="poste_cible_cand" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Message de motivation</label>
                    <textarea name="message" class="sp-textarea" placeholder="Parlez-nous de votre motivation..."></textarea>
                </div>

                <div class="sp-field">
                    <label class="sp-label">CV (PDF, Word) <span>*</span></label>
                    <div class="sp-file-wrap" onclick="document.getElementById('cv-cand').click()">
                        <div class="sp-file-icon"><svg viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg></div>
                        <div class="sp-file-label"><strong>Cliquez</strong> ou glissez votre CV ici</div>
                        <div class="sp-file-name" id="cv-name">Aucun fichier choisi</div>
                        <input type="file" id="cv-cand" name="cv" accept=".pdf,.doc,.docx"
                            onchange="document.getElementById('cv-name').textContent=this.files[0]?.name||'Aucun fichier'">
                    </div>
                </div>

                <div class="sp-note">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0110 0v4" />
                    </svg>
                    Vos données sont sécurisées et traitées conformément au RGPD.
                </div>

                <button type="submit" class="sp-btn-submit">
                    <svg viewBox="0 0 24 24">
                        <line x1="22" y1="2" x2="11" y2="13" />
                        <polygon points="22 2 15 22 11 13 2 9 22 2" fill="currentColor" />
                    </svg>
                    Envoyer ma candidature
                </button>
                </form>
            </div>
        </aside>

        {{-- ══════════════════════════════════════════
     PANNEAU 2 — CV & DOCUMENTS
══════════════════════════════════════════ --}}
        <aside class="side-panel" id="panel-documents" aria-modal="true" role="dialog" aria-label="CV et documents">
            <div class="side-panel-header">
                <div class="side-panel-title">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    CV et documents
                </div>
                <button class="side-panel-close" onclick="closePanel('panel-documents')">
                    <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="side-panel-body">
                <div class="sp-success" id="success-documents">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <strong>Documents envoyés avec succès !</strong><br>
                    <span style="font-size:11px;color:#4a7c59">Vos documents ont été sauvegardés dans votre espace.</span>
                </div>
                @csrf

                <div class="sp-field">
                    <label class="sp-label">Votre CV (PDF) <span>*</span></label>
                    <div class="sp-file-wrap" onclick="document.getElementById('cv-doc').click()">
                        <div class="sp-file-icon"><svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg></div>
                        <div class="sp-file-label"><strong>Télécharger</strong> votre CV</div>
                        <div class="sp-file-name" id="cv-doc-name">Aucun fichier choisi</div>
                        <input type="file" id="cv-doc" name="cv" accept=".pdf,.doc,.docx"
                            onchange="document.getElementById('cv-doc-name').textContent=this.files[0]?.name||'Aucun fichier'" required>
                    </div>
                </div>

                <div class="sp-sep">Documents optionnels</div>

                <div class="sp-field">
                    <label class="sp-label">Lettre de motivation (Optionnelle)</label>
                    <div class="sp-file-wrap" onclick="document.getElementById('lm-doc').click()">
                        <div class="sp-file-icon"><svg viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg></div>
                        <div class="sp-file-label"><strong>Télécharger</strong> votre lettre</div>
                        <div class="sp-file-name" id="lm-doc-name">Aucun fichier choisi</div>
                        <input type="file" id="lm-doc" name="lettre_motivation" accept=".pdf,.doc,.docx"
                            onchange="document.getElementById('lm-doc-name').textContent=this.files[0]?.name||'Aucun fichier'">
                    </div>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Diplômes / Certificats</label>
                    <div class="sp-file-wrap" onclick="document.getElementById('dip-doc').click()">
                        <div class="sp-file-icon"><svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="6" />
                                <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11" />
                            </svg></div>
                        <div class="sp-file-label"><strong>Télécharger</strong> vos diplômes</div>
                        <div class="sp-file-name" id="dip-doc-name">Aucun fichier choisi</div>
                        <input type="file" id="dip-doc" name="diplomes[]" accept=".pdf,.jpg,.png" multiple
                            onchange="document.getElementById('dip-doc-name').textContent=this.files.length+' fichier(s)'">
                    </div>
                </div>

                <div class="sp-note">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Formats acceptés : PDF, Word, JPG, PNG — Max. 5 Mo par fichier
                </div>

                <button type="submit" class="sp-btn-submit">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    Envoyer les documents
                </button>
                </form>
            </div>
        </aside>

        {{-- ══════════════════════════════════════════
     PANNEAU 3 — ALERTES EMPLOI
══════════════════════════════════════════ --}}
        <aside class="side-panel" id="panel-alerte" aria-modal="true" role="dialog" aria-label="Créer une alerte emploi">
            <div class="side-panel-header">
                <div class="side-panel-title">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                    </svg>
                    Créer une alerte emploi
                </div>
                <button class="side-panel-close" onclick="closePanel('panel-alerte')">
                    <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="side-panel-body">
                <div class="sp-success" id="success-alerte">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <strong>Alerte créée avec succès !</strong><br>
                    <span style="font-size:11px;color:#4a7c59">Vous serez notifié dès qu'une offre correspondante sera publiée.</span>
                </div>
                @csrf

                <div class="sp-field">
                    <label class="sp-label">Email de notification <span>*</span></label>
                    <input type="email" name="email" class="sp-input"
                        placeholder="votre@email.com"
                        value="{{ auth()->user()->email ?? '' }}" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Mots-clés du poste <span>*</span></label>
                    <input type="text" name="mots_cles" class="sp-input"
                        placeholder="Ex: Data Scientist, Laravel..." required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Secteur d'activité</label>
                    <select name="secteur" class="sp-select">
                        <option value="">Tous les secteurs</option>
                        @foreach (['Technologies','Finance','Commerce','Santé','Éducation','Industrie','Agriculture','Services'] as $s)
                        <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Lieu</label>
                    <input type="text" name="lieu" class="sp-input" placeholder="Paris, Abidjan, Remote...">
                </div>

                <div class="sp-field">
                    <label class="sp-label">Type de contrat</label>
                    <select name="type_contrat" class="sp-select">
                        <option value="">Tous types</option>
                        <option value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="Stage">Stage</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Fréquence des notifications <span>*</span></label>
                    <select name="frequence" class="sp-select" required>
                        <option value="instantanee">Instantanée</option>
                        <option value="quotidienne" selected>Quotidienne</option>
                        <option value="hebdomadaire">Hebdomadaire</option>
                    </select>
                </div>

                <button type="submit" class="sp-btn-submit gold">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />
                    </svg>
                    Enregistrer l'alerte
                </button>
                </form>
            </div>
        </aside>

        {{-- ══════════════════════════════════════════
     PANNEAU 4 — RDV B2B
══════════════════════════════════════════ --}}
        <aside class="side-panel" id="panel-rdvb2b" aria-modal="true" role="dialog" aria-label="Prendre un rendez-vous B2B">
            <div class="side-panel-header">
                <div class="side-panel-title">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Prendre un Rendez-vous B2B
                </div>
                <button class="side-panel-close" onclick="closePanel('panel-rdvb2b')">
                    <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="side-panel-body">
                <div class="sp-success" id="success-rdvb2b">
                    <svg viewBox="0 0 24 24">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <strong>Rendez-vous confirmé !</strong><br>
                    <span style="font-size:11px;color:#4a7c59">Vous recevrez une confirmation par email sous peu.</span>
                </div>
                @csrf

                <div class="sp-field">
                    <label class="sp-label">Votre nom <span>*</span></label>
                    <input type="text" name="nom_complet" class="sp-input"
                        value="{{ auth()->user()->name ?? '' }}" placeholder="Votre nom complet" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Votre email <span>*</span></label>
                    <input type="email" name="email" class="sp-input"
                        value="{{ auth()->user()->email ?? '' }}" placeholder="votre@email.com" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Entreprise / Recruteur <span>*</span></label>
                    <select name="recruteur_id" class="sp-select" required>
                        <option value="">Sélectionnez un recruteur</option>
                        @foreach ($offres ?? [] as $o)
                        @if ($o->entreprise ?? false)
                        <option value="{{ $o->id }}">{{ $o->entreprise ?? $o['entreprise'] ?? '' }}</option>
                        @endif
                        @endforeach
                        {{-- Recruteurs statiques si vide --}}
                        @if (empty($offres) || count($offres) === 0)
                        @foreach (['Ecobank Côte d\'Ivoire','Sonatel','Société Générale','Orange CI','BAD','CGF Bourse'] as $r)
                        <option value="{{ $r }}">{{ $r }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Objet du rendez-vous <span>*</span></label>
                    <input type="text" name="objet" class="sp-input"
                        placeholder="Ex: Entretien pour poste Data Scientist" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Date et heure souhaitées <span>*</span></label>
                    <input type="datetime-local" name="date_heure" class="sp-input"
                        min="{{ now()->addDay()->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="sp-field">
                    <label class="sp-label">Message (Optionnel)</label>
                    <textarea name="message" class="sp-textarea" placeholder="Précisez l'objet de votre demande..." style="min-height:80px"></textarea>
                </div>

                <div class="sp-note">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Les rendez-vous se déroulent en présentiel au Forum ou en visioconférence.
                </div>

                <button type="submit" class="sp-btn-submit">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Confirmer le rendez-vous
                </button>
                </form>
            </div>
        </aside>

        {{-- ══ JAVASCRIPT ══ --}}
        @push('scripts')
        <script>
            // Ouvrir un panneau
            function openPanel(id) {
                closeAllPanels();
                const panel = document.getElementById(id);
                const overlay = document.getElementById('panelOverlay');
                if (panel) {
                    panel.classList.add('open');
                    overlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                    // Focus trap
                    setTimeout(() => panel.querySelector('input,button,select,textarea')?.focus(), 350);
                }
            }

            // Fermer un panneau
            function closePanel(id) {
                const panel = document.getElementById(id);
                if (panel) panel.classList.remove('open');
                checkOverlay();
                document.body.style.overflow = '';
            }

            // Fermer tous
            function closeAllPanels() {
                document.querySelectorAll('.side-panel').forEach(p => p.classList.remove('open'));
                document.getElementById('panelOverlay')?.classList.remove('open');
                document.body.style.overflow = '';
            }

            // Fermer overlay si aucun panneau ouvert
            function checkOverlay() {
                const anyOpen = [...document.querySelectorAll('.side-panel')].some(p => p.classList.contains('open'));
                if (!anyOpen) document.getElementById('panelOverlay')?.classList.remove('open');
            }

            // Touche Échap
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') closeAllPanels();
            });

            // Accessibilité clavier sur fonc-item
            document.querySelectorAll('.fonc-item[role="button"]').forEach(el => {
                el.addEventListener('keydown', e => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        el.click();
                    }
                });
            });

            // Soumission AJAX des formulaires
            ['candidature', 'documents', 'alerte', 'rdvb2b'].forEach(name => {
                const form = document.getElementById('form-' + name);
                if (!form) return;
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const btn = form.querySelector('.sp-btn-submit');
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<svg viewBox="0 0 24 24" class="spin" width="16" height="16" style="animation:spin 1s linear infinite" stroke="currentColor" fill="none" stroke-width="2"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Envoi en cours...';
                    btn.disabled = true;

                    try {
                        const data = new FormData(form);
                        const res = await fetch(form.action, {
                            method: 'POST',
                            body: data,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                                'Accept': 'application/json'
                            }
                        });

                        if (res.ok) {
                            document.getElementById('success-' + name)?.classList.add('show');
                            form.reset();
                            document.querySelectorAll('[id$="-name"]').forEach(el => el.textContent = 'Aucun fichier choisi');
                            setTimeout(() => {
                                document.getElementById('success-' + name)?.classList.remove('show');
                                closePanel('panel-' + name);
                            }, 3000);
                        } else {
                            alert('Une erreur est survenue. Veuillez réessayer.');
                        }
                    } catch (err) {
                        // Fallback : submit classique
                        form.submit();
                    } finally {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                });
            });

            // Ouvrir depuis un bouton externe (ex: offre d'emploi)
            function postulerOffre(offreId, offreTitle) {
                document.getElementById('offre_id_cand').value = offreId;
                document.getElementById('poste_cible_cand').value = offreTitle;
                openPanel('panel-candidature');
            }
        </script>


</div>

{{-- ══ FOOTER ══ --}}

@include('components.footer')

@endsection