@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: sans-serif;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h1 style="color: #0f284e; margin: 0;">Mes Offres d'Emploi</h1>
            <p style="color: #666; margin: 5px 0 0 0;">Suivez et modifiez vos publications</p>
        </div>
        <a href="{{ route('recruteur.offres.creer') }}" style="background: #0f284e; color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
            ➕ Nouvelle Offre
        </a>
    </div>

    {{-- Filtres de statut --}}
    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center;">
        <span style="font-weight: bold; color: #555;">Filtrer par :</span>
        <a href="{{ route('recruteur.offres') }}" style="text-decoration: none; color: {{ !request('statut') ? '#0f284e; font-weight: bold;' : '#666' }}">Toutes</a>
        <a href="{{ route('recruteur.offres', ['statut' => 'active']) }}" style="text-decoration: none; color: {{ request('statut') == 'active' ? '#2ecc71; font-weight: bold;' : '#666' }}">Actives</a>
        <a href="{{ route('recruteur.offres', ['statut' => 'inactive']) }}" style="text-decoration: none; color: {{ request('statut') == 'inactive' ? '#e74c3c; font-weight: bold;' : '#666' }}">Inactives</a>
    </div>

    {{-- Tableau des offres --}}
    <div style="background: #fff; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #0f284e; color: #fff;">
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
                            background: {{ $o->statut === 'active' ? '#e8f5e9; color: #2e7d32;' : ($o->statut === 'pourvue' ? '#e3f2fd; color: #0f284e;' : '#ffebee; color: #c62828;') }}">
                            {{ ucfirst($o->statut) }}
                        </span>
                    </td>
                    <td style="padding: 15px; font-weight: bold; color: #0f284e;">
                        {{ $o->candidatures_count }} reçue(s)
                    </td>
                    <td style="padding: 15px; text-align: right;">
                        <a href="{{ route('recruteur.offres.edit', $o->id) }}" style="color: #0f284e; text-decoration: none; margin-right: 15px; font-size: 14px;">Modifier</a>
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

@include('components.footer')

@endsection