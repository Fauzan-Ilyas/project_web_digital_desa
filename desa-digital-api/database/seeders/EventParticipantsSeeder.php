<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Seeder;
use App\Models\EventParticipants;
use App\Models\Event;

class EventParticipantsSeeder extends Seeder
{
    public function run(): void
    {
        // pastiin ada event dulu
        if (Event::count() === 0) {
            Log::warning('No events found. Skipping EventParticipantsSeeder.');
            return;
        }

        EventParticipants::factory()->count(20)->create([
            'event_id' => Event::inRandomOrder()->first()->id,
        ]);
    }
}
