<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat provinsi
        $jatim = Provinsi::create(['nama' => 'Jawa Timur']);
        $diy = Provinsi::create(['nama' => 'DI Yogyakarta']);

        // Tambah kabupaten dan kecamatan Jawa Timur
        $kabupatenJatim = [
            'Jember' => [
                'Ajung', 'Ambulu', 'Arjasa', 'Balung', 'Bangsalsari',
                'Gumukmas', 'Jelbuk', 'Jenggawah', 'Jombang', 'Kalisat',
            ],
            'Malang' => [
                'Lowokwaru', 'Klojen', 'Sukun', 'Blimbing', 'Kedungkandang',
            ],
            'Surabaya' => [
                'Tegalsari', 'Rungkut', 'Sukolilo', 'Wonokromo', 'Tambaksari',
            ],
        ];

        foreach ($kabupatenJatim as $namaKab => $kecamatans) {
            $kabupaten = Kabupaten::create([
                'nama' => $namaKab,
                'provinsi_id' => $jatim->id,
            ]);

            foreach ($kecamatans as $namaKec) {
                Kecamatan::create([
                    'nama' => $namaKec,
                    'kabupaten_id' => $kabupaten->id,
                ]);
            }
        }

        // Tambah kabupaten dan kecamatan DI Yogyakarta
        $kabupatenDIY = [
            'Kota Yogyakarta' => [
                'Gondokusuman', 'Jetis', 'Danurejan', 'Gedongtengen', 'Tegalrejo',
            ],
            'Bantul' => [
                'Kasihan', 'Pajangan', 'Banguntapan', 'Sewon', 'Pleret',
            ],
            'Sleman' => [
                'Depok', 'Ngaglik', 'Mlati', 'Berbah', 'Kalasan',
            ],
            'Gunungkidul' => [
                'Wonosari', 'Semanu', 'Karangmojo', 'Playen', 'Paliyan',
            ],
            'Kulon Progo' => [
                'Wates', 'Pengasih', 'Lendah', 'Sentolo', 'Galur',
            ],
        ];

        foreach ($kabupatenDIY as $namaKab => $kecamatans) {
            $kabupaten = Kabupaten::create([
                'nama' => $namaKab,
                'provinsi_id' => $diy->id,
            ]);

            foreach ($kecamatans as $namaKec) {
                Kecamatan::create([
                    'nama' => $namaKec,
                    'kabupaten_id' => $kabupaten->id,
                ]);
            }
        }
    }
}
