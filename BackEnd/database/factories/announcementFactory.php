<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\announcement>
 */
class announcementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'announcement_content' => fake()->text(),
            'announcement_title' => fake()->text(),
            'announcement_date' => fake()->date(),
            'importance_level' => random_int(0, 3),
            'admin_id' => random_int(1, 70),
        ];
    }
}
