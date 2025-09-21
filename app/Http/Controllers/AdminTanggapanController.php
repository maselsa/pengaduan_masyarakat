<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTanggapanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('admin.tanggapan.index', compact('pengaduan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggapan_admin' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->tanggapan_admin = $request->tanggapan_admin;
        $pengaduan->tanggal_tanggapan = now();
        $pengaduan->status = 'selesai'; // otomatis selesai setelah ditanggapi
        $pengaduan->save();

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}
