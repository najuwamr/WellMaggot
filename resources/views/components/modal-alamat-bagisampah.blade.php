<div x-data="{ open: false }">
    <button type="button" @click="open = true"
        class="text-sm text-black underline hover:bg-amber-500 hover:text-white rounded-lg font-semibold duration-500 py-2 px-2 mb-4">
        Tambah alamat baru?
    </button>

    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.away="open = false" class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Tambah Alamat Baru</h2>

            <form action="{{ route('alamat.new') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="alamat" class="block mb-1 font-medium">Alamat Jalan</label>
                        <input type="text" id="alamat" name="jalan"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                            placeholder="Tulis nama jalannya" required>
                    </div>

                    <div>
                        <label for="district" class="block mb-1 font-medium">Kecamatan</label>
                        <select name="kecamatan_id" id="district"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                            required>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatanList as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-white hover:text-red-500 duration-500">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-lime-500 text-white font-semibold rounded hover:bg-white hover:text-lime-500 duration-500">Simpan Alamat</button>
                </div>
            </form>
        </div>
    </div>
</div>
