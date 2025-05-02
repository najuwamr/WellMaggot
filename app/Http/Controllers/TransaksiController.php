<?php

namespace App\Http\Controllers;

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


    public function createTransaction(Request $request)
    {
        $userId = Auth::id();

        $keranjangList = Keranjang::with('produk')->where('user_id', $userId)->get();

        $totalHarga = 0;
        foreach ($keranjangList as $item) {
            $totalHarga += $item->produk->harga * $item->jumlah_produk;
        }

        $orderId = 'ORDER-' . time(); // Gunakan ID unik
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name ?? 'Customer',
                'email' => Auth::user()->email ?? 'noemail@example.com',
            ],
            // Optional: tambahkan item details agar terlihat di dashboard Midtrans
            'item_details' => $keranjangList->map(function ($item) {
                return [
                    'id' => $item->produk->id,
                    'price' => $item->produk->harga,
                    'quantity' => $item->jumlah_produk,
                    'name' => $item->produk->nama_produk,
                ];
            })->toArray(),
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('pembayaran', compact('snapToken'));
    }
}

