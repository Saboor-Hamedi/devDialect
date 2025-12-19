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
        // Start with is-loading
        document.documentElement.classList.add('is-loading');

        // Handle Theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @livewireStyles
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 min-h-screen"
    x-data="{ init() { this.$nextTick(() => document.documentElement.classList.remove('is-loading')); } }">
    <livewire:layout.navigation />

    <div class="flex flex-col items-center pt-8 sm:pt-16 px-4">
        {{ $slot }}
    </div>

    <x-theme-toggle />
    @livewireScripts
</body>

</html>