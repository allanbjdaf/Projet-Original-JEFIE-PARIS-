    {{-- resources/views/emploi/rdvb2b.blade.php --}}
    @extends('layouts.app')
    @section('title', 'Mes Rendez-vous B2B' )

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
        @include('emploi.partials.sidebar', ['active' => 'rdvb2b'])
        <main class="emploi-main">
            <div class="page-header">
                <div>
                    <div class="page-title">Mes Rendez-vous B2B</div>
                    <div class="page-subtitle">Planifiez vos rencontres avec les recruteurs</div>
                </div>
                <button class="btn-or" onclick="openPanel('panel-rdvb2b')">
                    <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Nouveau RDV
                </button>
            </div>

            @if (session('success'))
            <div class="alert-success"><svg viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" />
                </svg>{{ session('success') }}</div>
            @endif

            @if ($prochains->count() > 0)
            <div class="card" style="margin-bottom:1rem">
                <div class="card-title">Prochains rendez-vous</div>
                @foreach ($prochains as $rdv)
                <div class="rdv-card">
                    <div class="rdv-date">
                        <span class="rdv-day">{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d') }}</span>
                        <span class="rdv-month">{{ \Carbon\Carbon::parse($rdv->date_heure)->translatedFormat('M') }}</span>
                    </div>
                    <div class="rdv-info">
                        <div class="rdv-title">{{ $rdv->objet }}</div>
                        <div class="rdv-sub">{{ $rdv->recruteur_id }} &bull; {{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}</div>
                    </div>
                    <span class="rdv-statut s-accept">Confirmé</span>
                </div>
                @endforeach
            </div>
            @endif

            <div class="card">
                <div class="card-title">Tous mes rendez-vous</div>
                @if ($rdvs->count() > 0)
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Objet</th>
                                <th>Recruteur</th>
                                <th>Date &amp; Heure</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rdvs as $rdv)
                            <tr>
                                <td><strong>{{ $rdv->objet }}</strong></td>
                                <td style="color:#718096">{{ $rdv->recruteur_id }}</td>
                                <td style="font-size:12px">{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y à H:i') }}</td>
                                <td>
                                    <span class="statut-badge s-{{ $rdv->statut === 'en_attente' ? 'attente' : ($rdv->statut === 'confirme' ? 'accept' : 'refuse') }}">
                                        {{ match($rdv->statut) { 'en_attente'=>'En attente','confirme'=>'Confirmé','annule'=>'Annulé', default=>$rdv->statut } }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('emploi.rdvb2b.destroy', $rdv->id) }}" method="POST" onsubmit="return confirm('Annuler ce rendez-vous ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm btn-sm-del">Annuler</button>
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
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    <p>Aucun rendez-vous planifié.</p>
                    <button class="btn-primary" onclick="openPanel('panel-rdvb2b')">Prendre un RDV B2B</button>
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