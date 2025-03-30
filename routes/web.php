<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Guest\TicketController;
use App\Http\Controllers\Agent\TicketController as AgentTicketController;
use Illuminate\Support\Facades\Auth;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', function () {
    return redirect()->route('agent.tickets.index');
})->name('home');

// Guest Ticket Routes
Route::name('guest.')->group(function () {
    Route::get('/', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{reference_number}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])
        ->name('tickets.reply');
});

Route::middleware('auth')->prefix('agent')->name('agent.')->group(function () {
    Route::get('/tickets', [AgentTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [AgentTicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{ticket}/resolve', [AgentTicketController::class, 'resolve'])
        ->name('tickets.resolve');
});
