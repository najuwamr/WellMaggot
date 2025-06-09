<x-app-layout>
    <div class="flex flex-col min-h-screen">
        <!-- Hero Section -->
        <section class="bg-white w-full text-slate-600 px-4 md:px-16 py-12 flex-1 flex rounded-fullitems-center">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10 w-full">
                <div data-aos="fade-up">
                    <div class="space-y-6 flex flex-col justify-center">
                        <h1 class="text-3xl md:text-5xl font-semibold leading-tight">
                            Selamat Datang di
                            <span class="text-amber-500 font-semibold">WellMaggot</span>
                        </h1>
                        <p class="text-base md:text-lg text-slate-400">
                            WellMaggot adalah media web yang dirancang untuk mengelola pengajuan sampah organik dan
                            distribusi maggot secara efisien.
                        </p>
                        <a href="{{ route('produk.index') }}"
                            class="inline-block w-40 text-center bg-amber-500 text-white font-semibold px-6 py-3 rounded-lg shadow-2xl hover:bg-white hover:text-amber-500 hover:font-bold transition duration-500">
                            Lihat Produk
                        </a>
                    </div>
                </div>

                <div class="flex justify-center items-center">
                    <div data-aos="fade-right">
                        <img src="{{ asset('assets/lingkungan2.png') }}" alt=""
                            class="w-full max-w-md lg:max-w-lg object-contain mx-auto drop-shadow-md" />
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white relative py-10">
            <div data-aos="fade-up">
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4 md:items-center">
                    <div class="md:w-1/2 flex items-start">
                        <img src="{{ asset('assets/coin.jpg') }}" alt="Kandang" class="w-full max-w-md rounded-md" />
                    </div>
                    <div class="md:w-1/2 flex flex-col justify-center text-center mt-20">
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-300 shadow-2xlleading-tight">TUKARKAN
                            POIN<span class="text-slate-500"> BISA DAPAT </span>
                            <span class="text-yellow-400">BERAS?</span>
                        </h2>
                        <p class="text-gray-400 mt-4 text-left leading-relaxed">Poin adalah alat tukar untuk kamu yang
                            ingin mendapatkan benefit dari bagi sampah. Nah, kamu bisa pilih barang apa aja yang kamu
                            mau, TAPI kalau ada ya! Kalau kepo barang apa aj bisa langsung checkidot!
                        </p>
                        <a href="{{ route('produk.index') }}"
                            class="mt-3 w-[120px] text-left bg-yellow-300 text-yellow-500 font-semibold px-4 py-3 rounded-lg shadow hover:bg-white hover:text-amber-500 hover:font-bold transition duration-500">
                            Tukar Poin!
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <section class="bg-[#111B21] min-h-screen flex items-center">
            <div data-aos="fade-up" class="w-full">
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 px-4">

                    <div class="md:w-1/2 flex flex-col justify-center text-left">

                        <h2 class="text-2xl md:text-3xl font-bold text-slate-100 leading-tight">ATUR JADWAL<span
                                class="text-purple-300">, KITA JEMPUT </span>

                        </h2>
                        <p class="text-white mt-4 text-left leading-relaxed">Jadi nanti waktu kamu ingin bagi sampah
                            kamu ke kami, kamu gaperlu repot untuk jauh dateng ke tempat kami lho! Sampah kamu nanti
                            kita yang jemput OK?
                        </p>
                        <a href="{{ route('produk.index') }}"
                            class="mt-7 w-[120px] text-left bg-yellow-300 text-yellow-500 font-semibold px-4 py-3 rounded-lg shadow hover:bg-white hover:text-amber-500 hover:font-bold transition duration-500">
                            Tukar Poin!
                        </a>
                    </div>

                    <div class="md:w-1/2 flex">
                        <img src="{{ asset('assets/calender3.png') }}" alt="Kandang"
                            class="w-full max-w-md rounded-md" />
                    </div>

                </div>
            </div>
        </section>
        <section class="bg-green-50 relative py-10">
            <div data-aos="fade-up">
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4 md:items-center">
                    <div class="md:w-1/2 flex items-start">
                        <img src="{{ asset('assets/hubungi-kami.png') }}" alt="Kandang"
                            class="w-full max-w-md rounded-md" />
                    </div>
                    <div class="md:w-1/2 flex flex-col justify-center text-center mt-20">
                        <h2 class="text-2xl md:text-3xl text-start font-bold text-green-600 leading-tight">PUNYA
                            KENDALA,
                            HUBUNGI KAMI AJA!

                        </h2>
                        <p class="text-gray-400 mt-4 text-left leading-relaxed">Kalau emang ada masalah pada poin atau
                            produk yang kamu beli bisa hubungi kami, hanya dengan klik tombol dibawah ini! pasti dibalas
                            kok!
                        </p>
                        <a href="https://wa.me/6281336104254" target="_blank"
                            class="bg-green-500 text-white mt-5 px-4 py-2 rounded-lg font-bold hover:bg-green-600 inline-flex justify-start gap-3">
                            Hubungi Kami!<i data-feather="phone"></i>
                        </a>
                    </div>

                </div>
            </div>
        </section>

    </div>
</x-app-layout>
