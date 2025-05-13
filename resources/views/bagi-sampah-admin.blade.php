<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwal Penjemputan Sampah
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('penjemputan.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="jadwal" :value="'Pilih hingga 3 tanggal penjemputan'" />
                        <input
                            type="text"
                            id="jadwal"
                            name="jadwal[]"
                            class="datepicker block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Pilih tanggal..."
                            readonly
                        >
                        <x-input-error :messages="$errors->get('jadwal')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        Simpan Jadwal
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- jQuery UI Datepicker -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script>
    $(function () {
        let selectedDates = [];

        $("#jadwal").datepicker({
            dateFormat: "yy-mm-dd",
            beforeShowDay: function (date) {
                let string = $.datepicker.formatDate('yy-mm-dd', date);
                return [true, selectedDates.includes(string) ? 'ui-state-highlight' : ''];
            },
            onSelect: function (dateText) {
                if (selectedDates.includes(dateText)) {
                    selectedDates = selectedDates.filter(d => d !== dateText);
                } else if (selectedDates.length < 3) {
                    selectedDates.push(dateText);
                } else {
                    alert("Maksimal hanya 3 tanggal yang bisa dipilih.");
                }
                $(this).val(selectedDates.join(', '));
            }
        });
    });
    </script>
    @endpush
</x-app-layout>
