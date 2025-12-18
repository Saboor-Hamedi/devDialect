<?php

use App\Http\Controllers\UserProfileController;

Route::get('/user/profile', [UserProfileController::class, 'index'])->middleware(['auth'])->name('user.profile');
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('settings', 'settings')
    ->middleware(['auth'])
    ->name('settings');

require __DIR__ . '/auth.php';
