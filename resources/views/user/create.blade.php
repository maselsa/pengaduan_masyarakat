@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')
    <div class="container">
        <h2 class="mb-4">Buat Pengaduan</h2>

        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
            </div>
            <div class="mb-3">
                <label>Judul Pengaduan</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
            </div>
            <div class="mb-3">
                <label>Isi Pengaduan</label>
                <textarea name="isi" class="form-control" rows="5" required>{{ old('isi') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Bukti (opsional)</label>
                <input type="file" name="bukti" class="form-control">
            </div>
            <button class="btn btn-primary">Kirim</button>
        </form>
    </div>
@endsection
