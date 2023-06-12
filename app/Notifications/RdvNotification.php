<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RdvNotification extends Notification
{
    use Queueable;

    protected $appointments;

    public function __construct($appointments)
    {
        $this->appointments = $appointments;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url('/appointments/'.$this->appointments->first()->id);

        return (new MailMessage)
            ->subject('Rappel de rendez-vous')
            ->line('Bonjour '.$notifiable->nom.',')
            ->line('Vous avez un rendez-vous demain avec le médecin '.$this->appointments->first()->medecin->nom.'.')
            ->line('Date : '.$this->appointments->first()->date)
            ->line('Heure : '.$this->appointments->first()->heure)
            ->line('Durée : '.$this->appointments->first()->duree)
            ->line('Commentaire : '.$this->appointments->first()->commentaire)
            ->line('N\'oubliez pas d\'être à l\'heure pour votre rendez-vous.')
            ->action('Voir le rendez-vous', $url)
            ->line('Salutations,')
            ->line('Votre cabinet médical');
    }
}