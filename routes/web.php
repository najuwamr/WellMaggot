<?php

use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampahController;
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
    return redirect()->route('login');
});

Route::get('/get-kabupaten/{provinsi_id}', function ($provinsi_id) {
    return Kabupaten::where('provinsi_id', $provinsi_id)->get();
});

Route::get('/get-kecamatan/{kabupaten_id}', function ($kabupaten_id) {
    return Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
});

Route::get('/dashboard', function () {
    return view('dashboardUser');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboardUser', [HomeController::class, 'dashboardUser'])->name('dashboardUser');
    Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi.index');
    Route::get('/bagi-sampah', [SampahController::class, 'index'])->name('bagi-sampah.index');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::put('/produk-cancel-order', [EdukasiController::class, 'CancelOrder'])->name('produk.cancel');
    Route::get('/keranjang', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::get('/transaksi', [ProdukController::class, 'index'])->name('transaksi.index');
});

require __DIR__ . '/auth.php';
