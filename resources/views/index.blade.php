<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Build World with Maggot</title>


  @vite('resources/css/app.css')



</head>
<body class="bg-[#fff4e8] text-gray-800">
    <nav class="flex sticky items-center justify-between px-8 py-4 bg-white shadow-md top-0 left-0 right-0 z-50">
        <div>
            <a href="{{ route('beranda') }}" class="text-3xl font-bold italic text-[#B9C240]">WellMaggot</a>
        </div>
        <div class="space-x-6">

            @auth
                <a href="{{ route('dashboardUser') }}" class="text-[#B9C240] font-semibold hover:underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-[#B9C240] px-4 py-1 hover:bg-amber-500 hover:text-white hover:font-bold duration-500 rounded-full">Login</a>
                <a href="{{ route('register') }}" class="text-[#B9C240] px-4 py-2">Daftar</a>
            @endauth
        </div>
    </nav>
    <section class="relative overflow-hidden py-12 md:py-20">
        <!-- VIDEO BACKGROUND -->
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0 opacity-100">
          <source src="{{ asset('assets/index_bg.mp4') }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>

        <!-- OVERLAY (opsional) -->

        <!-- CONTENT -->
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-4 md:px-8">
          <div class="max-w-xl space-y-4 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-[#B9C240]">Build World <br />With Maggot</h1>
            <p class="text-sm md:text-base text-white italic">“Menyenangkan bila tempat tinggal yang kita huni hari ini masih terjaga dengan baik hingga anak, cucu, dan generasi penerus kita. Untuk itu telah menjadi tanggung jawab kita untuk menjaga lingkungan lebih baik dan jauh lebih baik lagi.”</p>
            <div class="flex justify-center md:justify-start">
              <a href="{{ route('login') }}" class="bg-[#B9C240] text-white px-5 py-2 rounded hover:bg-amber-500 duration-500 hover:font-bold inline-block text-sm md:text-base">Lihat Produk</a>
            </div>
          </div>
        </div>
      </section>


  <section class="bg-[#111B21] text-white py-20 px-4 md:px-12">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">
      <!-- Gambar kiri -->
      <div class="relative w-full md:w-1/2">
        <img src="{{ asset('assets/pemilik.png') }}" alt="pemilik" class="w-full rounded-md " />
        <!-- Elemen dekoratif opsional -->
        <div class="absolute bottom-[-10px] left-[-10px] w-6 h-6 bg-yellow-400 rounded-full"></div>
      </div>

      <!-- Teks kanan -->
      <div class="w-full md:w-1/2 space-y-4">
        <span class="bg-yellow-400 text-black font-bold text-sm px-3 py-1 rounded-md inline-block w-fit">Mashudi</span>
        <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">Bersama Kami,
            <span class="text-lime-200">Ciptakan Ekosistem </span>Lingkungan untuk
            <span class="text-red-500">Indonesia</span> <span>Lebih Baik</span></h3>
        <p class="text-sm md:text-base text-gray-500">
          Tujuan saya bukanlah semata mencari rupiah dari hasil penjualan. Namun saya juga ingin lingkungan yang saya dan generasi penerus saya setidaknya tidak buruk untuk ditinggali. Sampah telah menjadi momok masyarakat yang sulit untuk diurai atau dikelola. Kini di tahun 2025, kami akan membantu menyelesaikain masalah tersebut dibantu dengan digitalisasi!
        </p>
      </div>
    </div>
  </section>

  <section class="relative text-center py-10 bg-white">
    <!-- Tulisan di atas -->
    <div class="z-10 relative mb-6">
      <h2 class="text-2xl md:text-3xl font-bold text-[#111B21]">
        Republik Larva, <span class="text-lime-500">Perusahaan</span> atau <span class="text-amber-500">kandang?</span>
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto mt-2">
        Perusahaan ini berdiri sejak tahun 2019 tapatnya 10-November-2019. Berlokasi di Baratan Wetan, Baratan, Kec. Patrang, Kabupaten Jember, Jawa Timur. Menjadi salah satu kandang maggot terkenal di kota jember. Kami melayani penjualan 3 produk yaitu maggot, bibit maggot, dan kasgot (bibit maggot)
      </p>
    </div>

    <!-- Gambar dibawah dan terbalik -->
    <div class="w-full max-w-3xl mx-auto">
      <img src="{{ asset('assets/kandang.jpg') }}" alt="Kandang" class="w-full transform rotate-0 rounded-md" />
    </div>
  </section>

  <section class="relative py-10 bg-white">
    <div data-aos="fade-left">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4 md:items-start">
            <div class="md:w-1/2 flex flex-col justify-start mt-20">
                <h2 class="text-2xl md:text-3xl font-bold text-[#111B21] leading-tight">Apa itu.. <span class="text-lime-500">Bagi Sampah?</span></h2>
                <p class="text-gray-600 mt-4 leading-relaxed">Bagi sampah adalah salah satu fitur menarik, Mengapa? bagi anda jika merasa sampah dirumah terlalu menumpuk, kami bisa mengatasi. Anda hanya perlu mengirimkan sampah DAN! kami juga bisa mengambil ke rumah anda!
                </p>
            </div>
        <div class="md:w-1/2 flex justify-center items-start">
            <img src="{{ asset('assets/bagisampah.jpg') }}" alt="Kandang" class="w-full max-w-md rounded-md" />
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
</html>
