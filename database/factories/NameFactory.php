<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Name>
 */
class NameFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gender' => 'male',
            'name' => fake()->name(),
            'origins' => fake()->sentence(),
            'personality' => fake()->sentence(),
            'country_of_origin' => fake()->word(),
            'celebrities' => fake()->sentence(),
            'elfic_traits' => fake()->sentence(),
            'name_day' => fake()->sentence(),
            'litterature_artistics_references' => fake()->sentence(),
            'similar_names_in_other_languages' => fake()->sentence(),
            'klingon_translation' => fake()->sentence(),
            'unisex' => true,
            'total' => 1,
            'page_views' => 1,
        ];
    }
}
