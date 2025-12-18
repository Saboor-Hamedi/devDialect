<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DevDialect') }} | Home</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Handle Theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body
    class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 selection:bg-indigo-500 selection:text-white">
    <livewire:layout.navigation />

    <div class="relative overflow-hidden">
        <!-- Background Orbs -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[600px] pointer-events-none opacity-20 dark:opacity-30">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-indigo-500 rounded-full blur-[128px] animate-pulse"></div>
            <div class="absolute top-40 right-1/4 w-96 h-96 bg-purple-500 rounded-full blur-[128px] animate-pulse"
                style="animation-delay: 1s"></div>
        </div>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <!-- Hero Section -->
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 text-indigo-600 dark:text-indigo-400 text-xs font-black uppercase tracking-widest mb-6 animate-bounce">
                    <i class="fa-solid fa-rocket"></i>
                    <span>Version 2.0 Now Live</span>
                </div>

                <h1
                    class="text-5xl md:text-7xl font-black tracking-tight mb-6 bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-indigo-600 to-purple-600 dark:from-white dark:via-indigo-400 dark:to-purple-400 leading-tight">
                    The Pulse of the <br> <span class="text-indigo-600 dark:text-indigo-400">Developer</span> Community
                </h1>

                <p class="max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-400 leading-relaxed font-semibold">
                    DevDialect is where code speaks louder than words. Share components, debug thoughts, and build your
                    digital footprint in a high-performance workspace.
                </p>

                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-500/30 transition-all hover:-translate-y-1 active:translate-y-0 text-lg">
                            Go to Console
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-500/30 transition-all hover:-translate-y-1 active:translate-y-0 text-lg">
                            Login to Dialect
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-10 py-4 bg-white dark:bg-gray-800 text-gray-700 dark:text-white font-bold rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm transition-all hover:border-indigo-500 text-lg">
                            Join Community
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-32">
                <div
                    class="p-8 bg-white dark:bg-gray-800/50 backdrop-blur-xl border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div
                        class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-code text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Snippet Engine</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Share robust code modules with automatic syntax highlighting and rich Markdown support.
                    </p>
                </div>

                <div
                    class="p-8 bg-white dark:bg-gray-800/50 backdrop-blur-xl border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div
                        class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wand-magic-sparkles text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Live Customizer</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        A premium glassmorphic interface to toggle themes and personalize your developer console.
                    </p>
                </div>

                <div
                    class="p-8 bg-white dark:bg-gray-800/50 backdrop-blur-xl border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm hover:shadow-xl transition-all hover:-translate-y-2 group">
                    <div
                        class="w-12 h-12 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-bolt text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">TALL Stack Power</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Engineered with Livewire 3 and Alpine.js for an instantaneous, zero-jump responsive experience.
                    </p>
                </div>
            </div>

            <!-- Tabbed Feed Section -->
            <div x-data="{ activeFeed: 'snippets' }" class="mb-20">
                <div class="flex items-center justify-between mb-8 border-b border-gray-100 dark:border-gray-800 pb-4">
                    <h2 class="text-3xl font-black tracking-tight flex items-center">
                        <i class="fa-solid fa-bolt-lightning text-yellow-500 mr-3 animate-pulse"></i>
                        The Dialect Stream
                    </h2>

                    <div class="flex bg-gray-100 dark:bg-gray-800 p-1 rounded-xl">
                        <button @click="activeFeed = 'snippets'"
                            :class="activeFeed === 'snippets' ? 'bg-white dark:bg-gray-700 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                            class="px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                            Snippets
                        </button>
                        <button @click="activeFeed = 'posts'"
                            :class="activeFeed === 'posts' ? 'bg-white dark:bg-gray-700 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                            class="px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest transition-all">
                            Posts
                        </button>
                    </div>
                </div>

                <div class="relative min-h-[400px]">
                    <!-- Snippet Feed Tab -->
                    <div x-show="activeFeed === 'snippets'"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="opacity-90">
                        <livewire:snippets.snippet-feed />
                    </div>

                    <!-- Post Feed Tab -->
                    <div x-show="activeFeed === 'posts'" x-cloak
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0" class="opacity-90">
                        <livewire:posts.post-feed layout="grid" perPage="3" />
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border-t border-gray-100 dark:border-gray-700 py-12 mt-32">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex flex-col items-center md:items-start">
                    <span class="text-xl font-black tracking-tighter text-indigo-600 dark:text-indigo-400 mb-2">Dev
                        Dialect</span>
                    <p class="text-xs text-gray-500 dark:text-gray-400">The open engine for the modern developer.</p>
                </div>

                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-indigo-500 text-lg transition-colors"><i
                            class="fa-brands fa-github"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-500 text-lg transition-colors"><i
                            class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-500 text-lg transition-colors"><i
                            class="fa-brands fa-discord"></i></a>
                </div>

                <p class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest">
                    &copy; {{ date('Y') }} DevDialect. All systems nominal.
                </p>
            </div>
        </footer>
    </div>

    <x-theme-toggle />
</body>

</html>