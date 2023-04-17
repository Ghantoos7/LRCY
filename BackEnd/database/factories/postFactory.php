<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_caption' => fake()->sentence,
            'comment_count' => random_int(0, 100),
            'like_count' => random_int(0, 100),
            'post_date' => fake()->date,
            'post_type_id' => 3,
            'user_id' => random_int(1, 70)
        ];
    }
}
