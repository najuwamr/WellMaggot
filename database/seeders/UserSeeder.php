<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alamat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $alamat = Alamat::first();

        User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567890',
            'role_id' => '1',
            'alamat_id' => $alamat->id,
        ]);
    }
}
