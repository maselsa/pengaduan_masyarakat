@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Pengaduan</h3>

        <form action="{{ route('user.pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $pengaduan->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $pengaduan->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- No HP --}}
            <div class="form-group mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                    value="{{ old('no_hp', $pengaduan->no_hp) }}" required>
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="form-group mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                    value="{{ old('tanggal', $pengaduan->tanggal) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div class="form-group mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                    value="{{ old('lokasi', $pengaduan->lokasi) }}" required>
                @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="form-group mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $pengaduan->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="form-group mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Bukti --}}
            <div class="form-group mb-3">
                <label>Bukti (opsional)</label>
                <input type="file" name="bukti" class="form-control @error('bukti') is-invalid @enderror">
                @if ($pengaduan->bukti)
                    <p>File lama: <a href="{{ asset('storage/' . $pengaduan->bukti) }}" target="_blank">Lihat Bukti</a></p>
                @endif
                @error('bukti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-2">Update</button>
            <a href="{{ route('user.pengaduan.index') }}" class="btn btn-secondary mt-2">Batal</a>
        </form>
    </div>
@endsection
