<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Masyarakat;
use App\Models\Pengaduan;


class AdminMasyarakatController extends Controller
{
    public function index()
{
    $masyarakat = User::where('role', 'user')
        ->with('pengaduan')
        ->get();

    return view('admin.masyarakat.index', compact('masyarakat'));
}
}
