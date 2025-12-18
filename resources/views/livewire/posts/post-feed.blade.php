<div class="{{ $layout === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6' : 'space-y-6' }}">
    @forelse ($posts as $post)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden transition hover:shadow-md flex flex-col"
            wire:key="post-{{ $post->id }}">

            <!-- Body Container -->
            <div class="p-5 flex-1 flex flex-col">
                <!-- Header Row (Profile Info) -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <img class="h-9 w-9 rounded-full bg-gray-200 object-cover shrink-0 ring-2 ring-gray-100 dark:ring-gray-700"
                            src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&color=7F9CF5&background=EBF4FF"
                            alt="{{ $post->user->name }}">
                        <div>
                            <p class="text-sm font-black text-gray-900 dark:text-white leading-none">
                                {{ $post->user->name }}
                            </p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight mt-1">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    @if ($post->user_id === auth()->id())
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition p-1">
                                <i class="fa-solid fa-ellipsis-v text-xs"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-xl z-20 py-1 border border-gray-100 dark:border-gray-700">
                                <button wire:click="delete({{ $post->id }})"
                                    class="block w-full text-left px-4 py-2 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition font-bold">
                                    <i class="fa-solid fa-trash mr-2"></i> Delete
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Post Image (Full Width within card context) -->
                @if ($post->image_path)
                    <div class="w-full aspect-video overflow-hidden rounded-lg mb-4">
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                @endif

                <!-- Content Body -->
                <div x-data="{ expanded: false }" class="relative flex-1">
                    <div :class="expanded ? 'max-h-[2000px]' : 'max-h-24'"
                        class="text-sm text-gray-800 dark:text-gray-200 whitespace-pre-line leading-relaxed transition-all duration-700 relative overflow-hidden">
                        {{ $post->content }}
                        <div x-show="!expanded"
                            class="absolute bottom-0 left-0 w-full h-8 bg-gradient-to-t from-white dark:from-gray-800 to-transparent pointer-events-none">
                        </div>
                    </div>

                    @if(strlen($post->content) > 150)
                        <button @click="expanded = !expanded"
                            class="text-[10px] font-black uppercase text-indigo-600 dark:text-indigo-400 mt-3 hover:underline flex items-center">
                            <span x-text="expanded ? 'Show Less' : 'Full Post'"></span>
                            <i class="fa-solid ml-1 transition-transform"
                                :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                    @endif
                </div>

                <!-- Interaction Buttons -->
                <div class="mt-4 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-3">
                    <button
                        class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:hover:text-indigo-400 transition group">
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
        </div> <!-- End of Card -->
    @empty
        <div
            class="{{ $layout === 'grid' ? 'col-span-full' : '' }} bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 dark:bg-indigo-900/50 mb-4">
                <i class="fa-regular fa-pen-to-square text-indigo-500 text-xl"></i>
            </div>
            <p class="text-gray-900 dark:text-white font-medium">No posts yet</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Share what's on your mind to get started!</p>
        </div>
    @endforelse

    @if ($posts->count() < $total)
        <div class="{{ $layout === 'grid' ? 'col-span-full' : '' }} flex justify-center mt-8">
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="px-8 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-700 dark:text-gray-200 hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all shadow-sm hover:shadow-md active:scale-95 flex items-center space-x-3 group">
                <span wire:loading.remove wire:target="loadMore" class="flex items-center">
                    <span>Read More Posts</span>
                    <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
                <span wire:loading wire:target="loadMore" class="flex items-center text-indigo-500">
                    <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                    <span>Syncing Stream...</span>
                </span>
            </button>
        </div>
    @endif
</div>