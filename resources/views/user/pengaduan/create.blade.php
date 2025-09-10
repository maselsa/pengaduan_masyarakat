@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Buat Pengaduan Baru</h3>

    <form action="{{ route('user.pengaduan.create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama --}}
        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama') }}" required>
            @error('nama') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" required>
            @error('email') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- No HP --}}
        <div class="form-group mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" 
                   class="form-control @error('no_hp') is-invalid @enderror" 
                   value="{{ old('no_hp') }}" required>
            @error('no_hp') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div class="form-group mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" 
                   class="form-control @error('tanggal') is-invalid @enderror" 
                   value="{{ old('tanggal') }}" required>
            @error('tanggal') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Lokasi --}}
        <div class="form-group mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" 
                   class="form-control @error('lokasi') is-invalid @enderror" 
                   value="{{ old('lokasi') }}" required>
            @error('lokasi') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="form-group mb-3">
            <label>Kategori</label>
            <select name="category_id" 
                    class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
            <textarea name="deskripsi" rows="4" 
                      class="form-control @error('deskripsi') is-invalid @enderror" 
                      required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Bukti --}}
        <div class="form-group mb-3">
            <label>Bukti (opsional)</label>
            <input type="file" name="bukti" 
                   class="form-control @error('bukti') is-invalid @enderror">
            @error('bukti') 
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Kirim Pengaduan</button>
    </form>
</div>
@endsection
