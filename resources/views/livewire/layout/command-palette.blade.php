<div x-data="{ 
    open: false,
    toggle() {
        if (this.open) {
            return this.close()
        }
        this.open = true
        this.$nextTick(() => this.$refs.searchInput.focus())
    },
    close(focusAfter) {
        if (! this.open) return
        this.open = false
        focusAfter && focusAfter.focus()
    }
}" x-on:keydown.escape.window="close()" x-on:keydown.window.prevent.ctrl.k="toggle()"
    x-on:keydown.window.prevent.cmd.k="toggle()" class="relative z-50 w-full" style="display: none;" x-show="open">
    <!-- Overlay -->
    <div x-show="open" x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/80 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal -->
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all dark:bg-gray-800 dark:divide-gray-700 dark:ring-gray-700"
            @click.away="close()">
            <div class="relative">
                <i
                    class="fa-solid fa-magnifying-glass pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400 dark:text-gray-500"></i>
                <input x-ref="searchInput" type="text"
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm dark:text-white"
                    placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options" autofocus>
            </div>

            <!-- Results (Mock) -->
            <ul class="max-h-96 scroll-py-3 overflow-y-auto p-3" id="options" role="listbox">
                <li
                    class="group flex cursor-default select-none rounded-xl p-3 hover:bg-indigo-50 dark:hover:bg-gray-700/50">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-indigo-500">
                        <i class="fa-solid fa-folder-open text-white"></i>
                    </div>
                    <div class="ml-4 flex-auto">
                        <p
                            class="text-sm font-medium text-gray-700 group-hover:text-indigo-600 dark:text-gray-200 dark:group-hover:text-indigo-400">
                            Projects</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Manage your ongoing projects</p>
                    </div>
                </li>

                <li
                    class="group flex cursor-default select-none rounded-xl p-3 hover:bg-indigo-50 dark:hover:bg-gray-700/50">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-teal-500">
                        <i class="fa-solid fa-users text-white"></i>
                    </div>
                    <div class="ml-4 flex-auto">
                        <p
                            class="text-sm font-medium text-gray-700 group-hover:text-indigo-600 dark:text-gray-200 dark:group-hover:text-indigo-400">
                            Team</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">View team members and roles</p>
                    </div>
                </li>

                <li
                    class="group flex cursor-default select-none rounded-xl p-3 hover:bg-indigo-50 dark:hover:bg-gray-700/50">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-pink-500">
                        <i class="fa-solid fa-calendar-days text-white"></i>
                    </div>
                    <div class="ml-4 flex-auto">
                        <p
                            class="text-sm font-medium text-gray-700 group-hover:text-indigo-600 dark:text-gray-200 dark:group-hover:text-indigo-400">
                            Calendar</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Check upcoming events</p>
                    </div>
                </li>
            </ul>

            <!-- Empty State (Hidden for now) -->
            <!-- 
            <div class="py-14 px-6 text-center text-sm sm:px-14">
                <i class="fa-solid fa-magnifying-glass mx-auto h-6 w-6 text-gray-400"></i>
                <p class="mt-4 font-semibold text-gray-900 dark:text-white">No results found</p>
                <p class="mt-2 text-gray-500 dark:text-gray-400">No components found for this search term. Please try again.</p>
            </div>
            -->

            <div
                class="flex flex-wrap items-center bg-gray-50 py-2.5 px-4 text-xs text-gray-500 dark:bg-gray-700/50 dark:text-gray-400">
                Type <kbd
                    class="mx-1 flex items-center justify-center px-2 py-0.5 rounded border border-gray-200 bg-white font-semibold text-gray-900 sm:mx-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-100">?</kbd>
                to search
                <span class="mx-2 border-r border-gray-300 dark:border-gray-600 h-4"></span>
                <kbd
                    class="mx-1 flex items-center justify-center px-2 py-0.5 rounded border border-gray-200 bg-white font-semibold text-gray-900 sm:mx-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-100">↑↓</kbd>
                to navigate
                <span class="mx-2 border-r border-gray-300 dark:border-gray-600 h-4"></span>
                <kbd
                    class="mx-1 flex items-center justify-center px-2 py-0.5 rounded border border-gray-200 bg-white font-semibold text-gray-900 sm:mx-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-100">Enter</kbd>
                to select
                <span class="mx-2 border-r border-gray-300 dark:border-gray-600 h-4"></span>
                <kbd
                    class="mx-1 flex items-center justify-center px-2 py-0.5 rounded border border-gray-200 bg-white font-semibold text-gray-900 sm:mx-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-100">Esc</kbd>
                to close
            </div>
        </div>
    </div>
</div>