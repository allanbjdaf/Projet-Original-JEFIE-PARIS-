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

@include('components.footer')


@include('emploi.partials.modals')
@endsection