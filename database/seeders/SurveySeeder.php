<?php

namespace Database\Seeders;

use App\Models\Cancel;
use App\Models\Delegation;
use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil contoh target: Cancel & Delegation
        $cancel = Cancel::query()->first();
        $delegation = Delegation::query()->first();

        // 1 contoh untuk Cancel
        if ($cancel) {
            Survey::create([
                'target_type' => Cancel::class,
                'target_id'   => $cancel->id,
                'layanan'    => 'pembatalan',
                'kepuasan'    => 'puas',
            ]);
        }

        // 1 contoh untuk Delegation
        if ($delegation) {
            Survey::create([
                'target_type' => Delegation::class,
                'target_id'   => $delegation->id,
                'layanan'    => 'pelimpahan',
                'kepuasan'    => 'tidak puas',
            ]);
        }

        // Tambah dummy random (jika ada data target)
        foreach (range(1, 10) as $i) {
            $modelClass = $faker->randomElement([Cancel::class, Delegation::class]);
            $model = $modelClass::query()->inRandomOrder()->first();

            if ($model) {
                Survey::create([
                    'target_type' => $modelClass,
                    'target_id'   => $model->id,
                    'layanan'    => $faker->randomElement(['pendaftaran', 'pembatalan', 'pelimpahan']),
                    'kepuasan'    => $faker->randomElement(['puas', 'tidak puas']),
                ]);
            }
        }
    }
}
