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
use App\Http\Controllers\AdminMasyarakatController;
use App\Http\Controllers\UserNotifikasiController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserProfilController;


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
        Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('/pengaduan/{id}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
        Route::post('pengaduan/{id}/konfirmasi', [AdminController::class, 'konfirmasi'])->name('pengaduan.konfirmasi');
    
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
        Route::get('/notifikasi', [UserNotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::get('/profil', [UserProfilController::class, 'index'])->name('profil');
        Route::post('/profil', [UserProfilController::class, 'update'])->name('profil.update');
        
    });


    //NO AUTH 

    // Data kategori
    Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data.kategori');
    //Data pengaduan
    Route::get('/data-pengaduan', [AdminPengaduanController::class, 'index'])->name('data.pengaduan');
     //Data masyarakat
    Route::get('/data-masyarakat', [AdminMasyarakatController::class, 'index'])->name('data.masyarakat');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('user.notifikasi');
    Route::get('/admin/notifikasi', [NotifikasiController::class, 'admin'])->name('admin.notifikasi');
    // Halaman feedback (GET)
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('pengaduan.feedback');
    // route POST untuk mengirim tanggapan feedback
    Route::post('/admin/feedback/{id}/tanggapan', [FeedbackController::class, 'tanggapan'])->name('feedback.tanggapan');
});