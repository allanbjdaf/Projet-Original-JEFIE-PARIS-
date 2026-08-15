@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: sans-serif;">

    <div style="margin-bottom: 25px;">
        <h1 style="color: #0d1b3e; margin: 0;">Candidatures reçues</h1>
        <p style="color: #666;">Traitez et changez l'état d'avancement des profils</p>
    </div>

    <div style="background: #fff; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f4f6fb; text-align: left; border-bottom: 2px solid #eee;">
                    <th style="padding: 15px;">Candidat</th>
                    <th style="padding: 15px;">Offre concernée</th>
                    <th style="padding: 15px;">Date de réception</th>
                    <th style="padding: 15px;">Statut actuel</th>
                    <th style="padding: 15px; text-align: right;">Changer le statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidatures as $c)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px; font-weight: bold; color: #333;">
                        Utilisateur #{{ $c->user_id }}
                    </td>
                    <td style="padding: 15px; color: #0d1b3e; font-weight: 500;">
                        {{ $c->offreEmploi->titre }}
                    </td>
                    <td style="padding: 15px; color: #666;">
                        {{ $c->created_at->format('d/m/Y à H:i') }}
                    </td>
                    <td style="padding: 15px;">
                        <span style="padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold;
                            @if($c->statut === 'en_attente') background: #fff3cd; color: #856404;
                            @elseif($c->statut === 'en_cours') background: #e3f2fd; color: #0d47a1;
                            @elseif($c->statut === 'accepte') background: #d4edda; color: #155724;
                            @else background: #f8d7da; color: #721c24; @endif">
                            {{ str_replace('_', ' ', ucfirst($c->statut)) }}
                        </span>
                    </td>
                    <td style="padding: 15px; text-align: right;">
                        <form action="{{ route('recruteur.candidatures.status', $c->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('PATCH')
                            <select name="statut" onchange="this.form.submit()" style="padding: 6px; border-radius: 4px; border: 1px solid #ccc; font-size: 13px; cursor: pointer;">
                                <option value="en_attente" {{ $c->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ $c->statut == 'en_cours' ? 'selected' : '' }}>En cours d'examen</option>
                                <option value="accepte" {{ $c->statut == 'accepte' ? 'selected' : '' }}>Accepté</option>
                                <option value="refuse" {{ $c->statut == 'refuse' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 30px; text-align: center; color: #999; font-style: italic;">Aucune candidature reçue pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $candidatures.links() }}
    </div>
</div>
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
                <div class="nav-logo-text" style="color:#fff"><span>Journées économiques et Forum international de</span>l’Emploi de la diaspora gabonaise<br><small>2026</small></div>
            </a>
            <p>Plateforme de référence pour l'emploi et le recrutement au Forum International de l'Innovation 2026.</p>
            <nav class="socials" aria-label="Réseaux sociaux">
                <a href="#" aria-label="Facebook">f</a><a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="Twitter">&#120143;</a><a href="#" aria-label="YouTube">&#9654;</a>
            </nav>
        </div>
        <div class="fc">
            <h4>Navigation</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="{{ route('institutionnel') }}">Institutionnel</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
        </div>
        <div class="fc">
            <h4>Espace Emploi</h4>
            <a href="{{ route('emploi') }}">Offres d'emploi</a>
            <a href="#">Déposer une candidature</a>
            <a href="#">Espace recruteur</a>
            <a href="#">Rendez-vous B2B</a>
            <a href="{{ route('Faq') }}">FAQ</a>
        </div>
        <div class="fc">
            <h4>Contact</h4>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>contact@forum-innovation.org</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
                </svg>+221 33 123 45 67</div>
            <div class="fci"><svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5a623" fill="none" stroke-width="1.8">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>Dakar, Sénégal</div>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} CDC site. Tous droits réservés.</span>
        <div class="footer-legal">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Politique de confidentialité</a>
        </div>
    </div>
</footer>

@endsection