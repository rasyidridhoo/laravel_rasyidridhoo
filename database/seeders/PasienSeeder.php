<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pasiens = [
            [
                'nama' => 'Wawan',
                'alamat' => 'Tanah Abang',
                'telepon' => '08341xxx',
            ],
            [
                'nama' => 'Indra',
                'alamat' => 'Kulonprogo',
                'telepon' => '08211xxx',
            ],
            [
                'nama' => 'Agam',
                'alamat' => 'Bandung Barat',
                'telepon' => '08421xxx',
            ],
            [
                'nama' => 'Wayan',
                'alamat' => 'Bali',
                'telepon' => '08151xxx',
            ],
            [
                'nama' => 'Galuh',
                'alamat' => 'Jakarta',
                'telepon' => '08461xxx',
            ],
            [
                'nama' => 'Kukuh',
                'alamat' => 'Binjai',
                'telepon' => '08352xxx',
            ],
            [
                'nama' => 'Salim',
                'alamat' => 'Brebes',
                'telepon' => '08231xxx',
            ],
        ];

        foreach ($pasiens as $pasien) {
            DB::table('pasiens')->insert([
                'nama' => $pasien['nama'],
                'alamat' => $pasien['alamat'],
                'telepon' => $pasien['telepon'],
                'rumahsakit_id' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            
        }
    }
}
