<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('level:admin')->group(function(){

    });

Route::middleware('level:admin,kasir')->group(function(){

    });

Route::middleware('level:admin')->group(function() {
    Route::resource('kategori', KategoriController::class)->except('show');
});

});