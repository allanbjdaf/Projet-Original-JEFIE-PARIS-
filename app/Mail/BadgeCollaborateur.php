<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class BadgeCollaborateur extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $collab
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address', 'contact@jefieparis2026.fr'),
                config('mail.from.name',    'Forum JEFIE Paris 2026')
            ),
            replyTo: [
                new Address('contact@jefieparis2026.fr', 'Forum JEFIE Paris 2026'),
            ],
            subject: "💼 Votre badge collaborateur — Forum JEFIE Paris 2026 #{$this->collab->numero_badge}",
        );
    }

    public function content(): Content
    {
        $nomComplet = trim($this->collab->prenom . ' ' . $this->collab->nom);
        $qrUrl = "https://qrserver.com" . urlencode("JEFIE2026-COLLAB:{$this->collab->numero_badge}-{$nomComplet}");

        return new Content(
            view: 'email.badge-collaborateur',
            with: [
                'collab'      => $this->collab,
                'nomComplet'  => $nomComplet,
                'numeroBadge' => $this->collab->numero_badge,
                // Utilisation de la colonne exacte entreprise_nom vue dans votre phpMyAdmin
                'entreprise'  => $this->collab->inscription->entreprise_nom ?? 'Votre Entreprise',
                'qrUrl'       => $qrUrl,
            ],
        );
    }
}
