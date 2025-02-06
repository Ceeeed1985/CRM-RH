<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdminAfterRegistrationNotification extends Notification
{
    use Queueable;

    public $code;
    public $email;
    
    public function __construct($codeToSend, $sendToEmail)
    {
        $this->code = $codeToSend;
        $this->email = $sendToEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Création du compte administrateur')
                    ->line('Bonjour,')
                    ->line('Votre compte a été créé avec succès sur la plateforme de gestion des salaires.')
                    ->line('Saisissez le code ' .$this->code. ' et renseignez-le dans le formulaire qui apparaitra.')
                    ->line('Cliquez sur le bouton ci-dessous pour confirmer votre compte :')
                    ->action('Cliquez ici', url('/validate-account' .'/'. $this->email))
                    ->line('Merci pour votre confiance dans notre application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
