@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: sans-serif;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h1 style="color: #0d1b3e; margin: 0;">Mes Offres d'Emploi</h1>
            <p style="color: #666; margin: 5px 0 0 0;">Suivez et modifiez vos publications</p>
        </div>
        <a href="{{ route('recruteur.offres.creer') }}" style="background: #0d1b3e; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
            ➕ Nouvelle Offre
        </a>
    </div>

    {{-- Filtres de statut --}}
    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center;">
        <span style="font-weight: bold; color: #555;">Filtrer par :</span>
        <a href="{{ route('recruteur.offres') }}" style="text-decoration: none; color: {{ !request('statut') ? '#0d1b3e; font-weight: bold;' : '#666' }}">Toutes</a>
        <a href="{{ route('recruteur.offres', ['statut' => 'active']) }}" style="text-decoration: none; color: {{ request('statut') == 'active' ? '#2ecc71; font-weight: bold;' : '#666' }}">Actives</a>
        <a href="{{ route('recruteur.offres', ['statut' => 'inactive']) }}" style="text-decoration: none; color: {{ request('statut') == 'inactive' ? '#e74c3c; font-weight: bold;' : '#666' }}">Inactives</a>
    </div>

    {{-- Tableau des offres --}}
    <div style="background: #fff; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #0d1b3e; color: #fff;">
                    <th style="padding: 15px;">Poste / Entreprise</th>
                    <th style="padding: 15px;">Contrat & Lieu</th>
                    <th style="padding: 15px;">Statut</th>
                    <th style="padding: 15px;">Candidatures</th>
                    <th style="padding: 15px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($offres as $o)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;">
                        <strong style="color: #333; font-size: 16px;">{{ $o->titre }}</strong>
                        <div style="color: #777; font-size: 13px; margin-top: 4px;">{{ $o->entreprise }}</div>
                    </td>
                    <td style="padding: 15px;">
                        <span style="background: #e1ecf4; color: #39739d; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">{{ $o->type_contrat }}</span>
                        <div style="color: #555; font-size: 13px; margin-top: 5px;">📍 {{ $o->lieu }} ({{ $o->pays }})</div>
                    </td>
                    <td style="padding: 15px;">
                        <span style="padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; 
                            background: {{ $o->statut === 'active' ? '#e8f5e9; color: #2e7d32;' : ($o->statut === 'pourvue' ? '#e3f2fd; color: #1565c0;' : '#ffebee; color: #c62828;') }}">
                            {{ ucfirst($o->statut) }}
                        </span>
                    </td>
                    <td style="padding: 15px; font-weight: bold; color: #0d1b3e;">
                        {{ $o->candidatures_count }} reçue(s)
                    </td>
                    <td style="padding: 15px; text-align: right;">
                        <a href="{{ route('recruteur.offres.edit', $o->id) }}" style="color: #1565c0; text-decoration: none; margin-right: 15px; font-size: 14px;">Modifier</a>
                        <form action="{{ route('recruteur.offres.destroy', $o->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Supprimer cette offre définitivement ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #c62828; cursor: pointer; padding: 0; font-size: 14px;">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 30px; text-align: center; color: #999; font-style: italic;">Aucune offre trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $offres->links() }}
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