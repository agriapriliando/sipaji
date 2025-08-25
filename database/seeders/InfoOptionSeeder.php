<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('info_options')->insert([
            [
                'judul_informasi' => 'Alur Pendaftaran Haji',
                'isi_informasi'   => 'Tentang pendaftaran haji',
                'tipe_informasi'  => 'informasi',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'judul_informasi' => 'Alur Pembatalan Porsi Haji',
                'isi_informasi'   => 'Tentang Pembatalan Porsi haji',
                'tipe_informasi'  => 'informasi',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'judul_informasi' => 'Alur Pelimpahan Porsi Haji',
                'isi_informasi'   => 'Tentang Pelimpahan Porsi haji',
                'tipe_informasi'  => 'informasi',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
