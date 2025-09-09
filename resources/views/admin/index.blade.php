@extends('layouts.app')

@section('title', 'Daftar Pengaduan')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengaduan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mb-3">+ Buat Pengaduan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        <a href="{{ route('pengaduan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('pengaduan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pengaduan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
