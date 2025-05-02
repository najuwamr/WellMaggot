<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\DetailTransaksiSeeder as SeedersDetailTransaksiSeeder;
use Database\Seeders\KeranjangSeeder as SeedersKeranjangSeeder;
use Database\Seeders\PembayaranSeeder as SeedersPembayaranSeeder;
use Database\Seeders\TransaksiSeeder as SeedersTransaksiSeeder;
use Illuminate\Database\Seeder;
use KeranjangSeeder;
use PembayaranSeeder;
use TransaksiSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RegencySeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AlamatSeeder::class);
        $this->call(SeedersKeranjangSeeder::class);
        $this->call(MetodePengirimanSeeder::class);
        $this->call(SeedersPembayaranSeeder::class);
        $this->call(SeedersTransaksiSeeder::class);
        $this->call(SeedersDetailTransaksiSeeder::class);
    }
}
