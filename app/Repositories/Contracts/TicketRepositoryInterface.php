<?php

namespace App\Repositories\Contracts;

interface TicketRepositoryInterface
{
    public function create(array $data);

    public function findByReference(string $reference);

    public function getAll(string $search = null);

    public function updateStatus($ticket, string $status);
}
