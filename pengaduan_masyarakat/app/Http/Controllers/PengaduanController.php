<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Menampilkan daftar pengaduan
     */
    public function index()
    {
        // Ambil semua pengaduan milik user login
        $pengaduan = Pengaduan::where('user_id', auth()->id())->get();

        return view('user.pengaduan.index', compact('pengaduan'));
    }

    /**
     * Form tambah pengaduan
     */
    public function create()
    {
        return view('user.pengaduan.create');
    }

    /**
     * Simpan pengaduan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'  => 'required|date',
            'lokasi'   => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
        ]);

        Pengaduan::create([
            'user_id'  => auth()->id(),
            'tanggal'  => $request->tanggal,
            'lokasi'   => $request->lokasi,
            'kategori' => $request->kategori,
            'isi'      => $request->isi,
            'status'   => 'pending', // default status
        ]);

        return redirect()->route('user.pengaduan.index')
                         ->with('success', 'Pengaduan berhasil dikirim.');
    }

    /**
     * Detail pengaduan
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('user.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Form edit pengaduan
     */
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('user.pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Update pengaduan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'  => 'required|date',
            'lokasi'   => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status == 'pending') { // hanya bisa update kalau masih pending
            $pengaduan->update([
                'tanggal'  => $request->tanggal,
                'lokasi'   => $request->lokasi,
                'kategori' => $request->kategori,
                'isi'      => $request->isi,
            ]);
        }

        return redirect()->route('user.pengaduan.index')
                         ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Hapus pengaduan
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status == 'pending') { // hanya bisa hapus kalau pending
            $pengaduan->delete();
        }

        return redirect()->route('user.pengaduan.index')
                         ->with('success', 'Pengaduan berhasil dihapus.');
    }
}