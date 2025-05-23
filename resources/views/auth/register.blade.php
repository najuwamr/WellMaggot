<x-guest-layout>

    <body class="h-screen flex flex-wrap font-roboto">
        <div class="w-full md:w-2/5 p-10 relative flex justify-center items-start">
            <div>
                <h1 class="tracking-widest text-3xl md:text-6xl font-bold text-chartreuse mb-8">
                    Daftar untuk fitur lebih banyak...
                </h1>
                <img src="{{ asset('storage/images/maggot-img-1.png') }}" alt=""
                    class="md:absolute bottom-0 w-40 md:w-auto">
            </div>
        </div>

        <div class="w-full md:w-3/5 bg-chartreuse rounded-t-lg md:rounded-r-none md:rounded-l-lg p-10">
            <ul class="flex items-center justify-between mb-8">
                <li class="text-white font-semibold">Beranda</li>
                <div class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('login') }}" class="bg-white text-chartreuse cursor-pointer font-bold px-4 py-2 rounded-lg">
                            Login
                        </a>
                    </li>
                    <li class="text-white font-semibold">Daftar</li>
                </div>
            </ul>

            <div class="flex flex-col min-h-[calc(100vh-200px)] items-center justify-center">
                <form method="POST" action="{{ route('register') }}"
                    class="w-full max-w-2xl bg-white text-chartreuse p-10 rounded-xl shadow-md">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block mb-2 font-semibold">Nama Lengkap</label>
                            <input type="text" placeholder="tulis nama kamu..." name="name" id="name"
                                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 font-semibold">Email</label>
                            <input type="email" placeholder="tulis email kamu" name="email" id="email"
                                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required>
                        </div>

                        <div>
                            <label for="password" class="block mb-2 font-semibold">Kata Sandi</label>
                            <input type="password" placeholder="minimal 8 karakter ya!!" name="password" id="password"
                                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required>
                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="showPassword" class="mr-2">
                                <label for="showPassword" class="text-sm">Tampilkan kata sandi</label>
                            </div>
                        </div>

                        <div>
                            <label for="confirm_password" class="block mb-2 font-semibold">Konfirmasi Kata Sandi</label>
                            <input type="password" placeholder="konfirmasi di sini" name="password_confirmation"
                                id="confirm_password"
                                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required>
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 font-semibold">No. HP</label>
                            <input type="tel" placeholder="isi dengan angka ya" name="phone" id="phone"
                                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required>
                        </div>

                        <div>
                            <label for="alamat" class="block mb-2 font-semibold">Alamat</label>
                            <input type="text" placeholder="tulis nama jalannya" name="alamat" id="alamat"
                                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="district" class="block mb-2 font-semibold">Kecamatan</label>
                                <select name="kecamatan" id="district"
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                    required>
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="cursor-pointer bg-chartreuse text-white py-2 px-6 rounded-lg hover:bg-lime-600 transition-all font-bold">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const districtSelect = document.getElementById('district');

                const showPasswordCheckbox = document.getElementById('showPassword');
                const passwordInput = document.getElementById('password');

                showPasswordCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        passwordInput.type = 'text';
                    } else {
                        passwordInput.type = 'password';
                    }
                });
            });

        </script>
    </body>
</x-guest-layout>
