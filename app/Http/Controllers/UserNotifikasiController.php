<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotifikasiController extends Controller
{
    public function index()
    {
        // ambil semua notifikasi user yang login
        $notifikasi = auth()->user()->notifications;

        // kirim ke view
        return view('user.notifikasi.index', compact('notifikasi'));
    }
}
