@props(['href' => '#'])
    <a href="{{ $href }}"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-3.5 rounded-md"
    >
        {{ $slot }}
    </a>

