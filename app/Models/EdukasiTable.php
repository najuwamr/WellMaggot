<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdukasiTable extends Model
{
    use HasFactory;
    protected $table = "edukasiTable";

    protected $fillable =[
        'judul',
        'deskripsi',
        'tanggal',
        'link'
    ];
}
