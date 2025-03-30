@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ticket #{{ $ticket->reference_number }}</h5>
                    <span class="badge badge-{{ $ticket->status === 'pending' ? 'warning' : ($ticket->status === 'in_progress' ? 'info' : 'success') }}">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </div>

                <div class="card-body">
                    <!-- Ticket Details -->
                    <div class="ticket-details mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Customer Name:</strong> {{ $ticket->customer_name }}</p>
                                <p><strong>Email:</strong> {{ $ticket->email }}</p>
                                <p><strong>Phone:</strong> {{ $ticket->phone_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Created:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</p>
                                <p><strong>Last Updated:</strong> {{ $ticket->updated_at->format('M d, Y H:i') }}</p>
                                <p><strong>Assigned Agent:</strong> {{ $ticket->agent_id ? $ticket->agent->name : 'Unassigned' }}</p>
                            </div>
                        </div>
                        <div class="problem-description mt-3">
                            <h6>Problem Description:</h6>
                            <div class="border p-3 bg-light rounded">
                                {{ $ticket->description }}
                            </div>
                        </div>
                    </div>

                    <!-- Replies Section -->
                    <div class="replies-section mb-4">
                        <h5 class="mb-3">Conversation</h5>

                        @if($replies->isEmpty())
                            <div class="alert alert-info">No replies yet.</div>
                        @else
                            <div class="replies-list">
                                @foreach($replies as $reply)
                                    <div class="card mb-3 {{ $reply->user_id === auth()->id() ? 'border-primary' : '' }}">
                                        <div class="card-header d-flex justify-content-between bg-{{ $reply->user_id === auth()->id() ? 'primary text-white' : 'light' }}">
                                            <span>
                                                {{ $reply->user->name }}
                                                @if($reply->user_id === auth()->id())
                                                    (You)
                                                @endif
                                            </span>
                                            <small>{{ $reply->created_at->format('M d, Y H:i') }}</small>
                                        </div>
                                        <div class="card-body">
                                            {!! nl2br(e($reply->message)) !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Reply Form -->
                    <div class="reply-form">
                        <h5 class="mb-3">Add Reply</h5>
                        <form action="{{ route('agent.tickets.reply', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required></textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Send Reply</button>
                                @if($ticket->status !== 'resolved')
                                    <button type="button" class="btn btn-success ml-2" onclick="document.getElementById('resolveForm').submit()">
                                        Mark as Resolved
                                    </button>
                                @endif
                            </div>
                        </form>

                        <!-- Hidden form for resolving ticket -->
                        <form id="resolveForm" action="{{ route('agent.tickets.resolve', $ticket->id) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
