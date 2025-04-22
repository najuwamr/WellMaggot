<div
  x-data="{
    show: {{ session('error') ? 'true' : 'false' }},
    message:
      '{{ session('error') == 'empty' ? 'Data tidak boleh kosong' : (session('error') == 'invalid' ? 'Data tidak valid' : '') }}'
  }"
  x-show="show"
  x-transition
  x-cloak
  @keydown.window.escape="show = false"
  class="fixed inset-0 bg-black bg-opacity-25 flex justify-center items-center z-50"
>
  <div class="bg-white p-6 rounded-xl shadow-lg relative text-center max-w-md w-full">
    <button @click="show = false" class="absolute top-2 right-2 text-red-600 hover:text-red-800">✖</button>
    <div class="flex flex-col items-center">
      <h2 class="text-2xl font-semibold text-gray-700 mb-4" x-text="message"></h2>
      <img src="{{ asset('images/error.png') }}" alt="Error Icon" class="w-28 h-28" />
    </div>
  </div>
</div>
