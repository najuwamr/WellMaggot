<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAdmin extends Model
{
    use HasFactory;
    protected $table = "jadwal_admin";

    protected $fillable =[
        'tanggal',
        'waktu'
    ];
}
