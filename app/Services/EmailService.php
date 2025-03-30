<?php

namespace App\Services;

use App\Interfaces\Services\EmailServiceInterface;
use App\Mail\TicketAcknowledgement;
use App\Mail\TicketReplyNotification;
use Illuminate\Support\Facades\Mail;

class EmailService implements EmailServiceInterface
{
    /**
     * sendTicketAcknowledgement
     *
     * @param  mixed $data
     * @return void
     */
    public function sendTicketAcknowledgement(array $data)
    {
        Mail::to($data['email'])->send(new TicketAcknowledgement($data));
    }

    /**
     * sendTicketReplyNotification
     *
     * @param  mixed $data
     * @return void
     */
    public function sendTicketReplyNotification(array $data)
    {
        Mail::to($data['email'])->send(new TicketReplyNotification($data));
    }
}
