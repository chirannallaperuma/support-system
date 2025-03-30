<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TicketRepositoryInterface;
use App\Models\Reply;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    protected $ticket;

    protected $reply;

    /**
     * __construct
     *
     * @param  mixed $ticket
     * @param  mixed $reply
     * @return void
     */
    public function __construct(Ticket $ticket, Reply $reply)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }

    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->ticket->create($data);
    }

    /**
     * findById
     *
     * @param  mixed $id
     * @return void
     */
    public function findById(string $id)
    {
        return $this->ticket->find($id);
    }

    /**
     * findByreferenceNumber
     *
     * @param  mixed $referenceNumber
     * @return void
     */
    public function findByreferenceNumber(string $referenceNumber)
    {
        return $this->ticket->where('reference_number', $referenceNumber)->first();
    }

    /**
     * getAllPendingTickets
     *
     * @param  mixed $customerName
     * @return void
     */
    public function getAllPendingTickets(?string $customerName = null)
    {
        $query = $this->ticket->where('status', 'pending')
            ->orderBy('created_at', 'desc');

        if (isset($customerName)) {
            $query->where('customer_name', 'like', '%' . $customerName . '%');
        }

        return $query->paginate(10);
    }

    /**
     * addReply
     *
     * @param  mixed $data
     * @return void
     */
    public function addReply(array $data)
    {
        return $this->reply->create($data);
    }

    /**
     * updateTicketStatus
     *
     * @param  mixed $ticketId
     * @param  mixed $status
     * @return void
     */
    public function updateTicketStatus(string $ticketId, string $status)
    {
        return $this->ticket->where('id', $ticketId)->update([
            'status' => $status
        ]);
    }

    /**
     * markAsOpened
     *
     * @param  mixed $ticketId
     * @return void
     */
    public function markAsOpened(string $ticketId)
    {
        return $this->ticket->where('id', $ticketId)->update([
            'is_opened' => true
        ]);
    }
}
