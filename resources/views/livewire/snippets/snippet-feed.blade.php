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
                class="px-6 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full text-xs font-bold text-gray-600 dark:text-gray-400 hover:border-indigo-500 hover:text-indigo-500 transition-all flex items-center space-x-2">
                <span wire:loading.remove wire:target="loadMore">Show more snippets</span>
                <span wire:loading wire:target="loadMore" class="flex items-center">
                    <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Loading...
                </span>
            </button>
        </div>
    @endif
</div>