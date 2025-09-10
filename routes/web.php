<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReminderController;

// ==================== AUTH ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================== DASHBOARD ====================
Route::get('/', [DashadminController::class, 'index'])
    ->middleware(['auth', 'role:1,2,3,4'])
    ->name('dashboard-admin.index');

// ==================== ADMIN ONLY (role_id = 1) ====================
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/search-user', [UserController::class, 'searchUser']);
    Route::resource('/users-admin', UserController::class)->names('users-admin');
});

// ==================== ADMIN, SUPER USER, MULTI USER (role_id 1,2,3) ====================
Route::middleware(['auth', 'role:1,2,3'])->group(function () {
    Route::resource('/kategori_product', ProductController::class)->names('product-admin');
});

// ==================== ALL ROLES (1,2,3,4) ====================
Route::middleware(['auth', 'role:1,2,3,4'])->group(function () {
    Route::resource('/reminder', ReminderController::class)->names('reminders-admin');

    Route::prefix('archive-admin')->name('archive-admin.')->group(function () {
        Route::get('/', [ArchiveController::class, 'index'])->name('index');
        Route::post('/{id}/restore', [ArchiveController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [ArchiveController::class, 'forceDelete'])->name('forceDelete');
    });
});
