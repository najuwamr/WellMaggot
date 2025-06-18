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
use Illuminate\Support\Facades\DB;

class BagiSampahController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $besok = Carbon::today()->addDay();

        if ($user->role_id === 1) {
            // Ambil semua tanggal jadwal admin yang >= hari ini (termasuk hari ini)
            $tanggalTerpakai = JadwalAdmin::pluck('tanggal')->toArray();
            $penjadwalanAll = Penjadwalan::with([
                'jadwalAdmin',
                'metodePengambilan',
                'detailAlamat.alamat.kecamatan'
            ])
            ->get();

            $jadwalDenganJumlah = JadwalAdmin::select('jadwal_admin.id', 'jadwal_admin.tanggal', DB::raw('COUNT(penjadwalan.id) as jumlah_pengambilan'))
            ->leftJoin('penjadwalan', 'penjadwalan.jadwal_admin_id', '=', 'jadwal_admin.id')
            ->whereDate('jadwal_admin.tanggal', '>=', Carbon::today())
            ->groupBy('jadwal_admin.id', 'jadwal_admin.tanggal')
            ->orderBy('jadwal_admin.tanggal')
            ->get();

            // dd($penjadwalanAll->first());

            // Kirim ke view admin
            return view('bagi-sampah-admin', compact('penjadwalanAll','tanggalTerpakai', 'jadwalDenganJumlah'));
        } else {
            // User biasa, kirim data seperti biasa
            $userId = $user->id;

            $penjadwalanList = Penjadwalan::with(['metodePengambilan', 'detailAlamat'])
                ->where('status', 0)
                ->whereHas('detailAlamat', fn($q) => $q->where('user_id', $userId))
                ->get();

            $metodeList = MetodePengambilan::all();
            $alamatList = DetailAlamat::with('alamat.kecamatan')->where('user_id', $userId)->get();
            $kecamatanList = Kecamatan::all();
            $jadwalAdminList = JadwalAdmin::whereDate('tanggal', '>=', $besok)->get();

            return view('bagi-sampah-cust', compact(
                'penjadwalanList',
                'metodeList',
                'alamatList',
                'kecamatanList',
                'jadwalAdminList'
            ));
        }
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|string'
        ], ['tanggal.required' => 'Harap pilih minimal satu tanggal.']);

        $tanggalDipilih = array_map('trim', explode(',', $request->tanggal));

        foreach ($tanggalDipilih as $tanggal) {
            JadwalAdmin::firstOrCreate(['tanggal' => $tanggal]);
        }

        return redirect()->route('bagi-sampah.index')->with('success', 'Tanggal berhasil disimpan.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_berat' => 'required|numeric|min:0.01',
            'gambar' => 'required|string',
            'metode_pengambilan_id' => 'required|exists:metode_pengambilan,id',
            'detail_alamat_id' => 'required|exists:detail_alamat,id',
            'jadwal_admin_id' => 'required|exists:jadwal_admin,id',
        ], [
            'total_berat.required' => 'Total berat harus diisi.',
            'total_berat.numeric' => 'Total berat harus berupa angka.',
            'gambar.required' => 'Gambar sampah wajib diambil.',
            'metode_pengambilan_id.required' => 'Metode pengambilan wajib dipilih.',
            'detail_alamat_id.required' => 'Alamat wajib dipilih.',
            'jadwal_admin_id.required' => 'Tanggal jadwal wajib dipilih.',
        ]);

        $image = $request->gambar;
        $imageParts = explode(";base64,", $image);
        $imageType = explode("/", $imageParts[0])[1];
        $imageBase64 = base64_decode($imageParts[1]);

        $imageName = uniqid() . '.' . $imageType;
        $path = public_path('storage/images/' . $imageName);
        file_put_contents($path, $imageBase64);

        Penjadwalan::create([
            'total_berat' => $request->total_berat,
            'gambar' => $imageName,
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

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:penjadwalan,id',
        ]);

        $penjadwalan = Penjadwalan::findOrFail($request->id);
        $penjadwalan->delete();

        return redirect()->back()->with('success', 'Penjadwalan berhasil dibatalkan.');
    }

    public function destroy($id)
    {
        $penjadwalan = Penjadwalan::findOrFail($id);

        if ($penjadwalan->status == 1) {
            return back()->with('error', 'Penjadwalan sudah diklaim dan tidak bisa dibatalkan.');
        }

        $penjadwalan->delete();

        return back()->with('success', 'Penjadwalan berhasil dibatalkan.');
    }

}
