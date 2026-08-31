@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: sans-serif;">

    <div style="margin-bottom: 25px;">
        <h1 style="color: #0f284e; margin: 0;">Candidatures reçues</h1>
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
                    <td style="padding: 15px; color: #0f284e; font-weight: 500;">
                        {{ $c->offreEmploi->titre }}
                    </td>
                    <td style="padding: 15px; color: #666;">
                        {{ $c->created_at->format('d/m/Y à H:i') }}
                    </td>
                    <td style="padding: 15px;">
                        <span style="padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold;
                            @if($c->statut === 'en_attente') background: #fff3cd; color: #856404;
                            @elseif($c->statut === 'en_cours') background: #e3f2fd; color: #0f284e;
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

@include('components.footer')

@endsection