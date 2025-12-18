<div class="bg-white dark:bg-gray-800 rounded-[5px] sm:rounded-xl shadow-sm p-4">
    <div class="flex items-start">
        <div class="flex-1 min-w-0">
            <textarea wire:model="content" rows="2"
                class="block w-full rounded-xl border-0 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 resize-none text-sm p-3 transition-all @error('content') ring-1 ring-red-500 @enderror"
                placeholder="What's on your mind, {{ auth()->user()->name }}?"></textarea>
            @error('content') <span
            class="text-red-500 text-[10px] font-bold uppercase mt-1 block">{{ $message }}</span> @enderror

            @if ($image)
                <div class="relative mt-2 inline-block">
                    <img src="{{ $image->temporaryUrl() }}"
                        class="h-20 w-auto rounded-lg object-cover border border-gray-200 dark:border-gray-700 @error('image') border-red-500 @enderror">
                    <button wire:click="$set('image', null)" type="button"
                        class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 w-5 h-5 flex items-center justify-center shadow-sm transition-colors">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>
            @endif
            @error('image') <span class="text-red-500 text-[10px] font-bold uppercase mt-1 block">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="mt-3 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-3">
        <div class="flex space-x-2">
            <label
                class="cursor-pointer flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-1.5 rounded-lg transition">
                <i class="fa-solid fa-image text-green-500"></i>
                <span class="text-xs font-medium hidden sm:inline">Photo</span>
                <input type="file" wire:model="image" class="hidden" accept="image/*">
            </label>
            <button
                class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-1.5 rounded-lg transition">
                <i class="fa-solid fa-face-smile text-yellow-500"></i>
                <span class="text-xs font-medium hidden sm:inline">Feeling</span>
            </button>
        </div>
        <button wire:click="save" wire:loading.attr="disabled"
            class="relative inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed group">
            <span wire:loading.remove wire:target="save">Post</span>
            <span wire:loading wire:target="save" class="flex items-center">
                <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                Posting...
            </span>
        </button>
    </div>
</div>