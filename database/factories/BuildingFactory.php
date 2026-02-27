<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition(): array
    {
        $totalUnits = fake()->numberBetween(10, 60);
        return [
            'name' => fake()->company() . ' Residency',
            'address' => fake()->address(),
            'floors' => fake()->numberBetween(3, 12),
            'total_units' => $totalUnits,
            'notes' => fake()->sentence(),
        ];
    }
}
