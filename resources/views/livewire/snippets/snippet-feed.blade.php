<div class="space-y-6">
    @forelse ($snippets as $snippet)
        <livewire:snippets.snippet-card :snippet="$snippet" :key="'snippet-' . $snippet->id" />
    @empty
        <div
            class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-200 dark:border-gray-700">
            <i class="fa-solid fa-code text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
            <p class="text-gray-500 dark:text-gray-400 font-medium">No snippets shared yet. Be the first!</p>
        </div>
    @endforelse

    @if ($snippets->count() < $total)
        <div class="flex justify-center pt-4">
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="px-8 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-700 dark:text-gray-200 hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all shadow-sm hover:shadow-md active:scale-95 flex items-center space-x-3 group">
                <span wire:loading.remove wire:target="loadMore" class="flex items-center">
                    <span>Read More Snippets</span>
                    <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
                <span wire:loading wire:target="loadMore" class="flex items-center text-indigo-500">
                    <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                    <span>Syncing Content...</span>
                </span>
            </button>
        </div>
    @endif
</div>