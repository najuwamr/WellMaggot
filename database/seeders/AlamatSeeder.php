<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = Kecamatan::get()->first();
        // $detail_alamat = DetailAlamat::get()->first();

        Alamat::create([
            'jalan' => 'Jl. Mastrip No. 100',
            'kecamatan_id' => $kecamatan->id
        ]);
    }
}
