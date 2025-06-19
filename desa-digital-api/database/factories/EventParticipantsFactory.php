<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HeadOfFamily;
use Illuminate\Support\Str;

class EventParticipantsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'head_of_family_id' => HeadOfFamily::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'total_price' => $this->faker->numberBetween(10000, 50000),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'pending']),
        ];
    }
}