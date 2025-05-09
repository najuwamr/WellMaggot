@section('title', 'Checkout')
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
            <form action="{{ route('payment') }}" method="POST">
                @csrf
                <div class="mt-6 mb-4">
                    <label for="alamat_id" class="block font-semibold text-gray-700 mb-2">Pilih Alamat Pengiriman</label>
                    <select name="alamat_id" id="alamat_id" required class="w-full p-2 border border-gray-300 rounded-md">
                        @foreach($alamatList as $alamat)
                            <option value="{{ $alamat->id }}">{{ $alamat->detail_alamat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="alamat_baru" class="block font-semibold text-gray-700 mb-2">Atau Tambah Alamat Baru</label>
                    <textarea name="alamat_baru" id="alamat_baru" rows="2"
                              class="w-full p-2 border border-gray-300 rounded-md"
                              placeholder="Kosongkan jika tidak menambah alamat baru"></textarea>
                </div>

                <input type="hidden" name="total" value="{{ $totalHarga }}">

                <button class="bg-[#B9C240] text-white px-4 py-2 rounded-lg hover:bg-lime-800">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
