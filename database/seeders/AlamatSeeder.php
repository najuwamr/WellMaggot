<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = Kecamatan::get()->first();

        Alamat::create([
            'detail_alamat' => 'Jl. Mastrip No. 100',
            'kecamatan_id' => $kecamatan->id,
        ]);
    }
}
