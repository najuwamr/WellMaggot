<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Ubah informasi profil dan alamat email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="alamat" :value="__('Alamat')" />
            <div>
                @foreach ($user->detailAlamat as $detail)
                    <div class="flex justify-between items-center bg-gray-100 p-3 rounded mb-2">
                        <div>
                            {{ $detail->alamat->jalan ?? '-' }},
                            Kecamatan {{ $detail->alamat->kecamatan->nama ?? '-' }}
                        </div>
                        <button
                            type="button"
                            class="text-indigo-500 hover:underline"
                            onclick="openModal({{ $detail->id }})">
                            Edit
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    @foreach ($user->detailAlamat as $detail)
    <div
        id="modal-{{ $detail->id }}"
        class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md relative">
            <h2 class="text-lg font-semibold mb-4">Edit Alamat</h2>

            <form method="post" action="{{ route('alamat.update', $detail->id) }}">
                @csrf
                @method('patch')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jalan</label>
                    <input type="text" name="jalan" value="{{ $detail->alamat->jalan }}" class="w-full border border-gray-300 p-2 rounded mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                    <select name="kecamatan_id" class="w-full border border-gray-300 p-2 rounded mt-1">
                        @foreach ($kecamatanList as $kecamatan)
                            <option value="{{ $kecamatan->id }}" {{ $kecamatan->id == $detail->alamat->kecamatan_id ? 'selected' : '' }}>
                                {{ $kecamatan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-between gap-3 mt-4">
                    <div>
                        <button type="button" onclick="closeModal({{ $detail->id }})" class="text-gray-600 hover:underline">Batal</button>
                        <button type="submit" class="bg-lime-500 text-white px-4 py-2 rounded hover:bg-lime-700">Ubah</button>
                    </div>
            </form>

            <form method="post" action="{{ route('alamat.destroy', $detail->id) }}" onsubmit="return confirm('Yakin ingin menghapus alamat ini?');">
                @csrf
                @method('delete')
                <button type="submit" class="text-red-600 hover:underline ml-4 mt-2">Hapus</button>
            </form>
                </div>
        </div>
    </div>
    @endforeach

    <script>
        function openModal(id) {
            document.getElementById(`modal-${id}`).classList.remove('hidden');
            document.getElementById(`modal-${id}`).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(`modal-${id}`).classList.add('hidden');
            document.getElementById(`modal-${id}`).classList.remove('flex');
        }
    </script>
</section>
