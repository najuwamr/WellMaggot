<?php

namespace Database\Seeders;

use App\Models\Sembako;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SembakoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sembakoList = [
            [
                'nama' => 'Minyak 1 Liter',
                'nilai_rupiah' => 20000,
                'gambar' => 'sembako1.jpg',
                'poin_harga' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gula 1 Kg',
                'nilai_rupiah' => 17000,
                'gambar' => 'sembako2.jpg',
                'poin_harga' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($sembakoList as $sembako) {
            Sembako::create($sembako);
        }
    }
}
