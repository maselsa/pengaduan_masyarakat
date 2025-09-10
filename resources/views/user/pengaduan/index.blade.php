@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Daftar Pengaduan</h3>

        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary mb-3">Buat Pengaduan</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->lokasi }}</td>
                        <td>{{ $p->category->nama ?? '-' }}</td>
                        <td>
                            <span
                                class="badge bg-{{ $p->status == 'pending' ? 'warning' : ($p->status == 'proses' ? 'info' : 'success') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('user.pengaduan.show', $p->id) }}" class="btn btn-sm btn-info">Detail</a>
                            @if ($p->status == 'pending')
                                <a href="{{ route('user.pengaduan.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endif
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
