<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Appearance') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Select your preferred theme experience.') }}
            </p>
        </header>

        <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4" x-data="{ 
                theme: localStorage.theme || 'system',
                updateTheme(val) {
                    this.theme = val;
                    localStorage.theme = val;
                    if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
             }" x-init="$watch('theme', val => updateTheme(val))">

            <!-- Light Mode -->
            <button @click="updateTheme('light')"
                :class="theme === 'light' ? 'border-indigo-500 ring-2 ring-indigo-500' : 'border-gray-200 dark:border-gray-700'"
                class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700">
                <span class="flex flex-1">
                    <span class="flex flex-col">
                        <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            <i class="fa-solid fa-sun text-xl mb-2 text-yellow-500"></i>
                            Light
                        </span>
                    </span>
                </span>
                <i x-show="theme === 'light'"
                    class="fa-solid fa-circle-check text-indigo-600 absolute top-4 right-4"></i>
            </button>

            <!-- Dark Mode -->
            <button @click="updateTheme('dark')"
                :class="theme === 'dark' ? 'border-indigo-500 ring-2 ring-indigo-500' : 'border-gray-200 dark:border-gray-700'"
                class="relative flex cursor-pointer rounded-lg border bg-gray-900 p-4 shadow-sm focus:outline-none hover:bg-gray-800">
                <span class="flex flex-1">
                    <span class="flex flex-col">
                        <span class="block text-sm font-medium text-white">
                            <i class="fa-solid fa-moon text-xl mb-2 text-indigo-400"></i>
                            Dark
                        </span>
                    </span>
                </span>
                <i x-show="theme === 'dark'"
                    class="fa-solid fa-circle-check text-indigo-400 absolute top-4 right-4"></i>
            </button>

            <!-- System -->
            <button @click="updateTheme('system')"
                :class="theme === 'system' ? 'border-indigo-500 ring-2 ring-indigo-500' : 'border-gray-200 dark:border-gray-700'"
                class="relative flex cursor-pointer rounded-lg border bg-white dark:bg-gray-800 p-4 shadow-sm focus:outline-none hover:bg-gray-50 dark:hover:bg-gray-700">
                <span class="flex flex-1">
                    <span class="flex flex-col">
                        <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            <i class="fa-solid fa-desktop text-xl mb-2 text-gray-500 dark:text-gray-400"></i>
                            System
                        </span>
                    </span>
                </span>
                <i x-show="theme === 'system'"
                    class="fa-solid fa-circle-check text-indigo-600 dark:text-indigo-400 absolute top-4 right-4"></i>
            </button>
        </div>
    </div>
</div>