<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Point;
use App\Models\Sembako;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $sembakoList = Sembako::all();

        if ($user->role_id === 1) {
            return view('point-admin',);
        } else {
            $totalPoint = $user->point;

            $totalBerat = DB::table('penjadwalan')
                ->join('detail_alamat', 'penjadwalan.detail_alamat_id', '=', 'detail_alamat.id')
                ->where('detail_alamat.user_id', $user->id)
                ->sum('penjadwalan.total_berat');

            return view('point-user', compact('totalPoint', 'totalBerat', 'sembakoList'));
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'penjadwalan_id' => 'required|exists:penjadwalan,id',
            'user_id' => 'required|exists:users,id',
            'poin' => 'required|integer|min:1',
        ]);

        // Tambah poin ke user
        $user = User::find($request->user_id);
        $user->point += $request->poin;
        $user->save();

        $penjadwalan = Penjadwalan::findOrFail($request->penjadwalan_id);
        $penjadwalan->status = 1;
        $penjadwalan->save();

        return redirect()->back()->with('success', 'Penjadwalan telah disetujui dan poin ditambahkan.');
    }

    public function penukaran(Request $request)
    {
        $request->validate([
            'sembako_id' => 'required|exists:sembakos,id',
        ]);

        $user = Auth::user(); // Ambil user yang login
        $sembako = Sembako::findOrFail($request->sembako_id);

        // Cek apakah poin cukup
        if ($user->point < $sembako->poin_harga) {
            return redirect()->back()->with('poin_kurang', 'Poin kamu tidak cukup untuk menukar ' . $sembako->nama);
        }

        // Kurangi poin user
        $user->point -= $sembako->poin_harga;
        // dd(get_class($user));
        $user->save();

        // Simpan ke tabel points
        Point::create([
            'user_id' => $user->id,
            'sembako_id' => $sembako->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menukar ' . $sembako->nama);
    }

}
