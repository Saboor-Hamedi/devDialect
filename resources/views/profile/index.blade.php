<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <!-- Profile Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden mb-6">
            <!-- Cover Image -->
            <div class="h-48 w-full bg-gradient-to-r from-indigo-500 to-purple-600 relative">
                <!-- Optional: Add "Edit Cover" button here later -->
            </div>

            <!-- Profile Info Section -->
            <div class="px-8 pb-8 relative">
                <!-- Avatar (Overlapping Cover) -->
                <div class="relative -mt-16 mb-4 inline-block">
                    <img class="h-32 w-32 rounded-full ring-4 ring-white dark:ring-gray-800 object-cover bg-gray-200"
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF"
                        alt="{{ $user->name }}">
                    <div class="absolute bottom-2 right-2 h-5 w-5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"
                        title="Online"></div>
                </div>

                <!-- User Details -->
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                        <p class="text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 max-w-2xl">
                            Full-stack developer passionate about building beautiful UIs and robust backends.
                            (This is a placeholder bio functionality to be added).
                        </p>
                    </div>
                    <!-- Actions -->
                    <div class="flex space-x-3 mt-2">
                        <a href="{{ route('profile') }}"
                            class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4">
                    <div class="flex items-start space-x-4">
                        <img class="h-10 w-10 rounded-full object-cover bg-gray-200 shrink-0"
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF"
                            alt="{{ $user->name }}">
                        <div class="flex-1 min-w-0">
                            <textarea rows="2"
                                class="block w-full rounded-xl border-0 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-0 resize-none text-sm p-3"
                                placeholder="What's on your mind, {{ $user->name }}?"></textarea>
                        </div>
                    </div>
                    <div
                        class="mt-3 flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-3">
                        <div class="flex space-x-2">
                            <button
                                class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-1.5 rounded-lg transition">
                                <i class="fa-solid fa-image text-green-500"></i>
                                <span class="text-xs font-medium hidden sm:inline">Photo</span>
                            </button>
                            <button
                                class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-1.5 rounded-lg transition">
                                <i class="fa-solid fa-face-smile text-yellow-500"></i>
                                <span class="text-xs font-medium hidden sm:inline">Feeling</span>
                            </button>
                        </div>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Post
                        </button>
                    </div>
                </div>

                <!-- Feed Placeholder -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-400 italic">No posts yet.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>