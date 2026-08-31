{{-- resources/views/recruteur/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Espace Recruteur — JEFIE Paris 2026')
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

    .nav {
        background: #0f284e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 200;
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
        border: 2px solid #f5c518;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .8);
        font-size: 13px;
        text-decoration: none;
        transition: color .2s;
        white-space: nowrap;
    }

    .nav-links a:hover {
        color: #fff;
    }

    .nav-links a.active {
        color: #f5c518;
        border-bottom: 2px solid #f5c518;
        padding-bottom: 2px;
        font-weight: 700;
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
        padding: 5px;
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

    .btn-sinscrire {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 20px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
    }

    .btn-sinscrire:hover {
        opacity: .9;
    }

    /* ── LAYOUT ── */
    .rec-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        min-height: calc(100vh - 64px);
    }

    /* ── SIDEBAR ── */
    .rec-sidebar {
        background: #0f284e;
        display: flex;
        flex-direction: column;
        padding: 1.5rem 0;
    }

    .rs-brand {
        padding: .5rem 1.5rem 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        margin-bottom: .75rem;
    }

    .rs-brand-title {
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rs-brand-title svg {
        stroke: #f5c518;
    }

    .rs-brand-sub {
        color: rgba(255, 255, 255, .5);
        font-size: 10px;
        margin-top: 2px;
    }

    .rs-user {
        padding: .75rem 1.5rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        margin-bottom: .5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .rs-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(245, 166, 35, .2);
        border: 2px solid #f5c518;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .rs-avatar img {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border-radius: 50%;
    }

    .rs-avatar-init {
        color: #f5c518;
        font-size: 14px;
        font-weight: 700;
    }

    .rs-user-name {
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.3;
    }

    .rs-user-role {
        color: rgba(255, 255, 255, .5);
        font-size: 10px;
    }

    .rs-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 1.5rem;
        font-size: 13px;
        color: rgba(255, 255, 255, .65);
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all .15s;
        position: relative;
    }

    .rs-item:hover {
        background: rgba(255, 255, 255, .06);
        color: #fff;
    }

    .rs-item.active {
        background: rgba(245, 166, 35, .12);
        color: #f5c518;
        border-left-color: #f5c518;
        font-weight: 700;
    }

    .rs-item svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .rs-badge {
        margin-left: auto;
        background: #e53935;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 1px 7px;
        border-radius: 10px;
    }

    .rs-section {
        padding: .75rem 1.5rem .25rem;
        font-size: 10px;
        font-weight: 700;
        color: rgba(255, 255, 255, .3);
        text-transform: uppercase;
        letter-spacing: .1em;
    }

    .rs-bottom {
        margin-top: auto;
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, .08);
    }

    .rs-logout {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, .5);
        font-size: 12px;
        text-decoration: none;
        transition: color .2s;
    }

    .rs-logout:hover {
        color: #e53935;
    }

    .rs-logout svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
    }

    /* ── MAIN ── */
    .rec-main {
        padding: 1.75rem 2rem;
        overflow-y: auto;
    }

    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: .75rem;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 900;
        color: #0f284e;
    }

    .page-subtitle {
        font-size: 12px;
        color: #718096;
        margin-top: 3px;
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

    .btn-or svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .alert-success {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        color: #2e7d32;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-success svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
        flex-shrink: 0;
    }

    /* Stats */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: box-shadow .2s;
    }

    .stat-card:hover {
        box-shadow: 0 4px 14px rgba(15, 40, 78, .08);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 22px;
        height: 22px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.7;
    }

    .stat-num {
        font-size: 1.5rem;
        font-weight: 900;
        color: #0f284e;
        display: block;
        line-height: 1;
    }

    .stat-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 3px;
    }

    .stat-evol {
        font-size: 11px;
        font-weight: 700;
        color: #2e7d32;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    /* Grid 2 cols */
    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    /* Card */
    .card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.4rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .card-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 8px;
    }

    .card-link {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .card-link svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* Offre item */
    .offre-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .offre-item:last-child {
        border-bottom: none;
    }

    .offre-logo {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f4f6fa;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
    }

    .offre-logo img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .offre-logo-init {
        font-size: 14px;
        font-weight: 800;
        color: #0f284e;
    }

    .offre-info {
        flex: 1;
        min-width: 0;
    }

    .offre-titre {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .offre-meta {
        font-size: 11px;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 2px;
    }

    .offre-meta svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
    }

    .offre-stats {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .offre-stat {
        text-align: center;
    }

    .offre-stat-num {
        font-size: 13px;
        font-weight: 800;
        color: #0f284e;
        display: block;
    }

    .offre-stat-lbl {
        font-size: 9px;
        color: #a0aec0;
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

    .s-active {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .s-inactive {
        background: #f0f4f8;
        color: #718096;
    }

    .s-pourvue {
        background: #e3f2fd;
        color: #0f284e;
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

    .s-nouveau {
        background: #e3f2fd;
        color: #0f284e;
    }

    .s-vedette {
        background: #fff3e0;
        color: #f5c518;
    }

    /* Candidature item */
    .cand-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f8;
    }

    .cand-item:last-child {
        border-bottom: none;
    }

    .cand-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .cand-avatar img {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border-radius: 50%;
    }

    .cand-avatar-init {
        color: #f5c518;
        font-size: 14px;
        font-weight: 700;
    }

    .cand-info {
        flex: 1;
        min-width: 0;
    }

    .cand-name {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
    }

    .cand-meta {
        font-size: 11px;
        color: #718096;
        margin-top: 1px;
    }

    .cand-date {
        font-size: 10px;
        color: #a0aec0;
        flex-shrink: 0;
    }

    /* Table */
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
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: .06em;
        padding: 8px 14px;
        border-bottom: 2px solid #f0f4f8;
        text-align: left;
        white-space: nowrap;
    }

    td {
        font-size: 13px;
        color: #0a1e38;
        padding: 14px;
        border-bottom: 1px solid #f0f4f8;
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: #fafbfc;
    }

    .action-btns {
        display: flex;
        gap: 6px;
    }

    .btn-sm {
        padding: 6px 13px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        border: 1.5px solid;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all .2s;
        font-family: inherit;
        white-space: nowrap;
    }

    .btn-sm svg {
        width: 12px;
        height: 12px;
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

    .btn-sm-edit {
        border-color: #bfdbfe;
        color: #0f284e;
        background: #fff;
    }

    .btn-sm-edit:hover {
        background: #e3f2fd;
    }

    .btn-sm-del {
        border-color: #fecaca;
        color: #e53935;
        background: #fff;
    }

    .btn-sm-del:hover {
        background: #fce4ec;
    }

    .btn-sm-ok {
        border-color: #a5d6a7;
        color: #2e7d32;
        background: #fff;
    }

    .btn-sm-ok:hover {
        background: #e8f5e9;
    }

    /* Formulaire */
    .form-section {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .form-section-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
        border-left: 3px solid #f5c518;
        padding-left: 8px;
        margin-bottom: 1.1rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .fg1 {
        grid-column: 1/-1;
    }

    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        display: block;
        margin-bottom: 5px;
    }

    .req {
        color: #e53935;
    }

    .form-control {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid #d1d9e6;
        border-radius: 7px;
        font-size: 13px;
        color: #1a2744;
        outline: none;
        transition: border-color .2s;
        font-family: inherit;
        background: #fff;
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

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* Newsletter */
    .nl-stat {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .nl-stat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.1rem;
        text-align: center;
    }

    .nl-stat-num {
        font-size: 1.4rem;
        font-weight: 900;
        color: #0f284e;
        display: block;
    }

    .nl-stat-lbl {
        font-size: 11px;
        color: #718096;
        margin-top: 2px;
    }

    /* Empty */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .75rem;
    }

    .empty-state svg {
        width: 52px;
        height: 52px;
        stroke: #d1d9e6;
        fill: none;
        stroke-width: 1.2;
    }

    .empty-state h3 {
        font-size: 14px;
        font-weight: 700;
        color: #718096;
    }

    .empty-state p {
        font-size: 12px;
        color: #a0aec0;
        max-width: 280px;
        line-height: 1.6;
    }

    /* Footer */
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
        font-size: 10px;
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

    @media (max-width:1100px) {
        .rec-layout {
            grid-template-columns: 1fr;
        }

        .rec-sidebar {
            display: none;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .two-col {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:768px) {
        .nav-links {
            display: none;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

{{-- NAV --}}
<nav class="nav">
    <a href="{{ route('index') }}" class="nav-logo">
        <div class="nav-logo-icon"><svg width="22" height="22" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="1.8">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg></div>
        <div class="nav-logo-text"><span>JEFIE</span>Paris 2026</div>
    </a>
    <div class="nav-links">
        <a href="{{ route('index') }}">Accueil</a>
        <a href="{{ route('emploi') }}" class="active">Emploi &amp; Recrutement</a>
        <a href="{{ route('actualites') }}">Actualités</a>
        <a href="{{ route('partenaires') }}">Partenaires</a>
        <a href="{{ route('contact') }}">Contact</a>
    </div>
    <div class="nav-right">
        <button class="nav-icon-btn"><svg viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
            </svg></button>
        <a href="{{ route('emploi') }}" style="color:rgba(255,255,255,.7);font-size:12px;text-decoration:none">← Espace candidat</a>
        <a href="{{ route('inscription') }}" class="btn-sinscrire">S'inscrire</a>
    </div>
</nav>

<div class="rec-layout">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="rec-sidebar">
        <div class="rs-brand">
            <div class="rs-brand-title">
                <svg width="16" height="16" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Espace Recruteur
            </div>
            <div class="rs-brand-sub">Portail employeur JEFIE 2026</div>
        </div>

        <div class="rs-user">
            <div class="rs-avatar">
                @auth
                @if (auth()->user()->photo ?? false)
                <img src="{{ asset('storage/'.auth()->user()->photo) }}" alt="">
                @else
                <span class="rs-avatar-init">{{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}</span>
                @endif
                @else
                <span class="rs-avatar-init">R</span>
                @endauth
            </div>
            <div>
                <div class="rs-user-name">@auth{{ auth()->user()->name }}@else Recruteur@endauth</div>
                <div class="rs-user-role">Espace Recruteur</div>
            </div>
        </div>

        <a href="{{ route('recruteur.dashboard') }}" class="rs-item {{ request()->routeIs('recruteur.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
            Tableau de bord
        </a>
        <a href="{{ route('recruteur.offre.creer') }}" class="rs-item {{ request()->routeIs('recruteur.offre.creer') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Publier une offre
        </a>
        <a href="{{ route('recruteur.offres') }}" class="rs-item {{ request()->routeIs('recruteur.offres') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <polyline points="14 2 14 8 20 8" />
            </svg>
            Mes offres publiées
        </a>
        <a href="{{ route('recruteur.candidatures') }}" class="rs-item {{ request()->routeIs('recruteur.candidatures') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>
            Candidatures reçues
            @if (($stats['candidatures_new'] ?? 0) > 0)
            <span class="rs-badge">{{ $stats['candidatures_new'] }}</span>
            @endif
        </a>

        <div class="rs-section">Communication</div>
        <a href="{{ route('recruteur.newsletter') }}" class="rs-item {{ request()->routeIs('recruteur.newsletter') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24">
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="M2 7l10 7 10-7" />
            </svg>
            Newsletter & Emails
        </a>

        <div class="rs-section">Compte</div>
        <a href="{{ route('emploi.profil') }}" class="rs-item">
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Mon profil entreprise
        </a>

        <div class="rs-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="rs-logout" style="background:none;border:none;cursor:pointer;font-family:inherit">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                    </svg>
                    Se déconnecter
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN DASHBOARD ══ --}}
    <main class="rec-main">
        <div class="page-header">
            <div>
                <div class="page-title">Tableau de Bord Recruteur</div>
                <div class="page-subtitle">Gérez vos offres et suivez vos candidatures en temps réel</div>
            </div>
            <a href="{{ route('recruteur.offre.creer') }}" class="btn-or">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Publier une offre
            </a>
        </div>

        @if (session('success'))
        <div class="alert-success"><svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>{{ session('success') }}</div>
        @endif

        {{-- Stats --}}
        <div class="stats-grid">
            @foreach ([
            [($stats['offres_actives']??0), 'Offres actives', '#2e7d32','#e8f5e9','
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
            <polyline points="14 2 14 8 20 8" />'],
            [($stats['candidatures_total']??0), 'Candidatures reçues', '#0f284e','#e3f2fd','
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
            <circle cx="9" cy="7" r="4" />'],
            [($stats['candidatures_new']??0), 'Nouvelles aujourd\'hui','#b07d10','#fff8e6','
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />'],
            [($stats['vues_total']??0), 'Vues des offres', '#6a1b9a','#ede7f6','
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
            <circle cx="12" cy="12" r="3" />'],
            ] as [$n,$l,$c,$bg,$ic])
            <div class="stat-card">
                <div class="stat-icon" style="background:{{ $bg }};color:{{ $c }}">
                    <svg viewBox="0 0 24 24" stroke="{{ $c }}" fill="none" stroke-width="1.7">{!! $ic !!}</svg>
                </div>
                <div>
                    <span class="stat-num">{{ number_format($n) }}</span>
                    <div class="stat-lbl">{{ $l }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="two-col">
            {{-- Offres récentes --}}
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Mes Offres Récentes</span>
                    <a href="{{ route('recruteur.offres') }}" class="card-link">
                        Voir tout <svg viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @forelse ($offres_recentes ?? [] as $offre)
                <div class="offre-item">
                    <div class="offre-logo">
                        @if ($offre->logo_entreprise)
                        <img src="{{ asset('storage/'.$offre->logo_entreprise) }}" alt="{{ $offre->entreprise }}">
                        @else
                        @php $logos = ['ora.png'=>'Orange','eco.jpg'=>'Ecobank','socie.png'=>'Société Générale','Pnp.jpg'=>'PNUD','son.jpg'=>'Sonatel']; @endphp
                        @php $match = array_search($offre->entreprise, $logos); @endphp
                        @if ($match)
                        <img src="{{ asset('images/'.$match) }}" alt="{{ $offre->entreprise }}" style="max-width:36px;max-height:36px;object-fit:contain">
                        @else
                        <span class="offre-logo-init">{{ strtoupper(substr($offre->entreprise ?? 'E', 0, 2)) }}</span>
                        @endif
                        @endif
                    </div>
                    <div class="offre-info">
                        <div class="offre-titre">{{ $offre->titre }}</div>
                        <div class="offre-meta">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $offre->lieu }}
                            <span class="statut-badge s-{{ $offre->type_contrat === 'CDI' ? 'active' : 'cours' }}" style="font-size:9px;padding:2px 7px">{{ $offre->type_contrat }}</span>
                        </div>
                    </div>
                    <div class="offre-stats">
                        <div class="offre-stat">
                            <span class="offre-stat-num">{{ $offre->candidatures_count ?? 0 }}</span>
                            <div class="offre-stat-lbl">Candid.</div>
                        </div>
                        <div class="offre-stat">
                            <span class="offre-stat-num">{{ $offre->vues ?? 0 }}</span>
                            <div class="offre-stat-lbl">Vues</div>
                        </div>
                        <span class="statut-badge s-{{ $offre->statut }}">{{ ucfirst($offre->statut) }}</span>
                    </div>
                </div>
                @empty
                <div class="empty-state" style="padding:2rem">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    </svg>
                    <p>Aucune offre publiée.</p>
                    <a href="{{ route('recruteur.offre.creer') }}" class="btn-primary" style="font-size:12px;padding:8px 16px">Publier ma première offre</a>
                </div>
                @endforelse
            </div>

            {{-- Candidatures récentes --}}
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Nouvelles Candidatures</span>
                    <a href="{{ route('recruteur.candidatures') }}" class="card-link">
                        Voir tout <svg viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @forelse ($candidatures_recentes ?? [] as $c)
                <div class="cand-item">
                    <div class="cand-avatar">
                        <span class="cand-avatar-init">{{ strtoupper(substr($c->nom_complet ?? 'C', 0, 1)) }}</span>
                    </div>
                    <div class="cand-info">
                        <div class="cand-name">{{ $c->nom_complet }}</div>
                        <div class="cand-meta">{{ $c->offreEmploi->titre ?? '—' }}</div>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px">
                        <div class="cand-date">{{ $c->created_at->diffForHumans() }}</div>
                        <a href="{{ route('recruteur.candidature.voir', $c->id) }}" class="btn-sm btn-sm-view" style="font-size:10px;padding:4px 10px">Voir</a>
                    </div>
                </div>
                @empty
                <div class="empty-state" style="padding:2rem">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                    </svg>
                    <p>Aucune candidature reçue.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

{{-- ══ FOOTER ══ --}}

@include('components.footer')
@endsection