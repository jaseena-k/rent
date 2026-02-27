<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'id_proof' => 'passport',
            'emergency_contact' => fake()->name() . ' ' . fake()->phoneNumber(),
            'documents' => [],
        ];
    }
}
