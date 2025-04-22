<x-app-layout>
    <div class="flex m-8 space-x-4">
        <div class="w-5/6">
            <div class="py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($produkList as $produk)
                        <div x-data="{ modalEditProduk_{{ $produk->id }}: false }" class="bg-white rounded-2xl shadow-md overflow-hidden w-full max-w-xs mx-auto">
                            <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover" />
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-semibold text-[#B9C240]">{{ $produk->nama_produk }}</h3>
                                <div class="flex items-center justify-center mt-2 text-[#B9C240]">
                                    <p class="text-lg font-bold">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    <span class="text-sm ml-1">/ {{ $produk->satuan ?? 'kg' }}</span>
                                </div>
                                <div class="mt-3">
                                    <button @click="modalEditProduk_{{ $produk->id }} = true"
                                        class="bg-[#B9C240] text-white py-1 px-4 rounded-lg hover:bg-lime-800">
                                        Detail Produk
                                    </button>

                                    @include('components.modal-edit-produk', ['produk' => $produk])
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @include('components.modal-pop-up-berhasil')

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <div x-data="{ modalTambahProduk: false }">
            <button @click="modalTambahProduk = true"
                class="bg-[#B9C240] hover:bg-lime-900 text-white px-4 py-2 rounded-full">
                Tambah
            </button>

            @include('components.modal-tambah-produk')
        </div>
    </div>
</x-app-layout>
