<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Contoh 1 data manual
        // Feedback::create([
        //     'nama'  => 'Ahmad Fauzi',
        //     'nohp'  => '081234567890',
        //     'pesan' => 'Pelayanan sangat baik dan cepat, terima kasih!',
        // ]);

        // Generate dummy data tambahan
        foreach (range(1, 9) as $i) {
            Feedback::create([
                'nama'  => $faker->name(),
                'nohp'  => '08' . $faker->numerify('##########'),
                'pesan' => $faker->sentence(12),
            ]);
        }
    }
}
