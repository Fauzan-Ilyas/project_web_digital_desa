<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FamilyMemberResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profile_picture' => $this->faker->imageUrl(),
            'identity_number' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->dateTimeBetween('-60 years', 'now'),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'accupation' => $this->faker->jobTitle(),
            'marital_status' => $this->faker->randomElement(['Married', 'Single']),
            'relation' =>  $this->faker->randomElement(['wife', 'child', 'husband'])
        ];
    }
}
