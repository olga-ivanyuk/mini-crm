<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCompanyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private $company)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Company Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.new-company',
            with: [
                'company' => $this->company,
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
