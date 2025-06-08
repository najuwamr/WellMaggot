<x-app-layout>
    <div class="py-10 px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Judul -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tukar Poin dengan Sembako</h2>

            <!-- Daftar Sembako -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($sembakoList as $sembako)
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
                            <button @click="openEdit = true"
                                class="mt-4 bg-amber-500 text-white px-12 py-2 rounded-lg hover:bg-amber-700 transition">
                                Edit
                            </button>
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
                @endforeach
            </div>

            <!-- Modal Tambah Produk -->
            <div x-data="{ openAdd: false }">
                <!-- Tombol trigger -->
                <div class="mt-8 text-center">
                    <button @click="openAdd = true"
                            class="inline-block bg-amber-500 text-white px-6 py-3 rounded-lg hover:bg-[#a1a832] transition">
                        + Tambah Sembako
                    </button>
                </div>

                <!-- Modal -->
                <div x-show="openAdd"
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                    x-cloak
                    @click.away="openAdd = false">
                    <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full" @click.stop
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
                        }">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah Sembako Baru</h2>
                        <form action="{{ route('sembako.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

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
                                <input type="text" name="nama" required class="w-full border rounded p-2 mt-1">
                            </div>

                            <!-- Poin Harga -->
                            <div class="mb-4 text-left">
                                <label class="block text-sm text-gray-700">Poin Harga</label>
                                <input type="number" name="poin_harga" required class="w-full border rounded p-2 mt-1">
                            </div>

                            <!-- Nilai Rupiah -->
                            <div class="mb-4 text-left">
                                <label class="block text-sm text-gray-700">Nilai Rupiah</label>
                                <input type="number" name="nilai_rupiah" required class="w-full border rounded p-2 mt-1">
                            </div>

                            <!-- Tombol -->
                            <div class="flex justify-end gap-2">
                                <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-700">
                                    Simpan
                                </button>
                                <button type="button" @click="openAdd = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
