<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['role' => 'admin']);
        Role::create(['role' => 'pelanggan']);
    }
}
