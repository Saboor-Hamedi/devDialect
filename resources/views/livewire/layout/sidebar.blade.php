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

<aside x-cloak :class="sidebarOpen ? 'w-[250px] min-w-[250px]' : 'w-0 min-w-0 opacity-0 pointer-events-none'"
    class="flex flex-col h-[calc(100vh-4rem)] overflow-hidden transition-all duration-300 bg-white border-r border-gray-100 shrink-0 sticky top-16 dark:bg-gray-800 dark:border-gray-700">
    <!-- Logo -->
    <!-- Navigation Links -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            Dashboard
        </x-sidebar-link>

        <x-sidebar-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                </path>
            </svg>
            Settings
        </x-sidebar-link>
    </nav>

    <!-- User Profile & Logout -->
    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-gray-100 dark:border-gray-700 shrink-0">
        <div class="flex items-center justify-between group">
            <div class="flex items-center min-w-0 mr-2">
                <div class="relative overflow-hidden bg-gray-100 rounded-full w-9 h-9 dark:bg-gray-600 shrink-0">
                    <svg class="absolute text-gray-400 w-11 h-11 -left-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="min-w-0 ml-3">
                    <p class="text-sm font-medium text-gray-700 truncate dark:text-gray-200"
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></p>
                    <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

            <button wire:click="logout"
                class="p-2 text-gray-400 transition-colors duration-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none"
                title="Log out">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</aside>