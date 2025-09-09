<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', [DashadminController::class, 'index'])->name('dashboard-admin.index');

Route::resource('/users-admin', UserController::class)->names('users-admin');
Route::resource('/kategori_product', ProductController::class)->names('product-admin');
Route::resource('/reminder', \App\Http\Controllers\ReminderController::class)->names('reminders-admin');
Route::resource('/archive', \App\Http\Controllers\ArchiveController::class)->names('archive-admin');
