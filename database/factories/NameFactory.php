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
        $gender = fake()->randomElement(['male','female']);

        return [
            'gender' => $gender,
            'name' => fake()->firstName($gender),
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
        return $this->state(function (array $attributes) {
            return [
                'gender' => 'male',
                'name' => fake()->firstName('male'),
            ];
        });
    }

    /**
     * Indicate that the gender is female
     */
    public function female(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'gender' => 'female',
                'name' => fake()->firstName('female'),
            ];
        });
    }

    /**
     * Indicate that the model is unisex
     */
    public function unisex(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'unisex' => true,
            ];
        });
    }

    /**
     * Indicate that the model is not unisex
     */
    public function specific(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'unisex' => false,
            ];
        });
    }
}
