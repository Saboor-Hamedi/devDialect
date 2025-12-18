@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300'
        : 'flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>