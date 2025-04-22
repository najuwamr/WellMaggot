<div
    x-show="modalDetailProduk_{{ $produk->id }}"
    x-transition
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
    x-cloak
>
    <div @click.outside="modalDetailProduk_{{ $produk->id }} = false"
        class="bg-white rounded-2xl shadow-lg w-[700px] p-8 flex gap-6 relative">

        <button @click="modalDetailProduk_{{ $produk->id }} = false"
            class="absolute top-4 right-4 text-red-600 hover:text-red-800">✖</button>

        <div class="w-1/2">
            <img src="{{ asset('images/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                class="w-full h-48 object-cover rounded-lg" />
        </div>

        <div class="w-1/2 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-[#B9C240]">{{ $produk->nama_produk }}</h2>
                <p class="mt-2 text-gray-600">{{ $produk->deskripsi }}</p>
                <p class="mt-4 font-semibold text-lg text-[#B9C240]">{{ $produk->stok }} kg (Stocks)</p>
                <p class="text-2xl font-bold text-[#B9C240] mt-2">Rp. {{ number_format($produk->harga, 0, ',', '.') }}/kg</p>
            </div>

            <form method="POST" action="{{ route('keranjang.tambah', $produk->id) }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="bg-[#B9C240] hover:bg-lime-800 text-white w-full py-2 rounded-lg mt-4">
                    Tambahkan ke Keranjang 🛒
                </button>
            </form>
        </div>

    </div>
</div>
