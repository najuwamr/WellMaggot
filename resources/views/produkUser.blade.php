<x-app-layout>
    <div class="min-h-screen flex flex-col justify-center items-center p-8 bg-gray-50">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
            @foreach ($produkListActive as $produk)
                <div x-data="{ modalDetailProduk_{{ $produk->id }}: false }"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden w-[22rem]">

                    <img src="{{ asset('storage/images/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                        class="w-full h-56 object-cover" />

                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-[#B9C240] mb-2">
                            {{ $produk->nama_produk }}
                        </h3>

                        <div class="flex items-center justify-center text-[#B9C240] mb-4">
                            <p class="text-lg font-bold">
                                Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <span class="text-sm ml-1">
                                / {{ $produk->satuan ?? 'kg' }}
                            </span>
                        </div>

                        <button @click="modalDetailProduk_{{ $produk->id }} = true"
                            class="bg-amber-500 text-white font-semibold hover:bg-white hover:text-amber-500 border hover:border-amber-500 py-2 px-5 rounded-lg transition duration-300">
                            Detail Produk
                        </button>

                        @include('components.modal-detail-produk', ['produk' => $produk])
                    </div>
                </div>
            @endforeach
        </div>

        <div class="w-full max-w-sm mt-10">
            <a href="{{ route('keranjang.index') }}">
                <button
                    class="bg-amber-500 hover:bg-white hover:text-amber-500 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 w-full">
                    Keranjang
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
