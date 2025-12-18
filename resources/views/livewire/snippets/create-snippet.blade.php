<div>
    <form wire:submit.prevent="save"
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300">
        <!-- Header -->
        <div
            class="px-4 py-3 border-b border-gray-50 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-code text-xs"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200">Share a Snippet</h3>
            </div>

            <select wire:model="language"
                class="text-[10px] font-bold uppercase tracking-wider bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 rounded-lg px-2 py-1 text-gray-500 dark:text-gray-400 focus:ring-indigo-500">
                <option value="markdown">Markdown</option>
                <option value="javascript">JavaScript</option>
                <option value="php">PHP</option>
                <option value="python">Python</option>
                <option value="html">HTML</option>
                <option value="css">CSS</option>
            </select>
        </div>

        <!-- Body -->
        <div class="p-4 space-y-4">
            <input type="text" wire:model="title" placeholder="Snippet Title (e.g. Robust Sidebar Logic)"
                class="w-full bg-transparent border-none focus:ring-0 text-lg font-bold text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-600 p-0 @error('title') border-red-500 rounded-lg @enderror" />
            @error('title') <span class="text-red-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror

            <div class="relative group">
                <textarea wire:model="content" placeholder="Paste your code or markdown here..."
                    class="w-full min-h-[150px] bg-gray-50 dark:bg-gray-900/50 rounded-xl border-gray-100 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono text-gray-700 dark:text-gray-300 p-4 transition-all @error('content') border-red-500 ring-1 ring-red-500 @enderror"
                    style="scrollbar-width: thin;"></textarea>
                @error('content') <span
                class="text-red-500 text-[10px] font-bold uppercase mt-1 block">{{ $message }}</span> @enderror

                <!-- Floating Preview Icon -->
                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span
                        class="text-[10px] font-bold text-gray-400 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm px-2 py-1 rounded-md border border-gray-200 dark:border-gray-600">
                        Markdown Supported
                    </span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div
            class="px-4 py-3 bg-gray-50 dark:bg-gray-800/80 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <label class="flex items-center space-x-2 cursor-pointer group">
                    <input type="checkbox" wire:model="is_public"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span
                        class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-200 transition-colors">Public
                        Snippet</span>
                </label>
            </div>

            <div class="flex items-center space-x-3">
                @if (session()->has('snippet-saved'))
                    <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                        class="text-xs font-bold text-green-500 animate-pulse">
                        {{ session('snippet-saved') }}
                    </span>
                @endif

                <button type="submit" wire:loading.attr="disabled"
                    class="relative inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed group">
                    <span wire:loading.remove wire:target="save">Deploy Snippet</span>
                    <span wire:loading wire:target="save" class="flex items-center">
                        <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                        Deploying...
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>