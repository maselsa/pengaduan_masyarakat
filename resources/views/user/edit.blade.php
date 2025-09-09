@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Pengaduan</h2>

        <form action="{{ route('user.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pengaduan->nama) }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $pengaduan->email) }}"
                    required>
            </div>
            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pengaduan->no_hp) }}"
                    required>
            </div>
            <div class="mb-3">
                <label>Judul Pengaduan</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengaduan->judul) }}"
                    required>
            </div>
            <div class="mb-3">
                <label>Isi Pengaduan</label>
                <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $pengaduan->isi) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Bukti (opsional)</label>
                @if ($pengaduan->bukti)
                    <p>File saat ini:
                        <a href="{{ asset('uploads/' . $pengaduan->bukti) }}" target="_blank">{{ $pengaduan->bukti }}</a>
                    </p>
                @endif
                <input type="file" name="bukti" class="form-control">
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
