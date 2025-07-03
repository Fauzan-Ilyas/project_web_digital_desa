<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialAssistance;
use Database\Factories\SocialAssistanceFactory;

class SocialAssistanceSeeder extends Seeder
{
    public function run(): void
    {
        SocialAssistanceFactory::new()->count(10)->create();
    }
}
