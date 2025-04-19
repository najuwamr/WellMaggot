<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all(); // ambil semua produk dari database

        return view('produkUser', compact('produkList'));
    }

}
