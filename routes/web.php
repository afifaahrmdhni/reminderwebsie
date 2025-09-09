<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [DashadminController::class, 'index'])->name('dashboard-admin.index');

Route::resource('/users-admin', UserController::class)->names('users-admin');
Route::resource('/kategori_product', ProductController::class)->names('product-admin');
Route::resource('/reminder', \App\Http\Controllers\ReminderController::class)->names('reminders-admin');
Route::prefix('archive-admin')->name('archive-admin.')->group(function () {
    Route::get('/', [ArchiveController::class, 'index'])->name('index');   // 🔹 halaman arsip
    Route::post('/{id}/restore', [ArchiveController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force-delete', [ArchiveController::class, 'forceDelete'])->name('forceDelete');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });