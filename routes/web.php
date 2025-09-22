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
use App\Http\Controllers\AdminMasyarakatController;
use App\Http\Controllers\UserNotifikasiController;
use App\Http\Controllers\AdminTanggapanController;
use App\Http\Controllers\UserProfilController;
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
        Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('/pengaduan/{id}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
        Route::post('pengaduan/{id}/konfirmasi', [AdminPengaduanController::class, 'konfirmasi'])->name('pengaduan.konfirmasi');
        Route::get('/tanggapan', [AdminTanggapanController::class, 'index'])->name('tanggapan.index');   // tampilkan semua tanggapan
        Route::post('/tanggapan/{pengaduan}', [AdminTanggapanController::class, 'store'])->name('tanggapan.store'); // simpan tanggapan baru
        Route::put('/tanggapan/{tanggapan}', [AdminTanggapanController::class, 'update'])->name('tanggapan.update'); // edit tanggapan
        Route::delete('/tanggapan/{tanggapan}', [AdminTanggapanController::class, 'destroy'])->name('tanggapan.destroy'); // hapus tanggapan

    
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
        Route::get('/profil', [UserProfilController::class, 'index'])->name('profil');
        Route::post('/profil', [UserProfilController::class, 'update'])->name('profil.update');
        Route::get('/pengaduan/{id}', [UserPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::get('tanggapan', [UserTanggapanController::class, 'index'])->name('tanggapan.index');
        Route::get('notifikasi', [UserNotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::patch('notifikasi/{id}/read', [UserNotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
        
    });


    //NO AUTH 

    // Data kategori
    Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data.kategori');
    //Data pengaduan
    Route::get('/data-pengaduan', [AdminPengaduanController::class, 'index'])->name('data.pengaduan');
     //Data masyarakat
    Route::get('/data-masyarakat', [AdminMasyarakatController::class, 'index'])->name('data.masyarakat');
    
});