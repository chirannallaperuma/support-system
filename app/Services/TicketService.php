<?php

namespace App\Services;

use App\Interfaces\Repositories\TicketRepositoryInterface;
use App\Interfaces\Services\TicketServiceInterface;
use App\Traits\GeneratesReferenceNumber;

class TicketService implements TicketServiceInterface
{
    use GeneratesReferenceNumber;

    private $ticketRepository;

    /**
     * __construct
     *
     * @param  mixed $ticketRepository
     * @return void
     */
    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * createTicket
     *
     * @param  mixed $data
     * @return void
     */
    public function createTicket(array $data)
    {
        $data['reference_number'] = $this->generateReferenceNumber();
        $data['status'] = 'pending';
        $data['is_opened'] = false;

        $ticket = $this->ticketRepository->create($data);

        return [
            'ticket' => $ticket,
            'reference_number' => $ticket->reference_number
        ];
    }

    /**
     * getTicketByReferenceNumber
     *
     * @param  mixed $referenceNumber
     * @return void
     */
    public function getTicketByReferenceNumber(string $referenceNumber)
    {
        $ticket = $this->ticketRepository->findByreferenceNumber($referenceNumber);

        if (!$ticket) {
            return null;
        }

        return [
            'ticket' => $ticket,
            'replies' => $ticket->replies()->with('user')->get()
        ];
    }

    /**
     * getPendingTickets
     *
     * @param  mixed $customerName
     * @return void
     */
    public function getPendingTickets(?string $customerName = null)
    {
        return $this->ticketRepository->getAllPendingTickets($customerName);
    }

    /**
     * replyToTicket
     *
     * @param  mixed $data
     * @return void
     */
    public function replyToTicket(array $data)
    {
        $this->ticketRepository->updateTicketStatus($data['ticket_id'], 'in_progress');

        $reply = $this->ticketRepository->addReply($data);

        $this->ticketRepository->markAsOpened($data['ticket_id']);

        return $reply;
    }

    /**
     * getTicketById
     *
     * @param  mixed $id
     * @return void
     */
    public function getTicketById(string $id)
    {
        $ticket = $this->ticketRepository->findById($id);

        if (!$ticket) {
            return null;
        }

        return $ticket;
    }

    /**
     * markAsOpened
     *
     * @param  mixed $ticketId
     * @return bool
     */
    public function markAsOpened(string $ticketId): bool
    {
        return $this->ticketRepository->markAsOpened($ticketId);
    }
}
