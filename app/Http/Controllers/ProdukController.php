<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::where('stok', '>', 0)->get();

        return view('produkUser', compact('produkList'));
    }
}
