<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\goal>
 */
class goalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goal_description' => fake()->text,
            'goal_name' => fake()->name,
            'program_id' => random_int(1,3),
            'goal_status' => fake()->boolean,
            'number_completed' => random_int(1,3),
            'number_to_complete' => random_int(1,3),
            'goal_year' => random_int(2023,2030),
            'event_type_id' => random_int(1,5),
            'goal_deadline' => fake()->date,
            'start_date' => fake()->date,
        ];
    }
}
