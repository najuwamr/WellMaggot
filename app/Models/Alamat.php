<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $table = "alamat";

    protected $fillable =[
        'detail_alamat',
        'kecamatan_id'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
