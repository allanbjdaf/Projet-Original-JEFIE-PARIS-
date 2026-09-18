<?php

namespace App\Mail;

use App\Models\Inscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class BadgeInscription extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Inscription $inscription
    ) {}

    public function envelope(): Envelope
    {
        $sujet = $this->inscription->type_inscription === 'entreprise'
            ? "✅ Compte entreprise créé — Forum JEFIE Paris 2026 #{$this->inscription->numero_badge}"
            : "✅ Votre inscription est confirmée — Forum JEFIE Paris 2026 #{$this->inscription->numero_badge}";

        return new Envelope(
            from: new Address(
                config('mail.from.address', 'contact@jefieparis2026.fr'),
                config('mail.from.name',    'Forum JEFIE Paris 2026')
            ),
            replyTo: [
                new Address('contact@jefieparis2026.fr', 'Forum JEFIE Paris 2026'),
            ],
            subject: $sujet,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.badge-inscription',
            with: [
                'inscription' => $this->inscription,
                'qrUrl'       => $this->inscription->qr_image_url,
                'numeroBadge' => $this->inscription->numero_badge,
                'nomComplet'  => trim($this->inscription->prenom . ' ' . $this->inscription->nom),
                'isEntreprise' => $this->inscription->type_inscription === 'entreprise',
            ],
        );
    }
}
