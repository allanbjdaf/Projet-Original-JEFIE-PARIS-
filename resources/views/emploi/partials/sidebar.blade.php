{{-- resources/views/emploi/partials/sidebar.blade.php --}}
<aside class="emploi-sidebar">
    <div class="es-header">
        <div class="es-logo">
            <svg width="16" height="16" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" />
                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
            </svg>
            <span>Espace Emploi</span>
        </div>
    </div>

    <a href="{{ route('emploi') }}" class="es-item {{ $active==='offres'?'active':'' }}">
        <svg viewBox="0 0 24 24">
            <rect x="2" y="7" width="20" height="14" rx="2" />
            <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
        </svg>
        Offres d'emploi
    </a>
    <a href="{{ route('emploi.candidatures') }}" class="es-item {{ $active==='candidatures'?'active':'' }}">
        <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
            <circle cx="12" cy="7" r="4" />
        </svg>
        Mes candidatures
    </a>
    <a href="{{ route('emploi.rdvb2b') }}" class="es-item {{ $active==='rdvb2b'?'active':'' }}">
        <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <path d="M16 2v4M8 2v4M3 10h18" />
        </svg>
        Rendez-vous B2B
    </a>
    <a href="{{ route('emploi.alertes') }}" class="es-item {{ $active==='alertes'?'active':'' }}">
        <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
        </svg>
        Mes alertes
    </a>
    <a href="{{ route('emploi.documents') }}" class="es-item {{ $active==='documents'?'active':'' }}">
        <svg viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
            <polyline points="14 2 14 8 20 8" />
        </svg>
        Mes documents
    </a>
    <a href="{{ route('emploi.profil') }}" class="es-item {{ $active==='profil'?'active':'' }}">
        <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
            <circle cx="12" cy="7" r="4" />
        </svg>
        Mon profil
    </a>

    <div class="es-recruteur">
        <div class="es-recruteur-icon">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>
        </div>
        <div class="es-recruteur-title">Vous êtes recruteur ?</div>
        <p class="es-recruteur-desc">Publiez vos offres et trouvez les meilleurs talents.</p>
        <a href="{{ route('emploi') }}" class="es-recruteur-btn">Accéder à mon espace recruteur</a>
    </div>
</aside>