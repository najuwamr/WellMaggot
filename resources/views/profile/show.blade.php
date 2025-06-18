<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Profil Saya</h1>

        <div class="space-y-4">
            <div><strong>Nama:</strong> {{ $user->name }}</div>
            <div><strong>Email:</strong> {{ $user->email }}</div>
            <div><strong>Nomor:</strong> {{ $user->nomor_hp }}</div>

            <div>
                <div class="flex items-center justify-between">
                    <button id="toggleAlamatBtn" class="flex items-center font-semibold text-left focus:outline-none">
                        <span>Alamat</span>
                        <i id="chevronIcon" data-feather="chevron-down" class="ml-2 transition-transform duration-300"></i>
                    </button>
                </div>
                <div id="alamatList" class="mt-4 space-y-3 hidden transition-all duration-300">
                    @forelse ($alamatList as $detail)
                    <div class="bg-gray-100 p-3 rounded shadow-sm">
                        <p class="text-sm text-gray-800">
                            {{ $detail->alamat->jalan ?? 'Jalan tidak tersedia' }}<br>
                            <span class="text-gray-600">Kecamatan {{ $detail->alamat->kecamatan->nama ?? '-' }}</span>
                        </p>
                        @if ($loop->first)
                            <span class="inline-block mt-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                Alamat Utama
                            </span>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-500">Belum ada alamat yang ditambahkan.</p>
                    @endforelse
                    <button id="openModalBtn"
                        class="px-3 py-1 bg-lime-500 text-white text-sm rounded hover:bg-lime-700">
                        Tambah Alamat
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profil</a>
        </div>
    </div>

    <div id="alamatModal" class="fixed inset-0 z-50 bg-black bg-opacity-40 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Tambah Alamat Baru</h2>
            <form method="POST" action="{{ route('alamat.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="jalan" class="block text-sm font-medium text-gray-700">Jalan</label>
                    <input type="text" name="jalan" id="jalan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="kecamatan_id" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                    <select name="kecamatan_id" id="kecamatan_id" required class="mt-1 p-3 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach ($kecamatanList as $kecamatan)
                            <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeModalBtn" class="px-4 py-2 text-sm bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm bg-lime-500 text-white rounded hover:bg-lime-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();

            const toggleBtn = document.getElementById('toggleAlamatBtn');
            const alamatList = document.getElementById('alamatList');
            const chevron = document.getElementById('chevronIcon');

            toggleBtn.addEventListener('click', () => {
                alamatList.classList.toggle('hidden');
                chevron.classList.toggle('rotate-180');
            });

            const openModal = document.getElementById('openModalBtn');
            const closeModal = document.getElementById('closeModalBtn');
            const modal = document.getElementById('alamatModal');

            openModal.addEventListener('click', () => modal.classList.remove('hidden'));
            closeModal.addEventListener('click', () => modal.classList.add('hidden'));
        });
    </script>
</x-app-layout>
