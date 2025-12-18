@props(['active' => false, 'title'])

@php
    $classes = 'flex items-center w-full px-3 py-2 text-sm font-medium rounded-md transition-colors text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700';
@endphp

<div x-data="{ open: @json($active) }">
    <button @click="open = !open" {{ $attributes->merge(['class' => $classes]) }}>
        @if (isset($icon))
            {{ $icon }}
        @else
            {{ $slot }}
        @endif
        <span class="flex-1 text-left">{{ $title }}</span>
        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-90': open}" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
    <div x-show="open" x-collapse class="mt-1 space-y-1">
        {{ $submenu }}
    </div>
</div>