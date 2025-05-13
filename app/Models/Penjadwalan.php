<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $table = "penjadwalan";

    protected $fillable =[
        'total_berat',
        'gambar',
        'metode_pengambilan_id',
        'detail_alamat_id',
        'jadwal_admin_id',
    ];

    public function metodePengambilan()
    {
        return $this->belongsTo(MetodePengambilan::class);
    }

    public function detailAlamat()
    {
        return $this->belongsTo(DetailAlamat::class);
    }

    public function jadwalAdmin()
    {
        return $this->belongsTo(JadwalAdmin::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, DetailAlamat::class, 'id', 'id', 'detail_alamat_id', 'user_id');
    }
}
