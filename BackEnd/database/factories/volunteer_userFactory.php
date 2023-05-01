<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\volunteer_user>
 */
class volunteer_userFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'=>fake()->firstName(),
            'last_name'=>fake()->lastName(),
            "organization_id"=>random_int(0,9999),
            "gender"=>random_int(0,3),
            "user_type_id"=>random_int(0,1),
            'user_age'=>random_int(18,60),
            'user_dob'=>fake()->date(),
            'user_position'=>fake()->jobTitle(),
            'is_registered'=>random_int(0,1),
            'is_active'=>random_int(0,1),
            'branch_id'=>random_int(0,10),
            'user_start_date'=>fake()->date(),
            'password'=>fake()->password(),
            'username'=>fake()->userName(),
            'user_bio'=>fake()->text(),
            'user_profile_pic'=>fake()->imageUrl()
        ];
    }
}
