<x-app-layout>
    <div class="py-10 px-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Poin Saya</h2>

            <div class="bg-green-100 border border-green-400 text-green-800 p-6 rounded-lg shadow">
                <p class="text-xl font-semibold">Total Poin Anda:</p>
                <p class="text-4xl font-bold mt-2">{{ $totalPoint }} <span class="text-lg">poin</span></p>
            </div>

            <div class="bg-blue-100 border border-blue-400 text-blue-800 p-6 rounded-lg shadow">
                <p class="text-xl font-semibold">Total Sampah yang Diberikan:</p>
                <p class="text-4xl font-bold mt-2">{{ $totalBerat }} <span class="text-lg">kg</span></p>
            </div>
        </div>
    </div>
</x-app-layout>
