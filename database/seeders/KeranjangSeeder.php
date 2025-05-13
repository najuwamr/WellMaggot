<?php

namespace Database\Seeders;

use App\Models\Keranjang;
use Illuminate\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    public function run()
    {
        Keranjang::create([
            'user_id' => 2,
            'produk_id' => 1,
            'jumlah_produk' => 2,
        ]);
    }
}
