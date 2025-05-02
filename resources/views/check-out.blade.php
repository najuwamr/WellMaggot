<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold text-[#B9C240] mb-4">Checkout</h1>

        <ul class="space-y-2">
            @foreach ($keranjangList as $item)
                <li class="flex justify-between border-b pb-2">
                    <span>{{ $item->produk->nama_produk }} (x{{ $item->jumlah_produk }})</span>
                    <span>Rp. {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>

        <div class="mt-4 font-bold text-lg flex justify-between">
            <span>Total:</span>
            <span>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
        </div>

        <div class="mt-6">
            <form action="{{ route('payment') }}" method="GET">
                @csrf
                <!-- Tambahkan field pembayaran jika diperlukan -->
                <button class="bg-[#B9C240] text-white px-4 py-2 rounded-lg hover:bg-lime-800">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
