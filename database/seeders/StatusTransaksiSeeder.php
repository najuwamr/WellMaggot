<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusTransaksi;

class StatusTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['selesai', 'diproses', 'dikirim', 'dibayar', 'ditunda', 'gagal'];

        foreach ($statuses as $status) {
            StatusTransaksi::create([
                'status' => $status
            ]);
        }
    }
}
