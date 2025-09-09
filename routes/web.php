<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArchiveController;

Route::get('/', [DashadminController::class, 'index'])->name('dashboard-admin.index');

Route::resource('/users-admin', UserController::class)->names('users-admin');
Route::resource('/kategori_product', ProductController::class)->names('product-admin');
Route::resource('/reminder', \App\Http\Controllers\ReminderController::class)->names('reminders-admin');
Route::prefix('archive-admin')->name('archive-admin.')->group(function () {
    Route::get('/', [ArchiveController::class, 'index'])->name('index');   // 🔹 halaman arsip
    Route::post('/{id}/restore', [ArchiveController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force-delete', [ArchiveController::class, 'forceDelete'])->name('forceDelete');
});
