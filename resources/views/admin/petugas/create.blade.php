@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Tambah Petugas</h3>

        <form action="{{ route('admin.petugas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="petugas">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
