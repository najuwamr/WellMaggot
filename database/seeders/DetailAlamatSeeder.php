<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alamat;
use App\Models\DetailAlamat;
use Illuminate\Database\Seeder;

class DetailAlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();     // Ambil user pertama
        $alamat = Alamat::first(); // Ambil alamat pertama

        if ($user && $alamat) {
            DetailAlamat::create([
                'user_id' => $user->id,
                'alamat_id' => $alamat->id,
            ]);
        }
    }
}
