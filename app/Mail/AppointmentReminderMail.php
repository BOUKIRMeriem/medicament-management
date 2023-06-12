<?php

namespace App\Mail;


use App\Models\Rdv;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\AppointmentReminderMail;
use Illuminate\Support\Facades\Mail;

class AppointmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rdv;

    public function __construct(Rdv $rdv)
    {
        $this->rdv = $rdv;
    }

    public function build()
    {
        return $this
            ->subject('Rappel de rendez-vous')
            ->to('destination@example.com')
            ->cc(['cc1@example.com', 'cc2@example.com'])
            ->bcc('bcc@example.com')
            ->view('emails.appointment-reminder')
            ->with([
                'rdv' => $this->rdv,
            ]);
    }
}