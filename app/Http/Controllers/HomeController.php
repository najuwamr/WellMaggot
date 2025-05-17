<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;


class HomeController extends Controller
{
    public function dashboardUser()
    {
        return view('dashboardUser');
    }

    public function index()
    {
        $produkList = Produk::all();
        $produkListActive = Produk::where('stok', '>', 0)->get();
        $user = auth()->user();

        return view('index', compact('produkListActive'));

    }
}
