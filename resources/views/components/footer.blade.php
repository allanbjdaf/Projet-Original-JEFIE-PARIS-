{{-- ══════════════════════════════════════════════════════
     Composant Footer — identique au footer de la page Programme
     Utilisation : @include('components.footer')
     ══════════════════════════════════════════════════════ --}}

<style>
    /* ── FOOTER STYLES ── */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2.5rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr 1.2fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-brand p {
        font-size: 12px;
        line-height: 1.6;
        margin: .5rem 0 .75rem;
    }

    .footer-socials {
        display: flex;
        gap: 8px;
    }

    .footer-socials a {
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

    .footer-socials a:hover {
        background: rgba(255, 255, 255, .2);
    }

    .footer-col h4 {
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .75rem;
    }

    .footer-col a {
        display: block;
        color: rgba(255, 255, 255, .6);
        text-decoration: none;
        font-size: 12px;
        margin-bottom: 5px;
        transition: color .2s;
    }

    .footer-col a:hover {
        color: #fff;
    }

    .footer-info-row {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        font-size: 12px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, .7);
    }

    .footer-info-row svg {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .footer-nl-form {
        display: flex;
        gap: 6px;
        margin-top: 8px;
    }

    .footer-nl-form input {
        flex: 1;
        padding: 9px 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 5px;
        background: rgba(255, 255, 255, .07);
        color: #fff;
        font-size: 12px;
        outline: none;
    }

    .footer-nl-form input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .footer-nl-form button {
        background: #f5c518;
        border: none;
        border-radius: 5px;
        width: 38px;
        height: 38px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: opacity .2s;
    }

    .footer-nl-form button:hover {
        opacity: .9;
    }

    .footer-nl-form button svg {
        width: 15px;
        height: 15px;
        stroke: #0f284e;
        fill: none;
        stroke-width: 2;
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

    @media (max-width: 1100px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .site-footer {
            padding: 2rem 1.25rem 0;
        }
    }
</style>

{{-- ══ FOOTER HTML ══ --}}
<footer class="site-footer">
    <div class="footer-grid">

        {{-- Colonne 1 : Logo + description + réseaux --}}
        <div class="footer-brand">
            <a href="{{ route('index') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:.4rem">
                <img src="{{ asset('images/264.png') }}"
                    alt="Logo JEFIE Paris 2026"
                    style="height:55px;width:auto;display:block;border:none;background:transparent;">
                <div style="color:#fff;font-size:9px;font-weight:700;text-transform:uppercase;line-height:1.4">
                    <span style="color:#f5c518;display:block;font-size:11px;font-weight:800">Journées économiques et Forum international</span>
                    de l'emploi de la diaspora Gabonaise<br>
                    <small style="font-size:10px">2026</small>
                </div>
            </a>
            <p>Le rendez-vous mondial des décideurs, innovateurs et entrepreneurs engagés pour un avenir durable.</p>
            <nav class="footer-socials" aria-label="Réseaux sociaux">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="Twitter">&#120143;</a>
                <a href="#" aria-label="LinkedIn">in</a>
                <a href="#" aria-label="YouTube">&#9654;</a>
                <a href="#" aria-label="Instagram">&#9752;</a>
            </nav>
        </div>

        {{-- Colonne 2 : Liens rapides --}}
        <div class="footer-col">
            <h4>Liens Rapides</h4>
            <a href="{{ route('index') }}">Accueil</a>
            <a href="{{ route('programme') }}">Programme</a>
            <a href="#">Intervenants</a>
            <a href="{{ route('partenaires') }}">Partenaires</a>
            <a href="{{ route('actualites') }}">Actualités</a>
        </div>

        {{-- Colonne 3 : Participer --}}
        <div class="footer-col">
            <h4>Participer</h4>
            <a href="{{ route('inscription') }}">S'inscrire</a>
            <a href="{{ route('partenaires.devenir') }}">Devenir partenaire</a>
            <a href="#">Soumettre un pitch</a>
            <a href="#">Planifier un RDV B2B</a>
            <a href="#">Informations pratiques</a>
            <a href="{{ route('Faq') }}">FAQ</a>
        </div>

        {{-- Colonne 4 : Informations pratiques --}}
        <div class="footer-col">
            <h4>Informations</h4>
            <div class="footer-info-row">
                <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                15 – 18 Septembre 2026
            </div>
            <div class="footer-info-row">
                <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="1.8">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                Palais des Congrès<br>Paris, France
            </div>
            <div class="footer-info-row">
                <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="1.8">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>
                contact@forum-innovation.org
            </div>
            <div class="footer-info-row">
                <svg width="13" height="13" viewBox="0 0 24 24" stroke="#f5c518" fill="none" stroke-width="1.8">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .18h3a2 2 0 012 1.72 12 12 0 00.74 2.9A2 2 0 017.21 7l-1.27 1.27a16 16 0 006.79 6.79L14 13.79a2 2 0 012.18-.45c.93.35 1.9.61 2.9.74A2 2 0 0122 16.92z" />
                </svg>
                +33 1 00 00 00 00
            </div>
        </div>

        {{-- Colonne 5 : Newsletter --}}
        <div class="footer-col">
            <h4>Recevez nos Actualités</h4>
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <div class="footer-nl-form">
                    <input type="email" name="email_newsletter" placeholder="Votre email" required>
                    <button type="submit" aria-label="S'abonner">
                        <svg viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" fill="#0f284e" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

    </div>{{-- /.footer-grid --}}

    <div class="footer-bottom">
        <span class="footer-copy">&copy; {{ date('Y') }} CDC site by BJ . Tous droits réservés.</span>
        <div class="footer-legal">
            <a href="{{ route('mentions-legales') }}">Mentions légales</a>
            <a href="{{ route('confidentialite') }}">Confidentialité</a>
            <a href="#">CGU</a>
        </div>
    </div>
</footer>