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
            <p><strong>Isi Pengaduan:</strong> {{ $pengaduan->isi }}</p>

            @if($pengaduan->bukti)
                <p><strong>Bukti:</strong></p>
                <a href="{{ asset('uploads/'.$pengaduan->bukti) }}" target="_blank">
                    <img src="{{ asset('uploads/'.$pengaduan->bukti) }}" 
                         alt="Bukti" class="img-thumbnail" width="200">
                </a>
            @else
                <p><strong>Bukti:</strong> Tidak ada</p>
            @endif
        </div>
    </div>

    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
