@extends('layouts.app')

@section('title', 'Data Pengaduan')

@section('content')
    <div class="container">
        <h2 class="mb-4">Data Pengaduan</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mb-3">+ Buat Pengaduan</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengaduans as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>
                            <span class="badge bg-info">{{ $p->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pengaduan.show', $p->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('pengaduan.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pengaduan.destroy', $p->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data pengaduan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $pengaduans->links() }}
    </div>
@endsection
