<x-guest-layout>
    {{-- Main container for the two columns (flex-col on mobile, flex-row on desktop) --}}
    <div class="flex flex-col md:flex-row min-h-screen w-full">

        {{-- Left Column - Hidden on mobile, visible on medium screens and up --}}
        <div class="hidden md:flex md:w-2/5 flex-col justify-center items-center p-10 relative">
            <div>
                <h1 class="tracking-widest text-3xl md:text-6xl font-bold text-chartreuse mb-8 text-center md:text-left">
                    Daftar untuk fitur lebih banyak...
                </h1>
            </div>
        </div>

        {{-- Right Column - Takes full width on mobile, 3/5 on desktop --}}
        <div class="w-full md:w-3/5 bg-amber-500 rounded-t-lg md:rounded-r-none md:rounded-l-lg p-10">
            {{-- Navigation/Header --}}
            <ul class="flex items-center justify-between mb-8">
                <a href="{{ route('beranda') }}"
                    class="text-white cursor-pointer font-light hover:bg-amber-500 rounded-xl hover:white hover:font-bold duration-500 px-4 py-2">
                    Beranda
                </a>
                <div class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('login') }}"
                            class="bg-white text-chartreuse cursor-pointer font-bold px-4 py-2 rounded-lg hover:bg-chartreuse hover:text-white transition-colors duration-300">
                            Login
                        </a>
                    </li>
                    <li class="shadow-lg rounded-lg px-4 py-2 text-white font-semibold">Daftar</li>
                    {{-- Active state for Register --}}
                </div>
            </ul>

            {{-- Title for Mobile View --}}
            <h1 class="mt-10 mb-5 text-center text-3xl md:hidden font-semibold text-white">
                Daftar untuk fitur lebih banyak...
            </h1>

            {{-- Form Container --}}
            <div class="flex flex-col min-h-[calc(100vh-200px)] items-center justify-center">
                <form method="POST" action="{{ route('register') }}"
                    class="w-full max-w-2xl bg-white text-chartreuse p-10 rounded-xl shadow-md">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block mb-2 font-semibold">Nama Lengkap</label>
                            <input type="text" placeholder="tulis nama kamu..." name="name" id="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block mb-2 font-semibold">Email</label>
                            <input type="email" placeholder="tulis email kamu" name="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block mb-2 font-semibold">Kata Sandi</label>
                            <input type="password" placeholder="minimal 8 karakter ya!!" name="password" id="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required autocomplete="new-password">
                            <div class="flex items-center mt-2">
                                <input type="checkbox" id="showPassword" class="mr-2">
                                <label for="showPassword" class="text-sm">Tampilkan kata sandi</label>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block mb-2 font-semibold">Konfirmasi Kata
                                Sandi</label>
                            <input type="password" placeholder="konfirmasi di sini" name="password_confirmation"
                                id="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label for="phone" class="block mb-2 font-semibold">No. HP</label>
                            <input type="tel" placeholder="isi dengan angka ya" name="phone" id="phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required value="{{ old('phone') }}">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        {{-- Address --}}
                        <div>
                            <label for="alamat" class="block mb-2 font-semibold">Alamat</label>
                            <input type="text" placeholder="tulis nama jalannya" name="alamat" id="alamat"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                                required value="{{ old('alamat') }}">
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>
                    </div>

                    {{-- District (Kecamatan) --}}
                    <div class="mt-6"> {{-- Adjusted margin for better spacing --}}
                        <label for="district" class="block mb-2 font-semibold">Kecamatan</label>
                        <select name="kecamatan" id="district"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                            required>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}"
                                    {{ old('kecamatan') == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end mt-10"> {{-- Adjusted margin-top --}}
                        <button type="submit"
                            class="cursor-pointer bg-amber-500 text-white py-2 px-6 rounded-lg hover:bg-white hover:text-amber-500 transition-all duration-500 font-bold">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> {{-- End of main flex container --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showPasswordCheckbox = document.getElementById('showPassword');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById(
            'password_confirmation'); // Assuming you'll use this ID

            showPasswordCheckbox.addEventListener('change', function() {
                const newType = this.checked ? 'text' : 'password';
                passwordInput.type = newType;
                confirmPasswordInput.type = newType; // Apply to confirm password as well for consistency
            });
        });
    </script>
</x-guest-layout>
