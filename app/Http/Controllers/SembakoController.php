<?php

namespace App\Http\Controllers;

use App\Models\Sembako;
use Illuminate\Http\Request;

class SembakoController extends Controller
{
    // Tampilkan form tambah sembako
    public function create()
    {
        return view('components.modal-tambah-sembako');
    }

    // Simpan sembako baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nilai_rupiah' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'poin_harga' => 'required|integer|min:0',
        ]);

        $data = $request->only('nama', 'poin_harga', 'nilai_rupiah');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            $data['gambar'] = basename($path); // Simpan ke dalam $data
        } else {
            $data['gambar'] = 'WellMaggot.png'; // fallback jika ingin default gambar
        }

        Sembako::create($data);

        return redirect()->route('point.index')->with('success', 'Sembako berhasil ditambahkan.');
    }

    // Update sembako
    public function update(Request $request, Sembako $sembako)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nilai_rupiah' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'poin_harga' => 'required|integer|min:0',
        ]);

        $data = $request->only('nama', 'poin_harga', 'nilai_rupiah');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            $data['gambar'] = basename($path); // Simpan ke dalam $data
        } else {
            $data['gambar'] = 'WellMaggot.png'; // fallback jika ingin default gambar
        }

        $sembako->update($data);

        return back()->with('success', 'Data sembako berhasil diperbarui.');
    }

    // Hapus sembako
    public function destroy(Sembako $sembako)
    {
        $sembako->delete();
        return redirect()->route('sembako.index')->with('success', 'Sembako berhasil dihapus.');
    }
}
