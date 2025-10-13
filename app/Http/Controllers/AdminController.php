<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Pengaduan;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {
        $totalKategori = Category::count();
        $totalPengaduan = Pengaduan::count();
        $pengaduanPending = Pengaduan::where('status', 'pending')->count();
        $pengaduanProses = Pengaduan::where('status', 'proses')->count();
        $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();
        $pengaduanTolak = Pengaduan::where('status', 'tolak')->count();

        // Data chart kategori
        $categories = Category::withCount('pengaduan')->get();
        $categoryNames = $categories->pluck('name');
        $pengaduanCounts = $categories->pluck('pengaduan_count');

        // Ambil 5 pengaduan terbaru
        $pengaduanTerbaru = Pengaduan::with('user')->latest()->take(20)->get();

        // Ambil 5 user terbaru dengan role masyarakat
        $masyarakatTerbaru = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();


        return view('admin.dashboard', compact(
            'totalKategori',
            'totalPengaduan',
            'pengaduanPending',
            'pengaduanProses',
            'pengaduanSelesai',
            'pengaduanTolak',
            'categoryNames',
            'pengaduanCounts',
            'pengaduanTerbaru',
            'masyarakatTerbaru'
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
