<?php

use App\Http\Controllers\UserExportController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/export-users', [UserExportController::class, 'downloadCsv'])->name('users.export');

require __DIR__.'/auth.php';
