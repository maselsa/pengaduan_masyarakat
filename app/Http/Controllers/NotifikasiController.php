<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
{
    $notifikasi = \App\Models\Tanggapan::with('pengaduan')
        ->whereHas('pengaduan', function($q) {
            $q->where('user_id', auth()->id());
        })
        ->latest()
        ->get();

    return view('user.notifikasi.index', compact('notifikasi'));
}

}
