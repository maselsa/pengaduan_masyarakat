<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserPengaduanController;
use App\Http\Controllers\AdminPengaduanController;
use App\Http\Controllers\AdminPetugasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserTanggapanController;

// HALAMAN UTAMA (Public)
Route::get('/', function () {
    return view('home');
});

// AUTH ROUTES
Auth::routes();
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// ROUTES WITH AUTH
Route::middleware(['auth'])->group(function () {

    // DASHBOARD REDIRECT BY ROLE
    Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'petugas') {
            return redirect()->route('admin.dashboard'); // admin & petugas
        } elseif (Auth::user()->role === 'user') {
            return redirect()->route('user.dashboard'); // user
        }
    }
    return redirect()->route('login');
});

    // ADMIN ROUTES
    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        // Data pengaduan
        Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('/pengaduan/{id}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
        //Data petugas
        Route::get('/petugas', [AdminPetugasController::class, 'index'])->name('petugas.index');
        Route::get('/petugas/create', [AdminPetugasController::class, 'create'])->name('petugas.create');
        Route::post('/petugas', [AdminPetugasController::class, 'store'])->name('petugas.store');
        // CRUD kategori
        Route::resource('categories', CategoryController::class);
    });


    // USER ROUTES
    Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        // Form pengaduan user (tampilan)
        Route::get('/user/form-pengaduan', [UserPengaduanController::class, 'index'])->name('form.pengaduan');
        // Form pengaduan (langsung create)
        Route::get('/form-pengaduan', [UserPengaduanController::class, 'create'])->name('form-pengaduan');
        // CRUD pengaduan
        Route::resource('pengaduan', UserPengaduanController::class);
        // Tanggapan
        Route::get('/tanggapan', [UserTanggapanController::class, 'index'])->name('tanggapan.index');
    });


    //NO AUTH 

    // Data kategori
    Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data.kategori');
    //Data pengaduan
    Route::get('/data-pengaduan', [AdminPengaduanController::class, 'index'])->name('data.pengaduan');
});