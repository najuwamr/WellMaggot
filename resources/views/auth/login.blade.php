<x-guest-layout>
    {{-- Ini adalah kontainer flex utama yang membungkus kedua kolom --}}
    <div class="flex flex-col md:flex-row min-h-screen w-full"> {{-- flex-col di mobile, flex-row di md ke atas --}}

        {{-- Kolom Kiri - Hanya tampil di MD ke atas (desktop) --}}
        <div class="hidden md:flex md:w-1/2 flex-col justify-center items-center p-10"> {{-- Sembunyikan di mobile --}}
            <h1 class="mt-10 text-center md:text-4xl font-semibold text-amber-500">
                Selamat Datang Di <span class="text-chartreuse font-bold">WellMaggot!</span>
            </h1>
            <img src="{{ asset('assets/login_ilus.jpg') }}" alt="" class="mt-16 w-full h-auto max-w-md mx-auto">
        </div>

        {{-- Kolom Kanan - Mengisi penuh di mobile, 1/2 di MD ke atas --}}
        <div class="w-full md:w-1/2 bg-amber-500 rounded-t-lg md:rounded-r-none md:rounded-l-lg p-10">
            <ul class="flex items-center justify-between">
                <a href="{{ route('beranda') }}"
                    class="text-white cursor-pointer font-light hover:bg-amber-500 rounded-xl hover:white hover:font-bold duration-500 px-4 py-2">
                    Beranda </a>
                <div class="flex items-center space-x-4">
                    <li class="shadow-lg rounded-lg px-4 py-2 text-white font-semibold">Login</li>
                    <li>
                        <a href="{{ route('register') }}"
                            class="bg-white text-chartreuse cursor-pointer hover:bg-amber-500 hover:text-white hover:font-extrabold shadow-xl duration-500 px-4 py-2 rounded-lg">
                            Daftar
                        </a>
                    </li>
                </div>
            </ul>

            {{-- Judul "Selamat Datang" yang hanya muncul di layar kecil --}}
            <h1 class="mt-10 mb-5 text-center text-3xl md:hidden font-semibold text-white"> {{-- hidden di md ke atas --}}
                Selamat Datang Di <span class="text-chartreuse font-bold">WellMaggot!</span>
            </h1>

            <div class="flex flex-col min-h-[calc(100vh-200px)] items-center justify-center">
                <form method="POST" action="{{ route('login') }}"
                    class="w-full max-w-md bg-white text-chartreuse p-10 rounded-xl shadow-md">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus placeholder="tulis email kamu..." />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" placeholder="minimal 8 karakter ya!!" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <input type="checkbox" id="showPassword" class="mr-2">
                    <label for="showPassword" class="text-sm">Tampilkan kata sandi</label>

                    <div class="flex items-center justify-center mt-10">
                        <x-primary-button class="ml-4">
                            {{ __('Masuk') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div> {{-- Penutup kontainer flex utama --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showPasswordCheckbox = document.getElementById('showPassword');
            const passwordInput = document.getElementById('password');

            showPasswordCheckbox.addEventListener('change', function() {
                passwordInput.type = this.checked ? 'text' : 'password';
            });
        });
    </script>
</x-guest-layout>
