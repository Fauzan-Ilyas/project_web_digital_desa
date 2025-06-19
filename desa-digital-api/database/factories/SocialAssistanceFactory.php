<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialAssistanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'thumbnail' => $this->faker->imageUrl(640, 480, 'social', true, 'Bantuan'), // tambahin ini
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(10),
            'amount' => $this->faker->numberBetween(1000, 100000),
            'provider' => $this->faker->company(),
        ];
    }
}
