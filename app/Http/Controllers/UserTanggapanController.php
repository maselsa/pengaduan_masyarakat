<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class UserTanggapanController extends Controller
{
    /**
     * Tampilkan daftar pengaduan beserta tanggapannya
     */
    public function index()
    {
        // Ambil semua pengaduan milik user yang sedang login (jika ada sistem login)
        // atau semua pengaduan jika belum dibatasi
        $pengaduan = Pengaduan::with('tanggapan')
        ->where('user_id', Auth::id())
        ->get();

        return view('user.tanggapan.index', compact('pengaduan'));
    }
}
