<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'produk' => 'Canon EOS 550D',
                'foto' => 'p1.png',
                'deskripsi' => 'Ini Kamera Profesional',
                'harga' => 2000000,
                'stok'=>5
            ],
            [
                'produk' => 'Game Pad PS',
                'foto' => 'p6.png',
                'deskripsi' => 'Ini Game Pad Play Station',
                'harga' => 100000,
                'stok' => 8
            ],
            [
                'produk' => 'Drone',
                'foto' => 'p3.png',
                'deskripsi' => 'Ini Drone',
                'harga' => 750000,
                'stok' => 2
            ],
        ];

        foreach ($data as $key => $value) {
            DB::table('tb_produk')->insert([
                'produk' => $value['produk'],
                'foto' => $value['foto'],
                'deskripsi' => $value['deskripsi'],
                'harga' => $value['harga'],
                'stok' => $value['stok'],
            ]);
        }
    }
}
