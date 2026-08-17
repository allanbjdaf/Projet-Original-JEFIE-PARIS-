{{-- ══ COMPOSANT NAVBAR PARTAGÉ ══ --}}
{{-- Utilisé sur toutes les pages du site. Styles intégrés pour fonctionnement autonome. --}}
<style>
    /* ══ NAV ══ */
    .nav {
        background: #0d1b3e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2.5rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        flex-shrink: 0;
    }

    .nav-logo-icon {
        width: 46px;
        height: 46px;
        border: 2px solid #f5a623;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #0d1b3e;
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
        color: #f5a623;
    }

    .nav-logo-text small {
        color: rgba(255, 255, 255, .7);
        font-size: 10px;
    }

    /* ── Liens de navigation ── */
    .nav-links {
        display: flex;
        gap: 1.4rem;
        align-items: center;
        flex: 1;
        justify-content: center;
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
        color: #f5a623;
    }

    .nav-links a.active {
        color: #f5a623;
        border-bottom: 2px solid #f5a623;
        font-weight: 700;
    }

    /* ── Bouton principal ── */
    .nav-btn {
        background: #f5a623;
        color: #0d1b3e;
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
        opacity: .9;
    }

    .nav-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── Zone droite ── */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 0.85rem;
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
        cursor: pointer;
    }

    .nav-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        z-index: 2000;
        min-width: 185px;
        background-color: #ffffff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
        border-radius: 8px;
        padding: 0.4rem 0;
        max-height: 280px;
        overflow-y: auto;
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

    .nav-dropdown-menu a:hover {
        background-color: #f4f6fa;
        color: #f5a623 !important;
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
        stroke: #f5a623;
        stroke-width: 2.5;
    }

    /* ── Barre de recherche ── */
    .search-container {
        display: flex;
        align-items: center;
    }

    #searchForm {
        display: none;
        margin-right: 6px;
    }

    #searchForm input {
        padding: 5px 10px;
        border: 1px solid rgba(255, 255, 255, .3);
        border-radius: 5px;
        font-size: 13px;
        background: rgba(255, 255, 255, .1);
        color: #fff;
        outline: none;
        width: 160px;
        transition: width .3s;
    }

    #searchForm input::placeholder {
        color: rgba(255, 255, 255, .45);
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
            <img src="{{ asset('images/264.png') }}"
                alt="Logo JEFIE Paris 2026"
                style="height: 60px; width: 200px; display: block; border-radius: 0; border: none; background: transparent;">
        </div>
        <div class="nav-logo-text">
            <span>JEFIE</span>
            <small>Paris 2026</small>
        </div>
    </a>

    {{-- Liens de navigation --}}
    <div class="nav-links">


        {{-- Acceuil (Dropdown) --}}
        <div class="nav-dropdown-wrapper" id="navAcceuilDropdown">
            <a href="#" class="nav-dropdown-toggle" onclick="toggleNavDropdown(event, 'navInstitutionnelMenu')">
                JEFIE 2026
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 3px;">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </a>
            <div class="nav-dropdown-menu" id="navInstitutionnelMenu">
                <a href="{{ route('index') }}">Acceuil</a>
                <a href="{{ route('Apropos') }}">Apropos</a>
                <a href="{{ route('programme') }}">Nos Programmes</a>
                <a href="{{ route('actualites') }}">Actualites et Medias</a>
                <a href="{{ route('gouvernance') }}">Gouvernance</a>
                <a href="{{ route('Faq') }}">FAQ</a>
            </div>
        </div>


        {{--Entreprises participantes (Dropdown) --}}
        <div class="nav-dropdown-wrapper" id="navEmploiDropdown">
            <a href="#" class="nav-dropdown-toggle" onclick="toggleNavDropdown(event, 'navEmploiMenu')">
                Entreprises participantes
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 3px;">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </a>
            <div class="nav-dropdown-menu" id="navEmploiMenu">
                <a href="{{ route('institutionnel') }}">Entreprise et partenaires</a>
            </div>
        </div>



        {{-- Mon espace (Bouton Simple) --}}
        <div class="nav-dropdown-wrapper" id="navEmploiDropdown">
            <a href="{{ route('mon-espace.dashboard') }}" class="nav-dropdown-toggle">
                Mon espace
            </a>
        </div>

        {{-- Contact --}}
        <a href="{{ route('contact') }}" @class(['active'=> request()->routeIs('contact')])>Contact</a>
    </div>

    {{-- Zone droite : icônes + bouton + langue --}}
    <div class="nav-right">

        {{-- Recherche --}}
        <div class="search-container">
            <form action="{{ route('actualites') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Rechercher...">
            </form>
            <button type="button" class="nav-icon-btn" aria-label="Rechercher" onclick="toggleSearch()">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>
            </button>
        </div>

        {{-- Notifications --}}
        <a href="

        {{-- Bouton S'inscrire --}}
        <a href=" {{ route('inscription') }}" class="nav-btn">
            S'inscrire
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
        </a>


    </div>
</nav>

{{-- Scripts du nav --}}
<script>
    /**
     * Bascule l'affichage d'un menu dropdown de navigation.
     * @param {Event} event - Événement de clic
     * @param {string} menuId - ID du menu à afficher/masquer
     */
    function toggleNavDropdown(event, menuId) {
        event.preventDefault();
        event.stopPropagation();
        const menu = document.getElementById(menuId);
        if (!menu) return;
        const isOpen = menu.style.display === 'block';
        // Fermer tous les autres menus ouverts
        document.querySelectorAll('.nav-dropdown-menu').forEach(m => m.style.display = 'none');
        if (!isOpen) menu.style.display = 'block';
    }

    /**
     * Bascule l'affichage du dropdown de sélection de langue.
     */
    function toggleLang() {
        const dropdown = document.getElementById('langDropdown');
        const btn = document.getElementById('langBtn');
        if (!dropdown) return;
        const isVisible = dropdown.classList.contains('open');
        dropdown.classList.toggle('open', !isVisible);
        if (btn) btn.setAttribute('aria-expanded', String(!isVisible));
    }

    /**
     * Bascule la barre de recherche.
     */
    function toggleSearch() {
        const form = document.getElementById('searchForm');
        if (!form) return;
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            form.querySelector('input')?.focus();
        } else {
            if (form.querySelector('input').value.trim() !== '') {
                form.submit();
            } else {
                form.style.display = 'none';
            }
        }
    }

    // Fermer les menus en cliquant en dehors
    document.addEventListener('click', function(e) {
        // Fermer dropdowns nav
        if (!e.target.closest('.nav-dropdown-wrapper')) {
            document.querySelectorAll('.nav-dropdown-menu').forEach(m => m.style.display = 'none');
        }
        // Fermer dropdown langue
        const langSwitcher = document.getElementById('langSwitcher');
        if (langSwitcher && !langSwitcher.contains(e.target)) {
            const dropdown = document.getElementById('langDropdown');
            if (dropdown) dropdown.classList.remove('open');
            const btn = document.getElementById('langBtn');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        }
    });
</script>