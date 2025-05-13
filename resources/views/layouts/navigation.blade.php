<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-amber-500 ">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">

            <div class="flex-shrink-0 w-1/4">
                <img src="{{ asset('storage/images/WellMaggot.png') }}" alt="Logo" class="h-12">
            </div>

            <div class="hidden md:flex items-center justify-center flex-1">
                <div class="flex space-x-2 px-6 py-2">
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
                            class="text-white text-base font-semibold px-4 py-2 rounded-lg
                                {{ request()->routeIs($item['pattern'] ?? $item['route'])
                                    ? 'shadow-lg'
                                    : 'hover:bg-white hover:text-amber-500 hover:font-bold transition duration-500' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end w-1/4">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="bg-white rounded-full px-5 py-2 text-amber-500 text-base font-semibold focus:outline-none">
                            Hi! {{ Auth::user()->name }}
                        </button>
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
                    <div class="flex space-x-2">
                        <a href="{{ route('register') }}"
                            class="text-[#B9C240] font-semibold hover:underline text-base">Daftar</a>
                        <a href="{{ route('login') }}"
                            class="bg-[#B9C240] text-white font-semibold px-4 py-2 rounded hover:bg-[#9da836] text-base">Login</a>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</nav>
