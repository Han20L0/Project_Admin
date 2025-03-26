<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/loginpros', [loginController::class, 'login_proces'])->name('loginpros');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/register', [loginController::class, 'register'])->name('register');
Route::post('/registerpros', [loginController::class, 'register_proces'])->name('registerpros');

Route::group(['prefix'=> 'admin','middleware' => ['auth'],'as' => 'admin.'], function(){
    Route::post('/store', [HomeController::class,'store'])->name('user.store');

    Route::get('/user', [HomeController::class, 'index'])->name('index');
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/create', [HomeController::class,'create'])->name('user.create');
    Route::get('/edit/{id}', [HomeController::class,'edit'])->name('user.edit');


    Route::put('/update/{id}', [HomeController::class,'update'])->name('user.update');


    Route::delete('/delete/{id}', [HomeController::class,'delete'])->name('user.delete');

});



