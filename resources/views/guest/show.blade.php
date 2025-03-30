@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Support Ticket #{{ $ticket->reference_number }}</h4>
                    <span class="badge badge-light">
                        Status:
                        <span class="text-{{
                            $ticket->status === 'pending' ? 'warning' :
                            ($ticket->status === 'in_progress' ? 'info' : 'success')
                        }}">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </span>
                </div>

                <div class="card-body">
                    <!-- Ticket Information -->
                    <div class="ticket-info mb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item mb-3">
                                    <h6 class="text-muted">Customer Name</h6>
                                    <p>{{ $ticket->customer_name }}</p>
                                </div>
                                <div class="detail-item mb-3">
                                    <h6 class="text-muted">Email Address</h6>
                                    <p>{{ $ticket->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item mb-3">
                                    <h6 class="text-muted">Phone Number</h6>
                                    <p>{{ $ticket->phone_number ?? 'Not provided' }}</p>
                                </div>
                                <div class="detail-item mb-3">
                                    <h6 class="text-muted">Created At</h6>
                                    <p>{{ $ticket->created_at->format('F j, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="problem-description mt-4">
                            <h6 class="text-muted">Problem Description</h6>
                            <div class="border p-3 bg-light rounded">
                                {!! nl2br(e($ticket->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Reference: {{ $ticket->reference_number }}
                        </small>
                        <a href="{{ route('guest.tickets.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus mr-1"></i> New Ticket
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 50px;
    }
    .timeline-item {
        margin-bottom: 30px;
        position: relative;
    }
    .timeline-badge {
        position: absolute;
        left: -50px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    .agent-reply .timeline-badge {
        background-color: #3490dc;
    }
    .customer-reply .timeline-badge {
        background-color: #6c757d;
    }
    .timeline-panel {
        background: white;
        border: 1px solid #eee;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .timeline-heading {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eee;
    }
    .timeline-title {
        margin-bottom: 0;
    }
    .detail-item h6 {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .problem-description {
        white-space: pre-wrap;
    }
</style>
@endsection
