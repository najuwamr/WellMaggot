<x-app-layout>
    <div class="flex flex-col min-h-screen">
        <!-- Hero Section -->
        <section class="bg-white w-full text-[#111B21] px-4 md:px-16 py-12 flex-1 flex rounded-fullitems-center">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full">
                <div class="space-y-6 flex flex-col justify-center">
                    <h1 class="text-3xl md:text-5xl font-light leading-tight">
                        Selamat Datang di
                        <span class="text-amber-500 font-semibold">WellMaggot</span>
                    </h1>
                    <p class="text-base md:text-lg text-slate-400">
                        WellMaggot adalah media web yang dirancang untuk mengelola pengajuan sampah organik dan distribusi maggot secara efisien.
                    </p>
                    <a href="{{ route('produk.index') }}"
                       class="inline-block w-40 text-center bg-amber-500 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-white hover:text-amber-500 hover:font-bold transition duration-500">
                        Lihat Produk
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <img src="{{ asset('assets/lingkungan2.png') }}" alt=""
                         class="transform scale-150 md:w-transform scale-20 lg:w-4/5 drop-shadow-lg" />
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
