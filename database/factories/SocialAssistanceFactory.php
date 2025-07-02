<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialAssistanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'thumbnail' => $this->faker->imageUrl(), // tambahin ini
            'name' => $this->faker->randomElement(['Bantuan Pangan', 'Bantuan Tunai', 'Bantuan Bahan Bakar Bersubsidi', 'Bantuan Kesehatan']) . '' . $this->faker->company,
            'category' => $this->faker->randomElement(['staple', 'cash', 'subsidized fuel', 'health']),
            'amount' => $this->faker->randomFloat(2, 100000, 1000000),
            'provider' => $this->faker->company,
            'description' => $this->faker->sentence,
            'is_available' => $this->faker->randomElement([true, false]),
        ];
    }
}
