<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Name>
 */
class NameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gender' => fake()->randomElement(['male', 'female']),
            'name' => fn (array $attributes) => fake()->firstName($attributes['gender']),
            'origins' => fake()->sentence(),
            'personality' => fake()->sentence(),
            'country_of_origin' => fake()->word(),
            'celebrities' => fake()->sentence(),
            'elfic_traits' => fake()->sentence(),
            'name_day' => fake()->sentence(),
            'litterature_artistics_references' => fake()->sentence(),
            'similar_names_in_other_languages' => fake()->sentence(),
            'klingon_translation' => fake()->sentence(),
            'unisex' => fake()->boolean,
            'total' => fake()->numberBetween(1, 100000),
            'page_views' => 1,
        ];
    }

    /**
     * Indicate that the gender is male
     */
    public function male(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'gender' => 'male',
        ]);
    }

    /**
     * Indicate that the gender is female
     */
    public function female(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'gender' => 'female',
        ]);
    }

    /**
     * Indicate that the model is unisex
     */
    public function unisex(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'unisex' => true,
        ]);
    }

    /**
     * Indicate that the model is not unisex
     */
    public function specific(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'unisex' => false,
        ]);
    }
}
