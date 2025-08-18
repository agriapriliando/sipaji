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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Agri Apriliando',
        //     'username' => 'admin',
        //     'password' => bcrypt('123'),
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // DelegationSeeder::class,
            // CancelSeeder::class,
            // SurveySeeder::class,
            // FeedbackSeeder::class,
        ]);
    }
}
