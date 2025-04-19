<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang</title>
  <script src="https://unpkg.com/feather-icons"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

  <!-- Wrapper -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-lime-500 text-white p-6 flex flex-col">
      <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
          <div class="bg-white text-lime-500 rounded-full w-10 h-10 flex items-center justify-center">
            <i data-feather="user"></i>
          </div>
          <div class="font-semibold">Hi..Ken Riezqy</div>
        </div>
      </div>

      <nav class="space-y-4">
        <a href="#" class="flex items-center gap-3 hover:underline">
          <i data-feather="home"></i> Beranda
        </a>
        <a href="#" class="flex items-center gap-3 hover:underline">
          <i data-feather="book-open"></i> Edukasi
        </a>
        <a href="#" class="flex items-center gap-3 hover:underline">
          <i data-feather="users"></i> Bagi Sampah
        </a>
        <a href="#" class="flex items-center gap-3 hover:underline">
          <i data-feather="package"></i> Produk
        </a>
        <a href="#" class="flex items-center gap-3 hover:underline">
          <i data-feather="repeat"></i> Transaksi
        </a>
      </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-8">
      <h1 class="text-3xl font-bold text-lime-600 mb-6 flex items-center gap-2">
        Keranjang <i data-feather="shopping-cart"></i>
      </h1>

      <div class="flex flex-col lg:flex-row gap-6">
        <!-- Daftar Item -->
        <div class="flex-1 space-y-4">
          <!-- Item -->
          <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow">
            <div class="flex items-center gap-4">
              <img src="https://via.placeholder.com/70" class="w-16 h-16 object-cover rounded-md" alt="Maggot">
              <div>
                <h2 class="font-bold text-lime-700">Maggot</h2>
                <p class="text-gray-500 text-sm">Rp. 18.000</p>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <input type="checkbox" class="w-5 h-5 text-lime-600 border-gray-300 rounded">
              <div class="flex items-center border border-gray-300 rounded-full px-2">
                <button class="px-1 text-lime-600 font-bold">-</button>
                <span class="px-2">1</span>
                <button class="px-1 text-lime-600 font-bold">+</button>
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
          <h3 class="text-lg font-bold text-gray-800">Ringkasan belanja</h3>

          <div class="flex justify-between items-center">
            <span class="text-sm text-gray-600">Lebih hemat dengan point</span>
            <div class="flex items-center gap-2">
              <span class="text-lime-700 font-bold">5.000 pts</span>
              <input type="checkbox" class="text-lime-600">
            </div>
          </div>

          <div class="flex justify-between font-bold text-gray-800">
            <span>Total</span>
            <span>Rp. 13.000</span>
          </div>

          <button class="w-full bg-lime-500 text-white py-2 rounded-lg hover:bg-lime-600 font-semibold">
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
