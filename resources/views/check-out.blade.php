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
                        @foreach($alamatList as $detail)
                            <option value="{{ $detail->id }}">
                                {{ $detail->detail_alamat }} {{ $detail->alamat->jalan ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="total" value="{{ $totalHarga }}">
                <button type="submit" class="bg-[#B9C240] text-white px-4 py-2 rounded-lg hover:bg-lime-800">
                    Pesan
                </button>
            </form>
            <x-modal-alamat-baru :kecamatanList="$kecamatanList" />
        </div>
    </div>

    {{-- @if ($snapToken)
    <script type="text/javascript">
        window.onload = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    console.log(result);
                    // redirect atau kirim data ke server jika perlu
                },
                onPending: function(result){
                    alert("Menunggu pembayaran!");
                    console.log(result);
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                    console.log(result);
                }
            });
        };
    </script> --}}
    {{-- @endif --}}
</x-app-layout>
