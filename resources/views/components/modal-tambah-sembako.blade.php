<x-app-layout>
    <section class="py-10">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold text-amber-600 mb-6">Tambah Sembako Baru</h2>

            <form action="{{ route('sembako.store') }}" method="POST" enctype="multipart/form-data"
                  x-data="{
                      preview: '{{ asset('storage/images/WellMaggot.png') }}',
                      updatePreview(event) {
                          const file = event.target.files[0];
                          if (file) {
                              const reader = new FileReader();
                              reader.onload = e => this.preview = e.target.result;
                              reader.readAsDataURL(file);
                          }
                      }
                  }"
            >
                @csrf

                <!-- Gambar Preview -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk</label>
                    <img :src="preview" alt="Preview" class="w-full h-40 object-contain rounded border mb-2">
                    <input type="file" name="gambar" accept="image/*"
                        @change="updatePreview"
                        class="w-full border rounded p-2 file:bg-amber-500 file:text-white file:border-none file:py-1 file:px-3 file:rounded file:cursor-pointer">
                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border rounded p-2 mt-1 @error('nama') border-red-500 @enderror" required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poin Harga -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Poin Harga</label>
                    <input type="number" name="poin_harga" value="{{ old('poin_harga') }}"
                        class="w-full border rounded p-2 mt-1 @error('poin_harga') border-red-500 @enderror" required>
                    @error('poin_harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nilai Rupiah -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Nilai Rupiah</label>
                    <input type="number" name="nilai_rupiah" value="{{ old('nilai_rupiah') }}"
                        class="w-full border rounded p-2 mt-1 @error('nilai_rupiah') border-red-500 @enderror" required>
                    @error('nilai_rupiah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('point.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-amber-500 text-white rounded hover:bg-amber-600 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
