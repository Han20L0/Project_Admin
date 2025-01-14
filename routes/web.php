<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::post('/store', [HomeController::class,'store'])->name('user.store');


Route::get('/user', [HomeController::class, 'index'])->name('index');
Route::get('/', [HomeController::class, 'dashboard']);
Route::get('/create', [HomeController::class,'create'])->name('user.create');
Route::get('/edit/{id}', [HomeController::class,'edit'])->name('user.edit');


Route::put('/update/{id}', [HomeController::class,'update'])->name('user.update');


Route::delete('/delete/{id}', [HomeController::class,'delete'])->name('user.delete');


Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/loginpros', [loginController::class, 'login_proces'])->name('loginpros');
