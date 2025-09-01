<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/Dashmin', [DashadminController::class, 'index'])->name('Dashboard.index');
Route::get('/User', [UserController::class, 'index'])->name('Users.index');
Route::get('/products', [ProductController::class, 'index'])->name('Products.index');
