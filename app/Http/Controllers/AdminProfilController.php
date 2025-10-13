<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AdminProfilController extends Controller
{
    public function index()
    {
        $admin = Auth::user(); // ambil admin yang login
        return view('admin.profil.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin->name = $request->name;

        if ($request->hasFile('foto')) {
            // hapus foto lama kalau ada
            if ($admin->foto && Storage::exists('public/' . $admin->foto)) {
                Storage::delete('public/' . $admin->foto);
            }
            // simpan foto baru
            $path = $request->file('foto')->store('foto', 'public');
            $admin->foto = $path;
        }

        $admin->save();

        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
