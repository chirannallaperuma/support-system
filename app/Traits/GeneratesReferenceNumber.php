<?php

namespace App\Traits;

trait GeneratesReferenceNumber
{
    /**
     * generateReferenceNumber
     *
     * @return void
     */
    protected function generateReferenceNumber()
    {
        return 'TICKET-' . strtoupper(uniqid());
    }
}
