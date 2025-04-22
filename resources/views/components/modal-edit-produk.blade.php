<div
  x-show="modalEditProduk_{{ $produk->id }}"
  x-transition
  x-cloak
  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
>
  <div
    x-data="{
      preview: '{{ $produk->gambar ? asset('images/' . $produk->gambar) : '' }}'
    }"
    @click.outside="modalEditProduk_{{ $produk->id }} = false"
    class="bg-white rounded-2xl shadow-lg w-[700px] p-8 flex gap-6"
  >

    <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data" class="flex gap-6 w-full">
      @csrf
      @method('PUT')

      <div class="w-1/3 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4 relative">
        <label class="cursor-pointer flex flex-col items-center gap-2">

          <template x-if="!preview">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12" />
            </svg>
          </template>

          <template x-if="preview">
            <img :src="preview" class="w-full h-auto rounded-lg object-cover" />
          </template>

          <input
            type="file"
            class="hidden"
            name="gambar"
            accept="image/*"
            @change="
              const file = $event.target.files[0];
              if (file) {
                const reader = new FileReader();
                reader.onload = (e) => preview = e.target.result;
                reader.readAsDataURL(file);
              }
            "
          />
          <span class="text-sm text-gray-500">Ubah gambar</span>
        </label>
      </div>

      <div class="w-2/3 space-y-4">
        <input type="text" name="nama_produk" placeholder="Nama produk"
          value="{{ old('nama_produk', $produk->nama_produk) }}" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2" />

        <textarea name="deskripsi" placeholder="Deskripsi" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 resize-none h-24">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

        <div class="flex items-center gap-2">
          <input type="number" name="stok" placeholder="Jumlah stok"
            value="{{ old('stok', $produk->stok) }}" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2" />
          <span class="text-sm text-[#B9C240] font-semibold">(Stocks)</span>
        </div>

        <input type="number" name="harga" placeholder="Harga"
          value="{{ old('harga', $produk->harga) }}" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2" />

        <div class="flex justify-end gap-4 pt-4">
          <button type="button" @click="modalEditProduk_{{ $produk->id }} = false"
            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Batal</button>
          <button type="submit" class="bg-lime-500 text-white px-4 py-2 rounded-lg hover:bg-lime-600">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
