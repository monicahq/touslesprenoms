<?php

namespace Database\Factories;

use App\Models\Name;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NameStatistic>
 */
class NameStatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_id' => Name::factory(),
            'year' => fake()->year(),
            'count' => fake()->numberBetween(1, 1000),
        ];
    }
}
