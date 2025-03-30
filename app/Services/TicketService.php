<?php

namespace App\Services;

use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketService
{
    protected $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function createTicket(array $data)
    {
        return $this->ticketRepository->create($data);
    }

    public function getTicketByReference(string $reference)
    {
        return $this->ticketRepository->findByReference($reference);
    }

    public function getAllTickets(string $search = null)
    {
        return $this->ticketRepository->getAll($search);
    }
}
