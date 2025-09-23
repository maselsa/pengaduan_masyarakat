<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class AdminTanggapanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('tanggapan')->get();
        return view('admin.tanggapan.index', compact('pengaduan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'isi'          => $request->isi,
            'user_id'      => auth()->id(),
        ]);

        // setelah admin kasih tanggapan, status selesai
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }

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

    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $pengaduan = $tanggapan->pengaduan;

        $tanggapan->delete();

        // kalau tanggapan dihapus, status balik ke proses
        $pengaduan->status = 'proses';
        $pengaduan->save();

        return back()->with('success', 'Tanggapan berhasil dihapus!');
    }
}