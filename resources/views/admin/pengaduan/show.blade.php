@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Detail Pengaduan</h3>

        <div class="card p-4">
            <p><strong>Nama:</strong> {{ $pengaduan->nama }}</p>
            <p><strong>Email:</strong> {{ $pengaduan->email }}</p>
            <p><strong>No HP:</strong> {{ $pengaduan->no_hp }}</p>
            <p><strong>Tanggal:</strong> {{ $pengaduan->tanggal }}</p>
            <p><strong>Lokasi:</strong> {{ $pengaduan->lokasi }}</p>
            <p><strong>Kategori:</strong> {{ $pengaduan->category->name ?? '-' }}</p>
            <p><strong>Deskripsi:</strong> {{ $pengaduan->deskripsi }}</p>
            <p><strong>Bukti:</strong>
                @if ($pengaduan->bukti)
                    <img src="{{ asset('storage/' . $pengaduan->bukti) }}" alt="Bukti Pengaduan"
                        style="max-width: 300px; height: auto;">
                @else
                    Tidak ada
                @endif
            </p>

            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
