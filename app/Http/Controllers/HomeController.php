<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;

class HomeController extends Controller
{
    public function showDashboard()
    {
        $user = auth()->user();
        if ($user->role_id === 1)
        {
            $totalTransaksi = Transaksi::sum('total_pembayaran');
            $totalUser = User::where('role_id', 2)->count();
            $totalOrder = Transaksi::count();

            $transaksiBerhasil = Transaksi::where('status_transaksi_id', 1)->get();

            $bulan = collect(range(0, 11))->map(function ($i) {
                return now()->subMonths($i)->format('Y-m');
            })->reverse();

            $totalTransaksiPerBulan = $bulan->map(function ($bulanKey) {
                return Transaksi::where('status_transaksi_id', 1)
                    ->whereYear('created_at', substr($bulanKey, 0, 4))
                    ->whereMonth('created_at', substr($bulanKey, 5, 2))
                    ->sum('total_pembayaran');
            })->values();

            $totalKgBagiSampah = Penjadwalan::sum('total_berat');
            $countSelesai = Penjadwalan::where('status', 1)->count();
            $countBelumSelesai = Penjadwalan::where('status', 0)->count();

            return view('dashboard-admin', compact(
                'totalTransaksi',
                'totalUser',
                'totalOrder',
                'transaksiBerhasil',
                'totalKgBagiSampah',
                'countSelesai',
                'countBelumSelesai',
                'totalTransaksiPerBulan'
            ));
        } else {
            return view('dashboardUser');
        }
    }


    public function index()
    {
        $produkList = Produk::all();
        $produkListActive = Produk::where('stok', '>', 0)->get();
        $user = auth()->user();

        return view('index', compact('produkListActive'));

    }
}
