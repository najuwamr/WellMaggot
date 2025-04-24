<x-app-layout>
    <div class="flex m-8 space-x-4">
        <div class="w-5/6">
            <div class="py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($produkListActive as $produk)
                        <div x-data="{ modalDetailProduk_{{ $produk->id }}: false }"
                            class="bg-white rounded-2xl shadow-md overflow-hidden w-full max-w-xs mx-auto">

                            <img src="{{ asset('storage/images/' . $produk->gambar) }}"
                                 alt="{{ $produk->nama_produk }}"
                                 class="w-full h-40 object-cover" />

                            <div class="p-4 text-center">
                                <h3 class="text-lg font-semibold text-[#B9C240]">
                                    {{ $produk->nama_produk }}
                                </h3>

                                <div class="flex items-center justify-center mt-2 text-[#B9C240]">
                                    <p class="text-lg font-bold">
                                        Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                                    </p>
                                    <span class="text-sm ml-1">
                                        / {{ $produk->satuan ?? 'kg' }}
                                    </span>
                                </div>

                                <div class="mt-3">
                                    <button @click="modalDetailProduk_{{ $produk->id }} = true"
                                        class="bg-[#B9C240] text-white py-1 px-4 rounded-lg hover:bg-lime-800 transition duration-300">
                                        Detail Produk
                                    </button>

                                    @include('components.modal-detail-produk', ['produk' => $produk])
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-1/6 flex justify-end items-start">
            <a href="{{ route('keranjang.index') }}">
                <button class="bg-[#B9C240] hover:bg-[#9da836] text-white font-semibold py-3 px-6 rounded-full transition duration-300">
                    Keranjang
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
