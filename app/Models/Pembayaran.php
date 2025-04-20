<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = [
        'transaksi_id', 'midtrans_order_id',
        'midtrans_tr_id', 'payment_type',
        'status', 'gross_amount', 'paid_at'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
