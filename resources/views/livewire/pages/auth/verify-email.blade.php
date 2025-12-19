<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div
    class="w-full sm:max-w-[400px] px-6 py-6 bg-white dark:bg-gray-800 shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden sm:rounded-2xl transition-all">
    <!-- Header -->
    <div class="mb-6 text-center">
        <div
            class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 mb-3 shadow-sm">
            <i class="fa-solid fa-satellite-dish text-lg animate-pulse"></i>
        </div>
        <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight">Verify Identity</h2>
        <p class="text-[9px] text-gray-400 dark:text-gray-500 mt-0.5 uppercase font-black tracking-[0.2em]">Deployment
            Awaiting Confirmation</p>
    </div>

    <div class="space-y-6">
        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed text-center">
            {{ __('Welcome to the stream. We\'ve dispatched a secure verification link to your email hash. Please authorize it to initialize your full developer access.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="p-3 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-xl">
                <p class="text-[10px] text-green-600 dark:text-green-400 font-bold uppercase tracking-wider text-center">
                    {{ __('A fresh link has been deployed to your inbox.') }}
                </p>
            </div>
        @endif

        <div class="space-y-3">
            <button wire:click="sendVerification"
                class="w-full flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase tracking-[0.2em] rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 relative overflow-hidden group">
                <div
                    class="absolute inset-0 bg-white/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700">
                </div>
                <span>{{ __('Resend Link') }}</span>
            </button>

            <button wire:click="logout"
                class="w-full text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors py-2">
                {{ __('Abort & Log Out') }}
            </button>
        </div>
    </div>
</div>