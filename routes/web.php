<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Routes untuk semua user yang sudah login & verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Routes khusus superadmin
Route::middleware(['auth', 'verified', 'role:superadmin'])->prefix('admin')->name('admin.')->group(function () {
    // Contoh: Route::view('users', 'admin.users')->name('users');
});

require __DIR__.'/settings.php';
