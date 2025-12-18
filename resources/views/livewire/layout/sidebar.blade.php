<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<aside x-cloak
    :class="sidebarOpen ? 'translate-x-0 lg:w-[250px] lg:min-w-[250px]' : '-translate-x-full lg:translate-x-0 lg:w-0 lg:min-w-0 lg:opacity-0 lg:pointer-events-none'"
    class="fixed top-16 bottom-0 left-0 z-30 w-[250px] bg-white border-r border-gray-100 dark:bg-gray-800 dark:border-gray-700 transition-all duration-300 transform flex flex-col lg:static lg:sticky lg:top-16 lg:h-[calc(100vh-4rem)]">
    <!-- Logo -->
    <!-- Navigation Links -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
            <div class="w-5 h-5 mr-2 flex justify-center items-center">
                <i class="fa-solid fa-gauge-high"></i>
            </div>
            Dashboard
        </x-sidebar-link>

        <x-sidebar-link href="#" :active="false">
            <div class="w-5 h-5 mr-2 flex justify-center items-center">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            Analytics
        </x-sidebar-link>

        <x-sidebar-dropdown title="Workspace" :active="false">
            <x-slot name="icon">
                <div class="w-5 h-5 mr-2 flex justify-center items-center">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
            </x-slot>
            <x-slot name="submenu">
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Projects</x-sidebar-link>
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Team</x-sidebar-link>
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Calendar</x-sidebar-link>
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Documents</x-sidebar-link>
            </x-slot>
        </x-sidebar-dropdown>

        <x-sidebar-dropdown title="Communication" :active="false">
            <x-slot name="icon">
                <div class="w-5 h-5 mr-2 flex justify-center items-center">
                    <i class="fa-solid fa-comments"></i>
                </div>
            </x-slot>
            <x-slot name="submenu">
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Messages</x-sidebar-link>
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Notifications</x-sidebar-link>
            </x-slot>
        </x-sidebar-dropdown>

        <x-sidebar-dropdown title="System" :active="request()->routeIs('settings')">
            <x-slot name="icon">
                <div class="w-5 h-5 mr-2 flex justify-center items-center">
                    <i class="fa-solid fa-server"></i>
                </div>
            </x-slot>
            <x-slot name="submenu">
                <x-sidebar-link href="#"
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">Reports</x-sidebar-link>
                <x-sidebar-link :href="route('settings')" :active="request()->routeIs('settings')" wire:navigate
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">
                    Settings
                </x-sidebar-link>
            </x-slot>
        </x-sidebar-dropdown>

        <x-sidebar-dropdown title="Account" :active="request()->routeIs('profile')">
            <x-slot name="icon">
                <div class="w-5 h-5 mr-2 flex justify-center items-center">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
            </x-slot>
            <x-slot name="submenu">
                <x-sidebar-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate
                    class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">
                    Profile
                </x-sidebar-link>
                <x-sidebar-link href="#" class="ml-5 pl-4 rounded-l-md border-l border-gray-100 dark:border-gray-700">
                    Privacy
                </x-sidebar-link>
            </x-slot>
        </x-sidebar-dropdown>
    </nav>

    <!-- User Profile & Logout -->
    <!-- User Profile & Logout -->
    <div class="p-3 border-t border-gray-100 dark:border-gray-700 shrink-0">
        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
            <div class="flex items-center min-w-0 flex-1">
                <div class="relative overflow-hidden bg-gray-100 rounded-full w-8 h-8 dark:bg-gray-600 shrink-0">
                    <svg class="absolute text-gray-400 w-10 h-10 -left-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="min-w-0 ml-3 flex-1">
                    <p class="text-sm font-medium text-gray-700 truncate dark:text-gray-200"
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                        x-on:profile-updated.window="name=$event.detail.name"></p>
                    <p class="text-xs text-gray-400 truncate dark:text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

            <button wire:click="logout"
                class="ml-2 p-1.5 text-gray-400 hover:text-red-500 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                title="Log out">
                <i class="fa-solid fa-arrow-right-from-bracket w-4 h-4"></i>
            </button>
        </div>
    </div>
</aside>