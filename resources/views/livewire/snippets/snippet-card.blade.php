<div
    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden group hover:shadow-md transition-all duration-300">
    <!-- Header -->
    <div
        class="px-4 py-3 border-b border-gray-50 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-800/50 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="relative w-8 h-8 rounded-full overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm"
                x-data="{ avatar: '{{ $snippet->user->profile_photo_path ? Storage::url($snippet->user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($snippet->user->name) . '&color=7F9CF5&background=EBF4FF' }}' }">
                <img :src="avatar" class="w-full h-full object-cover" alt="{{ $snippet->user->name }}">
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-gray-700 dark:text-gray-200">{{ $snippet->user->name }}</span>
                <span class="text-[10px] text-gray-400 font-medium">{{ $snippet->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <span
                class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-800">
                {{ $snippet->language }}
            </span>

            @if(auth()->id() === $snippet->user_id)
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <i class="fa-solid fa-ellipsis-v text-xs"></i>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-100 dark:border-gray-700 z-50 py-1">
                        <button wire:click="edit"
                            class="w-full text-left px-4 py-2 text-xs text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 font-bold transition-colors">
                            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                        </button>
                        <button wire:click="$parent.deleteSnippet({{ $snippet->id }})"
                            wire:confirm="Are you sure you want to delete this snippet?"
                            class="w-full text-left px-4 py-2 text-xs text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 font-bold transition-colors">
                            <i class="fa-solid fa-trash mr-2"></i> Delete
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($isEditing)
        <!-- Edit Mode -->
        <div class="p-4 space-y-4">
            <div>
                <input type="text" wire:model="editTitle"
                    class="w-full text-sm font-bold bg-transparent border-none focus:ring-0 text-gray-800 dark:text-white p-0 @error('editTitle') border-b border-red-500 @enderror"
                    placeholder="Snippet Title" />
                @error('editTitle') <span class="text-[10px] text-red-500 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center space-x-2">
                <span class="text-[10px] text-gray-400 font-bold uppercase">Language:</span>
                <select wire:model="editLanguage"
                    class="text-[10px] font-bold bg-gray-50 dark:bg-gray-900 border-none rounded-lg p-1 focus:ring-1 focus:ring-indigo-500">
                    <option value="markdown">Markdown</option>
                    <option value="javascript">JavaScript</option>
                    <option value="php">PHP</option>
                    <option value="python">Python</option>
                    <option value="html">HTML</option>
                    <option value="css">CSS</option>
                </select>
            </div>

            <div>
                <textarea wire:model="editContent" rows="8"
                    class="w-full text-[11px] font-mono bg-gray-50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 rounded-lg focus:ring-1 focus:ring-indigo-500 @error('editContent') border-red-500 @enderror"
                    placeholder="Code content..."></textarea>
                @error('editContent') <span class="text-[10px] text-red-500 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-2">
                <button wire:click="cancelEdit"
                    class="text-xs font-bold text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors px-4 py-2">
                    Cancel
                </button>
                <button wire:click="update" wire:loading.attr="disabled"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition-all flex items-center">
                    <span wire:loading.remove wire:target="update">Update Snippet</span>
                    <span wire:loading wire:target="update" class="flex items-center">
                        <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Updating...
                    </span>
                </button>
            </div>
        </div>
    @else
        <!-- Content View -->
        <div class="p-4 space-y-3">
            <h2
                class="text-sm font-bold text-gray-800 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                {{ $snippet->title }}
            </h2>

            <div x-data="{ expanded: false }" class="relative">
                <!-- Content Area with Height Limit -->
                <div :class="expanded ? 'max-h-[1000px]' : 'max-h-[300px]'"
                    class="transition-all duration-700 ease-in-out relative overflow-hidden">
                    <!-- Markdown View -->
                    @if ($snippet->language === 'markdown')
                        <div
                            class="prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                            {!! $snippet->rendered_content !!}
                        </div>
                    @else
                        <!-- Code Block with Copy Button -->
                        <div class="relative rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700" x-data="{ 
                                                                                copied: false,
                                                                                copy() {
                                                                                    $clipboard($refs.codeContent.innerText);
                                                                                    this.copied = true;
                                                                                    setTimeout(() => this.copied = false, 2000);
                                                                                }
                                                                            }">
                            <button @click="copy"
                                class="absolute top-2 right-2 p-1.5 rounded-lg bg-gray-900/50 hover:bg-gray-900 text-white/70 hover:text-white backdrop-blur-sm transition-all z-10">
                                <i class="fa-solid" :class="copied ? 'fa-check text-green-400' : 'fa-copy text-[10px]'"></i>
                            </button>

                            <pre class="bg-gray-900 text-gray-100 text-[11px] font-mono p-4 overflow-x-auto leading-relaxed"
                                style="scrollbar-width: thin;"><code x-ref="codeContent">{{ $snippet->content }}</code></pre>
                        </div>
                    @endif

                    <!-- Gradient Fade for long content -->
                    <div x-show="!expanded"
                        class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white dark:from-gray-800 to-transparent pointer-events-none">
                    </div>
                </div>

                <!-- See More Button -->
                <div class="flex justify-center mt-2">
                    <button @click="expanded = !expanded"
                        class="text-[10px] font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors flex items-center space-x-1 py-1">
                        <span x-text="expanded ? 'Show Less' : 'See More Content'"></span>
                        <i class="fa-solid transition-transform duration-300"
                            :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="px-4 py-2 border-t border-gray-50 dark:border-gray-700 flex items-center justify-between bg-gray-50/10">
        <div class="flex items-center space-x-4">
            <button
                class="flex items-center space-x-1.5 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                <i class="fa-regular fa-heart text-xs"></i>
                <span class="text-[10px] font-bold">Luv</span>
            </button>
            <button
                class="flex items-center space-x-1.5 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                <i class="fa-regular fa-comment text-xs"></i>
                <span class="text-[10px] font-bold">Reply</span>
            </button>
        </div>

        <div class="flex items-center">
            <button
                class="text-[10px] font-bold text-gray-400 hover:text-indigo-500 transition-colors flex items-center space-x-1">
                <i class="fa-solid fa-share-nodes text-[10px]"></i>
                <span>Raw</span>
            </button>
        </div>
    </div>
</div>