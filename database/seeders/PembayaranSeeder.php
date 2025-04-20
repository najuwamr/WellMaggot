<?php
namespace Database\Seeders;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::create([
            // 'transaksi_id' => 1,
            'midtrans_order_id' => 'INV-TEST001',
            'midtrans_tr_id' => 'TRX-MID-001',
            'payment_type' => 'bank_transfer',
            'status' => 'diterima',
            'gross_amount' => 59000,
            'paid_at' => now(),
        ]);
    }
}
