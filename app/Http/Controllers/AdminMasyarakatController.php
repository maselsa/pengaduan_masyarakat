<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;

class AdminMasyarakatController extends Controller
{
   public function index()
{
    // Ambil semua masyarakat yang punya minimal 1 pengaduan
    $masyarakat = Masyarakat::withCount('pengaduan') // hitung jumlah pengaduan
        ->with(['pengaduan' => function ($q) {
            $q->latest(); // ambil pengaduan terbaru
        }])
        ->has('pengaduan') // filter hanya yang punya pengaduan
        ->get();

    return view('admin.masyarakat.index', compact('masyarakat'));
}

}
