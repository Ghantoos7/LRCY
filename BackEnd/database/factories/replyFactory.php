<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reply>
 */
class replyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reply_content' => $this->faker->text,
            'reply_date' => $this->faker->dateTime,
            'user_id' => $this->faker->numberBetween(1, 10),
            //
        ];
    }
}
