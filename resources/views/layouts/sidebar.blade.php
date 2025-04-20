<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style type="text/tailwindcss">
            @layer utilities {
              .bg-chartreuse { background-color: #B9C240; }
              .text-chartreuse { color: #B9C240; }
              .focus\:ring-chartreuse:focus { --tw-ring-color: #B9C240; }
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <aside class="w-64 bg-[#B9C240] text-white my-6 p-6 rounded-r-3xl">
            <div class="flex items-center justify-end w-1/4">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button class="bg-[#B9C240] rounded-full px-5 py-2 text-white text-base font-semibold focus:outline-none">
                            Hi, {{ Auth::user()->name }}
                        </button>
                    </div>
                @else
                    <div class="flex space-x-2">
                        <a href="{{ route('login') }}"
                            class="bg-[#B9C240] text-white font-semibold px-4 py-2 rounded hover:bg-[#9da836] text-base">Masuk</a>
                    </div>
                @endauth
            </div>

            @php
            $sidebarItems = [
                ['label' => 'Produk', 'icon' => 'package', 'route' => 'produk.index', 'pattern' => 'produk.*'],
                ['label' => 'Transaksi', 'icon' => 'repeat', 'route' => 'transaksi.index', 'pattern' => 'transaksi.*'],
                ['label' => 'Bagi Sampah', 'icon' => 'users', 'route' => 'bagi-sampah.index', 'pattern' => 'bagi-sampah.*'],
                ['label' => 'Edukasi', 'icon' => 'book-open', 'route' => 'edukasi.index', 'pattern' => 'edukasi.*'],
            ];
            @endphp

            <div class="space-y-4 text-lg">
                @foreach ($sidebarItems as $item)
                    <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-2 px-4 py-2 text-2xl font-bold rounded-xl transition
                        {{ request()->routeIs($item['pattern'] ?? $item['route'])
                            ? 'bg-white text-[#B9C240]'
                            : 'hover:bg-white/20' }}">
                        <span>{{ $item['label'] }}</span> <i data-feather="{{ $item['icon'] }}"></i>
                    </a>
                    <hr>
                @endforeach
            </div>
        </aside>
    </body>
</html>
