<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPengambilan extends Model
{
    use HasFactory;
    protected $table = "jadwalPengambilan";

    protected $fillable =[
        'tanggal',
        'waktu'
    ];
}
