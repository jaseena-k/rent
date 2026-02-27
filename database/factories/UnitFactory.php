<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition(): array
    {
        return [
            'building_id' => Building::factory(),
            'unit_number' => strtoupper(fake()->bothify('A-###')),
            'floor' => fake()->numberBetween(1, 10),
            'type' => fake()->randomElement(['Studio', '1BHK', '2BHK']),
            'rent_amount' => fake()->numberBetween(10000, 40000),
            'status' => 'vacant',
        ];
    }
}
