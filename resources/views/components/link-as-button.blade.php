@props(['href' => '#',
        'class' => ''])
    <a href="{{ $href }}"
       class="@if(!$class)
           bg-blue-500 hover:bg-blue-700 text-white font-bold p-3.5 rounded-md
            @else
            {{ $class }}
           @endif"
    >
        {{ $slot }}
    </a>

