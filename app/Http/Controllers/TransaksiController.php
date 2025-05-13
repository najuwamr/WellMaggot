<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
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

        $transaksiList = Transaksi::with('detailTransaksi.produk', 'metodePengiriman', 'pembayaran')
                            ->where('users_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('transaksi.index', compact('transaksiList'));
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
            $alamatList = Alamat::where('user_id', $userId)->get();

            $totalHarga = 0;
            foreach ($keranjangList as $item) {
                $totalHarga += $item->produk->harga * $item->jumlah_produk;
            }

            return view('check-out', compact('keranjangList', 'totalHarga', 'alamatList'));
        }

    public function createTransaction(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'alamat_id' => 'nullable|exists:alamat,id',
            'alamat_baru' => 'nullable|string',
        ]);

        $alamat = null;

        if ($request->filled('alamat_baru')) {
            $alamatBaru = Alamat::create([
                'user_id' => Auth::id(),
                'detail_alamat' => $request->alamat_baru,
            ]);
            $alamat = $alamatBaru->alamat;
        } elseif ($request->filled('alamat_id')) {
            $alamatObj = Alamat::find($request->alamat_id);
            $alamat = $alamatObj ? $alamatObj->detail_alamat : 'Alamat tidak ditemukan';        }

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'shipping_address' => [
                    'address' => $alamat ?? 'Alamat tidak tersedia',
                ],
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('pembayaran', compact('snapToken'));
    }

}
