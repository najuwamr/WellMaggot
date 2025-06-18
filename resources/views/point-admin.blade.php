<x-app-layout>
    <section class="bg-gradient-to-b from-white to-amber-200 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Tab Header -->
            <div class="flex space-x-6 mb-8">
                <button id="tabSembako" class="tab-btn active text-amber-600 border-b-4 border-amber-500 font-bold px-4 py-2 transition">Kelola Sembako</button>
                <button id="tabRiwayat" class="tab-btn text-gray-600 hover:text-amber-600 border-b-4 border-transparent hover:border-amber-300 font-bold px-4 py-2 transition">Riwayat Penukaran</button>
            </div>

            <!-- Slides -->
            <div class="relative overflow-hidden">
                <!-- Slide: Kelola Sembako -->
                <div id="slideSembako" class="tab-content transition duration-500 ease-in-out">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                        <h1 class="text-4xl font-extrabold text-amber-600 tracking-tight">Kelola Sembako</h1>
                    </div>

                    <!-- Aktif -->
                    <div class="mb-12">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @forelse ($sembakoAktif as $sembako)
                                @include('components.sembako-card', ['sembako' => $sembako])
                            @empty
                                <p class="text-gray-500 col-span-full text-center">Belum ada sembako aktif.</p>
                            @endforelse

                            <a href="{{ route('sembako.create') }}" class="flex items-center justify-center bg-white border-2 border-dashed border-amber-300 rounded-xl hover:border-amber-500 hover:bg-amber-50 transition h-48">
                                <div class="text-center text-amber-600">
                                    <i data-feather="plus-circle" class="w-10 h-10 mx-auto mb-2"></i>
                                    <span class="font-medium">Tambah Sembako</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Non Aktif -->
                    <div>
                        <button id="toggleNonAktifBtn" class="flex items-center text-lg text-amber-700 font-semibold hover:text-amber-800 transition mb-4 group">
                            <span>Lihat Sembako Tidak Aktif</span>
                            <i id="chevronIcon" data-feather="chevron-down" class="ml-2 transition-transform duration-300 group-hover:translate-y-0.5"></i>
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

                <div id="slideRiwayat" class="tab-content hidden transition duration-500 ease-in-out">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                        <h1 class="text-4xl font-extrabold text-amber-600 tracking-tight">Riwayat Penukaran Poin</h1>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-amber-500 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                                    <th class="px-6 py-3 text-left font-semibold">Alamat</th>
                                    <th class="px-6 py-3 text-left font-semibold">Nama Barang</th>
                                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                                    <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                                    <th class="px-6 py-3 text-left font-semibold w-2xl">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                @foreach ($penukaranList as $penukaran)
                                    @php
                                        $batasWaktu = $penukaran->created_at->addDays(2);
                                        $terlambat = now()->greaterThan($batasWaktu) && $penukaran->status == 0;
                                        $terlambatDikirim = now()->greaterThan($batasWaktu) && $penukaran->status == 1;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 w-48">{{ $penukaran->created_at->format('d M Y') }}</td>

                                        @php $alamat = $penukaran->user->detailAlamat->first()?->alamat; @endphp
                                        <td class="px-4 py-4 max-w-xs">
                                            {{ $alamat->jalan ?? '-' }}, {{ $alamat->kecamatan->nama ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 w-48">{{ $penukaran->sembako->nama }}</td>
                                        <td class="px-6 py-4">
                                            @if ($penukaran->status == 1)
                                                <span class="text-green-600 font-semibold">Dikirim</span>
                                                @if ($terlambatDikirim)
                                                    <span class="block text-red-600">(Terlambat)</span>
                                                @endif
                                            @elseif ($terlambat)
                                                <span class="text-red-600 font-semibold">Terlambat</span>
                                            @else
                                                <span class="text-yellow-600 font-semibold">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('point.updateStatus', $penukaran->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="flex items-center gap-1 px-3 py-1 rounded-md text-xs transition
                                                    @if ($penukaran->status == 1)
                                                        bg-gray-200 text-gray-400 cursor-not-allowed
                                                    @else
                                                        border border-green-600 text-green-600 hover:bg-green-600 hover:text-white
                                                    @endif"
                                                    @if ($penukaran->status == 1) disabled @endif>
                                                    <i data-feather="check-circle" class="w-4 h-4"></i>
                                                    Tandai Dikirim
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 align-top flex flex-col items-start gap-2">
                                            @if ($terlambat && !$penukaran->isPointReturned)
                                                <span class="text-sm text-red-600 italic leading-tight max-w-xs">
                                                    Pesan: Maaf telah menunggu, pengiriman lebih dari 2x24 jam. Barang akan segera dikirimkan dan poin Anda akan kembali 100%.
                                                </span>
                                            @elseif ($penukaran->isPointReturned)
                                                <span class="text-sm text-red-600 italic leading-tight max-w-xs">
                                                    Pesan: Maaf telah menunggu, pengiriman lebih dari 2x24 jam. Barang akan segera dikirimkan dan poin Anda akan kembali 100%.
                                                </span>
                                                <span class="text-green-600 text-sm font-medium">Pelanggan berhasil mengambil poin.</span>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feather icons & Scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                feather.replace();

                const sembakoBtn = document.getElementById('tabSembako');
                const riwayatBtn = document.getElementById('tabRiwayat');
                const sembakoSlide = document.getElementById('slideSembako');
                const riwayatSlide = document.getElementById('slideRiwayat');

                sembakoBtn.addEventListener('click', () => {
                    sembakoBtn.classList.add('text-amber-600', 'border-amber-500');
                    sembakoBtn.classList.remove('text-gray-600');
                    riwayatBtn.classList.remove('text-amber-600', 'border-amber-500');
                    riwayatBtn.classList.add('text-gray-600');
                    sembakoSlide.classList.remove('hidden');
                    riwayatSlide.classList.add('hidden');
                });

                riwayatBtn.addEventListener('click', () => {
                    riwayatBtn.classList.add('text-amber-600', 'border-amber-500');
                    riwayatBtn.classList.remove('text-gray-600');
                    sembakoBtn.classList.remove('text-amber-600', 'border-amber-500');
                    sembakoBtn.classList.add('text-gray-600');
                    riwayatSlide.classList.remove('hidden');
                    sembakoSlide.classList.add('hidden');
                });

                // toggle non aktif
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
