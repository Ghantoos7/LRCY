<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\recover_request>
 */
class recover_requestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // boolean
            "request_status" => $this->faker->boolean,
            'request_date' => $this->faker->date(),
            'user_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
