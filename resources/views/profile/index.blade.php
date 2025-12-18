<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Profile Header Component -->
        <livewire:profile.profile-header :user="$user" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Sidebar (Intro/Photos/Friends) -->
            <div class="space-y-6">
                <!-- Intro Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Intro</h3>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                        <div class="flex items-center">
                            <i class="fa-solid fa-briefcase w-6 text-gray-400"></i>
                            <span>Software Engineer at <strong>Tech Corp</strong></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-graduation-cap w-6 text-gray-400"></i>
                            <span>Studied at <strong>Harvard University</strong></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-location-dot w-6 text-gray-400"></i>
                            <span>Lives in <strong>New York, USA</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-6" x-data="{ activeTab: 'posts' }">
                <!-- Tab Navigation -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-[5px] sm:rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-1 flex items-center">
                    <button @click="activeTab = 'posts'"
                        :class="activeTab === 'posts' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                        class="flex-1 flex items-center justify-center space-x-2 py-2 text-xs font-bold rounded-lg transition-all duration-300">
                        <i class="fa-solid fa-rectangle-list"></i>
                        <span>Posts</span>
                    </button>
                    <button @click="activeTab = 'snippets'"
                        :class="activeTab === 'snippets' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                        class="flex-1 flex items-center justify-center space-x-2 py-2 text-xs font-bold rounded-lg transition-all duration-300">
                        <i class="fa-solid fa-code"></i>
                        <span>Snippets</span>
                    </button>
                </div>

                <!-- Feed Sections -->
                <div class="space-y-6">
                    <!-- Posts Tab -->
                    <div x-show="activeTab === 'posts'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <livewire:posts.create-post />
                        <div class="mt-6">
                            <livewire:posts.post-feed />
                        </div>
                    </div>

                    <!-- Snippets Tab -->
                    <div x-show="activeTab === 'snippets'" x-cloak x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <livewire:snippets.create-snippet />
                        <div class="mt-6">
                            <livewire:snippets.snippet-feed />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>