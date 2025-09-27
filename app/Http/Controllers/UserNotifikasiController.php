<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class UserNotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.notifikasi.index', compact('notifikasi'));
    }

    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notifikasi->update(['is_read' => true]);

        return back();
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);

    // pastikan user hanya bisa hapus notifikasi miliknya
        if ($notifikasi->user_id !== auth()->id()) {
            abort(403, 'Tidak punya akses');
        }

        $notifikasi->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus!');
   }
}
