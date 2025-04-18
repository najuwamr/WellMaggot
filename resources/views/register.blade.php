
<x-guest-layout>
    <div class="w-full md:w-2/5 p-10 relative flex justify-center items-start">
        <div>
            <h1 class="tracking-widest md:text-4xl font-bold text-chartreuse mb-8">
                Daftar untuk fitur lebih banyak...
            </h1>
            <img src="{{ asset('images/maggot-img-1.png') }}" alt=""
                class="md:absolute bottom-0 w-48 md:w-auto">
        </div>
    </div>

    <div class="w-full md:w-3/5 bg-chartreuse rounded-t-lg md:rounded-l-none md:rounded-r-lg p-10">
        <ul class="flex items-center justify-between mb-8">
            <li class="text-white font-semibold">Beranda</li>
            <div class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('login') }}" class="bg-white text-chartreuse cursor-pointer font-bold px-4 py-2 rounded-lg">
                        Masuk
                    </a>
                </li>
                <li class="text-white font-semibold">Daftar</li>
            </div>
        </ul>

        <div class="flex flex-col min-h-[calc(100vh-200px)] items-center justify-center">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-2xl bg-white text-chartreuse p-10 rounded-xl shadow-md">
                @csrf

                <!-- Name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
                        placeholder="tulis nama kamu..."/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                        placeholder="tulis email kamu..."/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password"
                                        placeholder="minimal 8 karakter ya!!"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required
                                        placeholder="minimal 8 karakter ya!!"/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('No. HP')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus
                        placeholder="isi dengan angka ya..."/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="adress" :value="__('Alamat')" />
                        <x-text-input id="adress" class="block mt-1 w-full" type="text" name="adress" :value="old('adress')" required autofocus
                        placeholder="isi alamatmu..."/>
                        <x-input-error :messages="$errors->get('adress')" class="mt-2" />
                    </div>

                     <!-- Kecamatan -->
                    {{-- <div>
                        <x-input-label for="district" :value="__('Kecamatan')" />
                        <x-select-input id="district" name="district" :options="[
                            '' => 'Pilih Kecamatan',
                            'sumbersari' => 'Sumbersari',
                            'kaliwates' => 'Kaliwates'
                        ]" :selected="old('district')" />
                        <x-input-error :messages="$errors->get('district')" class="mt-2" />
                    </div> --}}

                    <!-- Kabupaten -->
                    {{-- <div>
                        <x-input-label for="regency" :value="__('Kabupaten')" />
                        <x-select-input id="regency" name="regency" :options="[
                            '' => 'Pilih Kabupaten',
                            'jember' => 'Jember',
                            'jombang' => 'Jombang'
                        ]" :selected="old('regency')" />
                        <x-input-error :messages="$errors->get('regency')" class="mt-2" />
                    </div> --}}
                    {{-- <div>
                        <x-input-label for="province" :value="__('Provinsi')" />
                        <x-select-input id="province" name="province" :options="[
                            '' => 'Pilih Provinsi',
                            'jawa-timur' => 'Jawa Timur',
                            'jawa-barat' => 'Jawa Barat'
                        ]" :selected="old('province')" />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div> --}}
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-chartreuse hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Sudah punya akun?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
