<x-app-layout>
    <div class="container mx-auto mt-12 p-6 rounded-2xl shadow-lg border bg-amber-50 border-amber-300">
        <h1 class="text-4xl font-extrabol text-amber-600 mb-8 flex items-center gap-2">
            <span class="text-3xl">📦</span> Daftar Transaksi
        </h1>

        <div class="bg-white rounded-2xl shadow-lg border border-amber-300 p-4 overflow-x-auto">
            <table id="transaksiTable" class="min-w-full divide-y divide-amber-300 text-sm">
                <thead class="bg-amber-600 text-white uppercase text-left text-sm tracking-wider">
                    <tr>
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-2 py-4">Waktu</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-amber-100">
                    @forelse ($transaksiList as $index => $transaksi)
                        <tr class="hover:bg-amber-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $transaksi->midtrans_order_id ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</td>
                            <td class="px-2 py-4 text-gray-600">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('H:i:s') }}</td>
                            <td class="px-6 py-4 font-semibold text-amber-600">Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($transaksi->status->status == 'Sukses') bg-green-100 text-green-700
                                    @elseif($transaksi->status->status == 'Pending') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ $transaksi->status->status ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button data-modal-target="modal-{{ $transaksi->id }}"
                                    class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 focus:ring-2 focus:ring-amber-400 transition">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>

                        {{-- Modal --}}
                        <div id="modal-{{ $transaksi->id }}" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 px-4">
                            <div class="bg-white rounded-3xl shadow-xl max-w-xl w-full p-8 relative overflow-y-auto max-h-[90vh] animate-fade-in-down">
                                <button data-close-modal class="absolute top-4 right-4 text-gray-600 hover:text-red-500 text-3xl font-bold">&times;</button>
                                <h2 class="text-3xl font-bold text-amber-600 mb-6 border-b border-amber-300 pb-3">Detail Transaksi</h2>

                                <div class="space-y-4 text-gray-800">
                                    <p><strong>Order ID:</strong> {{ $transaksi->midtrans_order_id ?? '-' }}</p>
                                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</p>
                                    <p><strong>Nama Pemesan:</strong> {{ $transaksi->detailAlamat->user->name ?? '-' }}</p>
                                    <p><strong>Alamat Pengiriman:</strong>
                                        {{ $transaksi->detailAlamat->alamat->jalan ?? '-' }},
                                        {{ $transaksi->detailAlamat->alamat->kecamatan->nama ?? '-' }}
                                    </p>
                                    <p><strong>Produk:</strong></p>
                                    <ul class="list-disc list-inside text-gray-700">
                                        @foreach ($transaksi->detailTransaksi as $detail)
                                            <li>{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</li>
                                        @endforeach
                                    </ul>

                                    <form action="{{ route('transaksi.updateStatus', $transaksi->id) }}" method="POST" class="mt-6 space-y-3">
                                        @csrf
                                        @method('PUT')
                                        <label for="status" class="block text-sm font-semibold mb-1">Ubah Status</label>
                                        <select name="status_id" id="status"
                                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                                            @foreach ($statusList as $status)
                                                <option value="{{ $status->id }}" {{ $status->id == $transaksi->status_transaksi_id ? 'selected' : '' }}>
                                                    {{ $status->status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="w-full py-3 bg-amber-600 text-white rounded-lg font-semibold hover:bg-amber-700 transition">
                                            Simpan Perubahan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-6 py-6 text-gray-400 italic">Tidak ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.3s ease-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-modal-target]').forEach(button => {
                button.addEventListener('click', function () {
                    const target = this.getAttribute('data-modal-target');
                    document.getElementById(target).classList.remove('hidden');
                    document.getElementById(target).classList.add('flex');
                });
            });
            document.querySelectorAll('[data-close-modal]').forEach(button => {
                button.addEventListener('click', function () {
                    this.closest('div[id^="modal-"]').classList.add('hidden');
                });
            });
            $('#transaksiTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama", last: "Terakhir",
                        next: "Selanjutnya", previous: "Sebelumnya"
                    },
                    zeroRecords: "Data tidak ditemukan",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)"
                },
                columnDefs: [{ orderable: false, targets: 5 }],
                responsive: true,
                autoWidth: false,
            });
            $('div.dataTables_length select').addClass('w-24 px-3 py-1 rounded-lg border border-gray-300');
        });
    </script>
</x-app-layout>
