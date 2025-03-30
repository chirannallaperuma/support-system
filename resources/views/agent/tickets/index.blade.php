@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pending Tickets</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('agent.tickets.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="customer_name" class="form-control" placeholder="Search by customer name" value="{{ request('customer_name') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Reference #</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr class="{{ $ticket->is_opened ? '' : 'table-primary' }}">
                                    <td>{{ $ticket->reference_number }}</td>
                                    <td>{{ $ticket->customer_name }}</td>
                                    <td>{{ $ticket->email }}</td>
                                    <td>{{ $ticket->phone_number }}</td>
                                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <span>
                                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('agent.tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
