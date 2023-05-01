<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comment_like>
 */
class comment_likeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            "user_id" => $this->faker->numberBetween(1, 70),
            "comment_id" => $this->faker->numberBetween(1, 70),
            'like_date' => $this->faker->date(),
            //
        ];
    }
}
