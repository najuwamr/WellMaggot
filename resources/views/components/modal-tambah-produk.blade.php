    <div
    x-show="modalTambahProduk"
    x-transition
    x-data="{ preview: null }"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
    >
    <div
        @click.outside="modalTambahProduk = false"
        class="bg-white rounded-2xl shadow-lg w-[700px] p-8 flex gap-6"
    >
        <form
        method="POST"
        action="{{ route('produk.store') }}"
        enctype="multipart/form-data"
        class="flex gap-6 w-full"
        >
        @csrf

        <!-- Upload Gambar -->
        <div class="w-1/3 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4 relative">
            <label class="cursor-pointer flex flex-col items-center gap-2">
            <!-- Preview Gambar -->
            <template x-if="!preview">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12" />
                </svg>
            </template>

            <template x-if="preview">
                <img :src="preview" class="w-full h-auto rounded-lg object-cover" />
            </template>

            <input
                type="file"
                name="gambar"
                id="gambar"
                accept="image/*"
                class="hidden"
                @change="
                const file = $event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => preview = e.target.result;
                    reader.readAsDataURL(file);
                } else {
                    preview = null;
                }
                "
            />
            <span class="text-sm text-gray-500">Unggah gambar</span>
            </label>
        </div>

        <!-- Form Data -->
        <div class="w-2/3 space-y-4">
            <!-- Nama Produk -->
            <div>
            <label class="block mb-1">Nama Produk</label>
            <input
                type="text"
                name="nama_produk"
                placeholder="Nama produk"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-green-400"
            />
            </div>

            <!-- Deskripsi -->
            <div>
            <label class="block mb-1">Deskripsi</label>
            <textarea
                name="deskripsi"
                placeholder="Deskripsi"
                rows="2"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-green-400"
            ></textarea>
            </div>

            <!-- Stok -->
            <div>
            <label class="block mb-1">Stok</label>
            <div class="flex items-center gap-2">
                <input
                type="number"
                name="stok"
                placeholder="Jumlah stok"
                required
                class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-green-400"
                />
                <span class="font-medium text-sm">(Kg)</span>
            </div>
            </div>

            <!-- Harga -->
            <div>
            <label class="block mb-1">Harga</label>
            <input
                type="number"
                name="harga"
                placeholder="Harga"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-green-400"
            />
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4">
            <button
                type="button"
                @click="modalTambahProduk = false"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md"
            >
                Batal
            </button>
            <button
                type="submit"
                class="bg-[#B9C240] hover:bg-lime-800 text-white px-4 py-2 rounded-md"
            >
                Simpan
            </button>
            </div>
        </div>
        </form>
    </div>
    </div>
