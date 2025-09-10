@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <h1>Selamat Datang di Sistem Pengaduan Masyarakat</h1>
        <p>Silakan ajukan atau kelola pengaduan sesuai hak akses Anda.</p>

        {{-- Link Form Pengaduan hanya untuk user --}}
        @if (auth()->user()->role == 'user')
            <a href="{{ route('user.pengaduan.create') }}" class="btn btn-success mt-3">Buat Pengaduan</a>
        @endif
    </div>
@endsection
