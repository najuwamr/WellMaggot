<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = Kecamatan::get()->first();
        $detail_alamat = DetailAlamat::get()->first();

        Alamat::create([
            'jalan' => 'Jl. Mastrip No. 100',
            'kecamatan_id' => $kecamatan->id
        ]);
    }
}
