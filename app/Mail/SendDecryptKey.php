<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendDecryptKey extends Mailable
{
    use Queueable, SerializesModels;

    private string $decryptKey;

    /**
     * Create a new message instance.
     */
    public function __construct(string $decryptKey)
    {
        $this->decryptKey = $decryptKey;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have new Message!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'message.decrypt',
            with: [
                'url' => route('message.read.view', ['decryptKey' => $this->decryptKey]),
                'code' => $this->decryptKey
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
