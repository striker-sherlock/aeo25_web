<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'created_by' => fake()->name(),
            'pic_name' => fake()->name(),
            'username' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'pic_phone_number' => fake()->unique()->phoneNumber(),
            'country_id' => mt_rand(1,100),
            'institution_name' => fake()->unique()->company(),
            'institution_email' => fake()->unique()->companyEmail(),
            'institution_type' => $this->faker->randomElement(['national', 'international']),
            'institution_logo' => fake()->image(),
            'password' => fake()->bothify('?????-#####'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
