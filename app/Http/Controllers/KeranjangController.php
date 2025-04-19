<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function tambah(Request $request, Produk $produk)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$produk->id])) {
            $keranjang[$produk->id]['jumlah']++;
        } else {
            $keranjang[$produk->id] = [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $produk->harga,
                'jumlah' => 1,
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}
