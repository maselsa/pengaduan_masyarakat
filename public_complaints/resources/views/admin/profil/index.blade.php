@extends('layouts.app')

@section('title', 'Profil Admin')

@section('content')
    <div class="container">
        <h3 class="mb-4 text-pink fw-bold">Profil Saya 🍓</h3>

        @if (session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card shadow rounded-4 border-0 p-4" style="background:#e6f0ff;">
            <div class="text-center mb-4">
                <!-- Foto Profil -->
                @if ($admin->foto)
                    <img src="{{ asset('storage/' . $admin->foto) }}" class="rounded-circle shadow mb-3"
                        style="width:120px; height:120px; object-fit:cover;">
                @else
                    <img src="{{ asset('assets/img/default.jpg') }}" class="rounded-circle shadow mb-3"
                        style="width:120px; height:120px; object-fit:cover;">
                @endif

                <h4 class="text-dark">{{ $admin->name }}</h4>
                <p class="text-muted mb-0">{{ $admin->email }}</p>
            </div>

            <hr>

            <!-- Form Update Profil -->
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" class="form-control rounded-3" value="{{ $admin->name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ubah Foto Profil</label>
                    <input type="file" name="foto" class="form-control rounded-3">
                </div>

                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                    save 📥
                </button>
            </form>
        </div>
    </div>
@endsection
