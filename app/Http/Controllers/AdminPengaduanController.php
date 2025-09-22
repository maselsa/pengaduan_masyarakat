<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Category;
use App\Models\Tanggapan;
use App\Models\Notifikasi;
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

    // 🌟 Update status (setelah proses) + tanggapan + notifikasi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai,ditolak',
            'isi'    => 'nullable|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        // kalau ada tanggapan admin
        if ($request->filled('isi')) {
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id'      => Auth::id(),
                'isi'          => $request->isi,
            ]);
        }

        // 🔔 Notifikasi sesuai status
        $pesan = match ($pengaduan->status) {
            'proses'  => 'Pengaduan kamu sedang diproses admin 🚀',
            'selesai' => 'Pengaduan kamu sudah selesai ✅',
            'ditolak' => 'Pengaduan kamu ditolak ❌',
            default   => 'Pengaduan kamu telah diperbarui 📌',
        };

        Notifikasi::create([
            'user_id' => $pengaduan->user_id,
            'pesan'   => $pesan,
            'is_read' => false
        ]);

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Status & tanggapan berhasil diperbarui!');
    }

    // 🌟 Konfirmasi pertama kali (pending -> proses)
    public function konfirmasi($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status === 'pending') {
            $pengaduan->status = 'proses';
            $pengaduan->save();

            // tanggapan otomatis
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id'      => Auth::id(),
                'isi'          => 'Pengaduan anda telah dikonfirmasi admin.'
            ]);

            // notifikasi otomatis
            Notifikasi::create([
                'user_id' => $pengaduan->user_id,
                'pesan'   => 'Pengaduan kamu sedang diproses admin 🚀',
                'is_read' => 0
            ]);
        }

        return redirect()->back()->with('success', 'Pengaduan berhasil dikonfirmasi!');
    }
}
