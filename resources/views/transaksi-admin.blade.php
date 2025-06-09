<x-app-layout>
    <div class="container mx-auto mt-12 p-6 rounded-2xl shadow-lg border bg-amber-50 border-amber-300">
        <h1 class="text-4xl font-extrabold text-amber-600 mb-8 flex items-center gap-2">
            <span class="text-3xl">📦</span> Daftar Transaksi
        </h1>

        <div class="bg-white rounded-2xl shadow-lg border border-amber-300 p-4 overflow-x-auto">
            <table id="transaksiTable" class="min-w-full divide-y divide-amber-300 text-sm">
                <thead class="bg-orange-600 text-white uppercase text-left text-sm tracking-wider">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Order ID</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                        <th class="px-4 py-3 flex items-center">Catatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-amber-100">
                    @forelse ($transaksiList as $index => $transaksi)
                        <tr class="hover:bg-amber-50 transition-colors">
                            <td class="px-4 py-3 font-semibold text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $transaksi->midtrans_order_id ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('H:i:s') }}</td>
                            <td class="px-4 py-3 font-semibold text-amber-600">Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($transaksi->status->status == 'selesai') bg-green-100 text-green-700
                                    @elseif($transaksi->status->status == 'dikirim') bg-green-100 text-green-700
                                    @elseif($transaksi->status->status == 'ditunda') bg-yellow-100 text-yellow-700
                                    @elseif($transaksi->status->status == 'gagal') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ strtolower($transaksi->status->status ?? '-') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center space-y-2">
                                {{-- Shaf atas: batal & edit --}}
                                <div class="flex justify-center gap-2">
                                    @php
                                        $status = strtolower($transaksi->status->status ?? '');
                                        $bisaDibatalkan = \Carbon\Carbon::parse($transaksi->created_at)->addMinutes(30)->isPast();
                                        $isDitunda = $status === 'ditunda';
                                        $batalDisabled = !$bisaDibatalkan || !$isDitunda;
                                    @endphp

                                    @if(!in_array($status, ['gagal', 'selesai', 'dikirim']))
                                        {{-- Tombol Batal --}}
                                        <button type="button"
                                            data-modal-target="modal-batal-{{ $transaksi->id }}"
                                            class="text-red-500 hover:text-red-700 disabled:opacity-40 disabled:cursor-not-allowed"
                                            title="Batalkan"
                                            @if($batalDisabled) disabled @endif>
                                            <i data-feather="x-circle"></i>
                                        </button>
                                        {{-- Modal Konfirmasi Batal --}}
                                        <div id="modal-batal-{{ $transaksi->id }}" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 px-4">
                                            <div class="bg-white rounded-3xl shadow-xl max-w-md w-full p-6 relative animate-fade-in-down">
                                                <button data-close-modal class="absolute top-3 right-4 text-gray-600 hover:text-red-500 text-3xl font-bold">&times;</button>
                                                <h3 class="text-xl font-semibold text-red-600 mb-4 border-b pb-2">Konfirmasi Pembatalan</h3>

                                                <form action="{{ route('transaksi.batalkan', $transaksi->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Alasan Pembatalan</label>
                                                        <textarea name="catatan" rows="3" required
                                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500"
                                                            placeholder="Contoh: Pembeli tidak melakukan pembayaran dalam waktu yang ditentukan."></textarea>
                                                    </div>
                                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white rounded-lg py-2 text-sm">
                                                        Batalkan Transaksi
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Icon edit status --}}
                                        <button type="button"
                                            data-modal-target="modal-edit-{{ $transaksi->id }}"
                                            class="w-5 h-5 mt-0.5 aspect-square flex items-center justify-center rounded-full ring-2 ring-emerald-600 text-emerald-600 hover:ring-emerald-700 transition"
                                            title="Edit Status">
                                            <i data-feather="edit-3" class="w-3 h-3"></i>
                                        </button>

                                        {{-- Modal Edit Status --}}
                                        <div id="modal-edit-{{ $transaksi->id }}" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50 px-4">
                                            <div class="bg-white rounded-3xl shadow-xl max-w-md w-full p-6 relative animate-fade-in-down">
                                                <button data-close-modal class="absolute top-3 right-4 text-gray-600 hover:text-red-500 text-3xl font-bold">&times;</button>
                                                <h3 class="text-xl font-semibold text-emerald-600 mb-4 border-b pb-2">Ubah Status Transaksi</h3>

                                                <form action="{{ route('transaksi.updateStatus', $transaksi->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status_id" class="w-full border rounded-lg px-3 py-2 text-sm text-gray-700">
                                                        @foreach($statusList as $status)
                                                            <option value="{{ $status->id }}" {{ $transaksi->status_transaksi_id == $status->id ? 'selected' : '' }}>
                                                                {{ ucfirst($status->status) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="mt-4 w-full bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg py-2 text-sm">
                                                        Simpan
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                                {{-- Shaf bawah: tombol detail --}}
                                <button data-modal-target="modal-{{ $transaksi->id }}"
                                    class="mt-2 px-3 py-1 bg-amber-500 text-white text-sm rounded-lg hover:bg-amber-600 transition">
                                    Lihat Detail
                                </button>
                            </td>
                            <td class="px-4 py-3 text-gray-600 whitespace-normal break-words max-w-xs">
                                {{ $transaksi->catatan ?? '-' }}
                            </td>
                        </tr>

                        {{-- Modal Detail --}}
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
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center px-6 py-6 text-gray-400 italic">Tidak ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Animasi --}}
    <style>
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.3s ease-out;
        }
    </style>

    {{-- Feather Icons + Modal Script + DataTables --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();

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
                lengthMenu: [5, 10, 25, 50],
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
                columnDefs: [{ orderable: false, targets: [6, 7] }],
                responsive: true,
                autoWidth: false,
            });

            $('div.dataTables_length select').addClass('w-24 px-3 py-1 rounded-lg border border-gray-300');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-dropdown-target]').forEach(button => {
                button.addEventListener('click', () => {
                    const dropdownId = button.getAttribute('data-dropdown-target');
                    const dropdown = document.getElementById(dropdownId);
                    dropdown.classList.toggle('hidden');
                });
            });

            // Klik di luar untuk menutup semua dropdown
            document.addEventListener('click', (e) => {
                if (!e.target.closest('[data-dropdown-target]') && !e.target.closest('form')) {
                    document.querySelectorAll('[id^="status-dropdown-"]').forEach(d => d.classList.add('hidden'));
                }
            });
        });
    </script>
</x-app-layout>
