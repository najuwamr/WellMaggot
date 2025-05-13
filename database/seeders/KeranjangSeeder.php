<?php

namespace Database\Seeders;

use App\Models\Keranjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keranjang::create([
            'user_id' => 2,
            'produk_id' => 1,
            'jumlah_produk' => 2,
        ]);
    }
}
