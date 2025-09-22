<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class AdminTanggapanController extends Controller
{
    // tampilkan semua pengaduan beserta tanggapannya
    public function index()
    {
        $pengaduan = Pengaduan::with('tanggapan')->get();
        return view('admin.tanggapan.index', compact('pengaduan'));
    }

    // tambah tanggapan baru
    public function store(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $tanggapan = new Tanggapan();
        $tanggapan->pengaduan_id = $id;
        $tanggapan->isi = $request->isi;
        $tanggapan->user_id = auth()->id(); 
        $tanggapan->save();

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }

    // edit tanggapan
    public function update(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->isi = $request->isi;
        $tanggapan->user_id = auth()->id(); 
        $tanggapan->save();

        return back()->with('success', 'Tanggapan berhasil diperbarui!');
    }

    // hapus tanggapan
    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        $pengaduan = $tanggapan->pengaduan;
        $pengaduan->status = 'proses'; // setelah hapus, balik ke "proses"
        $pengaduan->save();

        $tanggapan->delete();

        return back()->with('success', 'Tanggapan berhasil dihapus!');
    }
}