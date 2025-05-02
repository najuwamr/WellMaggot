<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function tambahKeKeranjang($produkId)
    {
        $userId = Auth::id();

        $keranjang = Keranjang::where('user_id', $userId)
                            ->where('produk_id', $produkId)
                            ->first();

        if ($keranjang) {
            $keranjang->jumlah_produk += 1;
            $keranjang->save();
        } else {
            Keranjang::create([
                'user_id' => $userId,
                'produk_id' => $produkId,
                'jumlah_produk' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function index()
    {
        $userId = Auth::id();
        $keranjangList = Keranjang::with('produk')->where('user_id', $userId)->get();

        return view('keranjang', compact('keranjangList'));
    }

    public function tambahStok($keranjangId)
    {
        $item = Keranjang::findOrFail($keranjangId);
        $item->jumlah_produk += 1;
        $item->save();

        return redirect()->back();
    }

    public function kurangStok($keranjangId)
    {
        $item = Keranjang::findOrFail($keranjangId);
        if ($item->jumlah_produk > 1) {
            $item->jumlah_produk -= 1;
            $item->save();
        } else {
            $item->delete();
        }

        return redirect()->back();
    }

    public function hapus($produkId)
    {
        $userId = Auth::id();
        Keranjang::where('user_id', $userId)->where('produk_id', $produkId)->delete();

        return redirect()->back();
    }

    public function checkout()
    {
        $userId = Auth::id();
        $keranjangList = Keranjang::with('produk')->where('user_id', $userId)->get();

        $totalHarga = 0;
        foreach ($keranjangList as $item) {
            $totalHarga += $item->produk->harga * $item->jumlah_produk;
        }

        return view('check-out', compact('keranjangList', 'totalHarga'));
    }

}
