<div x-data="{ themeOpen: false, current: localStorage.theme || 'system' }"
    @theme-changed.window="current = localStorage.theme || 'system'" class="fixed bottom-6 right-6 z-50">
    <!-- Toggle Button -->
    <button @click="themeOpen = !themeOpen"
        class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg focus:outline-none transition-transform duration-300 hover:scale-110">
        <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
    </button>

    <!-- Slide-out Menu -->
    <div x-show="themeOpen" x-cloak style="display: none;" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95" @click.away="themeOpen = false"
        class="absolute bottom-16 right-0 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5 p-2 space-y-1 origin-bottom-right"
        x-data="{
             setTheme(val) {
                 localStorage.theme = val;
                 this.current = val;
                 if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                     document.documentElement.classList.add('dark');
                 } else {
                     document.documentElement.classList.remove('dark');
                 }
                 // Dispatch event for other components to listen if needed
                 window.dispatchEvent(new CustomEvent('theme-changed'));
                 this.themeOpen = false;
             }
         }">

        <button @click="setTheme('light')"
            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fa-solid fa-sun w-5 mr-3 text-yellow-500"></i>
            <span>Light</span>
            <i x-show="current === 'light'" class="fa-solid fa-check ml-auto text-indigo-600"></i>
        </button>

        <button @click="setTheme('dark')"
            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fa-solid fa-moon w-5 mr-3 text-indigo-400"></i>
            <span>Dark</span>
            <i x-show="current === 'dark'" class="fa-solid fa-check ml-auto text-indigo-600"></i>
        </button>

        <button @click="setTheme('system')"
            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i class="fa-solid fa-desktop w-5 mr-3 text-gray-500"></i>
            <span>System</span>
            <i x-show="current === 'system'" class="fa-solid fa-check ml-auto text-indigo-600"></i>
        </button>
    </div>
</div>