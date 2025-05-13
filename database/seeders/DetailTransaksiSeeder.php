<?php

namespace Database\Seeders;
use App\Models\DetailTransaksi;
use App\Models\DetTransaksi;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    public function run()
    {
        DetTransaksi::create([
            'transaksi_id' => 1,
            'produk_id' => 1,
        ]);
    }
}
