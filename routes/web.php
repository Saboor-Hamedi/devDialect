<?php

use App\Http\Controllers\UserProfileController;

Route::get('/user/profile', [UserProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('user.profile');
Route::view('/', 'index')->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::view('settings', 'settings')
    ->middleware(['auth', 'verified'])
    ->name('settings');

require __DIR__ . '/auth.php';
