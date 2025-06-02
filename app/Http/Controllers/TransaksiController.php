<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\DetTransaksi;
use App\Models\Kecamatan;
use App\Models\Keranjang;
use App\Models\StatusTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Midtrans\Snap;
use Midtrans\Config;

class TransaksiController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        $userId = Auth::id();
        $statusList = StatusTransaksi::all();
        $transaksiList = Transaksi::all();
        $transaksiUserList = Transaksi::whereHas('detailAlamat', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with([
                'detailAlamat.alamat.kecamatan',
                'detailTransaksi.produk',
                'status'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($transaksiUserList->pluck('detailAlamat'));


        $user = auth()->user();
        if ($user->role_id === 1) {
            return view('transaksi-admin', compact('transaksiList', 'statusList'));
        } else {
            return view('transaksi-user', compact('transaksiUserList',));
        }
    }


    public function checkout()
    {
        $userId = Auth::id();
        $keranjangList = Keranjang::with('produk')->where('user_id', $userId)->get();
        $totalHarga = 0;
        foreach ($keranjangList as $item) {
            $totalHarga += $item->produk->harga * $item->jumlah_produk;
        }

        $alamatList = DetailAlamat::with('alamat')
            ->where('user_id', $userId)
            ->get();

        $kecamatanList = Kecamatan::all();

        $snapToken = null;
        $snapToken = session('snapToken');

        return view('check-out', compact('keranjangList', 'totalHarga', 'alamatList', 'kecamatanList', 'snapToken'));
    }


    public function alamatBaru(Request $request)
    {
        $request->validate([
            'jalan' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
        ]);

        $alamat = Alamat::create([
            'jalan' => $request->jalan,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        DetailAlamat::create([
            'user_id' => Auth::id(),
            'alamat_id' => $alamat->id,
        ]);

        return redirect()->route('checkout')->with('success', 'Alamat baru berhasil disimpan.');
    }

    public function createTransaction(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'detail_alamat_id' => 'required|exists:detail_alamat,id',
        ]);

        $user = Auth::user();
        $userId = $user->id;

        $keranjangList = Keranjang::with('produk')->where('user_id', $userId)->get();

        if ($keranjangList->isEmpty()) {
            return response()->json(['error' => 'Keranjang kosong.'], 400);
        }

        $orderId = 'ORDER-' . uniqid();

        $transaksi = Transaksi::create([
            'total_pembayaran' => $request->total,
            'tanggal_transaksi' => now()->toDateString(),
            'jenis_metode' => 'midtrans',
            'midtrans_order_id' => $orderId,
            'status_transaksi_id' => 5,
            'detail_alamat_id' => $request->detail_alamat_id,
        ]);

        foreach ($keranjangList as $item) {
            DetTransaksi::create([
                'produk_id' => $item->produk->id,
                'transaksi_id' => $transaksi->id,
            ]);

            $produk = $item->produk;
            $produk->stok -= $item->jumlah_produk;
            $produk->save();
        }

        // Keranjang::where('user_id', $userId)->delete();

        $items = $keranjangList->map(function ($item) {
            return [
                'id' => $item->produk->id,
                'price' => $item->produk->harga,
                'quantity' => $item->jumlah_produk,
                'name' => $item->produk->nama_produk,
            ];
        })->toArray();

        $alamat = DetailAlamat::with('alamat')->find($request->detail_alamat_id);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'shipping_address' => [
                    'address' => $alamat->detail_alamat . ', ' . ($alamat->alamat->jalan ?? ''),
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with(['detailAlamat.alamat.kecamatan', 'detailTransaksi.produk', 'status'])
            ->findOrFail($id);

        return response()->json([
            'midtrans_order_id' => $transaksi->midtrans_order_id ?? '-',
            'tanggal' => \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y'),
            'total' => number_format($transaksi->total_pembayaran, 0, ',', '.'),
            'status' => $transaksi->status->status ?? '-',
            'alamat' => ($transaksi->detailAlamat->alamat->jalan ?? '-') . ', ' . ($transaksi->detailAlamat->alamat->kecamatan->nama ?? '-'),
            'produk' => $transaksi->detailTransaksi->map(fn($d) => $d->produk->nama_produk ?? 'Produk tidak ditemukan'),
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:status_transaksi,id',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi_id = $request->status_id;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diubah.');
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $transaksi = Transaksi::find($request->midtrans_order_id);
                $transaksi -> update(['status' => 'Dibayar']);
            }
        }
    }
}
