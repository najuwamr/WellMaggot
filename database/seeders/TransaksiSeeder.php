<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
        Transaksi::create([
            'midtrans_order_id' => 'INV-TEST002',
            'midtrans_tr_id' => 'TRX-MID-002',
            'jenis_metode' => 'bank_transfer',
            'detail_alamat_id' => 1,
            'total_pembayaran' => 50000,
            'tanggal_transaksi' => now(),
            'status_transaksi_id' => 1,
        ]);
        Transaksi::create([
            'midtrans_order_id' => 'INV-TEST003',
            'midtrans_tr_id' => 'TRX-MID-001',
            'jenis_metode' => 'bank_transfer',
            'detail_alamat_id' => 1,
            'total_pembayaran' => 150000,
            'tanggal_transaksi' => now(),
            'status_transaksi_id' => 1,
        ]);
        Transaksi::create([
            'midtrans_order_id' => 'INV-TEST001',
            'midtrans_tr_id' => 'TRX-MID-001',
            'jenis_metode' => 'bank_transfer',
            'detail_alamat_id' => 1,
            'total_pembayaran' => 15000,
            'tanggal_transaksi' => now(),
            'status_transaksi_id' => 1,
        ]);
    }
}
