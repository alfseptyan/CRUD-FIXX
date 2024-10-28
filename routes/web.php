<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\Auth\LoginRegisterController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    route::get('/buku',[BooksController::class,'index']) -> name('buku');
    route::get('/buku/create',[BooksController::class,'create'])->name('create');
    route::post('/buku',[BooksController::class,'store'])->name('store');
    route::delete('/buku/{id}',[BooksController::class,'destroy'])->name('destroy');
    route::get('/buku/{id}/edit',[BooksController::class,'edit'])->name('edit');
    route::put('/buku/{id}/update',[BooksController::class,'update'])->name('update');
    route::get('/buku/search',[BooksController::class,'search'])->name('search');

});
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});