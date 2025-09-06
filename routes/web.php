<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', [DashadminController::class, 'index'])->name('dashboard-admin.index');

Route::resource('/user', UserController::class)->names('users-admin');
Route::resource('/kategori_product', ProductController::class)->names('products-admin');
Route::resource('/reminder', \App\Http\Controllers\ReminderController::class)->names('reminders-admin');
Route::resource('/archive', \App\Http\Controllers\ArchiveController::class)->names('archive-admin');






// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/Dashmin', [DashadminController::class, 'index'])->name('Dashboard.index');
// Route::get('/User', [UserController::class, 'index'])->name('Users.index');
// Route::get('/products', [ProductController::class, 'index'])->name('Products.index');
