<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Lease;

class ReminderService
{
    public function upcomingDueInvoices(int $days = 3)
    {
        return Invoice::whereIn('status', ['unpaid', 'partial'])
            ->whereBetween('due_date', [now(), now()->addDays($days)])
            ->get();
    }

    public function overdueInvoices()
    {
        return Invoice::whereIn('status', ['unpaid', 'partial', 'late'])
            ->whereDate('due_date', '<', now())
            ->get();
    }

    public function expiringLeases(int $days = 30)
    {
        return Lease::where('status', 'active')
            ->whereBetween('end_date', [now(), now()->addDays($days)])
            ->get();
    }
}
