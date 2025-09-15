@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <div class="text-center p-4 mb-4 rounded" style="background: linear-gradient(135deg, #ffb6c1, #ff69b4); color: white;">
            <h1>💕 Selamat Datang di Sistem Pengaduan Masyarakat 💕</h1>
            <p>🌸 Silakan ajukan atau kelola pengaduan sesuai hak akses Anda 🌷</p>

            {{-- Link Form Pengaduan hanya untuk user --}}
            @if (auth()->user()->role == 'user')
                <a href="{{ route('user.pengaduan.create') }}" class="btn btn-light mt-3">
                    ✍️ Buat Pengaduan 💌
                </a>
            @endif
        </div>

        {{-- Tambahan Dashboard Pinky --}}
        <div class="row text-center">
            <!-- Jumlah Pengaduan -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="background-color:#ffc0cb;">
                    <div class="card-body">
                        <h2>💖 {{ \App\Models\Pengaduan::where('email', auth()->user()->email)->count() }}</h2>
                        <p>Jumlah Pengaduan 🌷</p>
                    </div>
                </div>
            </div>

            <!-- Pengaduan Terakhir -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="background-color:#ffb6c1;">
                    <div class="card-body">
                        @php
                            $last = \App\Models\Pengaduan::where('email', auth()->user()->email)
                                    ->latest()->first();
                        @endphp
                        <h2>🕒💕</h2>
                        @if($last)
                            <p><b>Terakhir:</b> {{ $last->tanggal }}<br>💓 {{ ucfirst($last->status) }}</p>
                        @else
                            <p>Belum ada pengaduan 😢💔</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 3 Pengaduan Terbaru -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="background-color:#ff69b4; color:white;">
                    <div class="card-body">
                        <h2>🔥 3 Pengaduan Terbaru 💕</h2>
                        <ul class="list-unstyled">
                            @foreach(\App\Models\Pengaduan::where('email', auth()->user()->email)->latest()->take(3)->get() as $p)
                                <li>➡️ {{ $p->deskripsi }} ({{ ucfirst($p->status) }}) 💖</li>
                            @endforeach
                            @if(\App\Models\Pengaduan::where('email', auth()->user()->email)->count() == 0)
                                <li>Belum ada pengaduan 😅💞</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert mt-4 text-center" style="background-color:#ffe4e1; color:#ff1493; font-weight:bold;">
            💕 Terima kasih sudah mempercayakan pengaduan Anda 💕  
            Kami siap mendengarkan & menanggapi dengan sepenuh hati 🌸💖
        </div>
    </div>
@endsection