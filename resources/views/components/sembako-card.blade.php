<div x-data="{ openEdit: false }" class="relative bg-white rounded-2xl shadow-md overflow-hidden">
    <!-- Gambar -->
    <img src="{{ asset('storage/images/' . ($sembako->gambar ?: 'wellmaggot.png')) }}"
        alt="{{ $sembako->nama }}"
        class="w-full h-40 object-contain"
        onerror="this.onerror=null;this.src='{{ asset('storage/images/WellMaggot.png') }}';" />

    <!-- Info Produk -->
    <div class="p-4 text-center">
        <h3 class="text-lg font-semibold text-amber-500 mb-2">{{ $sembako->nama }}</h3>
        <p class="text-md font-bold text-amber-500">Poin: {{ $sembako->poin_harga }}</p>
        <p class="text-md font-bold text-amber-500">Rp {{ number_format($sembako->nilai_rupiah, 0, ',', '.') }}</p>
        <div class="flex justify-center mt-4">
            @if ($sembako->isActive == 0)
                <form action="{{ route('sembako.restore', $sembako->id) }}" method="POST"
                    class="inline-block"
                    onsubmit="return confirm('Yakin ingin mengaktifkan produk ini?')">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                        <i data-feather="refresh-cw" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Pulihkan</span>
                    </button>
                </form>
            @else
                <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
                    <form action="{{ route('sembako.destroy', $sembako->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menonaktifkan produk ini? Anda dapat memulihkannya nanti.')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="flex items-center gap-2 text-red-600 hover:text-white border border-red-600 px-4 py-2 rounded-md hover:bg-red-600 transition">
                            <i data-feather="trash-2" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Nonaktifkan</span>
                        </button>
                    </form>
                    <button @click="openEdit = true"
                        class="flex items-center gap-2 bg-amber-500 text-white px-4 py-2 rounded-md hover:bg-amber-600 transition">
                        <i data-feather="edit-2" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Edit</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Edit -->
    <div x-show="openEdit"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            x-cloak
            @click.away="openEdit = false">
        <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full" @click.stop>
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit Data Sembako</h2>
            <form action="{{ route('sembako.update', $sembako->id) }}" method="POST" enctype="multipart/form-data" x-data="{
                preview: '{{ asset('assets/' . ($sembako->gambar ?: 'wellmaggot.png')) }}',
                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = e => this.preview = e.target.result;
                        reader.readAsDataURL(file);
                    }
                }
            }">
                @csrf
                @method('PUT')

                <!-- Preview Gambar -->
                <div class="mb-4 text-left">
                    <label class="block text-sm text-gray-700 mb-1">Gambar</label>
                    <img :src="preview" alt="Preview Gambar" class="w-full h-40 object-contain rounded border mb-2">
                    <input type="file" name="gambar" accept="image/*"
                        @change="updatePreview"
                        class="w-full border rounded p-2">
                </div>

                <!-- Nama -->
                <div class="mb-4 text-left">
                    <label class="block text-sm text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ $sembako->nama }}" class="w-full border rounded p-2 mt-1">
                </div>

                <!-- Poin Harga -->
                <div class="mb-4 text-left">
                    <label class="block text-sm text-gray-700">Poin Harga</label>
                    <input type="number" name="poin_harga" value="{{ $sembako->poin_harga }}" class="w-full border rounded p-2 mt-1">
                </div>

                <!-- Nilai Rupiah -->
                <div class="mb-4 text-left">
                    <label class="block text-sm text-gray-700">Nilai Rupiah</label>
                    <input type="number" name="nilai_rupiah" value="{{ $sembako->nilai_rupiah }}" class="w-full border rounded p-2 mt-1">
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-2">
                    <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-700">
                        Simpan
                    </button>
                    <button type="button" @click="openEdit = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
