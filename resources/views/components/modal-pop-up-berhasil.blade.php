<div
  x-data="{
    show: {{ session('success') ? 'true' : 'false' }},
    message: '{{ session('success') == 'added' ? 'Data berhasil ditambahkan' : 'Data berhasil diubah' }}'
  }"
  x-show="show"
  x-transition
  x-cloak
  @keydown.window.escape="show = false"
  class="fixed inset-0 bg-black bg-opacity-25 flex justify-center items-center z-50"
>
  <div class="bg-white p-6 rounded-xl shadow-lg relative text-center max-w-md w-full">
    <button @click="show = false" class="absolute top-2 right-2 text-red-600 hover:text-red-800">✖</button>
    <div class="flex justify-center items-center">
      <h2 class="text-4xl font-semibold text-gray-700 mb-4" x-text="message"></h2>
      <img src="{{ asset('images/check.png') }}" alt="Success Icon" class="mx-auto w-28 h-28" />
    </div>
  </div>
</div>
