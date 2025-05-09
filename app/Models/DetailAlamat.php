<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlamat extends Model
{
    use HasFactory;
    protected $table = "detail_alamat";

    protected $fillable =[
        'alamat_id',
        'user_id'
    ];

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class);
    }
}
