<?php

namespace App\Interfaces\Services;

interface TicketServiceInterface
{
    public function createTicket(array $data);

    public function getTicketByReferenceNumber(string $referenceNumber);

    public function getPendingTickets(?string $customerName = null);

    public function replyToTicket(array $data);

    public function getTicketById(string $id);

    public function markAsOpened(string $ticketId): bool;
}
