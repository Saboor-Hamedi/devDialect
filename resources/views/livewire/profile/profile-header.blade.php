<div class="bg-white dark:bg-gray-800 rounded-[5px] sm:rounded-xl shadow-sm overflow-hidden mb-6">
    <!-- Cover Image Container -->
    <div class="h-48 w-full relative group bg-indigo-500 dark:bg-indigo-900 overflow-hidden">
        @if ($user->cover_photo_path)
            <img src="{{ Storage::url($user->cover_photo_path) }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-r from-indigo-500 to-purple-600"></div>
        @endif

        @if (auth()->id() === $user->id)
            <label
                class="absolute bottom-4 right-4 bg-black/50 hover:bg-black/70 text-white px-3 py-1.5 rounded-lg cursor-pointer transition-all opacity-0 group-hover:opacity-100 flex items-center space-x-2 text-sm backdrop-blur-sm">
                <i class="fa-solid fa-camera"></i>
                <span>Edit Cover</span>
                <input type="file" wire:model="coverPhoto" class="hidden" accept="image/*">
            </label>
            <div wire:loading wire:target="coverPhoto"
                class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <i class="fa-solid fa-spinner fa-spin text-white text-3xl"></i>
            </div>
        @endif
    </div>

    <!-- Profile Info Section -->
    <div class="px-8 pb-8 relative">
        <!-- Avatar Container -->
        <div class="relative -mt-16 mb-4 inline-block group">
            <div class="relative">
                <img class="h-32 w-32 rounded-full ring-4 ring-white dark:ring-gray-800 object-cover bg-gray-200"
                    src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF' }}"
                    alt="{{ $user->name }}">

                @if (auth()->id() === $user->id)
                    <label
                        class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-camera text-white text-xl"></i>
                        <input type="file" wire:model="profilePhoto" class="hidden" accept="image/*">
                    </label>
                    <div wire:loading wire:target="profilePhoto"
                        class="absolute inset-0 bg-black/30 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-spinner fa-spin text-white"></i>
                    </div>
                @endif
            </div>

            <div class="absolute bottom-2 right-2 h-5 w-5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"
                title="Online"></div>
        </div>

        <!-- User Details and Bio -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-start space-y-4 md:space-y-0">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                <p class="text-gray-500 dark:text-gray-400">{{ $user->email }}</p>

                <div class="mt-4 max-w-2xl" x-data="{ editing: false, bio: @entangle('bio') }"
                    @click.away="editing = false">

                    <div x-show="!editing" @click="editing = {{ auth()->id() === $user->id ? 'true' : 'false' }}"
                        class="group cursor-pointer">
                        <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed italic">
                            {{ $bio ?: 'Click to add a bio...' }}
                            @if (auth()->id() === $user->id)
                                <i
                                    class="fa-solid fa-pen ml-2 opacity-0 group-hover:opacity-100 transition-opacity text-xs text-indigo-500"></i>
                            @endif
                        </p>
                    </div>

                    @if (auth()->id() === $user->id)
                        <div x-show="editing" x-cloak>
                            <textarea x-model="bio" rows="3"
                                class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Describe yourself..."></textarea>
                            <div class="mt-2 flex justify-end space-x-2">
                                <button @click="editing = false"
                                    class="px-3 py-1 text-xs text-gray-500 hover:text-gray-700">Cancel</button>
                                <button @click="$wire.saveBio(); editing = false"
                                    class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Save
                                    Bio</button>
                            </div>
                        </div>
                    @endif
                </div>

                @if (session()->has('bio-saved'))
                    <span class="text-xs text-green-500 mt-2 block" x-data="{ show: true }" x-show="show"
                        x-init="setTimeout(() => show = false, 3000)">
                        {{ session('bio-saved') }}
                    </span>
                @endif
            </div>

            <!-- Header Actions -->
            <div class="flex items-center space-x-3 shrink-0">
                @if (auth()->id() === $user->id)
                    <a href="{{ route('profile') }}"
                        class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-[10px] sm:text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition ease-in-out duration-150">
                        <i class="fa-solid fa-gear mr-1.5 sm:mr-2"></i> Settings
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>