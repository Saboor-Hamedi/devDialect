<div class="space-y-6">
    @forelse ($posts as $post)
        <div class="bg-white dark:bg-gray-800 rounded-[5px] sm:rounded-xl shadow-sm p-6 transition hover:shadow-md"
            wire:key="{{ $post->id }}">
            <!-- Header Row -->
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-full bg-gray-200 object-cover shrink-0"
                        src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&color=7F9CF5&background=EBF4FF"
                        alt="{{ $post->user->name }}">
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">
                            {{ $post->user->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                @if ($post->user_id === auth()->id())
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                            class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-700 rounded-lg shadow-xl z-10 py-1 ring-1 ring-black ring-opacity-5">
                            <button wire:click="delete({{ $post->id }})"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                <i class="fa-solid fa-trash mr-2"></i> Delete
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content Body -->
            <div class="mt-4 text-sm text-gray-800 dark:text-gray-200 whitespace-pre-line leading-relaxed text-left text-start">
                {{ $post->content }}
            </div>

            @if ($post->image_path)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $post->image_path) }}"
                        class="rounded-lg max-h-64 w-auto max-w-full object-cover border border-gray-100 dark:border-gray-700">
                </div>
            @endif
            <!-- Interaction Buttons (Visual Placeholder) -->
            <div class="mt-4 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-3">
                <button
                    class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition group">
                    <i class="fa-regular fa-heart group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium">Like</span>
                </button>
                <button
                    class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition group">
                    <i class="fa-regular fa-comment group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium">Comment</span>
                </button>
                <button
                    class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition group">
                    <i class="fa-solid fa-share group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium">Share</span>
                </button>
            </div>
        </div>
    @empty
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 dark:bg-indigo-900/50 mb-4">
                <i class="fa-regular fa-pen-to-square text-indigo-500 text-xl"></i>
            </div>
            <p class="text-gray-900 dark:text-white font-medium">No posts yet</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Share what's on your mind to get started!</p>
        </div>
    @endforelse

    @if ($posts->count() < $total)
        <div class="mt-4 text-center">
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition disabled:opacity-50">
                <span wire:loading.remove wire:target="loadMore">Load More</span>
                <span wire:loading wire:target="loadMore"><i class="fa-solid fa-spinner fa-spin mr-2"></i> Loading...</span>
            </button>
        </div>
    @endif
</div>