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
}
