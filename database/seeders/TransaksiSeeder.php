<?php
namespace Database\Seeders;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        Transaksi::create([
            'midtrans_order_id' => 'INV-TEST001',
            'midtrans_tr_id' => 'TRX-MID-001',
            'jenis_metode' => 'bank_transfer',
            'detail_alamat_id' => 1,
            'total_pembayaran' => 50000,
            'tanggal_transaksi' => now(),
            'status_transaksi_id' => 1,
        ]);
    }
}
