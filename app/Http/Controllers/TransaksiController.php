<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Kecamatan;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $transaksiList = Transaksi::all();
        // $transaksiList = Transaksi::with('detailTransaksi.produk', 'metodePengiriman', 'pembayaran')
        //                     ->where('users_id', $userId)
        //                     ->orderBy('created_at', 'desc')
        //                     ->get();

        return view('transaksi', compact('transaksiList'));
    }

    // public function CancelOrder($request)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api-sandbox.collaborator.komerce.id/order/api/v1/orders/cancel',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'PUT',
    //         CURLOPT_POSTFIELDS => '{"order_no": "KOM20230607178649"}',
    //         CURLOPT_HTTPHEADER => array(
    //             'x-api-key: ENV.'
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     echo $response;
    // }


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

        $snapToken = null; // <-- Tambahkan ini untuk mencegah error

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

    // public function createTransaction(Request $request)
    // {
    //     $request->validate([
    //         'total' => 'required|numeric',
    //         'alamat_id' => 'nullable|exists:alamat,id',
    //     ]);

    //     $user = Auth::user();
    //     $userId = $user->id;

    //     $alamat = Alamat::find($request->alamat_id);

    //     if (!$alamat) {
    //         return back()->withErrors(['Alamat tidak ditemukan.']);
    //     }

    //     $keranjangList = Keranjang::with('produk')->where('user_id', $userId)->get();

    //     // Buat detail transaksi (belum disimpan ke DB di tahap ini)
    //     $items = [];
    //     foreach ($keranjangList as $item) {
    //         $items[] = [
    //             'id' => $item->produk->id,
    //             'price' => $item->produk->harga,
    //             'quantity' => $item->jumlah_produk,
    //             'name' => $item->produk->nama_produk,
    //         ];
    //     }

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => 'ORDER-' . uniqid(),
    //             'gross_amount' => $request->total,
    //         ],
    //         'item_details' => $items,
    //         'customer_details' => [
    //             'first_name' => $user->name,
    //             'email' => $user->email,
    //             'shipping_address' => [
    //                 'address' => $alamat->detail_alamat,
    //             ],
    //         ],
    //     ];

    //     $snapToken = Snap::getSnapToken($params);

    //     return view('check-out', compact('snapToken'));
    // }

    public function createTransaction(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'detail_alamat_id' => 'required|exists:detail_alamat,id', // asumsi kamu pakai ID dari detail_alamat
        ]);

        $user = Auth::user();

        // Generate order_id
        $orderId = 'ORDER-' . uniqid();

        // Simpan transaksi ke DB
        $transaksi = Transaksi::create([
            'total_pembayaran' => $request->total,
            'tanggal_transaksi' => now()->toDateString(),
            'jenis_metode' => 'midtrans', // bisa kamu sesuaikan
            'midtrans_order_id' => $orderId,
            'status_transaksi_id' => 5, // misalnya 1 = "Pending" di tabel status_transaksi
            'detail_alamat_id' => $request->detail_alamat_id,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'shipping_address' => [
                    'address' => $transaksi->detailAlamat->alamat->jalan ?? 'Tidak ada alamat',
                ],
            ],
        ];

        // Ambil Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('check-out', compact('snapToken'));
    }
}
