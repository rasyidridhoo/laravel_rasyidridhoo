<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RumahsakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rumahSakits = [
            [
                'nama' => 'RSUD Dr. Soetomo',
                'alamat' => 'Jl. Mayjend Prof. Dr. Moestopo No.6-8, Airlangga, Kec. Gubeng, Kota SBY, Jawa Timur 60286',
                'email' => 'info@rss.co.id',
                'telepon' => '+62315501078',
            ],
            [
                'nama' => 'RSUP Sanglah',
                'alamat' => 'Jl. Jend. Sudirman No.505, Pemecutan, Kec. Denpasar Bar., Kota Denpasar, Bali 80114',
                'email' => 'info@sanglahhospital.com',
                'telepon' => '+62361227911',
            ],
            [
                'nama' => 'RSUP Dr. Hasan Sadikin',
                'alamat' => 'Jl. Pasteur No.38, Pasteur, Kec. Sukajadi, Kota Bandung, Jawa Barat 40161',
                'email' => 'info@rsuphasansadikin.co.id',
                'telepon' => '+62222035116',
            ],
        ];

        foreach ($rumahSakits as $rumahSakit) {
            DB::table('rumahsakits')->insert([
                'nama' => $rumahSakit['nama'],
                'alamat' => $rumahSakit['alamat'],
                'email' => $rumahSakit['email'],
                'telepon' => $rumahSakit['telepon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
