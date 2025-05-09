<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePengambilan extends Model
{
    use HasFactory;
    protected $table = "metode_pengambilan";

    protected $fillable =[
        'metode'
    ];

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class);
    }
}
