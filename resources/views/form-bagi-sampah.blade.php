@section('title', 'Buat Jadwal Baru')

<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold text-chartreuse mb-4">Buat Jadwal Baru</h2>

        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                <input type="text" name="nama" required class="w-full border-gray-300 rounded p-2" />
            </div>

            <!-- Tombol ke Webcam -->
            <div class="mb-4">
                <a href="{{ route('webcam.index') }}"
                   class="inline-block bg-chartreuse text-white px-4 py-2 rounded hover:bg-lime-800">
                    Buka Kamera & Ambil Foto
                </a>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Alamat</label>
                <select name="alamat_id" class="w-full border-gray-300 rounded p-2">
                    @foreach ($alamatList as $alamat)
                        <option value="{{ $alamat->id }}">{{ $alamat->detail_alamat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Atau Tambah Alamat Baru</label>
                <textarea name="alamat_baru" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Alamat baru (jika ingin menambahkan)"></textarea>
            </div>

            <!-- Berat -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Total Berat (kg)</label>
                <input type="number" name="berat" id="berat" step="0.1" required class="w-full border-gray-300 rounded p-2" onchange="checkBerat()" />
                <p id="berat-msg" class="text-red-500 text-sm hidden mt-1">Penjemputan hanya tersedia untuk berat minimal 3 kg.</p>
            </div>

            <!-- Tanggal -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal & Waktu Penjemputan</label>
                <input type="datetime-local" name="jadwal" required class="w-full border-gray-300 rounded p-2" />
            </div>

            <button type="submit" class="bg-chartreuse text-white px-4 py-2 rounded hover:bg-lime-800">
                Kirim Jadwal
            </button>
        </form>
    </div>

    <script>
        function checkBerat() {
            const berat = parseFloat(document.getElementById('berat').value);
            const msg = document.getElementById('berat-msg');
            berat < 3 ? msg.classList.remove('hidden') : msg.classList.add('hidden');
        }
    </script>
</x-app-layout>
