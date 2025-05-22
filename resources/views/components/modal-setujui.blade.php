<div id="modalSetujui" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Persetujuan</h2>
        <p>Berat sampah <span id="modal-berat" class="font-semibold"></span> kg akan dikonversi ke poin untuk user ini.</p>
        <p class="mt-2 text-gray-700">Total poin yang diterima: <span id="modal-poin" class="font-bold text-green-600"></span> poin</p>

        <form method="POST" action="{{ route('penjadwalan.setujui') }}">
            @csrf
            <input type="hidden" name="penjadwalan_id" id="modal-penjadwalan-id">
            <input type="hidden" name="user_id" id="modal-user-id">
            <input type="hidden" name="poin" id="modal-poin-input">

            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" id="btn-batal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Setujui</button>
            </div>
        </form>
    </div>
</div>
