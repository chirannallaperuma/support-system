<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    protected $ticket;

    /**
     * __construct
     *
     * @param  mixed $ticket
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data)
    {
        $data['reference_number'] = uniqid('TCK-');
        return $this->ticket->create($data);
    }

    /**
     * findByReference
     *
     * @param  mixed $reference
     * @return void
     */
    public function findByReference(string $reference)
    {
        return $this->ticket->where('reference_number', $reference)->first();
    }

    /**
     * getAll
     *
     * @param  mixed $search
     * @return void
     */
    public function getAll(string $search = null)
    {
        return $this->ticket->when($search, function($query, $search) {
            return $query->where('customer_name', 'LIKE', "%{$search}%");
        })->orderBy('created_at', 'desc')
        ->paginate(10);
    }

    /**
     * updateStatus
     *
     * @param  mixed $ticket
     * @param  mixed $status
     * @return void
     */
    public function updateStatus($ticket, string $status)
    {
        $this->ticket->update([
            'status' => $status
        ]);
    }
}
