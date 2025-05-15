<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\JadwalAdmin;
use App\Models\Kecamatan;
use App\Models\MetodePengambilan;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $besok = Carbon::today()->addDay();

        $jadwalAdminList = JadwalAdmin::whereDate('tanggal', '>=', $besok)->get();
        $metodeList = MetodePengambilan::all();
        $alamatList = DetailAlamat::with('alamat')
            ->where('user_id', $userId)
            ->get();

        $kecamatanList = Kecamatan::all();

        return view('bagi-sampah-cust', compact('penjadwalanList', 'metodeList', 'jadwalAdminList', 'alamatList', 'kecamatanList'));
    }

    // public function ambilSampah()
    // {
    //     $userId = auth()->id();

    //     $penjadwalanList = Penjadwalan::with(['metodePengambilan', 'detailAlamat'])
    //         ->whereHas('detailAlamat', function ($query) use ($userId) {
    //             $query->where('user_id', $userId);
    //         })
    //         ->get();

    //     return view('bagi-sampah-admin', compact('penjadwalanList'));
    // }


    public function store(Request $request)
    {
        $request->validate([
            'total_berat' => 'required|numeric|min:0.01',
            'gambar' => 'required|string',
            'metode_pengambilan_id' => 'required|exists:metode_pengambilan,id',
            'detail_alamat_id' => 'required|exists:detail_alamat,id',
            'jadwal_admin_id' => 'required|exists:jadwal_admin,id',
        ]);
        if ($request->total_berat < 5 && $request->metode_pengambilan_id == 2) {
            return redirect()->back()->withErrors(['metode_pengambilan_id' => 'Metode "Diantar" tidak tersedia untuk berat di bawah 5 kg.'])->withInput();
        }

        // Proses base64 gambar
        $image = $request->gambar;
        $imageParts = explode(";base64,", $image);
        $imageType = explode("/", $imageParts[0])[1];
        $imageBase64 = base64_decode($imageParts[1]);

        $imageName = uniqid() . '.' . $imageType;
        $path = public_path('storage/images/' . $imageName);
        file_put_contents($path, $imageBase64);

        // Simpan data ke database
        Penjadwalan::create([
            'total_berat' => $request->total_berat,
            'gambar' => 'storage/images/' . $imageName,
            'metode_pengambilan_id' => $request->metode_pengambilan_id,
            'detail_alamat_id' => $request->detail_alamat_id,
            'jadwal_admin_id' => $request->jadwal_admin_id,
        ]);

        return redirect()->back()->with('success', 'Pengajuan penjadwalan berhasil disimpan.');
    }

    public function alamatNew(Request $request)
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

        return redirect()->route('bagi-sampah.index')->with('success', 'Alamat baru berhasil disimpan.');
    }
}
