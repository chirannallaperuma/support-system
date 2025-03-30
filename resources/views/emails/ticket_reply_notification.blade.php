<!-- resources/views/emails/ticket_reply_notification.blade.php -->
@extends('layouts.email')

@section('content')
    <h2>New Reply to Your Support Ticket</h2>
    <p>Hello {{ $data['customer_name'] }},</p>

    <p>You have received a new reply to your support ticket <strong>#{{ $data['reference_number'] }}</strong>:</p>

    <div style="background-color: #f8f9fa; border-left: 4px solid #007bff; padding: 15px; margin: 15px 0;">
        <p style="font-style: italic; margin-bottom: 10px;">"{{ $data['message'] }}"</p>
        <p style="font-size: 0.9em; color: #6c757d;">
            - {{ $data['reply']->user->name }} ({{ $data['reply']->created_at->format('M j, Y \a\t g:i a') }})
        </p>
    </div>

    <p><strong>Ticket Status:</strong> {{ ucfirst(str_replace('_', ' ', $data['reply']->ticket->status)) }}</p>

    <p>If you have any additional questions or information to share, please reply directly to this email or use the link above.</p>

    <p>Thank you,<br>
    {{ config('app.name') }} Support Team</p>

    <hr style="border: none; border-top: 1px solid #e9ecef; margin: 20px 0;">

    <p style="font-size: 0.8em; color: #6c757d;">
        Ticket Reference: #{{ $data['reference_number'] }}<br>
        Created: {{ $data['reply']->ticket->created_at->format('M j, Y \a\t g:i a') }}<br>
        Last Updated: {{ $data['reply']->ticket->updated_at->format('M j, Y \a\t g:i a') }}
    </p>
@endsection
