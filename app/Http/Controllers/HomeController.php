<?php

namespace App\Http\Controllers;

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
            
            return view('dashboard-admin', compact('totalTransaksi', 'totalUser', 'totalOrder'));
        }else{
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
