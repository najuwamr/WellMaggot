<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="relative flex items-center justify-between h-16">

                {{-- Kiri (kosong / logo) --}}
                <div class="flex-shrink-0 w-1/4">
                    <img src="{{asset('images/WellMaggot.png')}}" alt="">
                </div>

                {{-- Tengah (navigasi menu) --}}
                <div class="hidden md:flex items-center justify-center flex-1">
                    <div class="flex space-x-1 bg-[#B9C240] rounded-full px-4 py-1">
                        <a href="{{ route('tentang') }}"
                            class="text-white font-semibold px-3 py-1 text-sm {{ request()->routeIs('tentang') ? 'underline' : 'hover:underline' }}">
                            Beranda
                        </a>
                        <a href="{{ route('edukasi.index') }}"
                            class="text-white font-semibold px-3 py-1 text-sm {{ request()->routeIs('edukasi.*') ? 'underline' : 'hover:underline' }}">
                            Edukasi
                        </a>
                        <a href="{{ route('bagi-sampah.index') }}"
                            class="text-white font-semibold px-3 py-1 text-sm {{ request()->routeIs('bagi-sampah.*') ? 'underline' : 'hover:underline' }}">
                            Bagi Sampah
                        </a>
                        <a href="{{ route('produk.index') }}"
                            class="text-white font-semibold px-3 py-1 text-sm {{ request()->routeIs('produk.*') ? 'underline' : 'hover:underline' }}">
                            Produk
                        </a>
                        <a href="{{ route('keranjang.tambah') }}"
                            class="text-white font-semibold px-3 py-1 text-sm {{ request()->routeIs('keranjang.*') ? 'underline' : 'hover:underline' }}">
                            Keranjang
                        </a>
                        <a href="{{ route('transaksi.index') }}"
                            class="text-white font-semibold px-3 py-1 text-sm {{ request()->routeIs('transaksi.*') ? 'underline' : 'hover:underline' }}">
                            Transaksi
                        </a>
                    </div>
                </div>

                {{-- Kanan (nama user) --}}
                <div class="flex items-center justify-end w-1/4">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="ml-auto bg-[#B9C240] rounded-full px-4 py-1 text-white text-sm font-semibold focus:outline-none">
                                Hi, {{ Auth::user()->name }}
                            </button>

                            {{-- Dropdown --}}
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50 overflow-hidden">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex space-x-2 ml-auto">
                            <a href="{{ route('register') }}"
                                class="text-[#B9C240] font-semibold hover:underline text-sm md:text-base">Daftar</a>
                            <a href="{{ route('login') }}"
                                class="bg-[#B9C240] text-white font-semibold px-4 py-1 rounded hover:bg-[#9da836] text-sm md:text-base">Masuk</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</nav>
