<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Lease;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'lease_id' => Lease::factory(),
            'billing_month' => now()->startOfMonth(),
            'amount' => 15000,
            'balance' => 15000,
            'status' => 'unpaid',
            'due_date' => now()->startOfMonth()->addDays(4),
        ];
    }
}
