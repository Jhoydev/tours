<?php

namespace App\Mail;

use App\Date;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DateNotification extends Mailable
{
    use Queueable, SerializesModels;
    public  $date;
    public  $notificationType;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Date $date,$notificationType)
    {
        $this->date = $date;
        $this->notificationType = $notificationType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->notificationType == "request"){
            return $this->view('emails.date.request');
        }
        return $this->view('emails.date_notification');
    }
}
