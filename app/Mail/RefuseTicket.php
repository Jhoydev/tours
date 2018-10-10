<?php

namespace App\Mail;

use App\Customer;
use App\OrderDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefuseTicket extends Mailable
{
    use Queueable, SerializesModels;
    public $orderDetail,$customer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OrderDetail $detail,Customer $customer)
    {
        $this->orderDetail = $detail;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.refuse_ticket')
            ->with([
                'email_to' => $this->to[0]['address']
            ]);
    }
}
