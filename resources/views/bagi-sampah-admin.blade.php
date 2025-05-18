<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <main class="flex-1 p-6 md:p-10 bg-cover bg-center" style="background-image: url('{{ asset('assets/bagi-sampah.png') }}');">
            <div class="flex flex-col lg:flex-row gap-10">
                {{-- Tabel Jadwal Admin --}}
                <div class="flex-1 bg-white rounded-xl shadow-lg p-6 max-h-[600px] overflow-auto">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Jadwal Admin</h2>
                    <table class="min-w-full border-collapse border border-gray-300">
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

                    <script>
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
                            onChange: function(selectedDates, dateStr, instance) {
                                const formattedDates = selectedDates.map(d => instance.formatDate(d, "Y-m-d"));
                                instance.input.value = formattedDates.join(", ");
                            }
                        });
                    </script>
                </div>
            </div>

            {{-- Daftar Penjadwalan --}}
            <div class="mt-12 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Jadwal Pengambilan Sampah</h2>
                <div class="space-y-6 max-h-[600px] overflow-y-auto">
                    @forelse ($penjadwalanAll as $item)
                        <div class="flex justify-between items-center bg-green-50 rounded-lg p-4 shadow-sm hover:shadow-md transition duration-300">
                            <div class="space-y-1">
                                <h3 class="font-bold text-green-700 text-lg">{{ \Carbon\Carbon::parse($item->jadwalAdmin->tanggal)->format('d M Y') }}</h3>
                                <p class="text-gray-600 text-sm">Berat: <span class="font-semibold">{{ $item->total_berat }} kg</span></p>
                                <p class="text-gray-600 text-sm">Metode: <span class="font-semibold">{{ $item->metodePengambilan->metode }}</span></p>
                                <p class="text-gray-600 text-sm">Alamat: <span class="font-semibold">{{ $item->detailAlamat->alamat->jalan ?? '-' }}, {{ $item->detailAlamat->alamat->kecamatan->nama ?? '-' }}</span></p>
                            </div>
                            <img src="{{ asset($item->gambar) }}" alt="Gambar" class="w-24 h-24 rounded-lg object-cover shadow-md">
                        </div>
                    @empty
                        <p class="text-center text-gray-500 italic py-10">Belum ada penjadwalan sampah yang diajukan.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
