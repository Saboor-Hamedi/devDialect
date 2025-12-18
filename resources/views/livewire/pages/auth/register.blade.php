<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div
    class="w-full sm:max-w-[400px] px-6 py-6 bg-white dark:bg-gray-800 shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden sm:rounded-2xl transition-all">
    <!-- Header -->
    <div class="mb-4 text-center">
        <div
            class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 mb-3 shadow-sm">
            <i class="fa-solid fa-code-fork text-lg"></i>
        </div>
        <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight">Initialize Identity</h2>
        <p class="text-[9px] text-gray-400 dark:text-gray-500 mt-0.5 uppercase font-black tracking-[0.2em]">Create your
            developer credentials</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <!-- Name -->
        <div class="space-y-1">
            <label for="name"
                class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 ml-1">Full
                Name</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-user-ninja text-xs"></i>
                </div>
                <input wire:model="name" id="name"
                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-0 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all @error('name') ring-2 ring-red-500 @enderror"
                    type="text" name="name" required autofocus autocomplete="name" placeholder="Linus Torvalds" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1">
            <label for="email"
                class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 ml-1">Email
                Hash</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-at text-xs"></i>
                </div>
                <input wire:model="email" id="email"
                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-0 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all @error('email') ring-2 ring-red-500 @enderror"
                    type="email" name="email" required autocomplete="username" placeholder="developer@dialect.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <label for="password"
                class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 ml-1">Security
                Key</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-key text-xs"></i>
                </div>
                <input wire:model="password" id="password"
                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-0 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all @error('password') ring-2 ring-red-500 @enderror"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <label for="password_confirmation"
                class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 ml-1">Confirm
                Key</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock text-xs"></i>
                </div>
                <input wire:model="password_confirmation" id="password_confirmation"
                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-0 rounded-xl text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all @error('password_confirmation') ring-2 ring-red-500 @enderror"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase tracking-[0.2em] rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 relative overflow-hidden group">
                <div
                    class="absolute inset-0 bg-white/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700">
                </div>
                <span wire:loading.remove>Deploy Identity</span>
                <span wire:loading class="flex items-center">
                    <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                    Initializing...
                </span>
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400">
                Already part of the stream?
                <a href="{{ route('login') }}" class="text-indigo-500 hover:text-indigo-600 transition-colors ml-1"
                    wire:navigate>Sync Session</a>
            </p>
        </div>
    </form>
</div>