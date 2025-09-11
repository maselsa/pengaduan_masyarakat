<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserPengaduanController;
use App\Http\Controllers\AdminPengaduanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\HomeController;


    // Route halaman utama
    Route::get('/', function () {
    return view('home');
    });


    // Route data pengaduan (kalau ini untuk tampil data pengaduan)
    Route::get('/data-pengaduan', [AdminPengaduanController::class, 'index'])->name('data.pengaduan');
    Route::get('/user/form-pengaduan', [UserPengaduanController::class, 'index'])->name('form.pengaduan');
    Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data.kategori');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Auth bawaan Laravel (login, register, logout, dll.)
    Auth::routes();

    // Logout khusus (karena defaultnya GET → error)
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Semua route yang butuh login
    Route::group(['middleware' => ['auth']], function () {

    // Dashboard user
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    // CRUD pengaduan user
    Route::prefix('user')->name('user.')->group(function () {
    Route::resource('pengaduan', UserPengaduanController::class);
});

    // Form pengaduan (langsung create)
    Route::get('/form-pengaduan', [PengaduanController::class, 'create'])->name('form-pengaduan'); 
    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Data pengaduan (read & delete saja)
    Route::resource('pengaduan', AdminPengaduanController::class)->only(['index', 'show', 'destroy']);
    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    });
    // CRUD kategori
    
    //Dashboard diarahkan sesuai role -> user dan admin
    // (kalo login sebagai admin ya di arahkan ke admin/dashboard)
    Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('login');
});
});
