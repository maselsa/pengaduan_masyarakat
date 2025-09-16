<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTanggapanController extends Controller
{
    // 📨 Melihat semua tanggapan dari admin untuk pengaduan milik user yang login
    public function index()
    {
        $tanggapan = Tanggapan::whereHas('pengaduan', function ($q) {
            $q->where('user_id', Auth::id());
        })->latest()->get();

        return view('user.tanggapan.index', compact('tanggapan'));
    }

    // 💬 Admin mengirim tanggapan ke pengaduan tertentu
    public function store(Request $request, $pengaduan_id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($pengaduan_id);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => Auth::id(), // admin yang login
            'isi' => $request->isi,
        ]);

        // ubah status pengaduan jadi proses/selesai
        $pengaduan->update(['status' => 'proses']);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim.');
    }
}
