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

<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center">
                    <button @click="sidebarOpen = ! sidebarOpen"
                        class="inline-flex items-center justify-center p-1 rounded-full text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="shrink-0 flex items-center ml-6">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <span
                            class="text-2xl font-black tracking-tighter text-indigo-600 dark:text-indigo-400 font-sans">DevDialect</span>
                    </a>
                </div>
            </div>

            <!-- Right Side Actions -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Command Palette Trigger -->
                <button @click="$dispatch('keydown.window', { key: 'k', ctrlKey: true })"
                    class="p-2 mr-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors"
                    title="Command Palette (Ctrl+K)">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <!-- Notifications Dropdown -->
                <x-dropdown align="right" width="w-80">
                    <x-slot name="trigger">
                        <button
                            class="relative p-2 mr-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                            <i class="fa-regular fa-bell text-lg"></i>
                            <!-- Notification Badge -->
                            <span
                                class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-gray-800"></span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-600">
                            <span class="text-xs font-semibold text-gray-400 uppercase">Notifications</span>
                        </div>

                        <div
                            class="py-2 px-4 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                            <p class="font-medium">Welcome to DevDialect!</p>
                            <p class="text-xs text-gray-500">Just now</p>
                        </div>
                        <div
                            class="py-2 px-4 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                            <p class="font-medium">Profile updated successfully</p>
                            <p class="text-xs text-gray-500">2 mins ago</p>
                        </div>

                        <div class="border-t border-gray-100 dark:border-gray-600"></div>
                        <div class="p-2 text-center">
                            <a href="#" class="text-xs text-indigo-600 hover:text-indigo-500 font-medium">Mark all as
                                read</a>
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="w-56">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Info (Visible in Dropdown) -->
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-600 mb-1">
                            <p class="text-sm font-medium leading-5 text-gray-900 dark:text-gray-100"
                                x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"></p>
                            <p class="text-xs leading-5 text-gray-500 truncate dark:text-gray-400">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <x-dropdown-link :href="route('user.profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('settings')" wire:navigate>
                            {{ __('Settings') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100 dark:border-gray-600 my-1"></div>

                        <!-- Authentication -->
                        <button wire:click="logout"
                            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                            {{ __('Log Out') }}
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>