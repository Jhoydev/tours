<?php

namespace App\Notifications;

use App\Customer;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateCustomer extends Notification
{
    use Queueable;
    public $customer;
    public $username;
    public $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customer,$username,$password)
    {
        $this->customer = $customer;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Se ha creado un usuario relacionado con tu email")
                    ->line("Email: {$this->username}")
                    ->line("Contraseña: {$this->password}")
                    ->action('Acceder', url('portal'))
                    ->line('Gracias por usar nuestra aplicación.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
