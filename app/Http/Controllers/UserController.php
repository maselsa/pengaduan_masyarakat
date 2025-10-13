<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

    $userId = auth()->id();

    $total   = Pengaduan::where('user_id', $userId)->count();
    $pending = Pengaduan::where('user_id', $userId)->where('status', 'pending')->count();
    $proses  = Pengaduan::where('user_id', $userId)->where('status', 'proses')->count();
    $selesai = Pengaduan::where('user_id', $userId)->where('status', 'selesai')->count();
    $tolak   = Pengaduan::where('user_id', $userId)->where('status', 'tolak')->count();

    return view('user.dashboard', compact('total', 'pending', 'proses', 'selesai', 'tolak'));

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
