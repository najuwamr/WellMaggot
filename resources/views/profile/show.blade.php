<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Profil Saya</h1>

        <div class="space-y-4">
            <div>
                <strong>Nama:</strong> {{ $user->name }}
            </div>
            <div>
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div>
                <strong>Tanggal Bergabung:</strong> {{ $user->created_at->format('d M Y') }}
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profil</a>
        </div>
    </div>
</x-app-layout>
