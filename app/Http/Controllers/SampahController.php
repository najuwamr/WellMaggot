<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function index()
    {
        return view('bagi-sampah');
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'upload_gambar' => 'required|string',
        //     'alamat' => 'required|numeric|min:0',
        //     'stok' => 'required|integer|min:0',
        //     'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        // if ($request->hasFile('gambar')) {
        //     $file = $request->file('gambar');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('storage/images'), $filename);
        //     $validatedData['gambar'] = $filename;
        // }

        // Produk::create($validatedData);

        // return redirect()->route('produk.index')->with('success', 'added');

    }
}
