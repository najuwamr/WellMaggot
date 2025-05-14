<x-app-layout>
    <div class="flex min-h-screen">
        <main class="flex-1 p-6 md:p-10">
            <h1 class="text-3xl font-bold text-[#B9C240] mb-6 flex items-center gap-2">
                Bagi Sampah <i data-feather="refresh-cw"></i>
            </h1>

            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Kiri: daftar penjadwalan --}}
                <div class="flex-1 space-y-4">
                    @forelse ($penjadwalanList as $item)
                        <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
                            <div class="space-y-1">
                                <h2 class="font-bold text-[#B9C240] text-lg">{{ $item->jadwalAdmin->tanggal }}</h2>
                                <p class="text-sm text-gray-600">Berat: {{ $item->total_berat }} kg</p>
                                <p class="text-sm text-gray-600">Metode: {{ $item->metodePengambilan->metode }}</p>
                                <p class="text-sm text-gray-600">
                                    Alamat: {{ $item->detailAlamat->alamat->jalan ?? '-' }}, {{ $item->detailAlamat->alamat->kecamatan->nama ?? '-' }}
                                </p>
                            </div>
                            <img src="{{ $item->gambar }}" alt="Gambar" class="w-20 h-20 rounded object-cover">
                        </div>
                    @empty
                        <div class="text-gray-600">
                            Belum ada penjadwalan sampah yang diajukan.
                        </div>
                    @endforelse
                </div>

                {{-- Kanan: form ajukan sampah baru --}}
                <div class="w-full lg:w-1/3 bg-white p-6 rounded-xl shadow space-y-4">
                    <h3 class="text-lg font-bold text-[#B9C240]">Ajukan Sampah Baru</h3>

                    <form action="{{ route('bagi-sampah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <select name="jadwal_admin_id" class="mt-1 w-full border rounded-lg p-2">
                                @foreach ($jadwalAdminList as $jadwal)
                                    <option value="{{ $jadwal->id }}">{{ $jadwal->tanggal }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" class="mt-1 w-full border rounded-lg p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu</label>
                            <input type="time" name="waktu" class="mt-1 w-full border rounded-lg p-2">
                        </div>--}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Berat (,00 kg)</label>
                            <input type="number" name="total_berat" id="total_berat" min="0.01" max="100" step="0.01" class="mt-1 w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Metode Pengambilan</label>
                            <select name="metode_pengambilan_id" id="metode_pengambilan_id" class="mt-1 w-full border rounded-lg p-2">
                                <option value=""></option>
                                @foreach ($metodeList as $metode)
                                    <option value="{{ $metode->id }}" data-metode="{{ strtolower($metode->metode) }}">{{ $metode->metode }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mt-6 mb-4">
                            <label for="detail_alamat_id" class="block font-semibold text-gray-700 mb-2">Pilih Alamat</label>
                            <select name="detail_alamat_id" id="detail_alamat_id" required
                                class="w-full p-2 border border-gray-300 rounded-md">
                                @foreach ($alamatList as $detail)
                                    <option value="{{ $detail->id }}">
                                        {{ $detail->detail_alamat }} {{ $detail->alamat->jalan ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Sampah</label>
                            <!-- Tombol trigger modal -->
                            <button type="button"
                                    onclick="toggleModal(true)"
                                    class="mt-1 w-full bg-gray-100 border rounded-lg p-2 hover:bg-gray-200 text-left">
                                Ambil Gambar via Kamera
                            </button>

                            <!-- Input hidden untuk simpan base64 -->
                            <input type="hidden" name="gambar" class="image-tag">

                            <!-- Preview gambar -->
                            <div id="preview-container" class="mt-2"></div>
                        </div>

                        <button type="submit" class="w-full bg-[#B9C240] text-white py-2 rounded-lg hover:bg-lime-800 font-semibold">
                            Kirim Pengajuan
                        </button>
                    </form>
            <x-modal-alamat-bagisampah :kecamatanList="$kecamatanList" />
                </div>
            </div>
        </main>
    </div>
    @include('components.webcam-modal')

    <script>
        feather.replace();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('webcamModal');
            modal.classList.toggle('hidden', !show);

            if (show) {
                Webcam.set({
                    width: 480,
                    height: 320,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach('#my_camera');
            } else {
                Webcam.reset();
            }
        }

        function take_snapshot() {
            Webcam.snap(function (data_uri) {
                document.querySelector('.image-tag').value = data_uri;
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '" class="mx-auto rounded" />';
                document.getElementById('preview-container').innerHTML = '<img src="' + data_uri + '" class="w-32 h-32 object-cover rounded mt-2" />';
                toggleModal(false);
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const beratInput = document.getElementById('total_berat');
            const metodeSelect = document.getElementById('metode_pengambilan_id');

            beratInput.addEventListener('input', function () {
                const berat = parseFloat(this.value) || 0;

                // Tampilkan semua opsi dulu
                Array.from(metodeSelect.options).forEach(option => {
                    option.hidden = false;
                });

                if (berat < 5) {
                    Array.from(metodeSelect.options).forEach(option => {
                        if (option.dataset.metode === 'diambil') {
                            option.hidden = true;

                            // Jika opsi yang tersembunyi sedang dipilih, ganti ke yang lain
                            if (metodeSelect.value == option.value) {
                                metodeSelect.selectedIndex = 0;
                            }
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
