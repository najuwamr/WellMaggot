<x-app-layout>
    <div class="py-10 px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Informasi Poin dan Berat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <div class="bg-green-100 border border-green-400 text-green-800 p-6 rounded-xl shadow">
                    <p class="text-xl font-semibold">Total Poin Anda:</p>
                    <p class="text-4xl font-extrabold mt-2">{{ $totalPoint }} <span class="text-lg font-normal">poin</span></p>
                </div>
                <div class="bg-blue-100 border border-blue-400 text-blue-800 p-6 rounded-xl shadow">
                    <p class="text-xl font-semibold">Total Sampah yang Diberikan:</p>
                    <p class="text-4xl font-extrabold mt-2">{{ $totalBerat }} <span class="text-lg font-normal">kg</span></p>
                </div>
            </div>

            <!-- Daftar Produk Sembako -->
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tukar Poin dengan Sembako</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($sembakoList as $sembako)
                    <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <img src="{{ asset('assets/' . $sembako->gambar) }}"
                             alt="{{ $sembako->nama }}"
                             class="w-full h-40 object-cover" />

                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-[#B9C240] mb-2">{{ $sembako->nama }}</h3>
                            <p class="text-md font-bold text-[#B9C240]">Poin: {{ $sembako->poin_harga }}</p>
                            <p class="text-md font-bold text-[#B9C240]">Rp {{ number_format($sembako->nilai_rupiah, 0, ',', '.') }}</p>

                            <button @click="open = true"
                                    class="mt-4 bg-[#B9C240] text-white px-4 py-2 rounded-lg hover:bg-[#a1a832] transition">
                                Tukar Sekarang
                            </button>
                        </div>

                        <!-- Modal Konfirmasi -->
                        <div x-show="open"
                             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                             x-cloak
                             @click.away="open = false">
                            <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center" @click.stop>
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Penukaran</h2>
                                <p class="mb-4">Apakah Anda yakin ingin menukar <strong>{{ $sembako->nama }}</strong> dengan <strong>{{ $sembako->poin_harga }} poin</strong>?</p>
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
        </div>
    </div>

    <!-- Modal Poin Kurang -->
    @if (session('poin_kurang'))
        <div id="modalPoinKurang" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center">
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
</x-app-layout>
