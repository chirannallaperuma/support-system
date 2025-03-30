<?php

namespace App\Interfaces\Repositories;

interface TicketRepositoryInterface
{
    public function create(array $data);

    public function findById(string $id);

    public function findByreferenceNumber(string $referenceNumber);

    public function getAllPendingTickets(?string $customerName = null);

    public function addReply(array $data);

    public function updateTicketStatus(string $ticketId, string $status);

    public function markAsOpened(string $ticketId);
}
