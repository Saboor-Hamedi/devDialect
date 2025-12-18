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

            <!-- Main Feed -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Create Post Widget -->
                <livewire:posts.create-post />

                <!-- Feed -->
                <livewire:posts.post-feed />
            </div>
        </div>
    </div>
</x-app-layout>