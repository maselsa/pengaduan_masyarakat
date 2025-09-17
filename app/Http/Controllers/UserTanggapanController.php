<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class UserTanggapanController extends Controller
{
    // 👀 User lihat semua tanggapan dari admin untuk pengaduan miliknya
    public function index()
    {
        $pengaduan = Pengaduan::with('feedback')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.tanggapan.index', compact('pengaduan'));
    }
}