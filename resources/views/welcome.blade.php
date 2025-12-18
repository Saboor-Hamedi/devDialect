<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-50 dark:bg-black text-black/50 dark:text-white/50">
    <livewire:layout.navigation />

    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white pt-16">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <main class="mt-6 flex flex-col items-center justify-center text-center">
                <h2
                    class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                    Welcome to <span class="text-indigo-600 dark:text-indigo-400">DevDialect</span>
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Your modern dashboard for efficient management and analytics.
                </p>

                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 text-base font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                        Get Started
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 text-base font-medium text-indigo-700 bg-indigo-100 rounded-md hover:bg-indigo-200 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                            Register
                        </a>
                    @endif
                </div>
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                &copy; {{ date('Y') }} DevDialect. All rights reserved.
            </footer>
        </div>
    </div>
</body>

</html>