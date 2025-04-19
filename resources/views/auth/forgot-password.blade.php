<x-guest-layout>
    <div class="relative flex w-full h-screen">

        <div class="w-1/2 bg-[#B9C240] flex items-center justify-center relative">
            <img src="/images/kunci.png" alt="Gembok Kiri" class="w-3/4 opacity-60">
        </div>

        <div class="w-1/2 bg-[#F9FFEE] flex items-center justify-center relative">
            <img src="/images/kunci.png" alt="Gembok Kanan" class="w-3/4 opacity-40">
            <button class="absolute top-5 right-5 px-4 py-2 bg-[#B9C240] text-white rounded">Masuk</button>
        </div>

        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white p-8 rounded-xl shadow-lg z-20 w-80">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
