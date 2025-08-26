<?php

namespace Database\Seeders;

use App\Models\Cancel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CancelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada user
        $user = User::query()->first() ?? User::factory()->create();

        // Contoh 1 data nyata
        // Cancel::create([
        //     'id'                => Str::uuid(),
        //     'user_id'           => $user->id,
        //     'nomor_porsi'       => '3216549870123',
        //     'nama'              => 'Nur Aini',
        //     'bin_binti'         => 'binti Abdullah',
        //     'ttl_tempat'        => 'Katingan',
        //     'ttl_tanggal'       => '1988-09-21',
        //     'pekerjaan'         => 'Ibu Rumah Tangga',
        //     'alamat'            => 'Jl. Kenanga No. 5, Katingan',
        //     'alasan_pembatalan' => 'Kondisi kesehatan tidak memungkinkan',
        //     'status_surveys'    => false,
        // ]);

        // Dummy tambahan
        foreach (range(1, 10) as $i) {
            Cancel::create([
                'id'                => Str::uuid(),
                'user_id'           => $user->id,
                'nomor_porsi'       => (string) $faker->numberBetween(1000000000000, 9999999999999),
                'nama'              => $faker->name(),
                'bin_binti'         => $faker->boolean(70) ? ($faker->boolean() ? 'bin ' : 'binti ') . $faker->firstName() : null,
                'jenis_kelamin'      => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'ttl_tempat'        => $faker->city(),
                'ttl_tanggal'       => $faker->date('Y-m-d', '2003-12-31'),
                'pekerjaan'         => $faker->boolean(80) ? $faker->jobTitle() : null,
                'alamat'            => $faker->address(),
                'alasan_pembatalan' => $faker->boolean(85) ? $faker->sentence(8) : null,
                'status_surveys'    => $faker->boolean(),
            ]);
        }
    }
}
