{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'submit',
    'class' => 'bg-lime-500 text-white py-2 px-6 rounded-lg hover:bg-white hover:text-amber-500 transition-all font-bold'
]) !!}>
    {{ $slot }}
</button>
