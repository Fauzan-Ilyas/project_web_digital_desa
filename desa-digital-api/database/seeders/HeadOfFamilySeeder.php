<?php

namespace Database\Seeders;

use App\Models\FamilyMember;
use App\Models\User;
use App\Models\HeadOfFamily;
use Database\Factories\FamilyMemberFactory;
use Database\Factories\UserFactory;
use Database\Factories\HeadOfFamilyFactory;
use Illuminate\Database\Seeder;

class HeadOfFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // UserFactory::new()->count(15)->create()->each(function ($user) {
        //     $headOfFamily = HeadOfFamilyFactory::new()->count(1)->create([
        //         'user_id' => $user->id
        //     ])->first();
            
        //     FamilyMemberFactory::new()->count(6)->create(['head_of_family_id' => $headOfFamily->id, 'user_id' => UserFactory::new()->create()->id]);
        // });

        UserFactory::new()->count(15)->create()->each(function ($user) {
        $headOfFamily = HeadOfFamilyFactory::new()->create([
            'user_id' => $user->id
        ]);

        FamilyMemberFactory::new()->count(6)->create([
            'head_of_family_id' => $headOfFamily->id,
            'user_id' => UserFactory::new()->create()->id
        ]);
    });
    }
}
