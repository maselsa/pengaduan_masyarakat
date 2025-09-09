<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create()
{
    // Pastikan hanya user yang bisa akses
    if(auth()->user()->role != 'user') {
        abort(403); // akses ditolak
    }

    return view('user.create'); // ini menunjuk ke resources/views/user/create.blade.php
}


    public function store(Request $request)
    {
        try {
            // Validasi sesuai form
            $validatedData = $request->validate([
                'nama'   => 'required|string|max:255',
                'email'  => 'required|email|max:100',
                'no_hp'  => 'required|string|max:20',
                'judul'  => 'required|string|max:255',
                'isi'    => 'required|string',
                'bukti'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // Upload file kalau ada
            if ($request->hasFile('bukti')) {
                $fileName = time() . '.' . $request->bukti->extension();
                $request->bukti->move(public_path('uploads'), $fileName);
                $validatedData['bukti'] = $fileName;
            }

            // Simpan ke database
            Pengaduan::create($validatedData);

            return redirect()->route('dashboard')->with('success', 'Pengaduan berhasil dikirim!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }
    }

    public function show(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:100',
            'no_hp'  => 'required|string|max:20',
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'bukti'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4048',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->fill($request->except('bukti'));

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $path = $file->store('uploads', 'public');
            $pengaduan->bukti = $path;
        }

        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah diperbarui.');
    }

    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah dihapus.');
    }
}
