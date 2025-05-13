<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjadwalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodeIds = DB::table('metode_pengambilan')->pluck('id')->toArray();
        $jadwalIds = DB::table('jadwal_admin')->pluck('id')->toArray();
        $alamatIds = DB::table('detail_alamat')->pluck('id')->toArray();

        for ($i = 0; $i < 3; $i++) {
            DB::table('penjadwalan')->insert([
                'total_berat' => rand(1, 10) * 5,
                'gambar' => 'gambar'.($i+1).'.jpg',
                'metode_pengambilan_id' => $metodeIds[array_rand($metodeIds)],
                'detail_alamat_id' => $alamatIds[array_rand($alamatIds)],
                'jadwal_admin_id' => $jadwalIds[array_rand($jadwalIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
