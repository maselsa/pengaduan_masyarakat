<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class UserTanggapanController extends Controller
{
  public function index()
{
    $pengaduan = Pengaduan::with(['category'])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('user.tanggapan.index', compact('pengaduan'));
}
}
