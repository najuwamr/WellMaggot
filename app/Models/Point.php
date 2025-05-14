<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable =[
        'sembako_id',
        'user_id'
    ];

    public function sembako()
    {
        return $this->belongsTo(Sembako::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
