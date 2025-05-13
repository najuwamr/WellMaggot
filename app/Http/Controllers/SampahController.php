<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $penjadwalanList = Penjadwalan::with(['metodePengambilan', 'detailAlamat'])
            ->whereHas('detailAlamat', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        return view('bagi-sampah-cust', compact('penjadwalanList'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'total_berat' => 'required|numeric|min:1',
            'image' => 'required|string',
            'metode_pengambilan_id' => 'required|exists:metode_pengambilan,id',
            'detail_alamat_id' => 'required|exists:detail_alamat,id',
        ]);

        // Proses base64 gambar
        $image = $request->image;
        $imageParts = explode(";base64,", $image);
        $imageType = explode("/", $imageParts[0])[1];
        $imageBase64 = base64_decode($imageParts[1]);

        $imageName = uniqid() . '.' . $imageType;
        $path = public_path('storage/images/' . $imageName);
        file_put_contents($path, $imageBase64);

        // Simpan data ke database
        Penjadwalan::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'total_berat' => $request->total_berat,
            'gambar' => $imageName,
            'metode_pengambilan_id' => $request->metode_pengambilan_id,
            'detail_alamat_id' => $request->detail_alamat_id,
        ]);

        return redirect()->back()->with('success', 'Pengajuan penjadwalan berhasil disimpan.');
    }

}
