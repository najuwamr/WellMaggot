@props(['id' => '', 'title' => '', 'message' => '', 'action' => '', 'cancelText' => 'Kembali', 'confirmText' => 'Batalkan Penjadwalan'])

<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-xl max-w-md w-full text-center">
        <h2 class="text-lg font-bold mb-4">{{ $title }}</h2>
        <p class="text-gray-600 mb-6">{{ $message }}</p>
        <form id="{{ $id }}-form" method="POST" action="{{ $action }}">
            @csrf
            <input type="hidden" name="id" id="{{ $id }}-input">
            <div class="flex justify-center gap-4">
                <button type="button" onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-200 rounded">
                    {{ $cancelText }}
                </button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">
                    {{ $confirmText }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id, penjadwalanId) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.getElementById(id + '-input').value = penjadwalanId;
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
