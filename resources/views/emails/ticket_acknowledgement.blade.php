<!-- resources/views/emails/ticket_acknowledgement.blade.php -->
@extends('layouts.email')

@section('content')
    <h2>Support Ticket Received</h2>
    <p>Hello {{ $data['customer_name'] }},</p>

    <p>We've received your support ticket with reference number:
       <strong>{{ $data['reference_number'] }}</strong></p>

    <p>Our team will review your request and respond shortly.</p>

    <p>You can check the status of your ticket at any time using this reference number.</p>

    <p>Thank you,<br>
    {{ config('app.name') }} Support Team</p>
@endsection
