@props(['title', 'value', 'trend' => null, 'trendUp' => true])

<div class="p-6 bg-white border border-gray-100 shadow-sm dark:bg-gray-800 dark:border-gray-700 sm:rounded-lg">
    <div class="flex items-center">
        <div class="p-3 mr-4 text-indigo-500 bg-indigo-100 rounded-full dark:text-indigo-100 dark:bg-indigo-900">
            {{ $icon }}
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                {{ $title }}
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                {{ $value }}
            </p>
        </div>
    </div>
    @if($trend)
        <div class="flex items-center mt-4 text-sm">
            <span class="{{ $trendUp ? 'text-green-500' : 'text-red-500' }} flex items-center font-medium">
                @if($trendUp)
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                @else
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                    </svg>
                @endif
                {{ $trend }}
            </span>
            <span class="ml-2 text-gray-400">vs last month</span>
        </div>
    @endif
</div>