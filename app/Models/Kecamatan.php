<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = "kecamatan";

    protected $fillable =[
        'nama',
        'kabupaten_id'
    ];

    public function alamat()
    {
        return $this->hasMany(Alamat::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }


}
