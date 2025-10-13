<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminMasyarakatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari form pencarian
        $search = $request->input('search');

        // Query dasar: ambil semua user dengan role 'user'
        $query = User::where('role', 'user')->with('pengaduan');

        // Kalau user mengetik sesuatu di kolom search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Ambil hasilnya
        $masyarakat = $query->get();

        // Kirim ke view
        return view('admin.masyarakat.index', compact('masyarakat'));
    }
}
