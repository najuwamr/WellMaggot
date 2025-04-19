<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk - WellMaggot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="font-sans bg-white text-gray-800">

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

        <!-- Konten -->
        <main class="flex-1 p-10">
            <h1 class="text-4xl font-bold text-[#B9C240] italic mb-2">Produk</h1>
            <p class="text-sm mb-6">
                Cari solusi cerdas untuk sampah organik? Pilih WellMaggot! <br>
                Praktis, modern, dan berdampak. Beli sekarang dan jadilah bagian dari perubahan hijau!
            </p>

            <!-- Produk Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Produk 1 -->
                <div class="bg-white shadow rounded-lg p-4 relative">
                    <span class="absolute top-0 left-0 bg-yellow-300 text-xs font-bold px-2 py-1 rounded-br-lg">Best Deal</span>
                    <img src="{{ asset('images/maggot-produk.png') }}" alt="Maggot" class="w-full h-40 object-cover rounded mb-2">
                    <h2 class="text-lg font-semibold text-center">Maggot</h2>
                    <p class="text-center text-[#B9C240] font-bold">Rp. 9000 <span class="text-sm">/kg</span></p>
                </div>

                <!-- Produk 2 -->
                <div class="bg-white shadow rounded-lg p-4">
                    <img src="{{ asset('images/maggot-produk.png') }}" alt="Bibit Maggot" class="w-full h-40 object-cover rounded mb-2">
                    <h2 class="text-lg font-semibold text-center">Bibit Maggot</h2>
                    <p class="text-center text-sm text-gray-600">1 kg</p>
                    <p class="text-center text-[#B9C240] font-bold">Rp. 9000 <span class="text-sm">/gr</span></p>
                </div>

                <!-- Produk 3 -->
                <div class="bg-white shadow rounded-lg p-4">
                    <img src="{{ asset('images/pupuk-produk.png') }}" alt="Pupuk Kompos" class="w-full h-40 object-cover rounded mb-2">
                    <h2 class="text-lg font-semibold text-center">Pupuk Kompos</h2>
                    <p class="text-center text-sm text-gray-600">20 kg</p>
                    <p class="text-center text-[#B9C240] font-bold">Rp. 20.000 <span class="text-sm">/karung</span></p>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
