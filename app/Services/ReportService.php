<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Unit;

class ReportService
{
    public function occupancyRate(): array
    {
        $total = Unit::count();
        $occupied = Unit::where('status', 'occupied')->count();

        return [
            'total_units' => $total,
            'occupied_units' => $occupied,
            'vacant_units' => max(0, $total - $occupied),
            'occupancy_rate' => $total > 0 ? round(($occupied / $total) * 100, 2) : 0,
        ];
    }

    public function pendingDues(): array
    {
        $overdue = Invoice::with('lease.tenant', 'lease.unit')
            ->whereIn('status', ['unpaid', 'late', 'partial'])
            ->whereDate('due_date', '<', now())
            ->get();

        return [
            'count' => $overdue->count(),
            'total_due' => (float) $overdue->sum('balance'),
            'items' => $overdue,
        ];
    }

    public function netCashFlow(string $month): array
    {
        $start = now()->parse("{$month}-01")->startOfMonth();
        $end = now()->parse("{$month}-01")->endOfMonth();

        $income = Invoice::whereBetween('billing_month', [$start, $end])->sum('amount');
        $expenses = Expense::whereBetween('expense_date', [$start, $end])->sum('amount');

        return [
            'month' => $month,
            'income' => (float) $income,
            'expenses' => (float) $expenses,
            'net_cash_flow' => (float) $income - (float) $expenses,
        ];
    }
}
