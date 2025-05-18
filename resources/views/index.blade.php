<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Build World with Maggot</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-[#fff4e8] text-gray-800">
    <!-- Navbar -->
    <nav class="flex sticky items-center justify-between px-8 py-6 bg-amber-500 shadow-md top-0 left-0 right-0 z-50">
        <div>
            <a href="{{ route('beranda') }}"
                class="text-xl bg-white px-2 py-3 rounded-full font-bold italic text-[#B9C240]">WellMaggot</a>
        </div>
        <div class="space-x-6 font-semibold">
            @auth
                <a href="{{ route('dashboardUser') }}" class="text-[#B9C240] font-semibold hover:underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="text-white px-4 py-1 hover:bg-white hover:text-amber-500 hover:font-bold duration-500 rounded-full">Login</a>
                <a href="{{ route('register') }}"
                    class="text-white px-4 py-1 hover:bg-white hover:text-amber-500 hover:font-bold duration-500 rounded-full">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden py-12 md:py-20">
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0 opacity-100">
            <source src="{{ asset('assets/index_bg.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-4 md:px-8">
            <div class="max-w-xl space-y-4 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold text-amber-500 shadow-2xl">Build World <br />With Maggot</h1>
                <p class="text-sm md:text-base text-white italic">“Menyenangkan bila tempat tinggal yang kita huni hari
                    ini masih terjaga dengan baik hingga anak, cucu, dan generasi penerus kita.”</p>
                <div class="flex justify-center md:justify-start">
                    <a href="{{ route('login') }}"
                        class="bg-[#B9C240] text-white px-5 py-2 rounded hover:bg-amber-500 duration-500 hover:font-bold inline-block text-sm md:text-base">Lihat
                        Produk</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Pemilik -->
    <section class="bg-[#111B21] text-white py-20 px-4 md:px-12">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">
            <div class="relative w-full md:w-1/2">
                <img src="{{ asset('assets/pemilik.png') }}" alt="pemilik" class="w-full rounded-md" />
                <div class="absolute bottom-[-10px] left-[-10px] w-6 h-6 bg-yellow-400 rounded-full"></div>
            </div>
            <div class="w-full md:w-1/2 space-y-4">
                <span
                    class="bg-yellow-400 text-black font-bold text-sm px-3 py-1 rounded-md inline-block w-fit">Mashudi</span>
                <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">
                    Bersama Kami, <span class="text-lime-200">Ciptakan Ekosistem </span>Lingkungan untuk
                    <span class="text-red-500">Indonesia</span> <span>Lebih Baik</span>
                </h3>
                <p class="text-sm md:text-base text-gray-500">
                    Tujuan saya bukanlah semata mencari rupiah dari hasil penjualan. Namun saya juga ingin lingkungan
                    yang saya dan generasi penerus saya setidaknya tidak buruk untuk ditinggali...
                </p>
            </div>
        </div>


    </section>

    <section class="bg-white text-slate-800 py-20 px-4 md:px-12">
        <div class="flex flex-col md:flex-row items-start justify-between gap-10 max-w-7xl mx-auto px-6 py-20">
            <!-- KIRI -->
            <div class="md:w-1/2 text-slate-800 flex flex-col gap-6">
                <div>
                    <div data-aos="fade-up">
                        <h2 class="text-5xl font-bold leading-tight mb-4">
                            Jelajahi selengkapnya<br />
                            tentang <span class="text-amber-500">Produk berkualitas kami</span>
                        </h2>
                        <p class="text-lg text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Commodi accusamus totam doloremque dicta sapiente vitae unde obcaecati, perspiciatis natus
                            maxime!</p>
                    </div>
                </div>

                <!-- Tombol di bawah teks -->
                <!-- Tombol navigasi DI BAWAH TEKS -->
                <div class="flex gap-4 mt-4">
                    <button id="custom-prev"
                        class="border border-black text-black w-10 h-10 rounded-full flex items-center justify-center hover:bg-amber-500 hover:border-white hover:text-white duration-400 transition">
                        &larr;
                    </button>
                    <button id="custom-next"
                        class="border border-black text-black w-10 h-10 rounded-full flex items-center justify-center hover:bg-amber-500 hover:border-white hover:text-white duration-400 transition">
                        &rarr;
                    </button>
                </div>

            </div>

            <!-- KANAN -->
            <div class="md:w-1/2 w-full">
                <div class="swiper mySwiper w-full">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide bg-amber-100 text-black rounded-2xl p-6 shadow-xl">
                            <img src="{{ 'assets/maggot.jpg' }}" alt="Grup Privacy" class="rounded-xl mb-4" />
                            <h4 class="font-semibold text-xl mb-2">Maggot</h4>
                            <p class="text-gray-700 mb-2">
                                Anda bisa memilih siapa yang bisa menambahkan Anda ke chat grup...
                            </p>
                            <a href="#" class="text-green-600 font-medium hover:underline">
                                Coba Produk ↗
                            </a>
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide bg-amber-100 text-black rounded-2xl p-6 shadow-xl">
                            <img src="{{ 'assets/maggot.jpg' }}" alt="Grup Privacy" class="rounded-xl mb-4" />
                            <h4 class="font-semibold text-xl mb-2">Kasgot</h4>
                            <p class="text-gray-700 mb-2">
                                Tentukan siapa yang bisa melihat tanda terbaca pesan kamu...
                            </p>
                            <a href="#" class="text-green-600 font-medium hover:underline">
                                Coba Produk ↗
                            </a>
                        </div>
                        <div class="swiper-slide bg-amber-100 text-black rounded-2xl p-6 shadow-xl">
                            <img src="{{ 'assets/maggot.jpg' }}" alt="Grup Privacy" class="rounded-xl mb-4" />
                            <h4 class="font-semibold text-xl mb-2">Bibit Maggot</h4>
                            <p class="text-gray-700 mb-2">
                                Tentukan siapa yang bisa melihat tanda terbaca pesan kamu...
                            </p>
                            <a href="#" class="text-green-600 font-medium hover:underline">
                                Coba Produk ↗
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Footer -->
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".swiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: "#custom-next",
                prevEl: "#custom-prev",
            },
            grabCursor: true,
            effect: "slide",
        });
    </script>



</body>

</html>
