{{-- resources/views/emploi/profil.blade.php --}}
@extends('layouts.app')
@section('title', 'Mon Profil Candidat' )

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
    @include('emploi.partials.sidebar', ['active' => 'profil'])
    <main class="emploi-main">
        <div class="page-header">
            <div>
                <div class="page-title">Mon Profil</div>
                <div class="page-subtitle">Complétez votre profil pour attirer les recruteurs</div>
            </div>
        </div>

        @if (session('success'))
        <div class="alert-success"><svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>{{ session('success') }}</div>
        @endif

        <form action="{{ route('emploi.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="card" style="margin-bottom:1rem">
                <div class="card-title">Informations personnelles</div>
                <div class="profil-avatar-wrap">
                    <div class="profil-avatar">
                        @if ($profil->photo ?? false)
                        <img src="{{ asset('storage/'.$profil->photo) }}" alt="Photo de profil">
                        @else
                        <span class="profil-avatar-init">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <div style="font-size:14px;font-weight:700;color:#0f284e;margin-bottom:4px">{{ $profil->nom_complet ?? Auth::user()->name }}</div>
                        <div style="font-size:12px;color:#718096;margin-bottom:8px">{{ $profil->titre_pro ?? 'Titre professionnel non renseigné' }}</div>
                        <label style="cursor:pointer;display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#0f284e;border:1px solid #d1d9e6;padding:6px 14px;border-radius:5px;background:#fff">
                            <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            Changer la photo
                            <input type="file" name="photo" accept="image/*" style="display:none" onchange="previewPhoto(this)">
                        </label>
                    </div>
                </div>
                <div class="form-grid">
                    <div><label class="form-label">Nom complet <span class="req">*</span></label><input type="text" name="nom_complet" class="form-control" value="{{ old('nom_complet', $profil->nom_complet ?? Auth::user()->name) }}" required></div>
                    <div><label class="form-label">Téléphone</label><input type="tel" name="telephone" class="form-control" value="{{ old('telephone', $profil->telephone ?? '') }}" placeholder="+33 6 00 00 00 00"></div>
                    <div><label class="form-label">Titre professionnel</label><input type="text" name="titre_pro" class="form-control" value="{{ old('titre_pro', $profil->titre_pro ?? '') }}" placeholder="Ex: Développeur Full Stack"></div>
                    <div><label class="form-label">Localisation</label><input type="text" name="localisation" class="form-control" value="{{ old('localisation', $profil->localisation ?? '') }}" placeholder="Paris, France"></div>
                    <div><label class="form-label">Secteur d'activité</label>
                        <select name="secteur" class="form-control">
                            <option value="">Sélectionnez...</option>
                            @foreach (['Technologies','Finance','Commerce','Santé','Éducation','Industrie','Agriculture','Services','Conseil','Énergie'] as $s)
                            <option value="{{ $s }}" {{ old('secteur',$profil->secteur??'') === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="form-label">Disponibilité</label><input type="text" name="disponibilite" class="form-control" value="{{ old('disponibilite', $profil->disponibilite ?? '') }}" placeholder="Immédiate, 1 mois..."></div>
                    <div><label class="form-label">LinkedIn</label><input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $profil->linkedin ?? '') }}" placeholder="https://linkedin.com/in/..."></div>
                    <div class="fg1"><label class="form-label">Bio / Présentation</label><textarea name="bio" class="form-control" style="min-height:100px" placeholder="Décrivez votre parcours et vos compétences...">{{ old('bio', $profil->bio ?? '') }}</textarea></div>
                </div>
            </div>
            <button type="submit" class="btn-or">
                <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                Enregistrer mon profil
            </button>
        </form>
    </main>
</div>
@push('scripts')
<script>
    function previewPhoto(input) {
        if (input.files?.[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const avatar = document.querySelector('.profil-avatar');
                avatar.innerHTML = `<img src="${e.target.result}" style="width:80px;height:80px;object-fit:cover;border-radius:50%">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ --}}

@include('components.footer')


@endpush
@endsection