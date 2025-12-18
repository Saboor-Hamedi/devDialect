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
                <input x-ref="searchInput" wire:model.live.debounce.300ms="search" type="text"
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm dark:text-white"
                    @keydown.enter="if($results.length > 0) window.location.href = $results[0].url"
                    placeholder="Search posts, snippets, and more..." role="combobox" aria-expanded="false"
                    aria-controls="options" autofocus>

                <div wire:loading wire:target="search" class="absolute top-3.5 right-4">
                    <i class="fa-solid fa-circle-notch fa-spin text-indigo-500"></i>
                </div>
            </div>

            <!-- Results -->
            @if(count($results) > 0)
                <ul class="max-h-96 scroll-py-3 overflow-y-auto p-3" id="options" role="listbox">
                    @foreach($results as $result)
                        <li onclick="window.location.href = '{{ $result['url'] }}'"
                            class="group flex cursor-pointer select-none rounded-xl p-3 hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg {{ $result['color'] }}">
                                <i class="fa-solid {{ $result['icon'] }} text-white"></i>
                            </div>
                            <div class="ml-4 flex-auto">
                                <p
                                    class="text-sm font-bold text-gray-700 group-hover:text-indigo-600 dark:text-gray-200 dark:group-hover:text-indigo-400">
                                    {{ $result['title'] }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $result['description'] }}</p>
                            </div>
                            <div class="flex items-center">
                                <span
                                    class="text-[9px] font-black uppercase px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">{{ $result['type'] }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @elseif($search !== '')
                <!-- Empty State -->
                <div class="py-14 px-6 text-center text-sm sm:px-14">
                    <i
                        class="fa-solid fa-magnifying-glass mx-auto h-8 w-8 text-gray-300 dark:text-gray-600 mb-4 transition-all animate-pulse"></i>
                    <p class="font-bold text-gray-900 dark:text-white text-lg">No results found</p>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">We couldn't find any items matching "{{ $search }}".
                    </p>
                </div>
            @else
                <!-- Initial State -->
                <div class="py-14 px-6 text-center text-sm sm:px-14">
                    <i class="fa-solid fa-bolt mx-auto h-8 w-8 text-indigo-400 animate-pulse mb-4"></i>
                    <p class="font-bold text-gray-900 dark:text-white text-lg">Start typing to search</p>
                    <p class="mt-2 text-gray-500 dark:text-gray-400 font-medium">Search for code snippets, posts, and
                        developer thoughts.</p>
                </div>
            @endif

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