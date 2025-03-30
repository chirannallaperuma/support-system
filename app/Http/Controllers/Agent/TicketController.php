<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\ReplyTicketRequest;
use App\Interfaces\Services\EmailServiceInterface;
use App\Interfaces\Services\TicketServiceInterface;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $customerName = $request->input('customer_name');

        $tickets = $this->ticketService->getPendingTickets($customerName);

        return view('agent.tickets.index', compact('tickets'));
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show(string $id)
    {
        $ticket = $this->ticketService->getTicketById($id);

        if (!$ticket) {
            abort(404);
        }

        // Mark ticket as opened
        $this->ticketService->markAsOpened($id);

        return view('agent.tickets.show', [
            'ticket' => $ticket,
            'replies' => $ticket->replies
        ]);
    }

    /**
     * reply
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function reply(ReplyTicketRequest $request, string $id)
    {
        $validated = $request->validated();

        $validated['ticket_id'] = $id;
        $validated['user_id'] = Auth::id();

        $reply = $this->ticketService->replyToTicket($validated);

        // Send reply notification email
        $this->emailService->sendTicketReplyNotification([
            'email' => $reply->ticket->email,
            'customer_name' => $reply->ticket->customer_name,
            'message' => $validated['message'],
            'reference_number' => $reply->ticket->reference_number,
            'reply' => $reply
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

    /**
     * resolve
     *
     * @param  mixed $request
     * @param  mixed $ticket
     * @return void
     */
    public function resolve(Request $request, Ticket $ticket)
    {
        $ticket->update(['status' => 'resolved']);

        return back()->with('success', 'Ticket marked as resolved!');
    }
}
