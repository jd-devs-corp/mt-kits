<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReabonnementConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reabonnement;

    public function __construct($reabonnement)
    {
        $this->reabonnement = $reabonnement;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reabonnement Confirmed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'view.reabonnement_confirmed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            'kitNumber' => $this->reabonnement->kit->unpay_kit->kit_number,
            'startDate' => $this->reabonnement->date_abonnement,
            'endDate' => $this->reabonnement->date_fin_abonnement
        ];
    }
}
