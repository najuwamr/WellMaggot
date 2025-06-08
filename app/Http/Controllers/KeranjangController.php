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

        // Keranjang dari transaksi gagal/ditunda
        $keranjangList = Keranjang::with(['produk.detailTransaksi.transaksi.status' => function ($query) {
            $query->whereIn('status', ['ditunda', 'gagal']);
        }])
        ->where('user_id', $userId)
        ->whereHas('produk.detailTransaksi.transaksi.status', function ($query) {
            $query->whereIn('status', ['ditunda', 'gagal']);
        })
        ->get();

        // Keranjang yang belum masuk transaksi
        $keranjangBaru = Keranjang::with('produk')
            ->where('user_id', $userId)
            ->whereDoesntHave('produk.detailTransaksi.transaksi.status', function ($query) {
                $query->whereIn('status', ['ditunda', 'gagal']);
            })
            ->get();

        // Gabungkan dan kelompokkan berdasarkan produk_id
        $gabungan = collect();

        foreach ($keranjangList->merge($keranjangBaru) as $item) {
            $existing = $gabungan->firstWhere('produk_id', $item->produk_id);

            if ($existing) {
                $existing->jumlah_produk += $item->jumlah_produk;
            } else {
                $gabungan->push($item);
            }
        }

        // Hitung total harga
        $totalHarga = $gabungan->sum(function ($item) {
            return $item->produk->harga * $item->jumlah_produk;
        });

        $gabungan = $gabungan->filter(fn($item) => $item->jumlah_produk > 0)->values();

        return view('keranjang', [
            'keranjangGabungan' => $gabungan,
            'totalHarga' => $totalHarga,
        ]);
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

    public function hapus($id)
    {
        $userId = Auth::id();
        Keranjang::where('id', $id)->where('user_id', $userId)->delete();

        return redirect()->back();
    }


}
