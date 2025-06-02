<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-amber-500">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <div class="flex-shrink-0 w-1/4">
                <img src="{{ asset('storage/images/WellMaggot.png') }}" alt="Logo" class="h-12">
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center justify-center flex-1">
                <div class="flex space-x-2 px-6 py-2">
                    @php
                        $navItems = [
                            ['label' => 'Home', 'route' => 'dashboardUser'],
                            ['label' => 'Poin', 'route' => 'point.index', 'pattern' => 'point.*'],
                            ['label' => 'Bagi Sampah', 'route' => 'bagi-sampah.index', 'pattern' => 'bagi-sampah.*'],
                            ['label' => 'Produk', 'route' => 'produk.index', 'pattern' => 'produk.*'],
                            ['label' => 'Transaksi', 'route' => 'transaksi.index', 'pattern' => 'transaksi.*'],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="text-white text-base font-semibold px-4 py-2 rounded-lg
                                {{ request()->routeIs($item['pattern'] ?? $item['route'])
                                    ? 'shadow-lg'
                                    : 'hover:bg-white hover:text-amber-500 hover:font-bold transition duration-500' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- User Info / Auth -->
            <div class="hidden md:flex items-center justify-end w-1/4">
                @auth
                    <div x-data="{ userDropdown: false }" class="relative">
                        <button @click="userDropdown = !userDropdown"
                            class="bg-white rounded-full px-5 py-2 text-amber-500 text-base font-semibold focus:outline-none">
                            Hi! {{ Auth::user()->name }}
                        </button>
                        <div x-show="userDropdown" @click.away="userDropdown = false"
                            class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50 overflow-hidden">
                            <a href="{{ route('profile.show') }}"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Lihat Profil
                            </a>
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
                    <div class="flex space-x-2">
                        <a href="{{ route('register') }}"
                            class="text-[#B9C240] font-semibold hover:underline text-base">Daftar</a>
                        <a href="{{ route('login') }}"
                            class="bg-[#B9C240] text-white font-semibold px-4 py-2 rounded hover:bg-[#9da836] text-base">Login</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger Button (Mobile only) -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            class="md:hidden flex flex-col space-y-2 mb-9 bg-amber-400 p-4 rounded-xl shadow-lg">

            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                    class="text-white font-semibold py-2 px-4 rounded hover:bg-white hover:text-amber-500">
                    {{ $item['label'] }}
                </a>
            @endforeach

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left py-2 px-4 text-white hover:bg-white hover:text-amber-500 rounded">
                        Logout
                    </button>
                </form>
            @else
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('register') }}"
                        class="text-[#B9C240] font-semibold hover:underline text-base">Daftar</a>
                    <a href="{{ route('login') }}"
                        class="bg-[#B9C240] text-white font-semibold px-4 py-2 rounded hover:bg-[#9da836] text-base">Login</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
