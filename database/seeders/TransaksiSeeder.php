<?php
namespace Database\Seeders;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        Transaksi::create([
            'users_id' => 2,
            'metode_pengiriman_id' => 1,
            'total_harga' => 50000,
            'ongkir' => 9000,
            'tanggal_transaksi' => now(),
            'status_transaksi' => 'diproses',
        ]);
    }
}
