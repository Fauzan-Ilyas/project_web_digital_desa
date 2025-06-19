<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialAssistance;

class SocialAssistanceSeeder extends Seeder
{
    public function run(): void
    {
        SocialAssistance::factory()->count(10)->create();
    }
}
