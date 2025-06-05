<?php

use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BagiSampahController;
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

// Route::get('/', function () {
//     return view('index');
// })->name('beranda');


Route::get('/', [HomeController::class, 'index'])->name('beranda');


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
    // Home
    Route::get('/dashboardUser', [HomeController::class, 'dashboardUser'])->name('dashboardUser');
    // Profile
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/alamat/{id}', [ProfileController::class, 'updateAlamat'])->name('alamat.update');
    Route::delete('/alamat/{id}', [ProfileController::class, 'destroyAlamat'])->name('alamat.destroy');
    Route::post('/alamat', [ProfileController::class, 'storeAlamat'])->name('alamat.store');

    // Produk - Keranjang
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{produkId}', [KeranjangController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/stok/tambah/{keranjangId}', [KeranjangController::class, 'tambahStok'])->name('keranjang.stok.tambah');
    Route::post('/keranjang/stok/kurang/{keranjangId}', [KeranjangController::class, 'kurangStok'])->name('keranjang.stok.kurang');
    Route::delete('/keranjang/hapus/{produkId}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    // Check out - Transaksi
    Route::get('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
    Route::post('/check-out/alamat-baru', [TransaksiController::class, 'alamatBaru'])->name('alamat.baru');
    Route::post('/payment', [TransaksiController::class, 'createTransaction'])->name('payment');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'detail']);
    Route::put('/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::post('/midtrans-callback', [TransaksiController::class, 'callback']);
    // Bagi Sampah - Poin
    Route::get('/bagi-sampah', [BagiSampahController::class, 'index'])->name('bagi-sampah.index');
    Route::post('bagi-sampah', [BagiSampahController::class, 'store'])->name('bagi-sampah.store');
    // Route::get('/bagi-sampah/jadwal-sampah', [BagiSampahController::class, 'jadwalStore'])->name('ambil-sampah.index');
    Route::post('jadwal-sampah', [BagiSampahController::class, 'jadwalStore'])->name('jadwal-sampah.store');
    Route::post('/bagi-sampah/alamat-baru', [BagiSampahController::class, 'alamatNew'])->name('alamat.new');
    Route::post('/bagi-sampah/setujui', [PointController::class, 'create'])->name('penjadwalan.setujui');
    Route::post('bagi-sampah/cancel', [BagiSampahController::class, 'delete'])->name('penjadwalan.delete');
    Route::get('/point', [PointController::class, 'index'])->name('point.index');
    Route::post('/point/tukar', [PointController::class, 'penukaran'])->name('penukaran.proses');
});

require __DIR__ . '/auth.php';
