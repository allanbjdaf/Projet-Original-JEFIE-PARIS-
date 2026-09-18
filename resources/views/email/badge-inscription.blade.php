<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Votre badge — Forum JEFIE Paris 2026</title>
</head>

<body style="margin:0;padding:0;background:#f0f2f7;font-family:'Segoe UI',Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f7;padding:2rem 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:14px;overflow:hidden;max-width:600px;width:100%;">

                    {{-- HEADER --}}
                    <tr>
                        <td style="background:#0f284e;padding:2rem;text-align:center;">
                            <div style="color:#f5c518;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px;">
                                {{ $isEntreprise ? 'Compte entreprise confirmé' : 'Inscription confirmée' }}
                            </div>
                            <div style="color:#ffffff;font-size:22px;font-weight:900;">Forum JEFIE Paris 2026</div>
                            <div style="color:rgba(255,255,255,.65);font-size:13px;margin-top:4px;">15 – 18 Septembre 2026 · Paris, France</div>
                        </td>
                    </tr>

                    {{-- CORPS --}}
                    <tr>
                        <td style="padding:2rem;">
                            <p style="font-size:15px;color:#1a2744;margin:0 0 1rem;">
                                Bonjour <strong>{{ $nomComplet }}</strong>,
                            </p>
                            <p style="font-size:14px;color:#4a5568;line-height:1.6;margin:0 0 1.5rem;">
                                @if($isEntreprise)
                                Votre compte entreprise pour le Forum JEFIE Paris 2026 a bien été créé. Voici votre badge d'accès et votre code de référence.
                                @else
                                Votre inscription au Forum JEFIE Paris 2026 est confirmée. Voici votre badge d'accès personnel, à présenter le jour de l'événement.
                                @endif
                            </p>

                            {{-- BADGE --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;margin-bottom:1.5rem;">
                                <tr>
                                    <td style="padding:1.5rem;text-align:center;">
                                        <div style="font-size:10px;font-weight:800;color:#a0aec0;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">
                                            Numéro de badge
                                        </div>
                                        <div style="font-size:20px;font-weight:900;color:#0f284e;margin-bottom:1rem;">
                                            {{ $numeroBadge }}
                                        </div>

                                        @if(!empty($qrUrl))
                                        <img src="{{ $qrUrl }}" alt="QR Code d'accès" width="180" height="180" style="display:block;margin:0 auto;border-radius:8px;border:4px solid #ffffff;box-shadow:0 2px 10px rgba(15,40,78,.1);">
                                        <div style="font-size:11px;color:#718096;margin-top:10px;">
                                            Présentez ce QR Code à l'accueil du Forum
                                        </div>
                                        @else
                                        <div style="font-size:12px;color:#a0aec0;padding:1rem;">
                                            Votre QR Code sera généré et disponible dans votre espace personnel.
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size:13px;color:#718096;line-height:1.6;margin:0 0 1.5rem;">
                                Conservez ce badge — il vous sera demandé à l'entrée du Forum. En cas de perte, vous pouvez le retrouver à tout moment dans votre espace personnel sur le site.
                            </p>

                            {{-- BOUTON --}}
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="border-radius:8px;background:#f5c518;">
                                        <a href="{{ url('/mon-espace/billet') }}" style="display:inline-block;padding:13px 28px;font-size:13px;font-weight:700;color:#0f284e;text-decoration:none;">
                                            Voir mon billet en ligne
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="padding:1.5rem 2rem;border-top:1px solid #e2e8f0;text-align:center;">
                            <p style="font-size:11px;color:#a0aec0;margin:0 0 4px;">
                                Forum JEFIE Paris 2026 — CNIT Forest La Défense, 92800 Puteaux, France
                            </p>
                            <p style="font-size:11px;color:#a0aec0;margin:0;">
                                Une question ? Écrivez-nous à
                                <a href="mailto:contact@jefieparis2026.net" style="color:#2a5aa2;">contact@jefieparis2026.net</a>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>