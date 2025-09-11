<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReminderController;
use App\Models\User;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================== DASHBOARD ====================
Route::get('/', [DashadminController::class, 'index'])
    ->middleware(['auth', 'role:Admin,Super User,Multi User,Basic User'])
    ->name('dashboard-admin.index');

// ==================== ADMIN ONLY ====================
Route::middleware(['auth', 'role:Admin,Administrator'])->group(function () {
    Route::get('/search-user', [UserController::class, 'searchUser']);
    Route::resource('/users-admin', UserController::class)->names('users-admin');
});

// ==================== ADMIN, SUPER USER, MULTI USER ====================
Route::middleware(['auth', 'role:Admin,Super User,Multi User'])->group(function () {
    Route::resource('/kategori_product', ProductController::class)->names('product-admin');
});

// ==================== ALL ROLES ====================
Route::middleware(['auth', 'role:Admin,Super User,Multi User,Basic User'])->group(function () {
    Route::resource('/reminder', ReminderController::class)->names('reminders-admin');
    Route::get('/search-email', [UserController::class, 'searchEmail'])->name('search.email');
    
    Route::prefix('archive-admin')->name('archive-admin.')->group(function () {
        Route::get('/', [ArchiveController::class, 'index'])->name('index');
        Route::post('/{id}/restore', [ArchiveController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [ArchiveController::class, 'forceDelete'])->name('forceDelete');
    });
});