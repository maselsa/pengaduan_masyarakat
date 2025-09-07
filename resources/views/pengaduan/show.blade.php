@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Pengaduan</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $pengaduan->nama }}</p>
                <p><strong>Email:</strong> {{ $pengaduan->email }}</p>
                <p><strong>No HP:</strong> {{ $pengaduan->no_hp }}</p>
                <p><strong>Judul:</strong> {{ $pengaduan->judul }}</p>
                <p><strong>Isi:</strong> {{ $pengaduan->isi }}</p>
                <p><strong>Status:</strong> <span class="badge bg-info">{{ $pengaduan->status }}</span></p>

                @if ($pengaduan->bukti)
                    <p><strong>Bukti:</strong></p>
                    <img src="{{ asset('storage/' . $pengaduan->bukti) }}" width="200" alt="Bukti">
                @endif
            </div>
        </div>

        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
