<!-- components/webcam-modal.blade.php -->
<div id="webcamModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg">
        <h2 class="text-lg font-bold mb-4">Ambil Gambar Sampah</h2>

        <div id="my_camera" class="mb-4"></div>
        <div id="results" class="mb-4 text-center text-sm text-gray-500">Gambar akan muncul di sini...</div>

        <div class="flex justify-end gap-2">
            <button onclick="take_snapshot()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ambil</button>
            <button onclick="toggleModal(false)" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Tutup</button>
        </div>
    </div>
</div>
