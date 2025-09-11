<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Category;

class UserPengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('category')
            ->where('email', auth()->user()->email) // hanya tampilkan data user login
            ->get();

        return view('user.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
         if(auth()->user()->role != 'user') {
            abort(403); // hanya user yg bisa akses
        }
        $categories = Category::all();
        return view('user.pengaduan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|max:100',
            'no_hp'       => 'required|string|max:20',
            'tanggal'     => 'required|date',
            'lokasi'      => 'nullable|string',
            'category' => 'required|exists:categories,id',
            'deskripsi'   => 'required|string',
            'bukti'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti')) {
            $fileName = time() . '.' . $request->bukti->extension();
            $request->bukti->move(public_path('uploads'), $fileName);
            $validated['bukti'] = $fileName;
        }

        Pengaduan::create($validated);

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim!');

            
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('category')->findOrFail($id);
        return view('user.pengaduan.show', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $categorie = Category::all();
        return view('user.pengaduan.edit', compact('pengaduan', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update($request->all());

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
