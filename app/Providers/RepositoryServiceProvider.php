<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\TicketRepositoryInterface;
use App\Repositories\TicketRepository;
use App\Interfaces\Services\TicketServiceInterface;
use App\Services\TicketService;
use App\Interfaces\Services\EmailServiceInterface;
use App\Services\EmailService;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
        $this->app->bind(EmailServiceInterface::class, EmailService::class);
    }

    public function boot()
    {
        //
    }
}
