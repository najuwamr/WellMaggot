<x-app-layout>
    <div class="mt-16 px-6 pb-10 overflow-y-auto" x-data="{ slide: 1 }">


        {{-- Tab Navigasi --}}
        <div class="flex justify-center gap-4 mb-6 text-lg">
            <button @click="slide = 1" :class="slide === 1 ? 'text-amber-500' : 'bg-gray-200 text-gray-600'"
                class="px-4 py-2 rounded-full hover:bg-white hover:text-amber-500 transition duration-300">Transaksi</button>
            <button @click="slide = 2" :class="slide === 2 ? 'text-amber-500' : 'bg-gray-200 text-gray-600'"
                class="px-4 py-2 rounded-full hover:bg-white hover:text-amber-500 transition duration-300">Bagi
                Sampah</button>
        </div>

        {{-- Slide 1: Transaksi --}}
        <div x-show="slide === 1" x-transition>
            {{-- Ringkasan --}}
            <div class="flex flex-col md:flex-row justify-center items-center gap-6 mb-10">
                <div
                    class="bg-green-100 p-4 rounded-full w-60 h-60 flex flex-col justify-center items-center text-center shadow-xl smooth-bounce delay-0">
                    <p class="text-green-800 text-lg font-light">Total Transaksi</p>
                    <p class="text-3xl font-bold text-black/40">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
                </div>

                <div
                    class="bg-blue-100 p-4 rounded-full w-60 h-60 flex flex-col justify-center items-center text-center shadow-xl smooth-bounce delay-1">
                    <p class="text-blue-800 text-lg font-light">Total User</p>
                    <p class="text-3xl font-bold text-black/40 flex justify-center items-center gap-3">
                        <i data-feather="users"></i> {{ $totalUser }}
                    </p>
                </div>

                <div
                    class="bg-yellow-100 p-4 rounded-full w-60 h-60 flex flex-col justify-center items-center text-center shadow-xl smooth-bounce delay-2">
                    <p class="text-yellow-600 text-lg font-light">Total Order</p>
                    <p class="text-3xl font-bold text-black/40 flex justify-center items-center gap-2">
                        <i data-feather="shopping-bag"></i> {{ $totalOrder }}
                    </p>
                </div>
            </div>



            {{-- Grafik Transaksi --}}
            <div class="bg-white shadow rounded-xl p-6 mb-10 text-center">
                <h2 class="text-4xl font-light text-amber-600 mb-4">Grafik Transaksi Bulanan</h2>
                <canvas id="grafikTransaksi" class="w-full max-w-4xl mx-auto"></canvas>
            </div>
        </div>

        {{-- Slide 2: Bagi Sampah --}}
        <div x-show="slide === 2" x-transition>
            {{-- Ringkasan --}}
            <div class="flex justify-center items-center md:grid-cols-3 gap-6 mb-10">
                <div
                    class="bg-yellow-100 p-4 rounded-full w-60 h-60 flex flex-col justify-center items-center text-center shadow-xl smooth-bounce delay-0">
                    <p class="text-yellow-700 text-lg font-light">Total Kg Bagi Sampah</p>
                    <p class="text-3xl font-bold text-amber-500 flex justify-center items-center gap-2"> <i
                            data-feather="clipboard"></i>{{ number_format($totalKgBagiSampah, 2, ',', '.') }} kg
                    </p>
                </div>
                <div
                    class="bg-green-100 p-4 rounded-full w-60 h-60 flex flex-col justify-center items-center text-center shadow-xl smooth-bounce delay-1">
                    <p class="text-green-700 text-lg font-light">Penjadwalan Selesai</p>
                    <p class="text-3xl font-bold text-green-700 flex justify-center items-center gap-2"> <i
                            data-feather="calendar"></i>{{ $countSelesai }}</p>
                </div>
                <div
                    class="bg-red-100 p-4 rounded-full w-60 h-60 flex flex-col justify-center items-center text-center shadow-xl smooth-bounce delay-2">
                    <p class="text-red-700 text-lg font-light">Penjadwalan Belum Selesai</p>
                    <p class="text-3xl font-bold text-red-500 flex justify-center items-center gap-2"> <i
                            data-feather="calendar"></i>{{ $countBelumSelesai }}</p>
                </div>
            </div>

            {{-- Grafik Pie Bagi Sampah --}}
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl text-center font-semibold text-amber-600 mb-4">Pie Chart Bagi Sampah</h2>
                <canvas id="grafikBagiSampah" class="w-full max-w-md mx-auto"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data dari controller
        const bulanLabels = [
            @foreach ($bulan as $b)
                "{{ \Carbon\Carbon::parse($b)->translatedFormat('F') }}",
            @endforeach
        ];

        const totalTransaksi = @json($totalTransaksiPerBulan);

        const ctxTransaksi = document.getElementById('grafikTransaksi');
        new Chart(ctxTransaksi, {
            type: 'line',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Total Transaksi',
                    data: totalTransaksi,
                    fill: true,
                    borderColor: '#f59e0b',
                    backgroundColor: 'white',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });

        const ctxSampah = document.getElementById('grafikBagiSampah');
        new Chart(ctxSampah, {
            type: 'pie',
            data: {
                labels: ['Selesai', 'Belum Selesai'],
                datasets: [{
                    data: [{{ $countSelesai }}, {{ $countBelumSelesai }}],
                    backgroundColor: ['#34d399', '#f87171']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>
