{{-- ══ COMPOSANT NAVBAR PARTAGÉ ══ --}}
{{-- Utilisé sur toutes les pages du site. Styles intégrés pour fonctionnement autonome. --}}
<style>
    /* ══ NAV ══ */
    * {
        box-sizing: border-box
    }

    .nav {
        background: #0f284e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2.5rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .nav.scrolled {
        box-shadow: 0 4px 24px rgba(0, 0, 0, .35)
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none
    }

    .nav-logo-icon {
        width: 44px;
        height: 44px;
        border: 2px solid #f5c518;
        ;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0
    }

    /* Remplacement de la règle svg par celle-ci pour l'image */
    .nav-logo-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        display: block;
        font-size: 12px;
        font-weight: 800;
        color: #f5c518;
    }

    .nav-logo-text small {
        color: rgba(255, 255, 255, .7);
        font-size: 9px;
    }

    /* ── Liens de navigation ── */
    .nav-links {
        display: flex;
        gap: 1.75rem;
        align-items: center
    }


    .nav-links a {
        color: rgba(255, 255, 255, .85);
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        transition: color .2s;
        white-space: nowrap;
        padding-bottom: 3px;
        letter-spacing: .01em;
    }

    .nav-links a:hover {
        color: #f5c518;
    }

    .nav-links a.active {
        color: #f5c518;
        border-bottom: 2px solid #f5c518;
        font-weight: 700;
    }

    /* ── Bouton principal ── */
    .nav-btn {
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 12.5px;
        padding: 10px 22px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: opacity .2s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .nav-btn:hover {
        transform: translateY(-1px)
    }

    .nav-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2
    }

    /* ── Bouton hamburger ── */
    .hamburger {
        display: none;
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
        padding: 6px;
        border-radius: 7px;
        transition: background .2s;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 36px;
        height: 36px;
    }

    .hamburger:hover {
        background: rgba(255, 255, 255, .1)
    }

    .ham-line {
        display: block;
        width: 22px;
        height: 2px;
        background: #fff;
        border-radius: 2px;
        transition: all .3s;
        transform-origin: center;
    }

    .hamburger.open .ham-line:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px)
    }

    .hamburger.open .ham-line:nth-child(2) {
        opacity: 0;
        transform: scaleX(0)
    }

    .hamburger.open .ham-line:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px)
    }


    /* ═══════════════════════════════════════════
   MENU MOBILE OVERLAY
═══════════════════════════════════════════ */
    .mobile-overlay {
        display: none;
        position: fixed;
        inset: 64px 0 0 0;
        background: #0a1428;
        z-index: 999;
        overflow-y: auto;
        transform: translateX(100%);
        transition: transform .3s cubic-bezier(.4, 0, .2, 1);
    }

    .mobile-overlay.open {
        display: block;
        transform: translateX(0);
    }

    .mob-inner {
        padding: 1rem 0 2rem
    }

    /* Section mobile */
    .mob-section-title {
        font-size: 9px;
        font-weight: 800;
        color: rgba(255, 255, 255, .35);
        text-transform: uppercase;
        letter-spacing: .12em;
        padding: .85rem 1.5rem .35rem;
    }

    .mob-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: .85rem 1.5rem;
        color: rgba(255, 255, 255, .85);
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, .04);
        transition: background .15s, color .15s;
    }

    .mob-link:hover,
    .mob-link:active {
        background: rgba(255, 255, 255, .07);
        color: #f5c518;
    }

    .mob-link.active-route {
        color: #f5c518;
        border-left: 3px solid #f5c518;
        padding-left: calc(1.5rem - 3px);
        background: rgba(245, 166, 35, .07);
    }

    .mob-link svg {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.7;
        flex-shrink: 0;
        opacity: .7;
    }

    .mob-link:hover svg,
    .mob-link.active-route svg {
        opacity: 1
    }

    .mob-link-arrow {
        margin-left: auto;
        opacity: .35;
        font-size: 12px
    }

    /* Accordion mobile */
    .mob-accordion {}

    .mob-acc-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: .85rem 1.5rem;
        color: rgba(255, 255, 255, .85);
        font-size: 14px;
        font-weight: 600;
        border-bottom: 1px solid rgba(255, 255, 255, .04);
        cursor: pointer;
        transition: background .15s;
        user-select: none;
    }

    .mob-acc-head:hover {
        background: rgba(255, 255, 255, .07)
    }

    .mob-acc-head svg {
        width: 17px;
        height: 17px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.7;
        flex-shrink: 0;
        opacity: .7;
    }

    .mob-acc-chevron {
        margin-left: auto;
        width: 14px;
        height: 14px;
        stroke: rgba(255, 255, 255, .4);
        fill: none;
        stroke-width: 2;
        transition: transform .25s;
        flex-shrink: 0;
    }

    .mob-accordion.open .mob-acc-chevron {
        transform: rotate(180deg)
    }

    .mob-acc-body {
        display: none;
        background: rgba(0, 0, 0, .15);
    }

    .mob-accordion.open .mob-acc-body {
        display: block
    }

    .mob-acc-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: .7rem 1.5rem .7rem 2.75rem;
        color: rgba(255, 255, 255, .65);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, .03);
        transition: color .15s;
    }

    .mob-acc-link::before {
        content: '';
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, .2);
        border-radius: 50%;
        flex-shrink: 0;
    }

    .mob-acc-link:hover {
        color: #f5c518
    }

    .mob-acc-link:hover::before {
        background: #f5c518
    }

    /* Bas du menu mobile */
    .mob-bottom {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, .08);
        margin-top: .5rem;
    }

    .mob-btn-inscr {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #f5c518;
        color: #0f284e;
        font-weight: 700;
        font-size: 14px;
        padding: 14px;
        border-radius: 8px;
        text-decoration: none;
        margin-bottom: .75rem;
        transition: opacity .2s;
    }

    .mob-btn-inscr:hover {
        opacity: .9
    }

    .mob-btn-inscr svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2
    }

    .mob-btn-espace {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        padding: 13px;
        border-radius: 8px;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, .15);
        transition: background .2s;
    }

    .mob-btn-espace:hover {
        background: rgba(255, 255, 255, .14)
    }

    .mob-btn-espace svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2
    }

    /* Agenda & search mobile row */
    .mob-actions-row {
        display: flex;
        gap: .5rem;
        padding: .75rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .mob-action-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: rgba(255, 255, 255, .06);
        color: rgba(255, 255, 255, .8);
        font-size: 12px;
        font-weight: 600;
        padding: 10px;
        border-radius: 7px;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, .1);
        transition: background .15s;
        position: relative;
    }

    .mob-action-btn:hover {
        background: rgba(255, 255, 255, .12)
    }

    .mob-action-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8
    }

    .mob-agenda-count {
        display: none;
        position: absolute;
        top: -5px;
        right: -5px;
        width: 16px;
        height: 16px;
        background: #e53935;
        border-radius: 50%;
        color: #fff;
        font-size: 8px;
        font-weight: 800;
        align-items: center;
        justify-content: center;
    }

    /* Recherche mobile */
    .mob-search {
        padding: .75rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, .06)
    }

    .mob-search-input {
        width: 100%;
        padding: 11px 14px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
        outline: none;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .mob-search-input::placeholder {
        color: rgba(255, 255, 255, .35)
    }

    .mob-search-input:focus {
        border-color: rgba(245, 166, 35, .5);
        background: rgba(255, 255, 255, .12)
    }

    /* ═══════════════════════════════════════════
   BREAKPOINTS
═══════════════════════════════════════════ */
    /* TABLETTE : 768–1100px */
    @media(max-width:1100px) {
        .nav {
            padding: 0 1.5rem
        }

        .nav-links {
            gap: .85rem
        }

        .nav-links a,
        .nav-dropdown-toggle {
            font-size: 11.5px
        }

        .nav-btn {
            padding: 8px 14px;
            font-size: 11.5px
        }

        #searchForm input {
            width: 140px
        }
    }

    /* TABLETTE portrait : 768–900px */
    @media(max-width:900px) {
        .nav-links {
            gap: .6rem
        }

        .nav-links a,
        .nav-dropdown-toggle {
            font-size: 11px
        }

        .nav-btn span {
            display: none
        }
    }

    /* MOBILE : < 768px */
    @media(max-width:768px) {
        .nav {
            padding: 0 1.25rem;
            height: 60px
        }

        .nav-links {
            display: none
        }

        .nav-btn {
            display: none
        }

        .nav-icon-btn.search-toggle {
            display: none
        }

        .hamburger {
            display: flex
        }

        .search-container {
            display: none
        }

        .mobile-overlay {
            top: 60px
        }
    }

    /* Très petit : < 400px */
    @media(max-width:400px) {
        .nav-logo img {
            max-width: 110px
        }

        .nav-logo-text span {
            font-size: 10px
        }

        .nav-logo-text small {
            display: none
        }
    }

    /* ── Zone droite ── */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-shrink: 0;
    }

    .nav-right-actions {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── Icônes ── */
    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
        border-radius: 6px;
        transition: background .2s, color .2s;
        text-decoration: none;
        position: relative;
    }

    .nav-icon-btn:hover {
        color: #fff;
        background: rgba(255, 255, 255, .08);
    }

    .nav-icon-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── Dropdown navigation ── */
    .nav-dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    .nav-dropdown-toggle {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        color: rgba(255, 255, 255, .85);
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        transition: color .2s;
        white-space: nowrap;
        padding-bottom: 3px;
        letter-spacing: .01em;
        background: none;
        border: none;
        font-family: inherit;
    }

    .nav-dropdown-toggle:hover {
        color: #f5c518
    }

    .nav-dropdown-toggle svg {
        width: 11px;
        height: 11px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        transition: transform .25s;
        flex-shrink: 0;
    }

    .nav-dropdown-wrapper.open .nav-dropdown-toggle svg {
        transform: rotate(180deg)
    }

    .nav-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        z-index: 2000;
        min-width: 195px;
        background: #fff;
        box-shadow: 0 8px 32px rgba(0, 0, 0, .15);
        border-radius: 10px;
        padding: .4rem 0;
        border-top: 3px solid #f5c518;
        animation: dropIn .18s ease;
    }

    .nav-dropdown-wrapper:hover .nav-dropdown-menu {
        display: block;
    }

    .nav-dropdown-menu a {
        color: #333 !important;
        padding: 9px 15px;
        text-decoration: none;
        display: block;
        white-space: nowrap;
        font-size: 13px;
        font-weight: 500;
        transition: background .15s, color .15s;
        border-bottom: none !important;
    }

    @keyframes dropIn {
        from {
            opacity: 0;
            transform: translateY(-6px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    .nav-dropdown-menu a {
        color: #1a2744 !important;
        padding: 9px 16px;
        text-decoration: none;
        display: block;
        font-size: 13px;
        font-weight: 500;
        transition: background .15s, color .15s;
        border: none !important;
    }

    .nav-dropdown-menu a:hover {
        background-color: #f4f6fa;
        color: #f5c518 !important;
        padding-left: 20px;
    }


    /* ── Agenda badge ── */
    .agenda-btn {
        position: relative
    }

    #agendaNavCount {
        display: none;
        position: absolute;
        top: -5px;
        right: -5px;
        width: 16px;
        height: 16px;
        background: #e53935;
        border-radius: 50%;
        border: 2px solid #0f284e;
        color: #fff;
        font-size: 8px;
        font-weight: 800;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    /* ── Sélecteur de langue ── */
    .lang-switcher {
        position: relative;
        display: inline-block;
        flex-shrink: 0;
    }

    .lang-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 5px;
        padding: 6px 10px;
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
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .lang-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 6px);
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .18);
        min-width: 155px;
        z-index: 2000;
    }

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
        gap: 8px;
    }

    .lang-item:hover {
        background: #f4f4f4;
    }

    .lang-item.active {
        font-weight: 700;
    }

    .lang-item-name {
        font-size: 13px;
        font-weight: 400;
        flex: 1;
    }

    .lang-item-code {
        color: #888;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .lang-check {
        margin-left: auto;
    }

    .lang-check svg {
        width: 13px;
        height: 13px;
        fill: none;
        stroke: #f5c518;
        stroke-width: 2.5;
    }

    /* ── Recherche ── */
    .search-container {
        display: flex;
        align-items: center;
        position: relative
    }

    #searchForm {
        display: none;
        position: absolute;
        right: 34px;
        top: 50%;
        transform: translateY(-50%);
        background: #0f284e;
        z-index: 10;
    }

    #searchForm input {
        padding: 7px 12px;
        border: 1px solid rgba(255, 255, 255, .3);
        border-radius: 5px;
        font-size: 13px;
        background: rgba(255, 255, 255, .1);
        color: #fff;
        outline: none;
        width: 180px;
        font-family: 'Segoe UI', Arial, sans-serif;
        transition: width .3s;
    }

    #searchForm input::placeholder {
        color: rgba(255, 255, 255, .45);
    }

    #searchForm input:focus {
        width: 220px;
        border-color: rgba(245, 166, 35, .5);
    }

    /* ── Responsive ── */
    @media (max-width: 1200px) {
        .nav-links {
            gap: 1rem;
        }

        .nav-links a {
            font-size: 11.5px;
        }
    }

    @media (max-width: 1024px) {
        .nav {
            padding: 0 1.5rem;
        }

        .nav-links {
            gap: 0.75rem;
        }
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .nav {
            padding: 0 1.25rem;
        }
    }
</style>

{{-- ══ NAV ══ --}}
<nav class="nav">
    {{-- Logo --}}
    <a href="{{ route('index') }}" class="nav-logo">
        <div class="nav-logo-icon" style="background: none; border: none; border-radius: 0; padding: 0; box-shadow: none;">
            <img src="{{ asset('images/r2c.png') }}"
                alt="Logo JEFIE Paris 2026"
                style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
        </div>

    </a>

    {{-- LIENS DESKTOP --}}
    <div class="nav-links" id="navLinks">

        {{-- JEFIE 2026 Dropdown --}}
        <div class="nav-dropdown-wrapper" id="ddJefie">
            <button class="nav-dropdown-toggle" onclick="toggleDd(event,'ddJefie')">
                JEFIE 2026
                <svg viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </button>
            <div class="nav-dropdown-menu" id="ddJefieMenu">
                <a href="{{ route('index') }}">Accueil</a>
                <a href="{{ route('Apropos') }}">À propos</a>
                <a href="{{ route('pourquoi-participer') }}">Pourquoi participer ?</a>
                <a href="{{ route('programme') }}">Programme officiel</a>
                <a href="{{ route('actualites') }}">Actualités & Médias</a>
                <a href="{{ route('gouvernance') }}">Gouvernance</a>
                <a href="{{ route('Faq') }}">FAQ</a>
            </div>
        </div>

        {{-- Entreprises Dropdown --}}
        <div class="nav-dropdown-wrapper" id="ddEntreprises">
            <button class="nav-dropdown-toggle" onclick="toggleDd(event,'ddEntreprises')">
                Entreprises participantes
                <svg viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </button>
            <div class="nav-dropdown-menu" id="ddEntreprisesMenu">
                <a href="{{ route('institutionnel') }}">Entreprises & Partenaires</a>
                <a href="{{ route('partenaires.devenir') }}">Devenir partenaire</a>
            </div>
        </div>

        {{-- Mon Espace --}}
        @auth
        <a href="{{ route('mon-espace.dashboard') }}" @class(['active'=>request()->routeIs('mon-espace.*')])>Mon espace</a>
        @else
        <a href="{{ route('auth.choice') }}" @class(['active'=>request()->routeIs('auth.*')])>Mon espace</a>
        @endauth

        {{-- Contact --}}
        <a href="{{ route('contact') }}" @class(['active'=>request()->routeIs('contact')])>Contact</a>
    </div>

    {{-- Zone droite : icônes + bouton + langue --}}
    <div class="nav-right">




        {{-- Recherche desktop --}}
        <div class="search-container">
            <form action="{{ route('actualites') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Rechercher...">
            </form>
            <button type="button" class="nav-icon-btn search-toggle" aria-label="Rechercher" onclick="toggleSearch()">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
            </button>
        </div>

        {{-- Agenda --}}
        <a href="{{ route('programme.mon-agenda') }}" class="nav-icon-btn agenda-btn" id="agendaNavBtn" title="Mon agenda">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
                <line x1="8" y1="14" x2="16" y2="14" />
            </svg>
            <span id="agendaNavCount">0</span>
        </a>

        {{-- S'inscrire --}}
        <a href="{{ route('inscription') }}" class="nav-btn">
            S'inscrire
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
        </a>

        {{-- Hamburger --}}
        <button class="hamburger" id="hamburger" onclick="toggleMobile()" aria-label="Menu">
            <span class="ham-line"></span>
            <span class="ham-line"></span>
            <span class="ham-line"></span>
        </button>
    </div>
</nav>


{{-- ══════════════════════════════════
     MENU MOBILE OVERLAY
══════════════════════════════════ --}}
<div class="mobile-overlay" id="mobileOverlay">
    <div class="mob-inner">

        {{-- Recherche mobile --}}
        <div class="mob-search">
            <form action="{{ route('actualites') }}" method="GET">
                <input type="text" name="search" class="mob-search-input" placeholder="🔍  Rechercher une session, une entreprise...">
            </form>
        </div>

        {{-- Actions rapides --}}
        <div class="mob-actions-row">
            <a href="{{ route('programme.mon-agenda') }}" class="mob-action-btn">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Mon agenda
                <span class="mob-agenda-count" id="mobAgendaCount">0</span>
            </a>
            <a href="{{ route('inscription') }}" class="mob-action-btn" style="background:rgba(245,166,35,.15);border-color:rgba(245,166,35,.3);color:#f5c518">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                S'inscrire
            </a>
        </div>

        {{-- JEFIE 2026 accordion --}}
        <div class="mob-accordion" id="mobJefie">
            <div class="mob-acc-head" onclick="toggleMobAcc('mobJefie')">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                JEFIE 2026
                <svg class="mob-acc-chevron" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </div>
            <div class="mob-acc-body">
                <a href="{{ route('index') }}" class="mob-acc-link">Accueil</a>
                <a href="{{ route('Apropos') }}" class="mob-acc-link">À propos</a>
                <a href="{{ route('pourquoi-participer') }}" class="mob-acc-link">Pourquoi participer ?</a>
                <a href="{{ route('programme') }}" class="mob-acc-link">Programme officiel</a>
                <a href="{{ route('actualites') }}" class="mob-acc-link">Actualités & Médias</a>
                <a href="{{ route('gouvernance') }}" class="mob-acc-link">Gouvernance</a>
                <a href="{{ route('Faq') }}" class="mob-acc-link">FAQ</a>
            </div>
        </div>

        {{-- Entreprises accordion --}}
        <div class="mob-accordion" id="mobEntreprises">
            <div class="mob-acc-head" onclick="toggleMobAcc('mobEntreprises')">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                Entreprises participantes
                <svg class="mob-acc-chevron" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </div>
            <div class="mob-acc-body">
                <a href="{{ route('institutionnel') }}" class="mob-acc-link">Entreprises & Partenaires</a>
                <a href="{{ route('partenaires.devenir') }}" class="mob-acc-link">Devenir partenaire</a>
            </div>
        </div>

        {{-- Mon espace --}}
        <div class="mob-section-title">Mon compte</div>
        @auth
        <a href="{{ route('mon-espace.dashboard') }}" class="mob-link">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
            Mon espace
            <span class="mob-link-arrow">›</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="mob-link" style="width:100%;text-align:left;background:none;border:none;font-family:inherit;cursor:pointer">
                <svg viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                </svg>
                Se déconnecter
            </button>
        </form>
        @else
        <a href="{{ route('auth.choice') }}" class="mob-link">
            <svg viewBox="0 0 24 24">
                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
            </svg>
            Se connecter
            <span class="mob-link-arrow">›</span>
        </a>
        @endauth

        {{-- Liens directs --}}
        <div class="mob-section-title">Navigation</div>


        <a href="{{ route('partenaires') }}" class="mob-link">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87" />
            </svg>
            Partenaires
            <span class="mob-link-arrow">›</span>
        </a>
        <a href="{{ route('contact') }}" class="mob-link {{ request()->routeIs('contact') ? 'active-route' : '' }}">
            <svg viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
            </svg>
            Contact
            <span class="mob-link-arrow">›</span>
        </a>

        {{-- CTA bottom --}}
        <div class="mob-bottom">
            <a href="{{ route('inscription') }}" class="mob-btn-inscr">
                <svg viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                    <line x1="19" y1="8" x2="19" y2="14" />
                    <line x1="22" y1="11" x2="16" y2="11" />
                </svg>
                S'inscrire au Forum — C'est gratuit
            </a>
            @guest
            <a href="{{ route('auth.choice') }}" class="mob-btn-espace">
                <svg viewBox="0 0 24 24">
                    <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3" />
                </svg>
                Accéder à mon espace
            </a>
            @endguest
        </div>

    </div>
</div>

{{-- ══════════════════════════════════
     SCRIPTS
══════════════════════════════════ --}}
<script>
    // Scroll shadow
    window.addEventListener('scroll', () => {
        document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 10);
    }, {
        passive: true
    });

    // Dropdown desktop
    function toggleDd(e, wrapperId) {
        e.preventDefault();
        e.stopPropagation();
        const wrapper = document.getElementById(wrapperId);
        const isOpen = wrapper.classList.contains('open');
        document.querySelectorAll('.nav-dropdown-wrapper.open').forEach(w => w.classList.remove('open'));
        document.querySelectorAll('.nav-dropdown-menu').forEach(m => m.style.display = 'none');
        if (!isOpen) {
            wrapper.classList.add('open');
            wrapper.querySelector('.nav-dropdown-menu').style.display = 'block';
        }
    }
    document.addEventListener('click', e => {
        if (!e.target.closest('.nav-dropdown-wrapper')) {
            document.querySelectorAll('.nav-dropdown-wrapper').forEach(w => w.classList.remove('open'));
            document.querySelectorAll('.nav-dropdown-menu').forEach(m => m.style.display = 'none');
        }
    });

    // Recherche desktop
    function toggleSearch() {
        const form = document.getElementById('searchForm');
        if (!form) return;
        const visible = form.style.display === 'block';
        form.style.display = visible ? 'none' : 'block';
        if (!visible) setTimeout(() => form.querySelector('input').focus(), 50);
    }

    // Menu mobile toggle
    function toggleMobile() {
        const ham = document.getElementById('hamburger');
        const overlay = document.getElementById('mobileOverlay');
        const isOpen = ham.classList.contains('open');
        ham.classList.toggle('open', !isOpen);
        overlay.classList.toggle('open', !isOpen);
        document.body.style.overflow = isOpen ? '' : 'hidden';
    }

    // Accordion mobile
    function toggleMobAcc(id) {
        const acc = document.getElementById(id);
        const isOpen = acc.classList.contains('open');
        document.querySelectorAll('.mob-accordion.open').forEach(a => a.classList.remove('open'));
        if (!isOpen) acc.classList.add('open');
    }

    // Fermer mobile au clic sur lien
    document.querySelectorAll('.mob-acc-link, .mob-link').forEach(link => {
        if (!link.closest('form')) link.addEventListener('click', () => {
            document.getElementById('hamburger').classList.remove('open');
            document.getElementById('mobileOverlay').classList.remove('open');
            document.body.style.overflow = '';
        });
    });

    // Fermer mobile au resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            document.getElementById('hamburger').classList.remove('open');
            document.getElementById('mobileOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }
    });

    // Badge agenda localStorage
    document.addEventListener('DOMContentLoaded', () => {
        try {
            const agenda = JSON.parse(localStorage.getItem('jefie_agenda_2026') || '[]');
            const count = agenda.length;
            // Desktop badge
            const desktopBadge = document.getElementById('agendaNavCount');
            if (desktopBadge && count > 0) {
                desktopBadge.textContent = count;
                desktopBadge.style.display = 'flex';
            }
            // Mobile badge
            const mobileBadge = document.getElementById('mobAgendaCount');
            if (mobileBadge && count > 0) {
                mobileBadge.textContent = count;
                mobileBadge.style.display = 'flex';
            }
        } catch (e) {}
    });
</script>