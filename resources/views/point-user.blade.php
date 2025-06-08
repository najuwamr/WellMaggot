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

    </div>
</x-app-layout>
