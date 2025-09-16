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

        return redirect()->route('pengaduan.feedback')->with('success', 'Tanggapan berhasil dikirim!');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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