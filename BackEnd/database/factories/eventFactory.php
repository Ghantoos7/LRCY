<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\event>
 */
class eventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_main_picture' => fake()->imageUrl(),
            'event_description' => fake()->text(),
            'event_location' => fake()->address(),
            'event_date' => fake()->date(),
            'event_title' => fake()->word(),
            'event_type_id' => random_int(1, 3),
            'program_id' => random_int(1, 4),
            'budget_sheet' => fake()->imageUrl(),
            'proposal' => fake()->imageUrl(),
            'meeting_minute' => fake()->imageUrl(),
            'branch_id' => '502'
        ];
    }
}
