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
        $userList = [
            [
                'name' => 'User Test',
                'email' => 'user@test.com',
                'password' => Hash::make('userpassword'),
                'nomor_hp' => '089876543210',
                'point' => 500,
                'role_id' => '2',
            ],
            [
                'name' => 'Admin Test',
                'email' => 'admin@test.com',
                'password' => Hash::make('password'),
                'nomor_hp' => '081234567890',
                'role_id' => '1',
            ],
            [
                'name' => 'Ken',
                'email' => 'Kenuser@test.com',
                'password' => Hash::make('kenpassword'),
                'nomor_hp' => '089876543210',
                'point' => 500,
                'role_id' => '2',
            ],

        ];

        foreach ($userList as $user) {
            User::create($user);
        }
    }
}
