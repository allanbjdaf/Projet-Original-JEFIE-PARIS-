{{-- resources/views/emploi/candidatures.blade.php --}}
@extends('layouts.app')
@section('title', 'Mes Candidatures — Espace Emploi JEFIE')

@section('styles')
@vite(['resources/css/app.css'])
<link rel="stylesheet" href="{{ asset('css/emploi.css') }}">
<style>
    /* Styles inline si pas de fichier CSS séparé */
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
</style>
@endsection

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

{{-- ── LAYOUT ── --}}
<div class="emploi-layout">
    @include('emploi.partials.sidebar', ['active' => 'candidatures'])

    <main class="emploi-main">
        {{-- Header --}}
        <div class="page-header">
            <div>
                <div class="page-title">Mes Candidatures</div>
                <div class="page-subtitle">Suivez l'état de toutes vos candidatures en temps réel</div>
            </div>
            <button class="btn-or" onclick="openPanel('panel-candidature')">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Nouvelle candidature
            </button>
        </div>

        @if (session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Stats --}}
        <div class="stats-mini">
            @foreach ([
            [$stats['total']??0, 'Total', '#0f284e','#eef2ff','
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />'],
            [$stats['en_attente']??0, 'En attente', '#b07d10','#fff8e6','
            <path d="M12 22v-6M12 8V2M4.93 4.93l4.24 4.24M14.83 14.83l4.24 4.24M2 12h6M16 12h6M4.93 19.07l4.24-4.24M14.83 9.17l4.24-4.24" />'],
            [$stats['acceptees']??0, 'Acceptées', '#2e7d32','#e8f5e9','
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
            <polyline points="22 4 12 14.01 9 11.01" />'],
            [$stats['refusees']??0, 'Refusées', '#c2185b','#fce4ec','
            <circle cx="12" cy="12" r="10" />
            <line x1="15" y1="9" x2="9" y2="15" />
            <line x1="9" y1="9" x2="15" y2="15" />'],
            ] as [$n,$l,$c,$bg,$ic])
            <div class="stat-mini">
                <div class="stat-mini-icon" style="background:{{ $bg }};color:{{ $c }}">
                    <svg viewBox="0 0 24 24" stroke="{{ $c }}" fill="none" stroke-width="1.7">{!! $ic !!}</svg>
                </div>
                <div>
                    <span class="stat-mini-num" style="color:{{ $c }}">{{ $n }}</span>
                    <div class="stat-mini-lbl">{{ $l }}</div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Table candidatures --}}
        <div class="card">
            <span class="card-title">Toutes mes candidatures</span>
            @if (isset($candidatures) && $candidatures->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Poste ciblé</th>
                            <th>Entreprise</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>CV</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidatures as $c)
                        <tr>
                            <td><strong>{{ $c->poste_cible }}</strong></td>
                            <td style="color:#718096">{{ $c->offreEmploi->entreprise ?? '—' }}</td>
                            <td style="color:#a0aec0;font-size:12px">{{ $c->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="statut-badge {{ match($c->statut) { 'en_attente'=>'s-attente','en_cours'=>'s-cours','accepte'=>'s-accept','refuse'=>'s-refuse',default=>'s-attente' } }}">
                                    {{ match($c->statut) { 'en_attente'=>'En attente','en_cours'=>'En cours','accepte'=>'Acceptée','refuse'=>'Refusée',default=>$c->statut } }}
                                </span>
                            </td>
                            <td>
                                @if ($c->cv_path)
                                <span style="color:#2e7d32;font-size:11px;font-weight:700">✓ Joint</span>
                                @else
                                <span style="color:#a0aec0;font-size:11px">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('emploi.candidature.show', $c->id) }}" class="btn-sm btn-sm-view">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        Voir
                                    </a>
                                    <form action="{{ route('emploi.candidature.destroy', $c->id) }}" method="POST"
                                        onsubmit="return confirm('Supprimer cette candidature ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-sm btn-sm-del">
                                            <svg viewBox="0 0 24 24">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top:1rem">{{ $candidatures->links() }}</div>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <h3>Aucune candidature</h3>
                <p>Vous n'avez pas encore postulé à une offre. Explorez les offres disponibles et postulez en quelques clics.</p>
                <div style="display:flex;gap:10px;justify-content:center">
                    <a href="{{ route('emploi') }}" class="btn-primary">Voir les offres</a>
                    <button class="btn-or" onclick="openPanel('panel-candidature')">Candidature spontanée</button>
                </div>
            </div>
            @endif
        </div>
    </main>
</div>


{{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}

@include('components.footer')



{{-- Modales --}}
@include('emploi.partials.modals')
@endsection