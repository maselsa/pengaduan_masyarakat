<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Route bawaan auth (login, register, logout, dll.)
Auth::routes();

Route::group(['middleware' => ['auth']], function () {


    // Resource CRUD untuk Pengaduan
    Route::resource('pengaduan', PengaduanController::class);

    // Admin
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])
         ->name('admin.dashboard')->middleware('auth');;

    // Pelapor
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index'])
         ->name('user.dashboard')->middleware('auth');;

    Route::get('/form-pengaduan', [PengaduanController::class, 'create'])
     ->name('form-pengaduan');

     

     





});
