@props(['title', 'content', 'reverse' => false])

<div class="bg-white/90 backdrop-blur-md rounded-lg shadow-lg p-6 flex flex-col md:flex-row {{ $reverse ? 'md:flex-row-reverse' : '' }} items-start md:items-center gap-6">
    <div class="w-40 h-40 bg-gray-300"></div>
    <div>
        <h2 class="text-[#B9C240] font-bold text-lg mb-2">{{ $title }}</h2>
        <p class="text-sm text-gray-700 text-justify">{{ $content }}</p>
    </div>
</div>

