<x-app-layout>
    <section class="bg-gradient-to-b from-white to-amber-200 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                <h1 class="text-4xl font-extrabold text-amber-600 tracking-tight">Kelola Sembako</h1>
                <a href="{{ route('poin.riwayatPenukaran') }}" class="text-2xl underline font-extrabold text-amber-600 tracking-tight">Lihat Penukaran Poin</a>
            </div>

            <!-- Sembako Aktif -->
            <div class="mb-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($sembakoAktif as $sembako)
                        @include('components.sembako-card', ['sembako' => $sembako])
                    @empty
                        <p class="text-gray-500 col-span-full text-center">Belum ada sembako aktif.</p>
                    @endforelse

                    <!-- Tombol Tambah -->
                    <a href="{{ route('sembako.create') }}"
                       class="flex items-center justify-center bg-white border-2 border-dashed border-amber-300 rounded-xl hover:border-amber-500 hover:bg-amber-50 transition h-48">
                        <div class="text-center text-amber-600">
                            <i data-feather="plus-circle" class="w-10 h-10 mx-auto mb-2"></i>
                            <span class="font-medium">Tambah Sembako</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Sembako Non-Aktif -->
            <div>
                <button id="toggleNonAktifBtn"
                        class="flex items-center text-lg text-amber-700 font-semibold hover:text-amber-800 transition mb-4 group">
                    <span>Lihat Sembako Tidak Aktif</span>
                    <i id="chevronIcon" data-feather="chevron-down"
                       class="ml-2 transition-transform duration-300 group-hover:translate-y-0.5"></i>
                </button>

                <div id="nonAktifList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 hidden">
                    @forelse ($sembakoNonAktif as $sembako)
                        @include('components.sembako-card', ['sembako' => $sembako])
                    @empty
                        <p class="text-gray-500 col-span-full text-center">Belum ada sembako tidak aktif.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Feather icons & toggle script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                feather.replace();

                const toggleBtn = document.getElementById('toggleNonAktifBtn');
                const list = document.getElementById('nonAktifList');
                const chevron = document.getElementById('chevronIcon');

                toggleBtn.addEventListener('click', () => {
                    list.classList.toggle('hidden');
                    chevron.classList.toggle('rotate-180');
                });
            });
        </script>
    </section>
</x-app-layout>
