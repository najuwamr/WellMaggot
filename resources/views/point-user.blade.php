<x-app-layout>
    <div class="bg-gradient-to-b from-white to-amber-200 py-10">

        {{-- Sidebar di luar grid --}}
        <div class="bg-white py-5 flex flex-wrap gap-6 justify-center mb-10 top-20">

            <h2 class="bg-amber-500 text-2xl font-semibold text-amber-900 p-5 items-center rounded-2xl shadow-lg">
                CEK PRODUK
            </h2>
            <div class="bg-green-100 text-green-800 p-6 rounded-xl shadow-lg">
                <p class="text-xl font-semibold">Total Poin Anda:</p>
                <p class="text-4xl font-extrabold mt-2">{{ $totalPoint }} <span class="text-lg font-normal">poin</span>
                </p>
            </div>
            <div class="bg-amber-200 text-amber-700 p-6 rounded-xl shadow-lg">
                <p class="text-xl font-semibold">Total Sampah yang Diberikan:</p>
                <p class="text-4xl font-extrabold mt-2">{{ $totalBerat }} <span class="text-lg font-normal">kg</span>
                </p>
            </div>

        </div>

        {{-- Grid produk --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-8">
            @foreach ($sembakoList as $sembako)
                <div x-data="{ open: false }"
                    class="bg-amber-500 rounded-2xl shadow-lg overflow-hidden flex flex-col items-center p-6">
                    <img src="{{ asset('assets/' . $sembako->gambar) }}" alt="{{ $sembako->nama }}"
                        class="w-40 h-40 object-cover rounded-xl mb-4" />

                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ $sembako->nama }}</h3>
                        <p class="text-md font-bold text-white">Poin: {{ $sembako->poin_harga }}</p>
                        <button @click="open = true"
                            class="mt-4 font-bold bg-white text-amber-700 px-4 py-2 rounded-lg hover:bg-amber-500 hover:text-white duration-300 transition">
                            <span class="flex items-center gap-2">
                                Tukar Sekarang
                                <i data-feather="shopping-bag"></i>
                            </span>
                        </button>
                    </div>

                    {{-- Modal --}}
                    <div x-show="open"
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-cloak
                        @click.away="open = false">
                        <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center" @click.stop>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Penukaran</h2>
                            <p class="mb-4">Apakah Anda yakin ingin menukar <strong>{{ $sembako->nama }}</strong>
                                dengan <strong>{{ $sembako->poin_harga }} poin</strong>?</p>
                            <div class="flex justify-center gap-4">
                                <form action="{{ route('penukaran.proses') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sembako_id" value="{{ $sembako->id }}">
                                    <button type="submit"
                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Ya
                                    </button>
                                </form>
                                <button @click="open = false"
                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 px-8">
            <h3 class="text-2xl font-bold text-amber-800 mb-4">Riwayat Penukaran</h3>
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-amber-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-3 text-left font-semibold">Alamat</th>
                            <th class="px-6 py-3 text-left font-semibold">Nama Barang</th>
                            <th class="px-6 py-3 text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-left font-semibold w-2xl">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @foreach ($PenukaranUser as $penukaran)
                            @php
                                $batasWaktu = $penukaran->created_at->addDays(2);
                                $terlambat = now()->greaterThan($batasWaktu) && $penukaran->status == 0;
                            @endphp

                            <tr>
                                <td class="px-6 py-4 w-48">{{ $penukaran->created_at->format('d M Y') }}</td>

                                @php
                                    $alamat = $penukaran->user->detailAlamat->first()?->alamat;
                                @endphp

                                <td class="px-4 py-4 max-w-xs">
                                    {{ $alamat->jalan ?? '-' }},
                                    {{ $alamat->kecamatan->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-4 w-48">{{ $penukaran->sembako->nama }}</td>
                                <td class="px-6 py-4">
                                    @if ($terlambat)
                                        <span class="text-red-600 font-semibold">Terlambat</span>
                                    @elseif ($penukaran->status == 1)
                                        <span class="text-green-600 font-semibold">Dikirim</span>
                                    @else
                                        <span class="text-yellow-600 font-semibold">Menunggu</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-top flex flex-col items-start gap-2">
                                    @if ($terlambat && !$penukaran->isPointReturned)
                                        <span class="text-sm text-red-600 italic leading-tight max-w-xs">
                                            Maaf telah menunggu, pengiriman lebih dari 2x24 jam. Barang akan segera dikirimkan dan poin Anda akan kembali 100%.
                                        </span>
                                        <form action="{{ route('point.pengembalian') }}" method="POST" onsubmit="return confirm('Yakin ingin mengajukan pengembalian poin?');">
                                            @csrf
                                            <input type="hidden" name="point_id" value="{{ $penukaran->id }}">
                                            <button
                                                type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm font-semibold"
                                                onclick="this.disabled=true; this.innerText='Mengirim...'; this.form.submit();"
                                            >
                                                Ambil Poin
                                            </button>
                                        </form>
                                    @elseif ($penukaran->isPointReturned)
                                        <span class="text-sm text-red-600 italic leading-tight max-w-xs">
                                            Maaf telah menunggu, pengiriman lebih dari 2x24 jam. Barang akan segera dikirimkan dan poin Anda akan kembali 100%.
                                        </span>
                                        <span class="text-green-600 text-sm font-medium">Poin sudah dikembalikan</span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $PenukaranUser->links() }}
                </div>
            </div>
        </div>

        <!-- Modal Poin Kurang -->
        @if (session('poin_kurang'))
            <div id="modalPoinKurang" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center">Add commentMore actions
                    <h2 class="text-lg font-semibold text-red-600 mb-4">Poin Tidak Cukup</h2>
                    <p class="text-gray-700 mb-4">{{ session('poin_kurang') }}</p>
                    <button onclick="document.getElementById('modalPoinKurang').classList.add('hidden')"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Tutup
                    </button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div id="modalBerhasil" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
                    <h2 class="text-xl font-semibold text-green-600 mb-4">Berhasil!</h2>
                    <p class="text-gray-700">{{ session('success') }}</p>
                    <p>Barang akan dikirimkan dalam waktu 2x24 jam oleh kami</p>
                    <button onclick="document.getElementById('modalBerhasil').classList.add('hidden')" class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tutup</button>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
