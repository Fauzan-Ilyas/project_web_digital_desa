<?php



namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\User;



class UserSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run(): void

    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@desa.com',
            'password' => bcrypt('password')
        ])->assignRole('admin');

        UserFactory::new()->count(15)->create();

    }

}