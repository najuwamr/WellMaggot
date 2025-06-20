@section('title', 'Checkout')
<x-app-layout>
    <div class="p-6 bg-white rounded-md shadow-2xl">
        <h1 class="text-2xl font-bold text-[#B9C240] mb-4">Checkout</h1>

        <ul class="space-y-2">
            @foreach ($keranjangList as $item)
                <li class="flex justify-between border-b pb-2">
                    <span>{{ $item->produk->nama_produk }} (x{{ $item->jumlah_produk }})</span>
                    <span>Rp. {{ number_format($item->produk->harga * $item->jumlah_produk, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>

        {{-- Rincian Total --}}
        <div class="mt-6 space-y-1 text-md">
            <div class="flex justify-between">
                <span class="font-semibold">Subtotal:</span>
                <span>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Biaya Penanganan:</span>
                <span>Rp. {{ number_format($biayaPenanganan, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-lg font-bold border-t pt-2 mt-2">
                <span>Total:</span>
                <span>Rp. {{ number_format($totalAkhir, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Form Pembayaran --}}
        <div class="mt-6">
            <form id="payment-form" action="{{ route('payment') }}" method="POST">
                @csrf
                {{-- Pilih Alamat --}}
                <div class="mt-4 mb-4">
                    <label for="alamat_id" class="block font-semibold text-gray-700 mb-2">Pilih Alamat Pengiriman</label>
                    <select name="alamat_id" id="alamat_id" required class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="">-- Pilih Alamat --</option>
                        @foreach ($alamatList as $detail)
                            <option value="{{ $detail->id }}">
                                {{ $detail->detail_alamat }} {{ $detail->alamat->jalan ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                <input type="hidden" name="total" id="total" value="{{ $totalAkhir }}">

                <button id="btn-bayar" type="button" class="bg-[#B9C240] text-white px-4 py-2 rounded-lg hover:bg-lime-800">
                    Bayar Sekarang
                </button>
            </form>

            {{-- Modal Tambah Alamat Baru --}}
            <div class="mt-4">
                <x-modal-alamat-baru :kecamatanList="$kecamatanList" />
            </div>
        </div>
    </div>

    {{-- Wave Transition --}}
    <div class="-mt-1">
        <img src="{{ asset('assets/wave1.svg') }}" alt="Wave Transition" class="w-full" />
    </div>

    {{-- Script untuk proses pembayaran --}}
    <script>
        document.getElementById('btn-bayar').addEventListener('click', function (e) {
            e.preventDefault();

            const alamatSelect = document.getElementById('alamat_id');
            const alamatId = alamatSelect.value;
            const total = document.getElementById('total')?.value;
            const token = document.getElementById('csrf_token')?.value;

            if (!alamatId || !total || !token) {
                alert("Lengkapi data alamat dan total terlebih dahulu.");
                return;
            }

            fetch("{{ route('payment') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    detail_alamat_id: alamatId,
                    total: total
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            alert("Pembayaran berhasil!");
                            window.location.href = "/transaksi";
                        },
                        onPending: function (result) {
                            alert("Menunggu pembayaran!");
                            window.location.href = "/transaksi";
                        },
                        onError: function (result) {
                            alert("Pembayaran gagal!");
                            console.error(result);
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran.");
                }
            })
            .catch(error => {
                console.error("Terjadi kesalahan:", error);
            });
        });
    </script>
</x-app-layout>
