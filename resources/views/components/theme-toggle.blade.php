<div x-data="{ 
    configOpen: false, 
    current: localStorage.theme || 'system' 
}" @theme-changed.window="current = localStorage.theme || 'system'" class="relative">

    <!-- Backdrop (only when open) -->
    <div x-show="configOpen" x-cloak x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="configOpen = false"
        class="fixed inset-0 bg-black/10 dark:bg-black/40 backdrop-blur-[2px] z-[50]"></div>

    <!-- Right Customization Sidebar & Handle -->
    <aside x-cloak
        class="fixed inset-y-0 right-0 w-[180px] bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl border-l border-gray-100 dark:border-gray-800 z-[55] shadow-2xl flex flex-col transition-transform duration-500 ease-in-out"
        :class="configOpen ? 'translate-x-0' : 'translate-x-full'" x-data="{
                setTheme(val) {
                    localStorage.theme = val;
                    this.current = val;
                    if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                    window.dispatchEvent(new CustomEvent('theme-changed'));
                }
           }">

        <!-- Toggle Handle (Always visible, moves with sidebar) -->
        <div class="absolute top-1/2 -left-10 -translate-y-1/2">
            <button @click="configOpen = !configOpen"
                class="bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-100 dark:border-gray-700 rounded-l-xl w-10 h-10 flex items-center justify-center shadow-[-8px_0_15px_-3px_rgba(0,0,0,0.1)] dark:shadow-[-8px_0_15px_-3px_rgba(0,0,0,0.5)] focus:outline-none transition-all duration-500 group">
                <i class="fa-solid fa-gear text-xs transition-transform duration-700 group-hover:rotate-180"
                    :class="configOpen ? 'rotate-180' : 'rotate-0'"></i>
            </button>
        </div>

        <!-- Header -->
        <div class="px-4 py-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
            <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">Customization
            </h3>
            <button @click="configOpen = false"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Settings List -->
        <div class="flex-1 overflow-y-auto py-4 px-2 space-y-6">
            <!-- Theme Selection -->
            <div class="space-y-3">
                <span
                    class="px-2 text-[9px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-tighter">Theme
                    Selection</span>
                <div class="space-y-1">
                    <button @click="setTheme('light')"
                        class="flex items-center w-full px-3 py-2 text-xs font-medium rounded-lg transition-all"
                        :class="current === 'light' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'">
                        <i class="fa-solid fa-sun w-5 mr-1 text-yellow-500"></i>
                        <span>Light</span>
                        <i x-show="current === 'light'" class="fa-solid fa-check ml-auto scale-75 opacity-50"></i>
                    </button>

                    <button @click="setTheme('dark')"
                        class="flex items-center w-full px-3 py-2 text-xs font-medium rounded-lg transition-all"
                        :class="current === 'dark' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'">
                        <i class="fa-solid fa-moon w-5 mr-1 text-indigo-400"></i>
                        <span>Dark</span>
                        <i x-show="current === 'dark'" class="fa-solid fa-check ml-auto scale-75 opacity-50"></i>
                    </button>

                    <button @click="setTheme('system')"
                        class="flex items-center w-full px-3 py-2 text-xs font-medium rounded-lg transition-all"
                        :class="current === 'system' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'">
                        <i class="fa-solid fa-desktop w-5 mr-1 text-gray-400"></i>
                        <span>System</span>
                        <i x-show="current === 'system'" class="fa-solid fa-check ml-auto scale-75 opacity-50"></i>
                    </button>
                </div>
            </div>

            <!-- Future Sections Placeholder -->
            <div class="px-2">
                <div
                    class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-[9px] text-gray-400 dark:text-gray-500 font-medium">More options coming soon...</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="p-4 border-t border-gray-50 dark:border-gray-800 text-center">
            <span
                class="text-[9px] font-bold text-indigo-600 dark:text-indigo-400 tracking-tighter uppercase italic opacity-50">DevDialect
                Engine</span>
        </div>
    </aside>
</div>