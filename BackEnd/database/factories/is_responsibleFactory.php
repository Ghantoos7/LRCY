<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\is_responsible>
 */
class is_responsibleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'organization_id' => $this->faker->numberBetween(1, 5),
            'event_id' => $this->faker->numberBetween(150, 500),
            'role_name' => 'role_name',
        ];
    }
}
