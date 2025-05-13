<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();
        $produkListActive = Produk::where('stok', '>', 0)->get();
        $user = auth()->user();

        if ($user->role_id === 1) {
            return view('produkAdmin', compact('produkList'));
        } else {
            return view('produkUser', compact('produkListActive'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images'), $filename);
            $validatedData['gambar'] = $filename;
        }

        Produk::create($validatedData);

        return redirect()->route('produk.index')->with('success', 'added');

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Data berhasil diubah');

        $produk->nama_produk = $validated['nama_produk'];
        $produk->deskripsi = $validated['deskripsi'] ?? $produk->deskripsi;
        $produk->harga = $validated['harga'];
        $produk->stok = $validated['stok'];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $oldPath = public_path('storage/images/' . $produk->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images'), $filename);
            $produk->gambar = $filename;
        }

        $produk->save();
    }

}
