<?php

namespace App\Mail;

use App\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MeetingNotification extends Mailable
{
    use Queueable, SerializesModels;
    public  $meeting;
    public  $notificationType;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Meeting $meeting,$notificationType)
    {
        $this->meeting = $meeting;
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
            return $this->view('emails.meeting.request');
        }
        return $this->view('emails.meeting_notification');
    }
}
