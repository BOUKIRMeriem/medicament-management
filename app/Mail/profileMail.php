<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class profileMail extends Mailable
{
    use Queueable, SerializesModels;

    private $login;
    private $email;

    /**
     * Create a new message instance.
     */
    public function __construct($login,$email)
    {
        $this->login = $login;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Profile confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
   
        return new Content(
            view: 'emails.inscription',
            with:[
                'login'=> $this->login,
                'email'=>$this->email
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