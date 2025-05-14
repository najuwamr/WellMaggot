<?php

use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WebcamController;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('beranda');

// Route::get('/get-kabupaten/{provinsi_id}', function ($provinsi_id) {
//     return Kabupaten::where('provinsi_id', $provinsi_id)->get();
// });

// Route::get('/get-kecamatan/{kabupaten_id}', function ($kabupaten_id) {
//     return Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
// });

Route::get('/dashboard', function () {
    return view('dashboardUser');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/edukasi', [PointController::class, 'index'])->name('edukasi.index');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/bagi-sampah', [SampahController::class, 'index'])->name('bagi-sampah.index');
    Route::get('/jadwal-sampah', [SampahController::class, 'ambilSampah'])->name('ambil-sampah.index');
    // routes/web.php
    Route::post('/alamat-baru', [TransaksiController::class, 'alamatBaru'])->name('alamat.baru');
    Route::post('/alamat-baru', [SampahController::class, 'alamatBaru'])->name('alamat.new');

    Route::get('/dashboardUser', [HomeController::class, 'dashboardUser'])->name('dashboardUser');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{produkId}', [KeranjangController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/stok/tambah/{keranjangId}', [KeranjangController::class, 'tambahStok'])->name('keranjang.stok.tambah');
    Route::post('/keranjang/stok/kurang/{keranjangId}', [KeranjangController::class, 'kurangStok'])->name('keranjang.stok.kurang');
    Route::delete('/keranjang/hapus/{produkId}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    // Route::post('/transaksi/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');
    Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
    Route::get('webcam', [WebcamController::class, 'index']);
    Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

    Route::post('bagi-sampah', [SampahController::class, 'store'])->name('bagi-sampah.store');
    // Route::post('/penjemputan', [JadwalAdminContriller]);

    // Route::put('/produk-cancel-order', [EdukasiController::class, 'CancelOrder'])->name('produk.cancel');
    Route::post('/payment', [TransaksiController::class, 'createTransaction'])->name('payment');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/produk/spaymenttore', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
});

require __DIR__ . '/auth.php';
