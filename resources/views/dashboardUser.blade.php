<x-app-layout>
    <div class="flex flex-col min-h-screen">
        <!-- Hero Section -->
        <section class="bg-[#B9C240] text-white px-4 md:px-16 py-12 flex-1 flex items-center">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full">
                <div class="space-y-6 flex flex-col justify-center">
                    <h1 class="text-3xl md:text-5xl font-bold leading-tight">
                        Selamat Datang di WellMaggot
                    </h1>
                    <p class="text-base md:text-lg italic">
                        WellMaggot adalah media web yang dirancang untuk mengelola pengajuan sampah organik dan distribusi maggot secara efisien.
                    </p>
                    <a href="{{ route('produk.index') }}"
                       class="inline-block w-40 text-center bg-white text-[#B9C240] font-semibold px-6 py-3 rounded-full shadow hover:bg-[#f3f3f3] transition">
                        Lihat Produk
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <img src="{{ asset('images/maggot-2.png') }}" alt="Maggot"
                         class="w-52 md:w-64 lg:w-72 drop-shadow-lg" />
                </div>
            </div>
        </section>

        {{-- <section id="Halaman-Edukasi">
            <div>
                <div>
                    <h1>Maggot</h1>
                </div>
                <div>
                </div>

            </div>
        </section> --}}


        <footer class="bg-[#B9C240] text-white py-4 mb-0">
            <div class="w-full px-4 text-center">
                <p class="text-sm">&copy; 2025 WellMaggot. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
