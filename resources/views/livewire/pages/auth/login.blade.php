<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div
    class="w-full sm:max-w-[400px] px-6 py-6 bg-white dark:bg-gray-800 shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden sm:rounded-2xl transition-all">
    <!-- Header -->
    <div class="mb-4 text-center">
        <div
            class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 mb-3 shadow-sm">
            <i class="fa-solid fa-terminal text-lg"></i>
        </div>
        <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight">Sync Stream</h2>
        <p class="text-[9px] text-gray-400 dark:text-gray-500 mt-0.5 uppercase font-black tracking-[0.2em]">Identify
            yourself to continue</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-4">
        <!-- Email Address -->
        <div class="space-y-1">
            <label for="email"
                class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 ml-1">Email
                Hash</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-at text-xs"></i>
                </div>
                <input wire:model="form.email" id="email"
                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-0 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all @error('form.email') ring-2 ring-red-500 @enderror"
                    type="email" name="email" required autofocus autocomplete="username"
                    placeholder="developer@dialect.com" />
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <div class="flex items-center justify-between ml-1">
                <label for="password"
                    class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">Security
                    Key</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black uppercase tracking-widest text-indigo-500 hover:text-indigo-600 transition-colors"
                        href="{{ route('password.request') }}" wire:navigate>
                        Lost Key?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-key text-xs"></i>
                </div>
                <input wire:model="form.password" id="password"
                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-0 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all @error('form.password') ring-2 ring-red-500 @enderror"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center group cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded-md bg-gray-50 dark:bg-gray-900/50 border-0 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-0 dark:focus:ring-offset-gray-800 transition-all"
                    name="remember">
                <span
                    class="ms-2 text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">{{ __('Stay Synced') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase tracking-[0.2em] rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 relative overflow-hidden group">
                <div
                    class="absolute inset-0 bg-white/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700">
                </div>
                <span wire:loading.remove>Deploy Session</span>
                <span wire:loading class="flex items-center">
                    <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                    Syncing...
                </span>
            </button>
        </div>

        <div class="text-center pt-4">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                New to the platform?
                <a href="{{ route('register') }}" class="text-indigo-500 hover:text-indigo-600 transition-colors ml-1"
                    wire:navigate>Initialize Identity</a>
            </p>
        </div>
    </form>
</div>