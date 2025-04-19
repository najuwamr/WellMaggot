<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($produkList as $produk)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden w-full max-w-xs">
                    <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-full h-40 object-cover" />

                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-[#B9C240]">{{ $produk->nama }}</h3>
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
</x-app-layout>
