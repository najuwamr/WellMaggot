<x-guest-layout>
    <div class="w-full md:w-2/5 p-10 relative flex justify-center items-start">
        <div>
            <h1 class="tracking-widest md:text-4xl font-bold text-chartreuse">
                Selamat Datang Di WellMaggot!
            </h1>
            <img src="{{ asset('images/Reduce plastic bag campaign.png') }}" alt=""
                class="md:absolute bottom-0 w-48 md:w-auto">
        </div>
    </div>

    <div class="w-full md:w-3/5 bg-chartreuse rounded-t-lg md:rounded-r-none md:rounded-l-lg p-10">
        <ul class="flex items-center justify-between">
            <li class="text-white font-semibold">Beranda</li>
            <div class="flex items-center space-x-4">
              <li class="text-white font-semibold">Masuk</li>
                <li>
                    <a href="{{ route('register') }}" class="bg-white text-chartreuse cursor-pointer font-bold px-4 py-2 rounded-lg">
                        Daftar
                    </a>
                </li>
            </div>
        </ul>

        <div class="flex flex-col min-h-[calc(100vh-200px)] items-center justify-center">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md bg-white text-chartreuse p-10 rounded-xl shadow-md">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="tulis email kamu..." />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="minimal 8 karakter ya!!"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-chartreuse hover:text-lime-800" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-4">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
