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
                @if(request()->routeIs('dashboard') || request()->routeIs('profile') || request()->routeIs('settings') || request()->routeIs('user.profile'))
                    <div class="-mr-2 flex items-center">
                        <button @click="sidebarOpen = ! sidebarOpen"
                            class="inline-flex items-center justify-center p-1 rounded-full text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Logo -->
                <div class="shrink-0 flex items-center ml-6">
                    <a href="{{ auth()->check() ? route('dashboard') : route('welcome') }}" wire:navigate>
                        <span
                            class="text-2xl font-black tracking-tighter text-indigo-600 dark:text-indigo-400 font-sans">
                            Dev Dialect
                        </span>
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

                @auth
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
                            <div
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center justify-between">
                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Recent
                                    Activity</span>
                                <button
                                    class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Clear
                                    All</button>
                            </div>

                            <div class="max-h-80 overflow-y-auto">
                                <div
                                    class="p-3 flex items-start space-x-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors border-b border-gray-50 dark:border-gray-700/50 last:border-0">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-rocket text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-700 dark:text-gray-200 leading-tight">Welcome
                                            to DevDialect 2.0!</p>
                                        <p class="text-[10px] text-gray-500 mt-0.5">Start sharing your first snippet today.
                                        </p>
                                        <p class="text-[9px] text-gray-400 mt-1 uppercase font-black">Just Now</p>
                                    </div>
                                </div>

                                <div
                                    class="p-3 flex items-start space-x-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors border-b border-gray-50 dark:border-gray-700/50 last:border-0">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-user-check text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-700 dark:text-gray-200 leading-tight">Profile
                                            Verified</p>
                                        <p class="text-[10px] text-gray-500 mt-0.5">Your developer credentials have been
                                            synced.</p>
                                        <p class="text-[9px] text-gray-400 mt-1 uppercase font-black">2 mins ago</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="p-3 border-t border-gray-100 dark:border-gray-700 text-center bg-gray-50/30 dark:bg-gray-800/30">
                                <a href="#"
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-indigo-600 transition-colors">See
                                    All Notifications</a>
                            </div>
                        </x-slot>
                    </x-dropdown>

                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="w-48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-1 py-1 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 dark:text-gray-400 bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 group">

                                <div class="relative w-8 h-8 rounded-full overflow-hidden border-2 border-transparent group-hover:border-indigo-500 transition-colors"
                                    x-data="{ 
                                                avatar: '{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}' 
                                             }"
                                    x-on:profile-updated.window="avatar = $event.detail.profile_photo_url || avatar">
                                    <img :src="avatar" class="w-full h-full object-cover" alt="{{ auth()->user()->name }}">
                                </div>

                                <div class="ml-2 hidden md:flex items-center">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 mr-1"
                                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></span>
                                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400"></i>
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
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition-colors"
                            wire:navigate>Log in</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-sm shadow-indigo-200 dark:shadow-none"
                            wire:navigate>Join DevDialect</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>