<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Pengaduan;
use App\Models\Category;
use App\Models\Masyarakat;

class UserPengaduanController extends Controller
{
    public function index()
{
    $pengaduan = Pengaduan::with('category')
        ->where('email', auth()->user()->email)
        ->get();

    return view('user.pengaduan.index', compact('pengaduan'));
}

    public function create()
    {
        if (auth()->user()->role != 'user') {
            abort(403); // hanya user yang boleh akses
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
        'category_id' => 'required|exists:categories,id',
        'deskripsi'   => 'required|string',
        'bukti'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('bukti')) {
        $path = $request->file('bukti')->store('bukti_pengaduan', 'public');
        $validated['bukti'] = $path;
    }

    // Hubungkan pengaduan ke user yang login
    $validated['user_id'] = auth()->id();   // <-- tetap simpan user_id dari tabel users
    $validated['status'] = 'pending';       // default status

    // Simpan data
    Pengaduan::create($validated);

    // Bikin notifikasi untuk user
    Notifikasi::create([
        'user_id' => auth()->id(),
        'judul'   => 'Pengaduan Terkirim',
        'pesan'   => 'Pengaduan Anda berhasil dikirim dan menunggu konfirmasi Admin',
        'is_read' => 0,
    ]);
    

    return redirect()->route('user.pengaduan.index')
        ->with('success', 'Pengaduan berhasil dikirim!');
}


    public function show($id)
{
    $pengaduan = Pengaduan::with('category')
        ->where('email', auth()->user()->email)
        ->where('id', $id)
        ->firstOrFail();

    return view('user.pengaduan.show', compact('pengaduan'));
}

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->user_id !== auth()->id()) abort(403);

        $categories = Category::all();
        return view('user.pengaduan.edit', compact('pengaduan', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|max:100',
            'no_hp'       => 'required|string|max:20',
            'tanggal'     => 'required|date',
            'lokasi'      => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'deskripsi'   => 'required|string',
            'bukti'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pengaduan', 'public');
            $validated['bukti'] = $path;
        }

        $pengaduan->update($validated);

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->user_id !== auth()->id()) abort(403);

        $pengaduan->delete();

        return redirect()->route('user.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
