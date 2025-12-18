<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <livewire:dashboard.stats-grid />

            <!-- Content Grid -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- User Table (2/3 width) -->
                <div class="lg:col-span-2">
                    <livewire:dashboard.user-table />
                </div>

                <!-- Activity Log (1/3 width) -->
                <div>
                    <livewire:dashboard.activity-log />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>