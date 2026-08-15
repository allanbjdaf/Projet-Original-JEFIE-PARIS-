{{-- resources/views/emploi/alertes.blade.php --}}
@extends('layouts.app')
@section('title', 'Mes Alertes Emploi')

@section('content')

@include('components.navbar')


{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">


        </div>

</section>

<div class="emploi-layout">
    @include('emploi.partials.sidebar', ['active' => 'alertes'])
    <main class="emploi-main">
        <div class="page-header">
            <div>
                <div class="page-title">Mes Alertes Emploi</div>
                <div class="page-subtitle">Soyez notifié dès qu'une offre correspond à votre profil</div>
            </div>
            <button class="btn-or" onclick="openPanel('panel-alerte')">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Créer une alerte
            </button>
        </div>

        @if (session('success'))
        <div class="alert-success"><svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-title">Mes alertes actives</div>
            @if ($alertes->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Mots-clés</th>
                            <th>Secteur</th>
                            <th>Lieu</th>
                            <th>Fréquence</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alertes as $a)
                        <tr>
                            <td><strong>{{ $a->mots_cles }}</strong><br><span style="font-size:11px;color:#a0aec0">{{ $a->type_contrat ?? 'Tous types' }}</span></td>
                            <td style="color:#718096">{{ $a->secteur ?? 'Tous' }}</td>
                            <td style="color:#718096">{{ $a->lieu ?? 'Partout' }}</td>
                            <td>
                                <span class="statut-badge s-cours">
                                    {{ match($a->frequence) { 'instantanee'=>'Instantanée','quotidienne'=>'Quotidienne','hebdomadaire'=>'Hebdomadaire', default=>$a->frequence } }}
                                </span>
                            </td>
                            <td>
                                <label class="toggle-switch">
                                    <form action="{{ route('emploi.alerte.toggle', $a->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="checkbox" onchange="this.form.submit()" {{ $a->active ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </form>
                                </label>
                            </td>
                            <td>
                                <form action="{{ route('emploi.alerte.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Supprimer cette alerte ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm btn-sm-del">
                                        <svg viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />
                </svg>
                <p>Aucune alerte créée. Créez une alerte pour être notifié des nouvelles offres.</p>
                <button class="btn-primary" onclick="openPanel('panel-alerte')">Créer ma première alerte</button>
            </div>
            @endif
        </div>
    </main>
</div>


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


@include('emploi.partials.modals')
@endsection