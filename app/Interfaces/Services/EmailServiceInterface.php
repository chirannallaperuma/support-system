<?php

namespace App\Interfaces\Services;

interface EmailServiceInterface
{
    public function sendTicketAcknowledgement(array $data);
    
    public function sendTicketReplyNotification(array $data);
}
