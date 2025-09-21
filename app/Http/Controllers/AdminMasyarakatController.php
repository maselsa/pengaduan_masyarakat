<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;

class AdminMasyarakatController extends Controller
{
    public function index()
    {
        // ambil semua masyarakat dengan jumlah pengaduannya
        $masyarakat = Masyarakat::withCount('pengaduan')->get();

        return view('admin.masyarakat.index', compact('masyarakat'));
    }
}
