<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_admin')->insert([
            ['tanggal' => '2025-05-10', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-11', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-12', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-13', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-14', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-15', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
