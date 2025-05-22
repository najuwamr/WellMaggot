<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <main class="flex-1 p-6 md:p-10 bg-cover bg-center" style="background-image: url('{{ asset('assets/bagi-sampah.png') }}');">
            <div class="flex flex-col lg:flex-row gap-10">
                {{-- Tabel Jadwal Admin --}}
                <div class="flex-1 bg-white rounded-xl shadow-lg p-6 max-h-[600px] overflow-auto">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Jadwal Admin</h2>
                    <table id="jadwalTable" class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-green-200">
                            <tr>
                                <th class="border border-gray-300 px-5 py-3 text-left text-gray-700 font-medium">Tanggal</th>
                                <th class="border border-gray-300 px-5 py-3 text-left text-gray-700 font-medium">Jumlah Pengambilan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwalDenganJumlah as $jadwal)
                                <tr class="hover:bg-green-50">
                                    <td class="border border-gray-300 px-5 py-2">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                                    <td class="border border-gray-300 px-5 py-2">{{ $jadwal->jumlah_pengambilan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="border border-gray-300 px-5 py-4 text-center text-gray-400 italic">Belum ada jadwal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Form Pilih Tanggal --}}
                <div class="w-full lg:w-1/3 bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Tambah Jadwal Baru</h2>

                    <form method="POST" action="{{ route('jadwal-sampah.store') }}">
                        @csrf
                        <label for="tanggal" class="block mb-2 font-medium text-gray-700">Pilih Tanggal Jadwal:</label>
                        <input type="text" id="tanggal" name="tanggal" class="form-control w-full rounded border border-gray-300 p-2 mb-4 cursor-pointer" readonly>

                        @error('tanggal')
                            <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded transition duration-300">Simpan Jadwal</button>
                    </form>
                </div>
            </div>

            {{-- Daftar Penjadwalan --}}
            <div class="mt-12 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Jadwal Pengambilan Sampah</h2>

                {{-- Filter Status --}}
                <div class="mb-4">
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700">Filter Status:</label>
                    <select id="statusFilter" class="mt-1 block w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        <option value="Belum Diklaim">Belum Diklaim</option>
                        <option value="Sudah Diklaim">Sudah Diklaim</option>
                        <option value="">Semua</option>
                    </select>
                </div>

                <div class="overflow-x-auto">
                    <table id="penjadwalanTable" class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-green-200">
                            <tr>
                                <th class="border px-4 py-2">Tanggal</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Berat</th>
                                <th class="border px-4 py-2">Metode</th>
                                <th class="border px-4 py-2">Alamat</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Ubah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjadwalanAll as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->jadwalAdmin->tanggal)->format('d M Y') }}</td>
                                    <td class="border px-4 py-2">{{ $item->detailAlamat->user->name }} </td>
                                    <td class="border px-4 py-2">{{ $item->total_berat }} kg</td>
                                    <td class="border px-4 py-2">{{ $item->metodePengambilan->metode }}</td>
                                    <td class="border px-4 py-2">
                                        {{ $item->detailAlamat->alamat->jalan ?? '-' }},
                                        {{ $item->detailAlamat->alamat->kecamatan->nama ?? '-' }}
                                    </td>
                                    <td class="border px-4 py-2 font-semibold">
                                        @if ($item->status == 1)
                                            <span class="text-green-600">Sudah Diklaim</span>
                                        @else
                                            <span class="text-yellow-600">Belum Diklaim</span>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        @if ($item->status == 0)
                                            <button
                                                data-id="{{ $item->id }}"
                                                data-berat="{{ $item->total_berat }}"
                                                data-user="{{ $item->detailAlamat->user_id }}"
                                                class="btn-setujui bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">
                                                Konfirmasi Penjadwalan
                                            </button>
                                        @else
                                            <span class="text-gray-400 text-sm italic">Sudah diklaim</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('components.modal-setujui')
            </div>

        </main>
    </div>

    <script>
        // === Modal Setujui ===
        const modal = document.getElementById('modalSetujui');
        const beratSpan = document.getElementById('modal-berat');
        const poinSpan = document.getElementById('modal-poin');
        const poinInput = document.getElementById('modal-poin-input');
        const penjadwalanInput = document.getElementById('modal-penjadwalan-id');
        const userInput = document.getElementById('modal-user-id');

        document.querySelectorAll('.btn-setujui').forEach(button => {
            button.addEventListener('click', () => {
                const berat = button.dataset.berat;
                const userId = button.dataset.user;
                const penjadwalanId = button.dataset.id;

                beratSpan.textContent = berat;
                poinSpan.textContent = berat;
                poinInput.value = berat;
                penjadwalanInput.value = penjadwalanId;
                userInput.value = userId;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        document.getElementById('btn-batal').addEventListener('click', () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });
    </script>

    <script>
        // === Flatpickr ===
        const tanggalTerpakai = @json($tanggalTerpakai ?? []);
        const hariIni = new Date().toISOString().split('T')[0];

        flatpickr("#tanggal", {
            mode: "multiple",
            dateFormat: "Y-m-d",
            inline: true,
            disable: [
                ...tanggalTerpakai,
                {
                    from: "1970-01-01",
                    to: hariIni
                }
            ],
            onChange: function (selectedDates, dateStr, instance) {
                const formattedDates = selectedDates.map(d => instance.formatDate(d, "Y-m-d"));
                instance.input.value = formattedDates.join(", ");
            }
        });
    </script>

    <script>
        // === DataTables untuk dua tabel ===
        $(document).ready(function () {
            // Tabel Jadwal Admin
            $('#jadwalTable').DataTable({
                pageLength: 5,
                lengthChange: false,
                language: {
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "→",
                        previous: "←"
                    },
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ jadwal"
                }
            });

            // Tabel Penjadwalan Sampah + Filter Status
            const penjadwalanTable = $('#penjadwalanTable').DataTable({
                pageLength: 5,
                lengthChange: false,
                language: {
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "→",
                        previous: "←"
                    },
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
                }
            });

            // Filter Status (kolom ke-5 = status)
            $('#statusFilter').on('change', function () {
                const status = $(this).val();
                penjadwalanTable.column(4).search(status).draw();
            });
        });
    </script>

</x-app-layout>
