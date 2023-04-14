<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\training>
 */
class trainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'training_description' => fake()->sentence(),
            'training_name' => fake()->sentence(),
            'program_id' => random_int(1,3)
        ];
    }
}
