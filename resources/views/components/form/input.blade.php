@php

$name = $attributes->get('name') ?? $attributes->get('wire:model');

$classes = [
    'block w-full rounded-md border-0 px-3 py-1.5 pr-10 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',

    'focus:ring-primary-500' => !$errors->has($name),

    'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $errors->has($name),
];

@endphp

<input type="{{ $attributes->get('type', 'text') }}" @class($classes) {{ $attributes->except(['class', 'type']) }}>
