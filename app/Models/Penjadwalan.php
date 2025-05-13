<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $table = "penjadwalan";

    protected $fillable =[
        'tanggal',
        'waktu',
        'total_berat', 'gambar',
        'metode_pengambilan_id',
        'detail_alamat_id',
    ];

    public function metodePengambilan()
    {
        return $this->belongsTo(MetodePengambilan::class);
    }

    public function detailAlamat()
    {
        return $this->belongsTo(detailAlamat::class);
    }
}
