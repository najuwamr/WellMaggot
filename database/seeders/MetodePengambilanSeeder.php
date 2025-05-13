<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePengambilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metode_pengambilan')->insert([
            ['metode' => 'diambil', 'created_at' => now(), 'updated_at' => now()],
            ['metode' => 'diantar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
