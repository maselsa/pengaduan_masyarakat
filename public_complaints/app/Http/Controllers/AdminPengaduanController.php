<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengaduanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    // pengaduan relasi user & category
    $pengaduan = Pengaduan::with('user', 'category')
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })
        ->latest() 
        ->get();

    return view('admin.pengaduan.index', compact('pengaduan'));
}


    public function show($id)
    {
        $pengaduan = Pengaduan::with('category', 'user', 'tanggapan')->findOrFail($id);

        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }

    // Update status + tanggapan + notifikasi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai,tolak',
            'isi' => 'nullable|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        // kalau ada tanggapan admin
        if ($request->filled('isi')) {
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => Auth::id(),
                'isi' => $request->isi,
            ]);
        }

        //  Notifikasi sesuai status
        $pesan = match ($pengaduan->status) {
            'proses' => 'Pengaduan Anda sedang diproses Admin. Mohon bersabar, ya. ',
            'selesai' => 'Pengaduan Anda telah di tanggapi dan sudah selesai. Terima Kasih.',
            'tolak' => 'Pengaduan Anda di tolak Admin. Silahkan buat pengaduan baru yang benar.',
            default => 'Pengaduan Anda telah diperbarui ',
        };

        Notifikasi::create([
            'user_id' => $pengaduan->user_id, // pastikan ada di DB
            'judul' => 'Update Pengaduan',
            'pesan' => $pesan,
            'is_read' => 0,
        ]);

        return redirect()->route('admin.pengaduan.show', $id)
            ->with('success', 'Status & tanggapan berhasil diperbarui!');
    }

    // konfirmasi pertama kali (pending -> proses)
    public function konfirmasi($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status === 'pending') {
            $pengaduan->status = 'proses';
            $pengaduan->save();

            // tanggapan otomatis
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => Auth::id(),
                'isi' => 'Pengaduan Anda sedang diproses Admin.',
            ]);

            // notifikasi otomatis
            Notifikasi::create([
                'user_id' => $pengaduan->user_id, // pake user_id
                'judul' => 'Pengaduan Dikonfirmasi',
                'pesan' => 'Pengaduan Anda sedang diproses Admin. Mohon bersabar, ya.  ',
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Pengaduan berhasil dikonfirmasi!');
    }

    public function tolak($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status === 'pending') {
            $pengaduan->status = 'tolak';
            $pengaduan->save();

            // tanggapan otomatis
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => Auth::id(),
                'isi' => 'Pengaduan ditolak Admin.',
            ]);

            // notifikasi otomatis
            Notifikasi::create([
                'user_id' => $pengaduan->user_id,
                'judul' => 'Pengaduan Ditolak',
                'pesan' => 'Pengaduan Anda di tolak Admin. Silahkan buat pengaduan baru yang benar.',
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'pengaduan berhasil ditolak!❌');
    }

    public function selesai($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status === 'proses') {
            $pengaduan->status = 'selesai';
            $pengaduan->save();

            // tanggapan otomatis
            Tanggapan::create([
                'pengaduan_id' => $pengaduan->id,
                'user_id' => Auth::id(),
                'isi' => 'Pengaduan Selesai',
            ]);

            // notifikasi otomatis
            Notifikasi::create([
                'user_id' => $pengaduan->user_id,
                'judul' => 'Pengaduan Selesai',
                'pesan' => 'Pengaduan Anda telah di tanggapi dan sudah selesai. Terima Kasih.',
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'pengaduan berhasil diselesaikan!✅');
    }
}
