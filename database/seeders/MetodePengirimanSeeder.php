<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MetodePengiriman;

class MetodePengirimanSeeder extends Seeder
{
    public function run()
    {
        MetodePengiriman::create(['kurir' => 'JNE']);
        MetodePengiriman::create(['kurir' => 'JNT']);
        MetodePengiriman::create(['kurir' => 'SiCepat']);
    }
}
