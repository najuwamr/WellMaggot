<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "produk";

    protected $fillable =[
        'nama_produk',
        'deksripsi',
        'harga',
        'gambar',
        'stok'
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetTransaksi::class);
    }
}
