<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'users_id', 'metode_pengiriman_id',
        'total_harga', 'tanggal_transaksi',
        'status_transaksi', 'ongkir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function metodePengiriman()
    {
        return $this->belongsTo(MetodePengiriman::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetTransaksi::class);
    }
}

