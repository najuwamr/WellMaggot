<x-app-layout>
    <div class="bg-green-50 min-h-screen p-6">
        <h1 class="text-2xl font-bold text-green-600 mb-4">Transaksi</h1>

        {{-- Filter Bulan dan Tab --}}
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <select class="border rounded px-3 py-1">
                <option>Maret 2025</option>
                <option>Februari 2025</option>
                <option>Januari 2025</option>
            </select>
            <div class="flex gap-4 text-sm font-medium">
                <span class="text-green-700 border-b-2 border-green-600 pb-1">Status Transaksi</span>
                <span class="text-gray-500">Riwayat Transaksi</span>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded shadow p-4">
                <div class="text-gray-600 text-sm">Total transaksi</div>
                <div class="text-2xl font-bold text-yellow-600">💰 Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded shadow p-4">
                <div class="text-gray-600 text-sm">Total pengguna</div>
                <div class="text-2xl font-bold text-blue-600">👤 {{ number_format($totalUser) }}</div>
            </div>
            <div class="bg-white rounded shadow p-4">
                <div class="text-gray-600 text-sm">Total order</div>
                <div class="text-2xl font-bold text-green-600">📦 {{ number_format($totalOrder) }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
