<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Category;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class AdminPengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('category', 'masyarakat')->get();
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('category', 'masyarakat', 'tanggapan')->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }

    // 🌟 Update status + simpan tanggapan admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'isi' => 'nullable|string',
        ]);

        // update status pengaduan
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        // kalau ada tanggapan admin, simpan di tabel tanggapan
        if ($request->filled('isi')) {
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => Auth::id(), // admin yang login
                'isi' => $request->isi,
            ]);
        }

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Status & tanggapan berhasil diperbarui!');
    }

    

    public function konfirmasi($id)
   {
    $pengaduan = Pengaduan::findOrFail($id);

    // Ubah status
    $pengaduan->status = 'diproses';
    $pengaduan->save();

    // Simpan notifikasi ke session user (nanti bisa diganti database notif)
    session()->flash('notif_user', 'Pengaduan anda telah dikonfirmasi!');

    return redirect()->back()->with('success', 'Pengaduan berhasil dikonfirmasi!');
   }
}