<x-app-layout>
    <div class="flex flex-col min-h-screen">
        <!-- Hero Section -->
        {{-- <section class="bg-white w-full text-slate-600 px-4 md:px-16 py-12 flex-1 flex rounded-fullitems-center">
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
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-300 shadow-2xlleading-tight">TUKARKAN POIN<span
                                class="text-slate-500"> BISA DAPAT </span>
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
                        <p class="text-white mt-4 text-left leading-relaxed">Jadi nanti waktu kamu ingin bagi sampah kamu ke kami, kamu gaperlu repot untuk jauh dateng ke tempat kami lho! Sampah kamu nanti kita yang jemput OK?
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
    </div> --}}


        <body class="bg-[#fff4e8] text-gray-800">

            <section class="relative overflow-hidden py-12 md:py-20">
                <!-- VIDEO BACKGROUND -->
                <video autoplay muted loop playsinline
                    class="absolute top-0 left-0 w-full h-full object-cover z-0 opacity-100">
                    <source src="{{ asset('assets/index_bg.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

                <!-- OVERLAY (opsional) -->

                <!-- CONTENT -->
                <div data-aos="fade-up">
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-4 md:px-8">
                        <div class="max-w-xl space-y-4 text-center md:text-left">
                            <h1 class="text-3xl md:text-4xl font-bold text-amber-500 shadow-2xl">Build World <br />With
                                Maggot</h1>
                            <p class="text-sm md:text-base text-white italic">“Menyenangkan bila tempat tinggal yang
                                kita
                                huni hari
                                ini masih terjaga dengan baik hingga anak, cucu, dan generasi penerus kita. Untuk itu
                                telah
                                menjadi
                                tanggung jawab kita untuk menjaga lingkungan lebih baik dan jauh lebih baik lagi.”</p>
                            <div class="flex justify-center md:justify-start">
                                <a href="{{ route('produk.index') }}"
                                    class="bg-lime-500 text-white px-5 py-2 font-semibold rounded hover:bg-amber-500 duration-500 hover:font-bold inline-block md:text-base">Lihat
                                    Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="bg-[#111B21] text-white py-20 px-4 md:px-12">
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">
                    <!-- Gambar kiri -->
                    <div data-aos="fade-up">
                        <div class="relative w-full md:w-1/2">
                            <img src="{{ asset('assets/pemilik.png') }}" alt="pemilik" class="w-full rounded-md " />
                            <!-- Elemen dekoratif opsional -->
                            <div class="absolute bottom-[-10px] left-[-10px] w-6 h-6 bg-yellow-400 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Teks kanan -->

                    <div class="w-full md:w-1/2 space-y-4">
                        <span
                            class="bg-yellow-400 text-black font-bold text-sm px-3 py-1 rounded-md inline-block w-fit">Mashudi</span>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">Bersama Kami,
                            <span class="text-lime-200">Ciptakan Ekosistem </span>Lingkungan untuk
                            <span class="text-red-500">Indonesia</span> <span>Lebih Baik</span>
                        </h3>
                        <div data-aos="fade-up">
                            <p class="text-sm md:text-base text-gray-500">
                                Tujuan saya bukanlah semata mencari rupiah dari hasil penjualan. Namun saya juga
                                ingin
                                lingkungan
                                yang saya dan generasi penerus saya setidaknya tidak buruk untuk ditinggali. Sampah
                                telah
                                menjadi
                                momok masyarakat yang sulit untuk diurai atau dikelola. Kini di tahun 2025, kami
                                akan
                                membantu
                                menyelesaikain masalah tersebut dibantu dengan digitalisasi!
                            </p>
                        </div>
                    </div>

                </div>
            </section>

            <div data-aos="fade-up">
                <section class="relative text-center py-10 bg-white">
                    <!-- Tulisan di atas -->
                    <div class="z-10 relative mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-[#111B21]">
                            Republik Larva, <span class="text-lime-500">Perusahaan</span> atau <span
                                class="text-amber-500">kandang?</span>
                        </h2>
                        <p class="text-gray-600 max-w-2xl mx-auto mt-2">
                            Perusahaan ini berdiri sejak tahun 2019 tapatnya 10-November-2019. Berlokasi di Baratan
                            Wetan,
                            Baratan,
                            Kec. Patrang, Kabupaten Jember, Jawa Timur. Menjadi salah satu kandang maggot terkenal di
                            kota
                            jember.
                            Kami melayani penjualan 3 produk yaitu maggot, bibit maggot, dan kasgot (bibit maggot)
                        </p>
                    </div>

                    <!-- Gambar dibawah dan terbalik -->
                    <div class="w-full max-w-3xl mx-auto">
                        <img src="{{ asset('assets/kandang.jpg') }}" alt="Kandang"
                            class="w-full transform rotate-0 rounded-md" />
                    </div>
                </section>
            </div>

            <section class="relative py-10 bg-white">
                <div data-aos="fade-left">
                    <div class="flex flex-row justify-end items-center gap-8 px-8 max-w-screen-xl mx-auto">
                        <div class="md:w-1/2 mt-20">
                            <h2 class="text-2xl md:text-3xl font-bold text-[#111B21] leading-tight">
                                Apa itu.. <span class="text-lime-500">Bagi Sampah?</span>
                            </h2>
                            <p class="text-gray-600 mt-4 leading-relaxed">
                                Bagi sampah adalah salah satu fitur menarik. Mengapa? Jika Anda merasa sampah di rumah
                                terlalu menumpuk, kami bisa mengatasi. Anda hanya perlu mengirimkan sampah DAN kami juga
                                bisa mengambil ke rumah Anda!
                            </p>

                            <!-- ⬇️ Button diletakkan tepat di bawah teks -->
                            <a href="{{ route('bagi-sampah.index') }}"
                                class="mt-6 inline-block bg-lime-500 text-white px-5 py-2 font-semibold rounded hover:bg-amber-500 duration-500 hover:font-bold md:text-base">
                                Coba sekarang!
                            </a>
                        </div>

                        <div>
                            <img src="{{ asset('assets/bagisampah.jpg') }}" alt="Kandang" class="w-full max-w-md" />
                        </div>
                    </div>
                </div>
            </section>


            <footer class="bg-[#B9C240] text-white py-8">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-xl font-bold">Build World with Maggot</h3>
                            <p class="text-sm mt-1">© 2025 All Rights Reserved</p>
                        </div>

                        <div class="flex space-x-6">
                            <a href="#" class="hover:text-gray-200 text-sm">Tentang</a>
                            <a href="#" class="hover:text-gray-200 text-sm">Kontak</a>
                        </div>
                    </div>

                    <div class="border-t border-white/20 mt-6 pt-6 text-center text-sm">
                        <p>Dibangun sepenuh hati untuk lingkungan yang lebih baik</p>
                    </div>
                </div>
            </footer>
        </body>
</x-app-layout>
