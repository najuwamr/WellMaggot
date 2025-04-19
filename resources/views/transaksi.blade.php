<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transaksi</title>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Wrapper -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#B9C240] text-white my-6 p-6 rounded-r-3xl">
        <div class="flex items-center space-x-2 mb-10">
            <i data-feather="user"></i>
            <span class="text-xl font-bold">Hi, Ken Riezqy</span>
        </div>

        <nav class="space-y-4 text-lg">
            <a href="#" class="flex items-center text-2xl font-bold gap-2 hover:text-gray-600">
                <span>Beranda</span> <i data-feather="home"></i>
            </a>
            <hr>
            <a href="#" class="flex items-center text-2xl font-bold gap-2 hover:text-gray-600">
                <span>Edukasi</span> <i data-feather="book-open"></i>
            </a>
            <hr>
            <a href="#" class="flex items-center text-2xl font-bold gap-2 hover:text-gray-600">
                <span>Bagi Sampah</span> <i data-feather="users"></i>
            </a>
            <hr>
            <a href="#" class="flex items-center text-2xl font-bold gap-2 hover:text-gray-600">
                <span>Produk</span> <i data-feather="package"></i>
            </a>
            <hr>
            <a href="#" class="flex items-center text-2xl font-bold gap-2 hover:text-gray-600">
                <span>Keranjang</span><i data-feather="shopping-cart"></i>
            </a>
            <hr>
            <a href="#" class="flex items-center text-2xl font-bold gap-2 hover:text-gray-600">
                <span>Transaksi</span> <i data-feather="repeat"></i>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h1 class="text-3xl font-bold text-[#B9C240] flex items-center gap-2 mb-8">Transaksi <i data-feather="repeat"></i></h1>

      <!-- Pesanan Saya -->
      <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Pesanan Saya</h2>
        <div class="space-y-4">
          <!-- Item Pesanan -->
          <div class="bg-white shadow p-4 rounded-xl flex items-center justify-between">
            <div class="flex items-center gap-4">
              <img src="https://via.placeholder.com/80" alt="Maggot" class="w-16 h-16 rounded-lg object-cover">
              <div>
                <p class="text-sm font-bold text-[#B9C240]">#Id10300</p>
                <h3 class="text-md font-semibold">Maggot</h3>
                <p class="text-xs text-gray-500 max-w-xs">Jl. A sebelah Rukun 09, Suaran bareng 03 rt 03 rw 03 Kecamatan Lorem Ipsum - MALANG - JAWA TIMUR, KOTA 0349</p>
              </div>
            </div>
            <div class="text-right">
              <span class="inline-block bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full mb-2">Dikemas</span>
              <p class="font-semibold text-gray-800">Rp. 18.000</p>
            </div>
          </div>

          <div class="bg-white shadow p-4 rounded-xl flex items-center justify-between">
            <div class="flex items-center gap-4">
              <img src="https://via.placeholder.com/80" alt="Maggot" class="w-16 h-16 rounded-lg object-cover">
              <div>
                <p class="text-sm font-bold text-[#B9C240]">#Id10300</p>
                <h3 class="text-md font-semibold">Maggot</h3>
                <p class="text-xs text-gray-500 max-w-xs">Jl. A sebelah Rukun 09, Suaran bareng 03 rt 03 rw 03 Kecamatan Lorem Ipsum - MALANG - JAWA TIMUR, KOTA 0349</p>
              </div>
            </div>
            <div class="text-right">
              <span class="inline-block bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full mb-2">Dikirim</span>
              <p class="font-semibold text-gray-800">Rp. 18.000</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Riwayat Transaksi -->
      <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Riwayat Transaksi</h2>
        <div class="space-y-4">
          <!-- Item Riwayat -->
          <div class="bg-white shadow p-4 rounded-xl flex items-center justify-between">
            <div class="flex items-center gap-4">
              <img src="https://via.placeholder.com/80" alt="Maggot" class="w-16 h-16 rounded-lg object-cover">
              <div>
                <p class="text-sm font-bold text-[#B9C240]">#Id10300</p>
                <h3 class="text-md font-semibold">Maggot</h3>
                <p class="text-xs text-gray-500 max-w-xs">Jl. A sebelah Rukun 09, Suaran bareng 03 rt 03 rw 03 Kecamatan Lorem Ipsum - MALANG - JAWA TIMUR, KOTA 0349</p>
              </div>
            </div>
            <div class="text-right">
              <span class="inline-block bg-[#B9C240] text-white text-xs font-semibold px-3 py-1 rounded-full mb-2">Selesai</span>
              <p class="font-semibold text-gray-800">Rp. 18.000</p>
            </div>
          </div>

          <!-- Duplikat sesuai jumlah riwayat -->
          <!-- (kamu bisa buat loop kalau pakai blade/vue nanti) -->
        </div>
      </section>

      <div class="text-center">
        <a href="#" class="inline-flex items-center bg-[#B9C240] text-white font-semibold px-6 py-2 rounded-full hover:bg-lime-700 transition">
          Lihat Produk <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
        </a>
      </div>

    </main>
  </div>

  <script>
    feather.replace();
  </script>
</body>
</html>
