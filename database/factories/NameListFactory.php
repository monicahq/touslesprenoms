<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NameList>
 */
class NameListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'is_public' => fake()->boolean,
            'can_be_modified' => fake()->boolean,
            'is_list_of_favorites' => fake()->boolean,
            'uuid' => fake()->uuid,
            'gender' => fake()->random,
        ];
    }
}
