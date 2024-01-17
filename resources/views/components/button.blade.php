@php

$classes = [
    'inline-flex items-center gap-x-1.5 rounded-md px-2.5 py-1.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2',
    'bg-primary-600 hover:bg-primary-500 focus-visible:outline-primary-600 text-white'
];

@endphp

<button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->except(['class', 'type']) }} @class($classes)>
    {{ $slot }}
</button>
