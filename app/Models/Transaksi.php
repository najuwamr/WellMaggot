<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi";

    protected $fillable = [
        'total_pembayaran',
        'tanggal_transaksi',
        'jenis_metode',
        'midtrans_tr_id',
        'midtrans_order_id',
        'detail_alamat_id',
        'status_transaksi_id',
    ];

    public function detailAlamat()
    {
        return $this->belongsTo(DetailAlamat::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusTransaksi::class, 'status_transaksi_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetTransaksi::class);
    }
}
