<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'beny',
            'profile_photo' => asset('storage/images/perfil.png'),
            'username' => 'beny',
            'email' => 'beny@test.com',
            'password' => bcrypt('test'),
        ]);

        $this->call([
            UserSeeder::class,
        ]);
    }
}
