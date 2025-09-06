<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduan = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        // Validasi input termasuk file upload
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string',
            'date' => 'required|date',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'anonymous' => 'nullable|boolean',
        ]);

        // Cek jika ada file yang di-upload
        if ($request->hasFile('attachment')) {
            // Generate nama file unik
            $fileName = time() . '.' . $request->attachment->extension();
            // Pindahkan file ke folder 'uploads'
            $request->attachment->move(public_path('uploads'), $fileName);
            // Simpan nama file ke dalam array $validatedData
            $validatedData['attachment'] = $fileName;
        }

        // Simpan data ke database
        Pengaduan::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Pengaduan berhasil dikirim!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->validator)->withInput();
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $pengaduan = Pengaduan::findOrFail($id);
    return view('pengaduan.show', [
        'pengaduan' => $pengaduan,
        'attachmentUrl' => $pengaduan->attachment_url,
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string',
            'date' => 'required|date',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4048',
            'anonymous' => 'nullable|boolean',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->fill($request->except('attachment'));

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');
            $pengaduan->attachment = $path;
        }

        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah dihapus.');
    }
}