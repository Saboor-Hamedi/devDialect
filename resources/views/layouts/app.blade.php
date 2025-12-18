<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Handle Theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        // Handle Sidebar state to prevent layout jump on load
        const isDesktop = window.innerWidth >= 1024;
        const sidebarState = localStorage.getItem('sidebarOpen');
        if (isDesktop && (sidebarState === null || sidebarState === 'true')) {
            document.documentElement.classList.add('sidebar-expanded', 'is-loading');
        } else {
            document.documentElement.classList.remove('sidebar-expanded');
        }
    </script>
</head>

<body class="antialiased" x-data="{
        sidebarOpen: document.documentElement.classList.contains('sidebar-expanded'),
        init() {
            if (window.innerWidth < 1024) {
                this.sidebarOpen = false;
            }

            // Re-enable transitions after initial render
            this.$nextTick(() => {
                document.documentElement.classList.remove('is-loading');
            });

            this.$watch('sidebarOpen', val => {
                if (window.innerWidth >= 1024) {
                    localStorage.setItem('sidebarOpen', val);
                }
                if (val) document.documentElement.classList.add('sidebar-expanded');
                else document.documentElement.classList.remove('sidebar-expanded');
            });
        }
    }" @resize.window="if (window.innerWidth < 1024) sidebarOpen = false;">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <livewire:layout.command-palette />

        <livewire:layout.navigation />

        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 top-16 bg-gray-900/80 z-30 lg:hidden" x-cloak></div>

        <div class="flex min-h-screen">
            <livewire:layout.sidebar />

            <!-- Main Content -->
            <main class="flex-1 w-full transition-all duration-300">
                {{ $slot }}
            </main>
        </div>
        <x-theme-toggle />
    </div>
</body>

</html>