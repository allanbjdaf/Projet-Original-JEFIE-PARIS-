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

@include('components.footer')


    @include('emploi.partials.modals')
    @endsection