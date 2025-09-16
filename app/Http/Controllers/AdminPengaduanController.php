<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Category;

class AdminPengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('category', 'masyarakat')->get();
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('category', 'masyarakat')->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }

    // 🌟 Tambahan baru: Update status + tanggapan admin
    public function updateStatus(Request $request, $id)
    {
    $request->validate([
        'status' => 'required|in:pending,diproses,selesai,ditolak',
        'tanggapan_admin' => 'nullable|string',
    ]);

    $pengaduan = Pengaduan::findOrFail($id);
    $pengaduan->status = $request->status;
    $pengaduan->tanggapan_admin = $request->tanggapan_admin;
    $pengaduan->save();

    return redirect()->route('admin.pengaduan.show', $id)
        ->with('success', 'Status & tanggapan berhasil diperbarui!');
    }

    public function feedbackIndex()
{
    // Ambil semua pengaduan untuk ditanggapi
    $pengaduan = \App\Models\Pengaduan::with('category','masyarakat')->get();
    return view('admin.feedback.index', compact('pengaduan'));
}


}
