<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailAlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $alamat = Alamat::first();

        if ($user && $alamat) {
            DetailAlamat::create([
                'user_id' => $user->id,
                'alamat_id' => $alamat->id,
            ]);
        }
    }
}
