<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Pengaduan;

class AdminController extends Controller
{
    public function index()
    {
    $totalKategori = Category::count();
    $totalPengaduan = Pengaduan::count();
    $pengaduanPending = Pengaduan::where('status', 'pending')->count();
    $pengaduanProses = Pengaduan::where('status', 'proses')->count();
    $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();

    $categories = Category::withCount('pengaduan')->get();
    $categoryNames = $categories->pluck('name');
    $pengaduanCounts = $categories->pluck('pengaduan_count');

    return view('admin.dashboard', compact(
        'totalKategori',
        'totalPengaduan',
        'pengaduanPending',
        'pengaduanProses',
        'pengaduanSelesai',
        'categoryNames',
        'pengaduanCounts'
    ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
