<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Development>
 */
class DevelopmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thumbnail' => $this->faker->imageUrl(),
            'name' => $this->faker->randomElement(['Pembangunan Jalan', 'Perbaikan Jalan', 'Pembuatan Jalan']) . ' ' . $this->faker->city,
            'description' => $this->faker->paragraph(),
            'person_in_change' => $this->faker->name(),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'amount' => $this->faker->randomFloat(2, 100000, 1000000),
            'status' => $this->faker->randomElement(['ongoing', 'completed']),
        ];
    }
}
