<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\CreateTicketRequest;
use App\Interfaces\Services\EmailServiceInterface;
use App\Interfaces\Services\TicketServiceInterface;

class TicketController extends Controller
{
    private $ticketService;

    private $emailService;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        TicketServiceInterface $ticketService,
        EmailServiceInterface $emailService
    ) {
        $this->ticketService = $ticketService;
        $this->emailService = $emailService;
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('guest.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(CreateTicketRequest $request)
    {
        $validated = $request->validated();

        $result = $this->ticketService->createTicket($validated);

        // Send acknowledgement email
        $this->emailService->sendTicketAcknowledgement([
            'email' => $validated['email'],
            'customer_name' => $validated['customer_name'],
            'reference_number' => $result['reference_number']
        ]);

        return redirect()->route('guest.tickets.show', [
            'reference_number' => $result['reference_number']
        ])->with('success', 'Ticket created successfully!');
    }

    /**
     * show
     *
     * @param  mixed $referenceNumber
     * @return void
     */
    public function show(string $referenceNumber)
    {
        $ticketData = $this->ticketService->getTicketByReferenceNumber($referenceNumber);

        if (!$ticketData) {
            abort(404);
        }

        return view('guest.show', $ticketData);
    }
}
