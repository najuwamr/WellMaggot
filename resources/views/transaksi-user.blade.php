<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Transaksi</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded shadow">
                <thead>
                    <tr class="bg-amber-500 text-white">
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Order ID</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Alamat</th>
                        <th class="px-4 py-3 text-left">Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksiUserList as $index => $transaksi)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $transaksi->midtrans_order_id ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $transaksi->status->status ?? 'Tidak diketahui' }}</td>
                            <td class="px-4 py-2">
                                {{ $transaksi->detailAlamat->alamat->jalan ?? '-' }}, {{ $transaksi->detailAlamat->alamat->kecamatan->nama ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                <ul class="list-disc ml-4">
                                    @foreach ($transaksi->detailTransaksi as $detail)
                                        <li>{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">Tidak ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
