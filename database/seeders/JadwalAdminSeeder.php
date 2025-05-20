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
            ['tanggal' => '2025-05-23', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-24', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-05-25', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-06-01', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-06-02', 'created_at' => now(), 'updated_at' => now()],
            ['tanggal' => '2025-06-03', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
