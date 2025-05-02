<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = Kecamatan::get()->first();
        $users = User::get()->first();

        Alamat::create([
            'detail_alamat' => 'Jl. Mastrip No. 100',
            'kecamatan_id' => $kecamatan->id,
            'user_id' => $users->id,
        ]);
    }
}
