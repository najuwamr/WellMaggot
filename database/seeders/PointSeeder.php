<?php

namespace Database\Seeders;

use App\Models\Point;
use App\Models\Sembako;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $sembako = Sembako::first();

        if ($user && $sembako) {
            Point::create([
                'user_id' => $user->id,
                'sembako_id' => $sembako->id,
            ]);
        }
    }
}
