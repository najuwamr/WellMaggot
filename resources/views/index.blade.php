<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Build World with Maggot</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-white text-gray-800">
    <nav class="flex sticky items-center justify-between px-8 py-4 bg-white shadow-md top-0 left-0 right-0 z-50">
        <div>
            <a href="{{ route('beranda') }}" class="text-3xl font-bold italic text-[#B9C240]">WellMaggot</a>
        </div>
        <div class="space-x-6">
            <a href="#tentang-kami" class="text-[#B9C240] hover:text-lime-900 transition duration-200">Tentang Kami</a>

            @auth
                <a href="{{ route('dashboardUser') }}" class="text-[#B9C240] font-semibold hover:underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-[#B9C240] ring-2 px-4 py-1 ring-[#B9C240] rounded-full">Login</a>
                <a href="{{ route('register') }}" class="bg-[#B9C240] hover:bg-lime-900 text-white px-4 py-2 rounded-full">Daftar</a>
            @endauth
        </div>
    </nav>
  <section class="flex flex-col md:flex-row items-center justify-between px-4 md:px-8 py-12 md:py-20 bg-white">
    <div class="max-w-xl space-y-4 text-center md:text-left">
      <h1 class="text-3xl md:text-4xl font-bold text-[#B9C240]">Build World <br />With Maggot</h1>
      <p class="text-sm md:text-base text-gray-600 italic">“Maggot bukanlah hama, jangan jauhi, ia bukan sembarangan larva – ia bisa menjadi penyelamat lingkungan yang punya potensi besar dalam hal daur ulang.”</p>
      <div class="flex justify-center md:justify-start">
        <a href="#" class="bg-[#B9C240] text-white px-5 py-2 rounded hover:bg-[#9da836] inline-block text-sm md:text-base">Lihat Produk</a>
      </div>
    </div>
    <div class="mt-8 md:mt-0">
      <img src="{{ asset('images/maggot-2.png') }}" alt="Maggot" class="w-48 md:w-64 mx-auto" />
    </div>
  </section>

  <section class="px-4">
    <h2 id="tentang-kami" class="text-center text-[#B9C240] font-bold text-lg md:text-xl mb-6">Tentang kami</h2>
  </section>

  <section class="bg-repeat bg-center py-12 md:py-16 bg-[url('/images/maggot-real.png')]">
    <div class="max-w-5xl mx-auto space-y-8 md:space-y-10 px-4">
      <x-card title="Pemilik" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit..." :reverse="false" />
      <x-card title="Perusahaan" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit..." :reverse="true" />
      <x-card title="Capaian" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit..." :reverse="false" />
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
