<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(KecamatanSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AlamatSeeder::class);
        $this->call(DetailAlamatSeeder::class);
        $this->call(KeranjangSeeder::class);
        $this->call(JadwalAdminSeeder::class);
        $this->call(MetodePengambilanSeeder::class);
        $this->call(PenjadwalanSeeder::class);
        $this->call(StatusTransaksiSeeder::class);
        $this->call(TransaksiSeeder::class);
        $this->call(DetailTransaksiSeeder::class);
        $this->call(SembakoSeeder::class);
        $this->call(PointSeeder::class);
    }
}
