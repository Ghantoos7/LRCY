<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comment>
 */
class commentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment_content' => fake()->text(100),
            'user_id' => fake()->numberBetween(1, 70),
            'post_id' => fake()->numberBetween(1, 70),
            'comment_date' => fake()->date(),
            'comment_like_count' => fake()->numberBetween(0,0),
            'comment_reply_count' => fake()->numberBetween(0,0),
        ];
    }
}
