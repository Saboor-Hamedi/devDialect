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

<nav class="fixed top-0 w-full z-50 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Hamburger (Only for Authenticated Users) -->
                @auth
                    <div class="flex items-center -ml-2 mr-2">
                        <button @click="sidebarOpen = ! sidebarOpen"
                            class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endauth

                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">DevDialect</span>
                    </a>
                </div>
            </div>

            <!-- Right Side Navigation -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- User Dropdown -->
                    <div class="p-4 shrink-0">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">
                                    <div
                                        class="relative w-8 h-8 mr-2 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                        <svg class="absolute w-10 h-10 text-gray-400 -left-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    </div>
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- User Info -->
                                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">
                                    <p class="text-sm font-medium leading-5 text-gray-900 dark:text-gray-100"
                                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></p>
                                    <p class="text-xs leading-5 text-gray-500 truncate dark:text-gray-400">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>

                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Settings') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-100 dark:border-gray-600"></div>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @guest
                    <livewire:welcome.navigation />
                @endguest
            </div>
        </div>
    </div>
</nav>