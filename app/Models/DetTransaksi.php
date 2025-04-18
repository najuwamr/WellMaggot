<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetTransaksi extends Model
{
    use HasFactory;
    protected $table = "detTransaksi";

    protected $fillable =[
        'total_pembayaran',
        'harga'
    ];
}
