<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sembako extends Model
{
    use HasFactory;

    protected $fillable =[
        'nama',
        'poin_harga'
    ];

    public function point()
    {
        return $this->hasMany(Point::class);
    }
}
