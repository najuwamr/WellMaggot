<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id === 1) {
            return view('point-admin',);
        } else {
            $totalPoint = $user->point;

            // Hitung total berat dari semua penjadwalan user ini
            $totalBerat = DB::table('penjadwalan')
                ->join('detail_alamat', 'penjadwalan.detail_alamat_id', '=', 'detail_alamat.id')
                ->where('detail_alamat.user_id', $user->id)
                ->sum('penjadwalan.total_berat');

            return view('point-user', compact('totalPoint', 'totalBerat'));
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

}
