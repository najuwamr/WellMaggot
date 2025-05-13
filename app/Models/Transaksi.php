<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'detail_alamat_id',
        'total_pembayaran',
        'tanggal_transaksi',
        'status_transaksi_id',
        'midtrans_order_id',
        'midtrans_tr_id',
        'jenis_metode'
    ];

    public function detailAlamat()
    {
        return $this->belongsTo(DetailAlamat::class, 'users_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusTransaksi::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetTransaksi::class);
    }
}

