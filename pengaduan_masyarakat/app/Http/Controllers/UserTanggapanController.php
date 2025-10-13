<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class UserTanggapanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with(['category', 'tanggapan'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.tanggapan.index', compact('pengaduan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string'
        ]);

        Tanggapan::create([
            'pengaduan_id' => $id,
            'user_id' => Auth::id(), // user yang login
            'isi' => $request->isi
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}
