<?php

namespace Database\Seeders;

use App\Models\DetTransaksi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetTransaksi::create([
            'transaksi_id' => 1,
            'produk_id' => 1,
        ]);
    }
}
