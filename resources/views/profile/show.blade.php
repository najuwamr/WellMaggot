<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Profil Saya</h1>

        <div class="space-y-4">
            <div>
                <strong>Nama:</strong> {{ $user->name }}
            </div>
            <div>
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div>
                <strong>Nomor:</strong> {{ $user->nomor_hp}}
            </div>
            <div>
                <button id="toggleAlamatBtn"
                    class="w-full flex items-center justify-between text-left font-semibold focus:outline-none">
                    Alamat
                    <i id="chevronIcon" data-feather="chevron-down"
                    class="transition-transform duration-300"></i>
                </button>

                <div id="alamatList" class="mt-4 space-y-3 hidden transition-all duration-300">
                    @forelse ($alamatList as $detail)
                        <div class="bg-gray-100 p-3 rounded shadow-sm">
                            <p class="text-sm text-gray-800">
                                {{ $detail->alamat->jalan ?? 'Jalan tidak tersedia' }}<br>
                                <span class="text-gray-600">Kecamatan {{ $detail->alamat->kecamatan->nama ?? '-' }}</span>
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada alamat yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profil</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();
            const btn = document.getElementById('toggleAlamatBtn');
            const content = document.getElementById('alamatList');
            const icon = document.getElementById('chevronIcon');

            btn.addEventListener('click', function () {
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
    </script>
</x-app-layout>
