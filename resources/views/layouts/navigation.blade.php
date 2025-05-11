<nav x-data="{ open: false, userMenu: false }" class="sticky top-0 z-50 bg-white shadow-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('dashboardUser') }}">
                    <img class="h-10 w-auto" src="{{ asset('storage/images/WellMaggot.png') }}" alt="Logo">
                </a>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex md:items-center md:space-x-2 bg-chartreuse px-4 py-2 rounded-full">
                @php
                    $navItems = [
                        ['label' => 'Dashboard', 'route' => 'dashboardUser'],
                        ['label' => 'Edukasi', 'route' => 'edukasi.index', 'pattern' => 'edukasi.*'],
                        ['label' => 'Bagi Sampah', 'route' => 'bagi-sampah.index', 'pattern' => 'bagi-sampah.*'],
                        ['label' => 'Produk', 'route' => 'produk.index', 'pattern' => 'produk.*'],
                        ['label' => 'Transaksi', 'route' => 'transaksi.index', 'pattern' => 'transaksi.*'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="text-white font-semibold text-sm lg:text-base px-3 py-1 rounded-full
                            {{ request()->routeIs($item['pattern'] ?? $item['route'])
                                ? 'bg-white/20 backdrop-blur-sm'
                                : 'hover:bg-white/30 transition' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Mobile Hamburger --}}
            <div class="md:hidden">
                <button @click="open = !open" class="text-chartreuse focus:outline-none text-2xl">
                    ☰
                </button>
            </div>

            {{-- Auth & Cart --}}
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    @if (Auth::user()->role_id == 1)
                        <a href="{{ route('keranjang.index') }}" class="text-chartreuse text-xl hover:text-[#9da836]">
                            🛒
                        </a>
                    @endif

                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu"
                                class="bg-chartreuse text-white text-sm lg:text-base font-semibold px-4 py-1 rounded-full focus:outline-none">
                            Hi, {{ Auth::user()->name }}
                        </button>
                        <div x-show="userMenu" @click.away="userMenu = false"
                             class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50">
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
                    <a href="{{ route('register') }}" class="text-chartreuse text-sm lg:text-base font-semibold hover:underline">Daftar</a>
                    <a href="{{ route('login') }}" class="bg-chartreuse text-white text-sm lg:text-base font-semibold px-3 py-1 rounded hover:bg-[#9da836]">
                        Login
                    </a>
                @endauth
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" class="md:hidden mt-3 space-y-2">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="block px-3 py-2 text-chartreuse font-semibold rounded hover:bg-gray-100">
                    {{ $item['label'] }}
                </a>
            @endforeach

            @auth
                @if (Auth::user()->role_id == 1)
                    <a href="{{ route('keranjang.index') }}" class="block px-3 py-2 text-xl text-chartreuse">🛒</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('register') }}" class="block px-3 py-2 text-chartreuse font-semibold">Daftar</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 bg-chartreuse text-white rounded">Login</a>
            @endauth
        </div>
    </div>
</nav>
