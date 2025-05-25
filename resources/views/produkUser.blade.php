<x-app-layout>
    <div class="flex flex-col m-8 justify-center items-center">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($produkListActive as $produk)
                <div x-data="{ modalDetailProduk_{{ $produk->id }}: false }"
                    class="bg-white rounded-2xl shadow-md overflow-hidden w-full max-w-xs mx-auto">

                    <img src="{{ asset('assets/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
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
                                class="bg-amber-500 text-white font-semibold hover:bg-white hover:text-amber-500 py-1 px-4 rounded-lg transition duration-500">
                                Detail Produk
                            </button>

                            @include('components.modal-detail-produk', ['produk' => $produk])
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- Masih di dalam grid --}}



        </div>
        <div class="rounded-2xl items-start overflow-hidden w-full max-w-xs mx-auto ">
            <div class="p-10 text-start">
                <a href="{{ route('keranjang.index') }}">
                    <button
                        class="bg-amber-500 hover:bg-white hover:text-amber-500 text-white font-semibold py-2 px-4 rounded-lg transition duration-500 w-full">
                        Keranjang
                    </button>
                </a>
            </div>
        </div>
    </div>


    </div>
</x-app-layout>
