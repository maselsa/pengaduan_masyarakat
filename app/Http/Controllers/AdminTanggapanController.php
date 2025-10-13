<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class AdminTanggapanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengaduan = Pengaduan::with('tanggapan', 'user')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('admin.tanggapan.index', compact('pengaduan'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('tanggapan')
            ->findOrFail($id);

        return view('admin.tanggapan.show', compact('pengaduan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'isi' => $request->isi,
            'user_id' => auth()->id(),
        ]);

        if ($pengaduan->status == 'pending') {
            $pengaduan->status = 'proses';
        }
        $pengaduan->save();

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->isi = $request->isi;
        $tanggapan->user_id = auth()->id();
        $tanggapan->save();

        return redirect()->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil diperbarui!');
    }

    public function edit($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        return view('admin.tanggapan.edit', compact('tanggapan'));
    }

    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $pengaduan = $tanggapan->pengaduan;

        $tanggapan->delete();

        // kalau tanggapan dihapus, status balik ke proses
        if ($pengaduan->status != 'selesai') {
            $pengaduan->status = 'proses';
            $pengaduan->save();
        }

        return back()->with('success', 'Tanggapan berhasil dihapus!');
    }

    public function selesai($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return back()->with('success', 'Pengaduan berhasil diselesaikan!');
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduans,id',
            'isi' => 'required|string',
        ]);

        Tanggapan::create([
            'pengaduan_id' => $request->pengaduan_id,
            'user_id' => auth()->id(),
            'isi' => $request->isi,
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim 💬');
    }
}
