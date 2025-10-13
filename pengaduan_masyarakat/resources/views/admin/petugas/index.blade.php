@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Data Petugas 👮</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary mb-3">👮 Add Petugas</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($petugas as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->role }}</td>
                        <td>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('yakin mau hapus petugas ini? 💔')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill">delete💔</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
