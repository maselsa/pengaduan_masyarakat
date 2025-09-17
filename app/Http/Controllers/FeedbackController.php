<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('admin.feedback.index', compact('pengaduan'));
    }

    /**
     * Simpan tanggapan dari admin
     */
    public function tanggapan(Request $request, $id)
    {
        // validasi input
        $request->validate([
            'status' => 'required',
            'tanggapan' => 'nullable|string'
        ]);

        // cari pengaduan berdasarkan id
        $pengaduan = Pengaduan::findOrFail($id);

        // update status & tanggapan
        $pengaduan->status = $request->status;
        $pengaduan->tanggapan = $request->tanggapan;
        $pengaduan->save();

        return redirect()->route('feedback.index')->with('success', 'Tanggapan berhasil dikirim!');
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:Diproses,Selesai,Ditolak',
            'tanggapan' => 'nullable|string'
        ]);

        // Cari pengaduan
        $pengaduan = Pengaduan::findOrFail($id);

        // Update status & tanggapan
        $pengaduan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dikirim!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}