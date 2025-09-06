<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Controller;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});