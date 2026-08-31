{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.master')
@section('title','Tableau de bord')
@section('page-title','Tableau de bord')

@section('admin-content')

{{-- ── STATS PRINCIPALES ── --}}
<div class="stats-row">
    @foreach ([
    [($counts['inscriptions']??0), 'Inscriptions', '#2e7d32','#e8f5e9','
    <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
    <circle cx="12" cy="7" r="4" />
    <line x1="19" y1="8" x2="19" y2="14" />
    <line x1="22" y1="11" x2="16" y2="11" />',($counts['inscriptions_new']??0)],
    [($counts['candidatures']??0), 'Candidatures', '#0f284e','#e3f2fd','
    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
    <polyline points="14 2 14 8 20 8" />',($counts['candidatures_new']??0)],
    [($counts['contacts']??0), 'Messages Contact', '#6a1b9a','#ede7f6','
    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
    <polyline points="22,6 12,13 2,6" />',($counts['contacts_new']??0)],
    [($counts['partenariats']??0), 'Partenariats', '#b07d10','#fff8e6','
    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />',0],
    [($counts['newsletter']??0), 'Abonnés Newsletter', '#00838f','#e0f7fa','
    <rect x="2" y="4" width="20" height="16" rx="2" />
    <path d="M2 7l10 7 10-7" />',0],
    ] as [$n,$l,$c,$bg,$ic,$new])
    <div class="stat-card">
        <div class="stat-icon" style="background:{{ $bg }};color:{{ $c }}">
            <svg viewBox="0 0 24 24" stroke="{{ $c }}" fill="none" stroke-width="1.7">{!! $ic !!}</svg>
        </div>
        <div>
            <span class="stat-num">{{ number_format($n) }}</span>
            <div class="stat-lbl">{{ $l }}</div>
            @if ($new > 0)
            <div class="stat-evol evol-up">
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" fill="none" stroke-width="2.5">
                    <polyline points="18 15 12 9 6 15" />
                </svg>
                +{{ $new }} aujourd'hui
            </div>
            @endif
        </div>
        @if ($new > 0)<div class="stat-new">+{{ $new }}</div>@endif
    </div>
    @endforeach
</div>

{{-- ── GRID PRINCIPAL ── --}}
<div class="grid2" style="margin-bottom:1.25rem">

    {{-- Inscriptions récentes --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Dernières Inscriptions</div>
            <a href="{{ route('admin.inscriptions') }}" class="btn-sm bsv">Voir tout <svg viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg></a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Participant</th>
                        <th>Pass</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dernieresInscriptions ?? [] as $ins)
                    <tr>
                        <td>
                            <div class="td-name">{{ $ins->nom_complet ?? '—' }}</div>
                            <div class="td-email">{{ $ins->email ?? '' }}</div>
                        </td>
                        <td><span class="badge b-{{ $ins->type_pass ?? 'gratuit' }}">{{ ucfirst($ins->type_pass ?? '—') }}</span></td>
                        <td><span class="badge b-{{ $ins->statut ?? 'en_attente' }}">{{ ucfirst(str_replace('_',' ',$ins->statut ?? '')) }}</span></td>
                        <td class="td-date">{{ $ins->created_at?->format('d/m H:i') ?? '—' }}</td>
                    </tr>
                    @empty
                    @foreach ([
                    ['Jean Kouadio','jean@email.com','standard','confirme','Il y a 2h'],
                    ['Marie Nguema','marie@email.com','premium','confirme','Il y a 5h'],
                    ['Stéphane Obame','obame@email.com','gratuit','confirme','Il y a 1j'],
                    ['Laura Biyoghe','laura@email.com','standard','en_attente_paiement','Il y a 1j'],
                    ['Hervé Ndong','herve@email.com','premium','confirme','Il y a 2j'],
                    ] as [$n,$e,$p,$s,$d])
                    <tr>
                        <td>
                            <div class="td-name">{{ $n }}</div>
                            <div class="td-email">{{ $e }}</div>
                        </td>
                        <td><span class="badge b-{{ $p }}">{{ ucfirst($p) }}</span></td>
                        <td><span class="badge b-{{ $s }}">{{ ucfirst(str_replace('_',' ',$s)) }}</span></td>
                        <td class="td-date">{{ $d }}</td>
                    </tr>
                    @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Candidatures récentes --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Dernières Candidatures</div>
            <a href="{{ route('admin.candidatures') }}" class="btn-sm bsv">Voir tout <svg viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg></a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Candidat</th>
                        <th>Poste</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dernieresCandidatures ?? [] as $c)
                    <tr>
                        <td>
                            <div class="td-name">{{ $c->nom_complet ?? '—' }}</div>
                            <div class="td-email">{{ $c->email ?? '' }}</div>
                        </td>
                        <td style="max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $c->poste_cible ?? '—' }}</td>
                        <td><span class="badge b-{{ $c->statut ?? 'en_attente' }}">{{ ucfirst(str_replace('_',' ',$c->statut ?? '')) }}</span></td>
                        <td class="td-date">{{ $c->created_at?->format('d/m H:i') ?? '—' }}</td>
                    </tr>
                    @empty
                    @foreach ([
                    ['David Mba','david@email.com','Développeur Full Stack','en_attente','Il y a 3h'],
                    ['Aminata Diallo','aminata@email.com','Data Scientist','en_cours','Il y a 6h'],
                    ['Paul Essono','paul@email.com','Chef de Projet Digital','accepte','Il y a 1j'],
                    ['Rose Moukala','rose@email.com','Analyste Financier','en_attente','Il y a 1j'],
                    ] as [$n,$e,$p,$s,$d])
                    <tr>
                        <td>
                            <div class="td-name">{{ $n }}</div>
                            <div class="td-email">{{ $e }}</div>
                        </td>
                        <td style="font-size:11px;max-width:130px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $p }}</td>
                        <td><span class="badge b-{{ $s }}">{{ ucfirst(str_replace('_',' ',$s)) }}</span></td>
                        <td class="td-date">{{ $d }}</td>
                    </tr>
                    @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ── GRID SECONDAIRE ── --}}
<div class="grid3">

    {{-- Messages non lus --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Messages Contact</div>
            <a href="{{ route('admin.contacts') }}" class="btn-sm bsv">Voir tout</a>
        </div>
        <div class="timeline">
            @foreach ([
            ['Amadou Koné','Demande de partenariat institutionnel','Il y a 1h','#0f284e','#e3f2fd',false],
            ['Mireille Ondo','Question sur les inscriptions VIP','Il y a 3h','#2e7d32','#e8f5e9',true],
            ['Pierre Mouity','Renseignements accréditation presse','Il y a 5h','#b07d10','#fff8e6',false],
            ['Sophie Nzeng','Intervention comme speaker','Il y a 1j','#6a1b9a','#ede7f6',true],
            ] as [$nom,$sujet,$temps,$c,$bg,$lu])
            <div class="tl-item">
                <div class="av" style="background:{{ $bg }};color:{{ $c }}">{{ strtoupper(substr($nom,0,1)) }}</div>
                <div class="tl-content">
                    <div class="tl-label">{{ $nom }} @if(!$lu)<span class="badge b-non-lu" style="margin-left:4px;font-size:9px;padding:1px 5px">Nouveau</span>@endif</div>
                    <div class="tl-sub" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:160px">{{ $sujet }}</div>
                </div>
                <div class="tl-time">{{ $temps }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Newsletter --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Newsletter</div>
            <a href="{{ route('admin.newsletter') }}" class="btn-sm bsv">Gérer</a>
        </div>
        <div style="padding:1.1rem">
            <div style="text-align:center;margin-bottom:1rem">
                <div style="font-size:2rem;font-weight:900;color:#0f284e">{{ number_format($counts['newsletter'] ?? 2847) }}</div>
                <div style="font-size:11px;color:#718096">abonnés actifs</div>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px">
                @foreach ([['Abonnés actifs',($counts['newsletter']??2847),'#2e7d32','#e8f5e9'],['Désinscrits',142,'#e53935','#fce4ec'],['En attente validation',23,'#b07d10','#fff8e6']] as [$l,$n,$c,$bg])
                <div style="display:flex;align-items:center;justify-content:space-between;padding:6px 10px;background:{{ $bg }};border-radius:6px">
                    <span style="font-size:12px;font-weight:600;color:{{ $c }}">{{ $l }}</span>
                    <span style="font-size:13px;font-weight:900;color:{{ $c }}">{{ number_format($n) }}</span>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.export.download', ['type'=>'newsletter']) }}" class="btn-sm bsv" style="width:100%;justify-content:center;margin-top:.85rem">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                </svg>
                Exporter la liste
            </a>
        </div>
    </div>

    {{-- Activité rapide --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Accès Rapides</div>
        </div>
        <div style="padding:1rem;display:flex;flex-direction:column;gap:8px">
            @foreach ([
            [route('admin.export.download',['type'=>'inscriptions']),'Exporter inscriptions CSV','#2e7d32','#e8f5e9','
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
            <polyline points="7 10 12 15 17 10" />'],
            [route('admin.export.download',['type'=>'candidatures']),'Exporter candidatures CSV','#0f284e','#e3f2fd','
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />'],
            [route('admin.export.download',['type'=>'newsletter']),'Exporter newsletter CSV','#00838f','#e0f7fa','
            <rect x="2" y="4" width="20" height="16" rx="2" />'],
            [route('admin.export.download',['type'=>'contacts']),'Exporter contacts CSV','#6a1b9a','#ede7f6','
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />'],
            [route('admin.export.download',['type'=>'utilisateurs']),'Exporter utilisateurs CSV','#b07d10','#fff8e6','
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
            <circle cx="9" cy="7" r="4" />'],
            ] as [$url,$lbl,$c,$bg,$ic])
            <a href="{{ $url }}" style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:{{ $bg }};border-radius:8px;text-decoration:none;transition:opacity .2s" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                <div style="width:32px;height:32px;background:#fff;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg viewBox="0 0 24 24" width="15" height="15" stroke="{{ $c }}" fill="none" stroke-width="1.8">{!! $ic !!}</svg>
                </div>
                <span style="font-size:12px;font-weight:700;color:{{ $c }}">{{ $lbl }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection