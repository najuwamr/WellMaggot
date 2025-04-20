<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePengiriman extends Model
{
    use HasFactory;
    protected $table = "metode_pengiriman";

    protected $fillable = ['kurir'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
