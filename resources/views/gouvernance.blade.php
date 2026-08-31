{{--
    Page Gouvernance
    -----------------
    Adapter le @extends ci-dessous au nom de votre layout principal
    (celui qui contient déjà le header JEFIE / le menu de navigation).
--}}
@extends('layouts.app')

@section('title', 'Gouvernance — JEFIE')

@section('content')
@include('components.navbar')

<style>
    :root {
        --jefie-navy: #0B1B3A;
        --jefie-navy-light: #16295A;
        --jefie-orange: #f5c518;
        --jefie-bg: #F7F8FA;
        --jefie-text: #17233D;
        --jefie-text-muted: #5B6478;
        --jefie-border: #E4E7EE;
    }

    .gouv-hero {
        /* Fusionne le dégradé de la maquette avec votre image locale située dans public/images/ */
        background: linear-gradient(135deg, rgba(11, 37, 69, 0.85) 0%, rgba(20, 57, 102, 0.85) 100%),
            url('../images/264.png');
        /* À remplacer par votre nom d'image */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-blend-mode: multiply;
        /* Permet d'incruster l'image sous le dégradé bleu */
        color: #fff;
        padding: 72px 24px 96px;
        text-align: center;
    }


    .gouv-hero .eyebrow {
        display: inline-block;
        background: rgba(245, 166, 35, 0.15);
        color: var(--jefie-orange);
        font-weight: 700;
        font-size: 13px;
        letter-spacing: .08em;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 999px;
        margin-bottom: 20px;
    }

    .gouv-hero h1 {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 700;
        margin: 0 0 15px;
        color: #f5c518;
    }

    .gouv-hero p {
        max-width: 640px;
        margin: 0 auto;
        color: rgba(255, 255, 255, .85);
        /* Légèrement rehaussé à .85 pour contrer l'image de fond */
        font-size: 17px;
        line-height: 1.6;
    }

    .gouv-wrap {
        max-width: 1140px;
        margin: -56px auto 0;
        padding: 0 24px 80px;
        position: relative;
        z-index: 2;
    }

    /* Filtres façon "Jour 1 / Jour 2" du programme */
    .gouv-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        background: #fff;
        border: 1px solid var(--jefie-border);
        border-radius: 16px;
        padding: 12px;
        box-shadow: 0 12px 30px rgba(11, 27, 58, .08);
        margin-bottom: 48px;
    }

    .gouv-tab {
        border: 1px solid var(--jefie-border);
        background: #fff;
        color: var(--jefie-text);
        font-weight: 700;
        font-size: 14px;
        padding: 10px 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: all .15s ease;
    }

    .gouv-tab:hover {
        border-color: var(--jefie-navy);
    }

    .gouv-tab.is-active {
        background: var(--jefie-navy);
        border-color: var(--jefie-navy);
        color: #fff;
    }

    .gouv-section {
        margin-bottom: 56px;
    }

    .gouv-section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--jefie-navy);
        margin-bottom: 24px;
    }

    .gouv-section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--jefie-border);
    }

    /* Grille optimisée pour plus de 20 membres (4 colonnes sur PC, s'ajuste seule) */
    .gouv-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    /* Carte plus compacte et épurée */
    .gouv-card {
        background: #fff;
        border: 1px solid var(--jefie-border, #eef2f5);
        border-radius: 12px;
        padding: 24px 16px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(11, 27, 58, 0.03);
        transition: transform .2s ease, box-shadow .2s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        /* Force toutes les cartes à avoir la même hauteur */
    }

    .gouv-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(11, 27, 58, 0.08);
    }

    .gouv-avatar {
        width: 84px;
        height: 84px;
        border-radius: 50%;
        margin: 0 auto 15px;
        object-fit: cover;
        background: var(--jefie-bg, #f8f9fa);
        border: 3px solid #fff;
        box-shadow: 0 0 0 3px var(--jefie-border, #eef2f5);
    }

    .gouv-name {
        font-size: 16px;
        font-weight: 700;
        color: var(--jefie-text, #212529);
        margin: 0 0 6px;
    }

    .gouv-poste {
        display: inline-block;
        background: rgba(245, 166, 35, 0.12);
        color: #B5760A;
        font-weight: 700;
        font-size: 12.5px;
        padding: 4px 12px;
        border-radius: 999px;
        margin-bottom: 14px;
    }

    .gouv-bio {
        color: var(--jefie-text-muted, #6c757d);
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 16px;
        text-align: center;
    }

    .gouv-links {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: auto;
        /* Aligne obligatoirement le bouton tout en bas de la carte */
    }

    /* Correction de la classe bouton spécifique pour LinkedIn */
    .gouv-linkedin-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #eef4fe;
        color: #0a66c2;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 6px;
        transition: background 0.2s, color 0.2s;
        border: 1px solid transparent;
    }

    .gouv-linkedin-btn:hover {
        background: #0a66c2;
        color: #ffffff;
    }

    .gouv-empty {
        text-align: center;
        color: var(--jefie-text-muted, #6c757d);
        padding: 60px 0;
    }



    /* ── FOOTER ── */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 3rem 2.5rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr 1.3fr;
        gap: 2rem;
        margin-bottom: 2.5rem;
    }

    .fb p {
        font-size: 13px;
        line-height: 1.65;
        margin: .75rem 0 1rem;
    }

    .socials {
        display: flex;
        gap: 10px;
    }

    .socials a {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
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
        margin-bottom: 1rem;
    }

    .fc a {
        display: block;
        color: rgba(255, 255, 255, .6);
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 6px;
        transition: color .2s;
    }

    .fc a:hover {
        color: #fff;
    }

    .fci {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1.25rem 0;
        text-align: center;
        font-size: 12px;
        color: rgba(255, 255, 255, .35);
    }

    @media (max-width: 1100px) {
        .main-grid {
            grid-template-columns: 1fr 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .main-grid {
            grid-template-columns: 1fr;
        }

        .contact-bar {
            flex-direction: column;
        }

        .ci {
            border-right: none;
            border-bottom: 1px solid #e2e8f0;
        }

        .fg2 {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="gouv-hero">
    <div class="gouv-hero-overlay"></div>
    <div class="gouv-hero-content">
        <h1>Notre Gouvernance</h1>
        <p>
            Découvrez les femmes et les hommes qui portent le projet JEFIE : bureau exécutif,
            comité scientifique, comité d'organisation et partenaires institutionnels réunis
            autour d'une même ambition, l'innovation au service du développement durable.
        </p>
    </div>
</section>


{{-- Section Contenu --}}
<div class="gouv-wrap" style="max-width: 1200px; margin: -25px auto 60px; padding: 0 20px; position: relative; z-index: 10;">

    {{-- Onglets de filtrage dynamique --}}
    <div class="gouv-tabs" role="tablist" aria-label="Filtrer par catégorie" style="background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.08); padding: 10px; border-radius: 50px; display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
        <button type="button" class="gouv-tab is-active" data-filter="tous">Tous</button>
        <button type="button" class="gouv-tab" data-filter="bureau">Bureau Exécutif</button>
        <button type="button" class="gouv-tab" data-filter="scientifique">Comité Scientifique</button>
        <button type="button" class="gouv-tab" data-filter="organisation">Comité d'Organisation</button>
        <button type="button" class="gouv-tab" data-filter="partenaires">Partenaires Institutionnels</button>
    </div>

    {{-- Categorie : Bureau Exécutif --}}
    <div class="gouv-section" data-category="bureau">
        <div class="gouv-section-title">Bureau Exécutif</div>
        <div class="gouv-grid">
            <div class="gouv-card">
                <img class="gouv-avatar" src="{{ asset('images/boaa.jpg') }}" alt="Photo de Pr. Alpha Oumar Barry" loading="lazy">
                <p class="gouv-name">Pr. Alpha Oumar Barry</p>
                <span class="gouv-poste">Président Exécutif — JEFIE</span>
                <p class="gouv-bio">Ancien conseiller ministériel et expert international en stratégies d'innovation technologique et de codéveloppement durable.</p>
                <div class="gouv-links">
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="gouv-linkedin-btn" aria-label="Profil LinkedIn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.8v8.37h2.8v-4.67c0-.25.02-.5.1-.68a1.14 1.14 0 0 1 1-.77c.76 0 1 .52 1 1.3v4.82zm-13.5-9.18a1.66 1.66 0 1 0 0-3.32 1.66 1.66 0 0 0 0 3.32m1.4 9.18v-8.37h-2.8v8.37z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Categorie : Comité Scientifique --}}
    <div class="gouv-section" data-category="scientifique">
        <div class="gouv-section-title">Comité Scientifique</div>
        <div class="gouv-grid">
            <div class="gouv-card">
                <img class="gouv-avatar" src="{{ asset('images/baoo.jpeg') }}" alt="Photo de Dr. Eliane de Montgolfier" loading="lazy">
                <p class="gouv-name">Dr. Eliane de Montgolfier</p>
                <span class="gouv-poste">Présidente du Comité Scientifique</span>
                <p class="gouv-bio">Directrice de recherche émérite, spécialiste des dynamiques de transition énergétique et de l'impact environnemental industriel.</p>
                <div class="gouv-links">
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="gouv-linkedin-btn" aria-label="Profil LinkedIn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.8v8.37h2.8v-4.67c0-.25.02-.5.1-.68a1.14 1.14 0 0 1 1-.77c.76 0 1 .52 1 1.3v4.82zm-13.5-9.18a1.66 1.66 0 1 0 0-3.32 1.66 1.66 0 0 0 0 3.32m1.4 9.18v-8.37h-2.8v8.37z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Categorie : Comité d'Organisation --}}
    <div class="gouv-section" data-category="organisation">
        <div class="gouv-section-title">Comité d'Organisation</div>
        <div class="gouv-grid">
            <div class="gouv-card">
                <img class="gouv-avatar" src="{{ asset('images/bao.jpg') }}" alt="Photo de Marc-Antoine Vancamp" loading="lazy">
                <p class="gouv-name">Marc-Antoine Vancamp</p>
                <span class="gouv-poste">Commissaire Général JEFIE Paris 2026</span>
                <p class="gouv-bio">Plus de 20 ans d'expérience dans l'organisation et le pilotage opérationnel de sommets internationaux et de salons B2B.</p>
                <div class="gouv-links">
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="gouv-linkedin-btn" aria-label="Profil LinkedIn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.8v8.37h2.8v-4.67c0-.25.02-.5.1-.68a1.14 1.14 0 0 1 1-.77c.76 0 1 .52 1 1.3v4.82zm-13.5-9.18a1.66 1.66 0 1 0 0-3.32 1.66 1.66 0 0 0 0 3.32m1.4 9.18v-8.37h-2.8v8.37z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>

            <div class="gouv-card">
                <img class="gouv-avatar" src="{{ asset('images/bo.jpg') }}" alt="Photo de Fatoumata Diallo-Sy" loading="lazy">
                <p class="gouv-name">Toumata Diallo-Sy</p>
                <span class="gouv-poste">Directrice des Relations Institutionnelles</span>
                <p class="gouv-bio">Supervise les partenariats stratégiques avec les ministères, les représentations diplomatiques et les agences de développement.</p>
                <div class="gouv-links">
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="gouv-linkedin-btn" aria-label="Profil LinkedIn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.8v8.37h2.8v-4.67c0-.25.02-.5.1-.68a1.14 1.14 0 0 1 1-.77c.76 0 1 .52 1 1.3v4.82zm-13.5-9.18a1.66 1.66 0 1 0 0-3.32 1.66 1.66 0 0 0 0 3.32m1.4 9.18v-8.37h-2.8v8.37z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Categorie : Partenaires Institutionnels --}}
    <div class="gouv-section" data-category="partenaires">
        <div class="gouv-section-title">Partenaires Institutionnels</div>
        <div class="gouv-grid">
            <div class="gouv-card">
                <img class="gouv-avatar" src="{{ asset('images/bao.jpg') }}" alt="Photo de Sébastien Legendre" loading="lazy">
                <p class="gouv-name">Sébastien Legendre</p>
                <span class="gouv-poste">Délégué aux Alliances Privées</span>
                <p class="gouv-bio">Responsable du consortium des grands groupes industriels et des fonds d'investissement engagés pour la finance durable.</p>
                <div class="gouv-links">
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="gouv-linkedin-btn" aria-label="Profil LinkedIn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.8v8.37h2.8v-4.67c0-.25.02-.5.1-.68a1.14 1.14 0 0 1 1-.77c.76 0 1 .52 1 1.3v4.82zm-13.5-9.18a1.66 1.66 0 1 0 0-3.32 1.66 1.66 0 0 0 0 3.32m1.4 9.18v-8.37h-2.8v8.37z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tabs = document.querySelectorAll('.gouv-tab');
        var sections = document.querySelectorAll('.gouv-section');

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                // Nettoyage des classes actives
                tabs.forEach(function(t) {
                    t.classList.remove('is-active');
                });
                tab.classList.add('is-active');

                var filter = tab.getAttribute('data-filter');
                sections.forEach(function(section) {
                    // Si 'tous', afficher toutes les sections. Sinon filtrer par attribut data-category
                    if (filter === 'tous' || section.getAttribute('data-category') === filter) {
                        section.style.display = '';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });
    });
</script>


{{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}

@include('components.footer')

@endsection