@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex justify-content-center align-items-center" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
    <div class="card shadow-lg p-5 text-center" style="border-radius: 25px; max-width: 700px; width: 100%; background: white;">
        <h1 style="color:#d63384; font-weight:bold;">🌸 Selamat Datang, {{ Auth::user()->name }} 🌸</h1>
        <p class="mt-3 mb-4" style="font-size: 1.2rem; color:#6c757d;">
            Kamu berhasil login ke <strong>Aplikasi Pengaduan Masyarakat</strong> 💌  
        </p>

        <div class="d-flex justify-content-center gap-4">
            <a href="#" class="btn btn-lg text-white" style="background-color:#ff4d6d; border-radius:50px; font-weight:bold;">
                Buat Pengaduan
            </a>
            <a href="#" class="btn btn-lg text-white" style="background-color:#c471ed; border-radius:50px; font-weight:bold;">
                Lihat Riwayat
            </a>
        </div>

        <div class="mt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                    Logout 🚪
                </button>
            </form>
        </div>
    </div>
</div>
@endsections
