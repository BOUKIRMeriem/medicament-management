<?php

namespace App\Services;

use App\Models\Rdv;
use App\Mail\AppointmentReminderMail;
use Illuminate\Support\Facades\Mail;

class AppointmentReminderService
{
    public function sendAppointmentReminders()
    {
        // Récupérez les rendez-vous pour demain
        $rdvs = Rdv::whereDate('date', '=', date('Y-m-d', strtotime('+1 day')))
            ->with('patient')
            ->get();

        // Envoyez une notification par e-mail pour chaque rendez-vous
        foreach ($rdvs as $rdv) {
            $this->sendReminderEmail($rdv);
        }
    }

    private function sendReminderEmail($rdv)
    {
        // Envoyez l'e-mail de rappel de rendez-vous
        $patient = $rdv->patient;
        $email = $patient->email;
    
        Mail::to($email)->send(new AppointmentReminderMail($rdv));
    }
}