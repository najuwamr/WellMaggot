<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotodePengiriman extends Model
{
    use HasFactory;
    protected $table = "metodePengiriman";

    protected $fillable =[
        'jenis_pengiriman'
    ];
}
