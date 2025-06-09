<x-app-layout>
    <div class="mt-16 px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <h1 class="text-4xl font-extrabold text-amber-600 tracking-tight">Riwayat Penukaran Poin</h1>
            <a href="{{ route('point.index') }}" class="text-2xl font-extrabold underline text-amber-600 tracking-tight">Lihat Katalog Sembako</a>
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

                            @php
                                $alamat = $penukaran->user->detailAlamat->first()?->alamat;
                            @endphp

                            <td class="px-4 py-4 max-w-xs">
                                {{ $alamat->jalan ?? '-' }},
                                {{ $alamat->kecamatan->nama ?? '-' }}
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
                                    <button type="submit"
                                        class="flex items-center gap-1 px-3 py-1 rounded-md text-xs transition
                                            @if ($penukaran->status == 1)
                                                bg-gray-200 text-gray-400 cursor-not-allowed
                                            @else
                                                border border-green-600 text-green-600 hover:bg-green-600 hover:text-white
                                            @endif"
                                        @if ($penukaran->status == 1) disabled @endif
                                    >
                                        <i data-feather="check-circle" class="w-4 h-4"></i>
                                        Tandai Dikirim
                                    </button>
                                </form>
                            </td>

                            <td class="px-6 py-4 align-top flex flex-col items-start gap-2">
                                @if ($terlambat && !$penukaran->isPointReturned)
                                    <span class="text-sm text-red-600 italic leading-tight max-w-xs">
                                        Maaf telah menunggu, pengiriman lebih dari 2x24 jam. Barang akan segera dikirimkan dan poin Anda akan kembali 100%.
                                    </span>
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
        </div>
    </div>
</x-app-layout>
