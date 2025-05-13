<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;

class RegencySeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        $kecamatanJember = [
            "Ajung", "Ambulu", "Arjasa", "Balung", "Bangsalsari", "Gumukmas", "Jelbuk", "Jenggawah",
            "Jombang", "Kalisat", "Kaliwates", "Kencong", "Ledokombo", "Mayang", "Mumbulsari",
            "Pakusari", "Panti", "Patrang", "Puger", "Rambipuji", "Semboro", "Silo", "Sukorambi",
            "Sukowono", "Sumberbaru", "Sumberjambe", "Sumbersari", "Tanggul", "Tempurejo", "Umbulsari", "Wuluhan"
        ];

        foreach ($kecamatanJember as $namaKec) {
            Kecamatan::create([
                'nama' => $namaKec
            ]);
        }
    }
}
