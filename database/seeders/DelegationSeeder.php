<?php

namespace Database\Seeders;

use App\Models\Delegation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DelegationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada user
        $user = User::query()->first() ?? User::factory()->create();

        // Contoh 1 data jelas
        // Delegation::create([
        //     'id'                 => Str::uuid(),
        //     'user_id'            => $user->id,
        //     'nomor_porsi'        => '1234567890123',
        //     'nama_asal'          => 'Ahmad Fauzi',
        //     'bin_binti_asal'     => 'bin Slamet',
        //     'nama_penerima'      => 'Rizky Fauzan',
        //     'bin_binti_penerima' => 'bin Ahmad',
        //     'ttl_tempat'         => 'Katingan',
        //     'ttl_tanggal'        => '1985-04-12',
        //     'pekerjaan'          => 'Wiraswasta',
        //     'alamat'             => 'Jl. Melati No. 10, Katingan',
        //     'nomor_hp'           => '081234567890',
        //     'alasan_pelimpahan'  => 'Orang tua sakit dan tidak dapat berangkat',
        //     'status_surveys'     => false,
        //     'jenis_persyaratan'  => 'Sakit Permanen',
        // ]);

        // Dummy lainnya
        foreach (range(1, 10) as $i) {
            Delegation::create([
                'id'                 => Str::uuid(),
                'user_id'            => $user->id,
                'nomor_porsi'        => (string) $faker->numberBetween(1000000000000, 9999999999999),
                'nama_asal'          => $faker->name(),
                'bin_binti_asal'     => $faker->boolean(70) ? 'bin ' . $faker->firstNameMale() : null,
                'nama_penerima'      => $faker->name(),
                'bin_binti_penerima' => $faker->boolean(70) ? 'bin ' . $faker->firstNameMale() : null,
                'ttl_tempat'         => $faker->city(),
                'ttl_tanggal'        => $faker->date('Y-m-d', '2003-12-31'),
                'pekerjaan'          => $faker->boolean(80) ? $faker->jobTitle() : null,
                'alamat'             => $faker->address(),
                'nomor_hp'           => '08' . $faker->numerify('##########'),
                'alasan_pelimpahan'  => $faker->boolean(80) ? $faker->sentence(6) : null,
                'status_surveys'     => $faker->boolean(),
                'jenis_persyaratan'  => $faker->randomElement([
                    'Sakit Permanen',
                    'Meninggal Dunia',
                ]),
            ]);
        }
    }
}
