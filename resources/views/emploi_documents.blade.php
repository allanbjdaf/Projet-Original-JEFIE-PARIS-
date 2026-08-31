{{-- resources/views/emploi/documents.blade.php --}}
@extends('layouts.app')
@section('title', 'Mes Documents' )

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
    @include('emploi.partials.sidebar', ['active' => 'documents'])
    <main class="emploi-main">
        <div class="page-header">
            <div>
                <div class="page-title">Mes Documents</div>
                <div class="page-subtitle">Gérez votre CV, lettres et diplômes</div>
            </div>
            <button class="btn-or" onclick="openPanel('panel-documents')">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
                Télécharger un document
            </button>
        </div>

        @if (session('success'))
        <div class="alert-success"><svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-title">Mes documents enregistrés</div>
            @if ($documents->count() > 0)
            @foreach ($documents as $doc)
            <div class="doc-item">
                <div class="doc-icon" style="{{ $doc->type==='cv' ? 'background:#fce4ec;color:#c2185b' : ($doc->type==='lettre_motivation' ? 'background:#fff3e0;color:#f5c518' : 'background:#e8f5e9;color:#2e7d32') }}">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="doc-name">{{ $doc->nom_fichier }}</div>
                    <div class="doc-meta">{{ ucfirst(str_replace('_',' ',$doc->type)) }} &bull; {{ number_format($doc->taille/1024,0) }} Ko &bull; {{ $doc->created_at->format('d/m/Y') }}</div>
                </div>
                <div class="action-btns">
                    <form action="{{ route('emploi.document.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-sm-del">
                            <svg viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6" />
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                </svg>
                <p>Aucun document téléchargé. Ajoutez votre CV pour postuler rapidement.</p>
                <button class="btn-primary" onclick="openPanel('panel-documents')">Ajouter mon CV</button>
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