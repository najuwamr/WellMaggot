<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produkList = [
            [
                'nama_produk' => 'Maggot',
                'deskripsi' => 'Maggot segar berkualitas tinggi untuk pakan ternak.',
                'harga' => 9000,
                'gambar' => 'maggot.jpg',
                'stok' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Bibit Maggot',
                'deskripsi' => 'Bibit maggot berkualitas tinggi.',
                'harga' => 15000,
                'gambar' => 'maggot.jpg',
                'stok' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Kasgot',
                'deskripsi' => 'Pupuk maggot berkualitas tinggi.',
                'harga' => 20000,
                'gambar' => 'maggot.jpg',
                'stok' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($produkList as $produk) {
            Produk::create($produk);
        }
    }
}
