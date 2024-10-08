<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [HomeController::class, 'index'])->name('index');

Route::get('/', [HomeController::class, 'dashboard']);
Route::get('/create', [HomeController::class,'create'])->name('user.create');
Route::post('/store', [HomeController::class,'store'])->name('user.store');
