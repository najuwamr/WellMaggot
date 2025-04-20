<x-app-layout>
    <div class="flex m-8 space-x-4">
        {{-- Kiri: Daftar Produk (5/6 layar) --}}
        <div class="w-5/6">
            <div class="py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($produkList as $produk)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden w-full max-w-xs mx-auto">
                            <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover" />
                            <div class="p-4 text-center">
                                <h3 class="text-lg font-semibold text-[#B9C240]">{{ $produk->nama_produk }}</h3>
                                <div class="flex items-center justify-center mt-2 text-[#B9C240]">
                                    <p class="text-lg font-bold">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    <span class="text-sm ml-1">/ {{ $produk->satuan ?? 'kg' }}</span>
                                </div>
                                <div class="mt-3">
                                    <form method="POST" action="{{ route('keranjang.tambah', $produk->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-[#B9C240] text-white rounded-full w-8 h-8 inline-flex items-center justify-center hover:bg-[#9da836]">
                                            <span class="text-xl font-bold">+</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Kanan: Tombol Keranjang (1/6 layar) --}}
        <div class="w-1/6 flex justify-end items-start">
            <a href="{{ route('keranjang.tambah') }}">
                <button class="bg-[#B9C240] hover:bg-[#9da836] text-white font-semibold py-3 px-6 rounded-full transition duration-300">
                    Keranjang
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
