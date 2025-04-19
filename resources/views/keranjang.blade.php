<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang</title>
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

    <!-- Konten Utama -->
    <main class="flex-1 p-8">
      <h1 class="text-3xl font-bold text-[#B9C240] mb-6 flex items-center gap-2">
        Keranjang <i data-feather="shopping-cart"></i>
      </h1>

      <div class="flex flex-col lg:flex-row gap-6">
        <!-- Daftar Item -->
        <div class="flex-1 space-y-4">
          <!-- Item -->
          <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div class="flex items-center gap-4">
              <img src="{{ asset('images/maggot-produk.png') }}" class="w-16 h-16 object-cover rounded-md" alt="Maggot">
              <div>
                <h2 class="font-bold text-[#B9C240]">Maggot</h2>
                <p class="text-gray-500 text-sm">Rp. 18.000</p>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <input type="checkbox" class="w-5 h-5 text-[#B9C240] border-gray-300 rounded">
              <div class="flex items-center border border-gray-300 rounded-full px-2">
                <button class="px-1 text-[#B9C240] font-bold">-</button>
                <span class="px-2">1</span>
                <button class="px-1 text-[#B9C240] font-bold">+</button>
              </div>
              <button class="text-red-500 hover:text-red-700">
                <i data-feather="trash-2"></i>
              </button>
            </div>
          </div>

          <!-- Item kedua dan ketiga tinggal duplikat saja -->
        </div>

        <!-- Ringkasan Belanja -->
        <div class="w-full lg:w-1/3 bg-white p-4 rounded-xl shadow space-y-4">
          <h3 class="text-lg font-bold text-[#B9C240]">Ringkasan belanja</h3>

          <div class="flex justify-between items-center">
            <span class="text-sm text-gray-600">Lebih hemat dengan point</span>
            <div class="flex items-center gap-2">
              <span class="text-gray-800 font-bold">5.000 pts</span>
              <input type="checkbox" class="text-[#B9C240]">
            </div>
          </div>

          <div class="flex justify-between font-bold text-gray-800">
            <span>Total</span>
            <span>Rp. 13.000</span>
          </div>

          <button class="w-full bg-[#B9C240] text-white py-2 rounded-lg hover:bg-lime-800 font-semibold">
            Pesan
          </button>
        </div>
      </div>
    </main>

  </div>

  <script>
    feather.replace();
  </script>
</body>
</html>
