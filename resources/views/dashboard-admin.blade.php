<x-app-layout>
    <div class="mt-16 px-6 pb-10 overflow-y-auto" x-data="{ slide: 1 }">
        <h1 class="text-3xl font-bold text-center text-amber-600 mb-8">Dashboard Admin</h1>

        {{-- Tab Navigasi --}}
        <div class="flex justify-center gap-4 mb-6">
            <button @click="slide = 1"
                :class="slide === 1 ? 'bg-amber-500 text-white' : 'bg-gray-200 text-gray-600'"
                class="px-4 py-2 rounded-full transition duration-300">Transaksi</button>
            <button @click="slide = 2"
                :class="slide === 2 ? 'bg-amber-500 text-white' : 'bg-gray-200 text-gray-600'"
                class="px-4 py-2 rounded-full transition duration-300">Bagi Sampah</button>
        </div>

        {{-- Slide 1: Transaksi --}}
        <div x-show="slide === 1" x-transition>
            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-amber-100 p-4 rounded-lg text-center">
                    <p class="text-lg font-semibold">Total Transaksi</p>
                    <p class="text-2xl font-bold text-amber-600">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg text-center">
                    <p class="text-lg font-semibold">Total User</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $totalUser }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg text-center">
                    <p class="text-lg font-semibold">Total Order</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $totalOrder }}</p>
                </div>
            </div>

            {{-- Grafik Transaksi --}}
            <div class="bg-white shadow rounded-xl p-6 mb-10">
                <h2 class="text-xl font-semibold text-amber-600 mb-4">Grafik Transaksi Bulanan</h2>
                <canvas id="grafikTransaksi" class="w-full max-w-4xl mx-auto"></canvas>
            </div>
        </div>

        {{-- Slide 2: Bagi Sampah --}}
        <div x-show="slide === 2" x-transition>
            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-amber-100 p-4 rounded-lg text-center">
                    <p class="text-lg font-semibold">Total Kg Bagi Sampah</p>
                    <p class="text-2xl font-bold text-amber-600">{{ number_format($totalKgBagiSampah, 2, ',', '.') }} kg</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg text-center">
                    <p class="text-lg font-semibold">Penjadwalan Selesai</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $countSelesai }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg text-center">
                    <p class="text-lg font-semibold">Penjadwalan Belum Selesai</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $countBelumSelesai }}</p>
                </div>
            </div>

            {{-- Grafik Pie Bagi Sampah --}}
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold text-amber-600 mb-4">Pie Chart Bagi Sampah</h2>
                <canvas id="grafikBagiSampah" class="w-full max-w-md mx-auto"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data dari controller
        const bulanLabels = [
            @for ($i = 11; $i >= 0; $i--)
                "{{ \Carbon\Carbon::now()->subMonths($i)->translatedFormat('F') }}",
            @endfor
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
                    backgroundColor: 'rgba(251, 191, 36, 0.2)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
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
