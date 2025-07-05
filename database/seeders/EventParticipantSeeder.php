<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Seeder;
use App\Models\EventParticipant;
use App\Models\HeadOfFamily;
use App\Models\Event;

class EventParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();
        $headOfFamilies = HeadOfFamily::all();

        foreach($events as $event) {
            foreach($headOfFamilies as $headOfFamily) {
                EventParticipant::factory()->create([
                    'event_id' => $event->id,
                    'head_of_family_id' => $headOfFamily->id
                ]);
            }
        }
    }
}
