<?php

namespace Database\Factories;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaseFactory extends Factory
{
    protected $model = Lease::class;

    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'unit_id' => Unit::factory(),
            'start_date' => now()->subMonth(),
            'end_date' => now()->addMonths(11),
            'deposit' => 20000,
            'monthly_rent' => 15000,
            'due_day' => 5,
            'status' => 'active',
        ];
    }
}
