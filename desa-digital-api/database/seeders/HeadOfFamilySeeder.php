<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\HeadOfFamily;
use Illuminate\Database\Seeder;

class HeadOfFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(15)->create()->each(function ($user) {
            HeadOfFamily::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }
}
