<x-app-layout>
    <div class="flex min-h-screen">
        <main class="flex-1 p-6 md:p-10">
            <h1 class="text-3xl font-bold text-[#B9C240] mb-6 flex items-center gap-2">
                Keranjang <i data-feather="shopping-cart"></i>
            </h1>

            <div class="flex flex-col lg:flex-row gap-6">
                <div class="flex-1 space-y-4">
                    @php
                        $totalHarga = 0;
                    @endphp

                    @forelse ($keranjangList as $item)
                        @php
                            $totalHarga += $item->produk->harga * $item->jumlah_produk;
                        @endphp

                        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/images/' . ($item->produk->gambar ?? 'default.png')) }}"
                                     class="w-16 h-16 object-cover rounded-md" alt="{{ $item->produk->nama }}">
                                <div>
                                    <h2 class="font-bold text-[#B9C240]">{{ $item->produk->nama_produk }}</h2>
                                    <p class="text-gray-500 text-sm">Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center border border-gray-300 rounded-full px-2">
                                    <form action="{{ route('keranjang.stok.kurang', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-1 text-[#B9C240] font-bold">-</button>
                                    </form>
                                    <span class="px-2">{{ $item->jumlah_produk }}</span>
                                    <form action="{{ route('keranjang.stok.tambah', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-1 text-[#B9C240] font-bold">+</button>
                                    </form>
                                </div>
                                <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700" type="submit">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Keranjang kamu masih kosong.</p>
                    @endforelse
                </div>

                <div class="w-full lg:w-1/3 bg-white p-4 rounded-xl shadow space-y-4">
                    <h3 class="text-lg font-bold text-[#B9C240]">Ringkasan belanja</h3>

                    <div class="flex justify-between font-bold text-gray-800">
                        <span>Total</span>
                        <span id="total-harga">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('checkout') }}" method="GET">
                        @csrf
                        <button class="w-full bg-[#B9C240] text-white py-2 rounded-lg hover:bg-lime-800 font-semibold">
                            Lanjut ke Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        feather.replace();
    </script>
</x-app-layout>
