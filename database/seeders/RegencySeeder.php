<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsis = [
            ['nama' => 'Provinsi A'],
            ['nama' => 'Provinsi B'],
            ['nama' => 'Provinsi C'],
        ];

        foreach ($provinsis as $provData) {
            $provinsi = Provinsi::create($provData);

            for ($i = 1; $i <= 2; $i++) {
                $kabupaten = Kabupaten::create([
                    'nama' => $provData['nama'] . ' - Kabupaten ' . $i,
                    'provinsi_id' => $provinsi->id,
                ]);

                for ($j = 1; $j <= 2; $j++) {
                    Kecamatan::create([
                        'nama' => $kabupaten->nama . ' - Kecamatan ' . $j,
                        'kabupaten_id' => $kabupaten->id,
                    ]);
                }
            }
        }
    }
}
