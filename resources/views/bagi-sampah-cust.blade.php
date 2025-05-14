<x-app-layout>
    <div class="flex min-h-screen">
        <main class="flex-1 p-6 md:p-10 bg-cover bg-center" style="background-image: url('{{ asset('assets/bagi-sampah.png') }}');">



            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Kiri: daftar penjadwalan --}}
                <div class="flex-1 space-y-4">
                    @forelse ($penjadwalanList as $item)
                        <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
                            <div class="space-y-1">
                                <h2 class="font-bold text-[#B9C240] text-lg">{{ $item->tanggal }} - {{ $item->waktu }}</h2>
                                <p class="text-sm text-gray-600">Berat: {{ $item->total_berat }} kg</p>
                                <p class="text-sm text-gray-600">Metode: {{ $item->metodePengambilan->nama }}</p>
                                <p class="text-sm text-gray-600">Alamat: {{ $item->detailAlamat->jalan }}, {{ $item->detailAlamat->kecamatan }}</p>
                            </div>
                            <img src="{{ $item->gambar }}" alt="Gambar" class="w-20 h-20 rounded object-cover">
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl shadow-2xl flex items-center justify-center px-2 w-full min-h-[500px] text-center text-gray-500">
                            Belum ada penjadwalan sampah yang diajukan.
                        </div>
                    @endforelse
                </div>

                {{-- Kanan: form ajukan sampah baru --}}
                <div class="w-full lg:w-1/3 bg-white p-6 rounded-xl shadow-2xl space-y-4">
                    <h3 class="text-lg font-semibold text-center text-black">Ajukan Sampah Baru</h3>

                    <form action="{{ route('bagi-sampah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <select name="metode_pengambilan_id" class="mt-1 w-full border rounded-lg p-2">
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
                            <input type="number" name="total_berat" min="0.01" max="100" step="0.01" class="mt-1 w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Metode Pengambilan</label>
                            <select name="metode_pengambilan_id" class="mt-1 w-full border rounded-lg p-2">
                                @foreach ($metodeList as $metode)
                                    <option value="{{ $metode->id }}">{{ $metode->metode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pilih Alamat</label>
                            {{-- <select name="detail_alamat_id" class="mt-1 w-full border rounded-lg p-2">
                                @foreach ($alamatList as $alamat)
                                    <option value="{{ $alamat->id }}">{{ $alamat->jalan }} - {{ $alamat->kecamatan }}</option>
                                @endforeach
                            </select> --}}
                            {{-- <a href="{{ route('alamat.create') }}" class="text-blue-600 text-sm hover:underline mt-1 inline-block">
                                Tambah Alamat Baru
                            </a> --}}
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Sampah</label>
                            <!-- Tombol trigger modal -->
                            <button type="button"
                                    onclick="toggleModal(true)"
                                    class="mt-1 w-full min-h-[200px] bg-gray-100 flex justify-center items-center gap-3 rounded-lg p-2 hover:bg-gray-200 text-left">
                                Ambil Gambar<i data-feather="camera"></i>
                            </button>

                            <!-- Input hidden untuk simpan base64 -->
                            <input type="hidden" name="gambar" class="image-tag">

                            <!-- Preview gambar -->
                            <div id="preview-container" class="mt-2"></div>
                        </div>

                        <button type="submit" class="w-full bg-amber-500 text-white py-2 rounded-lg hover:bg-lime-500 hover:font-bold font-semibold duration-500">
                            Kirim Pengajuan
                        </button>
                    </form>
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
</x-app-layout>
